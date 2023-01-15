<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Profile;
use App\User;
use App\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Image;
use App\Http\Resources\ProductResource;
use App\Http\Resources\StoreResource;
use Laravolt\Avatar\Facade as Avatar;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{

    public function createStore(Request $request)
    {
        $request->validate([
            'from' => 'required|string|max:3',
            'name' => 'required|string|max:255',
            'category' => 'required',
            'description' => 'required|string|max:3000',
            'email' => 'required|email|unique:profiles',
            'phone' => 'required|numeric|unique:profiles',
            'address' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'town' => 'required|string|max:255',
            'founder_name' => 'required|string|max:80',
        ]);
        $user = Auth::user();

        $store =  Profile::create([
            'store_name' => ucfirst($request->name),
            'type' => $request->category,
            'description' => $request->description,
            'store_id' => $request->from === 'app' ? generateStoreId('AP') : generateStoreId('WB'),
            'adress' => $request->address,
            'country' => $request->country,
            'state' => $request->state,
            'town' => $request->town ?? '',
            'phone' => phoneNumber($request->phone),
            'logo' => $request->logo ?? "\/storage\/boutique\/images\/02052021608e952bb3331site_kali_icon.png",
            'document' => $document ?? '',
            'images' => $document2 ?? '',
            'founder_name' => $request->founder_name,
            'capital_price' => $request->capital_price ?? 0,
            'email' => $request->email,
            'slug' => slugify($request->name . uniqid()),
        ]);



        if ($store) {
            if ($request->newEmail) {

                $user->store_id = $store->store_id;
                $user->isSeller = 1;
                $user->email = $store->email;
                $user->email_verified_at = NOW();
                $user->role_id = 3;
                $user->save();

                // User::where('phone', $store->phone)->update([
                //     'store_id' => $store->store_id,
                //     'isSeller' => 1,
                //     'email'    => $store->email,
                //     'email_verified_at' => NOW(),
                //     'role_id' => 3,
                //     /*'type' => $store->type,*/
                // ]);
            } else if ($request->newPhone) {
                User::where('email', $store->email)->update([
                    'store_id' => $store->store_id,
                    'isSeller' => 1,
                    'phone'    => phoneNumber($request->phone),
                    'phone_verified_at' => NOW(),
                    'role_id' => 3,
                    /*'type' => $store->type,*/
                ]);
            } else {
                User::where('email', $store->email)->orWhere('phone', $store->phone)->update([
                    'store_id' => $store->store_id,
                    'isSeller' => 1,
                    'role_id' => 3,
                    /* 'type' => $store->type,*/
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Votre boutique à été crée  avec succès',
                'data' => $store,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Votre boutique n\'a pas été crée',
                'data' => [],
            ], 200);
        }

        // $store = new StoreResource($request->all());
        // $store->save();

        // $store->image = $request->image->store('uploads', 'public');
        // $store->save();


    }

    public function checkoutPlanSubscription(Request $request)
    {
        // init
        $data = [];
        $ref = rand(10000000, 99999999);

        $request->validate([
            'amount' => 'present|required|numeric',
            'reference' => 'present|required|string',
            'type' => 'present|required|string',
            // 'payment_method' => 'present|required|string',
        ]);

        $setNewPlan =  DB::table('transactions')->insert([
            'amount' => $request->amount,
            'reference' => $ref,
            'object' => $request->type . ' ' . $request->reference,
            'user' => Auth::id(),
            'status' => 'En attente',
            'created_at' => now(),
            'updated_at' => now()
        ]);


        // return $setNewPlan;

        if ($setNewPlan) {

            DB::table('subscriptions')->insert([
                'user_id' => Auth::id(),
                'name' => $request->type,
                'stripe_id'  => $ref,
                'stripe_status' => 'pending',
                'stripe_plan' => $request->reference,
                'quantity'  => 1,
                'trial_ends_at' => date('Y-m-d H:m:s', strtotime('+14 days')),
                'ends_at'  =>  date('Y-m-d H:m:s', strtotime('+1 month')),
                'created_at' => now(),
                'updated_at' => now()
            ]);

            $getPlan = DB::table('subscriptions')->where('stripe_id', $ref)->first();

            $request->merge([
                'Reference' => $ref
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Plan successfully set',
                'data' => [$getPlan, Epay($request)],
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Plan not set'
            ]);
        }
    }

    public function getStoreInfo(Request $request)
    {
        $request->validate([
            'email' => 'required_without:store_id|email',
            'store_id' => 'required_without:email|string',
            'slug' => 'required_without:email,store_id|string',
        ]);

        $find = Profile::where('store_id', $request->get('store_id'))
            ->orWhere('email', $request->get('email'))
            ->orWhere('slug', $request->get('slug'))
            ->with('products')->first();

        if (!empty($find)) {
            return response()->json([
                'success' => true,
                'data' => StoreResource::collection([$find]),
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'data' => [],
            ], 200);
        }
    }
}
