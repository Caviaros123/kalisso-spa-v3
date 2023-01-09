<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Profile;
use App\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Image;
use App\Http\Resources\ProductResource;
use App\Http\Resources\StoreResource;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();

        $this->response['message'] = 'success';
        $this->response['data'] = ProductResource::collection($products);

        return response()->json($this->response, 200);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:45'],
            'slug' => ['required'],
            'details' => ['required', 'string', 'max:45'],
            'description' => ['required', 'string', 'max:3000'],
            'price' => ['required', 'numeric'],
            'stock' => ['required', 'numeric'],
            'featured' => ['required', 'boolean'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'store_id' => ['required', 'string', 'max:255', 'unique:users'],
            'livraison' => ['required', 'string', 'max:255'],
            'etat' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'category' => ['required'],
            'image' => ['required', 'image'],
            'images' => ['required', 'image'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return Product::create([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'details' => $data['details'],
            'description' => $data['description'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'featured' => $data['featured'],
            'email' => $data['email'],
            'store_id' => $data['store_id'],
            'livraison' => $data['livraison'],
            'etat' => $data['etat'],
            'location' => $data['location'],
            'category' => $data['category'],
            'image' => $data['image'],
            'images' => $data['images'],
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProductInfo(Request $request)
    {

        $request->validate([
            "id" => "required|numeric",
        ]);

        $product = Product::find($request->id);

        if($product){
            $rs = json_decode($product->category);
    
            $category = Category::whereIn('id', $rs)->get(['id', 'name']);
    
            $product['category'] = json_encode($category);
    
            if ($product != null) {
                return response()->json([
                    'success' => true,
                    'data' => $product
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'data' => []
                ], 404);
            }
        }else{
            return response()->json([
                'success' => false,
                'data' => []
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'details' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,svg,gif',
            'images' => 'array',
            // 'details' => 'required|string|max:45',
            'description' => 'required|string|max:5000',
            'price' => 'required',
            'stock' => 'required',
            // 'featured' => 'required',
            // 'store_id' => 'required|string',
            'livraison' => 'required|string|max:255',
            'etat' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'category' => 'required',
        ]);

        // init
        $storeData = Profile::where('email', Auth::user()->email)
            ->orWhere('store_id', Auth::user()->store_id)->firstOrFail();


        $input = $request->all();
        $images = $request->file('images') ?? [];
        $image = null;
        $multipleImage = [];
        $categories = [];
        $path = public_path() . '/storage/products/' . date('FY');

        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        } else {
            $path = $path . '/';
        }

        // return $path;
        if ($request->hasFile('image')) {
            try {
                // //If multiples images
                if ($request->hasFile('images')) {

                    $files = $request->file('images');

                    foreach ($files as $file) {
                        $chemins = $file->store('products/' . date('FY'));
                        $multipleImage[] = $chemins;
                    }
                }

                $image = $request->file('image')->store('products/' . date('FY'));

                // $categories = array_push($request->category);

                //    array_push($categories, $request->category);
                //    return $request->name;

                if ($storeData) {
                    Product::create([
                        'name' => $request->name,
                        'slug' => slugify($request->name),
                        'details' => $request->details,
                        'description' => $request->description,
                        'price' => $request->price,
                        'stock' => $request->stock,
                        'featured' => $request->featured == "true" ? 1 : 0,
                        'livraison' => $request->livraison,
                        'etat' => $request->etat,
                        'category' => $request->category,
                        'image' => $image,
                        'images' =>  json_encode($multipleImage),
                        'email' => $storeData->email, //store infos
                        'store_id' => $storeData->store_id, //store infos
                        'location' => $storeData->town, //store infos
                    ]);

                    return response()->json([
                        "success" => true,
                        "message" => "Success",
                        "data" => $request->all()
                    ], 200);
                }
            } catch (\Exception $e) {
                return response()->json([
                    "success" => false,
                    "message" => $e->getMessage(),
                    "data" => $request->all()
                ], 200);
            }
        }
    }


    public function productReview(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'product_id' => 'required|numeric',
            'review_rating' => 'required|numeric',
            'review' => 'required|string|max:1000',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        } else {
            try {
                DB::table('tbl_review')->insert([
                    'status' => $request->status,
                    'review_name' => Auth::user()->name,
                    'user_id' => Auth::id(),
                    'product_id' => $request->product_id,
                    'review_rating' => (int) $request->review_rating,
                    'review' => $request->review,
                    'created_at' => NOW(),
                    'updated_at' => NOW()
                ]);

                $data = DB::table('tbl_review')->where('user_id', Auth::id())->latest()->take(1)->get();

                foreach ($data as $k => $v) {
                    $rsData[$k]['id'] = (int) $v->id;
                    $rsData[$k]['name'] = $v->review_name;
                    $rsData[$k]['date'] = date('j F Y', strtotime($v->created_at));
                    $rsData[$k]['rating'] = (int) $v->review_rating;
                    $rsData[$k]['review'] = $v->review;
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Votre avis a été ajouter',
                    'data' => $rsData
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => $e
                ], 200);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric|min:1',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        } else {
            if (Auth::user()) {
                Product::where('id', $request->id)->update([
                    'featured' => 0,
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
