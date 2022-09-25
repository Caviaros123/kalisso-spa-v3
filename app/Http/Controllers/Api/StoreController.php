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
            'from' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'category' => 'required',
            'description' => 'required|string|max:3000',
            'email' => 'required|email|unique:profiles',
            'phone' => 'required|numeric|unique:profiles',
            'address' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'town' => 'required|string|max:255',
            'founder_name' => 'required|string|max:255',
        ]);


        // return $request->form;

        // $avatar = Avatar::create($request->name)->save('sample.jpg', 75);

        // return $avatar;

        //create avatar with charcter name

        // $avatar = Avatar::create($request->name)->save('sample.jpg', 50);

        $store =  Profile::create([
            'store_name' => ucfirst($request->name),
            'type' => $request->category,
            'description' => $request->description,
            'store_id' => $request->from === 'app' ? generateStoreId('AP') : generateStoreId('WB'),
            'adress' => $request->address, 
            'country' => $request->country,
            'state' => $request->state,
            'town'=> $request->town ?? '',
            'phone' => $request->phone,
            'logo' => $request->logo ?? "\/storage\/boutique\/images\/02052021608e952bb3331site_kali_icon.png",
            'document' => $document ?? '',
            'images' => $document2 ?? '',
            'founder_name' => $request->founder_name ,
            'capital_price' => $request->capital_price ?? 0,
            'email' => $request->email,
            'slug' => slugify($request->name),
       ]);

    //    return $store;

       if($store){
           
           if($request->newEmail){
               User::where('phone', $request->phone)->update([
                   'store_id' => $store->store_id,
                   'isSeller' => true,
                   'email'    => $request->email,
                   'role_id' => 3,
                   /*'type' => $store->type,*/
               ]);
           }else {
                User::where('email', $request->email)->orWhere('phone', $request->phone)->update([
                    'store_id' => $store->store_id,
                    'isSeller' => true,
                    'role_id' => 3,
                   /* 'type' => $store->type,*/
                ]);
           }

           return response()->json([
                'success' => true,
                'message' => 'Votre boutique à été crée  avec succès',
                'data' => $store,
            ], 200);
       }else{
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
            'object'=> $request->type.' '.$request->reference,
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
                'data' => [$getPlan , Epay($request)],
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
            'slug' => 'string',
            'email' => 'email',
            'store_id' => 'string',
        ]);

        $find = Profile::where('slug', $request->slug)
                        ->orWhere('id', $request->store_id)
                        ->orWhere('store_id', $request->store_id)
                        ->orWhere('email', $request->email)
                        ->with('products')->get();

        if(count($find) ==! 0){
            return response()->json([
                'success' => true,
                // 'datas' => $find,
                'data' => StoreResource::collection($find),
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'data' => [],
            ], 200);
        }
    }
}
