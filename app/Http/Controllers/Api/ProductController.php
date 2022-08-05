<?php

namespace App\Http\Controllers\Api;

use Image;
use App\Models\Product;
use App\Models\Profile;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\StoreResource;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index()
    {
        # code...
        //in reandom order
        $products = Product::inRandomOrder()->get();
        // $products = Product::all()->inRandom();

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
     * @return \App\Models\User
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
            'id' => 'required|numeric',
            'slug' => 'string',
        ]);
        
        $product = Product::where('id', $request->id)->orWhere('slug', $request->slug)->first();

        $rs = json_decode($product->category);

        $category = Category::whereIn('id', $rs)->get(['id','name']);

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
          
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function creat()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpg,jpeg,png,svg,gif',
            // 'details' => 'required|string|max:45',
            // 'description' => 'required|string|max:4000',
            // 'price' => 'required',
            // 'stock' => 'required',
            // 'featured' => 'required',
            // 'store_id' => 'required|string',
            // 'livraison' => 'required|string|max:255',
            // 'etat' => 'required|string|max:255',
            // 'location' => 'required|string|max:255',
            // 'category' => 'required',
        ]);

         if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data'=> $validator->errors(),
            ], 400);
        }

        // init
        $input=$request->all();
        $images= array();
        $path = public_path().'/storage/products/'.date('FY');

        if(!is_dir($path)){
            mkdir($path, 0755, true);
        }else{
            $path = $path.'/';
        }
        
        // return $path;

        if ($request->file('image') && Auth::user()) {
                
            if($request->hasFile('images')) {
                // $validator = Validator::make($request->get('images'), [
                //     'images' => 'required|image|mimes:jpg,jpeg,png,svg,gif',
                // ]);

                //  if ($validator->fails()) {
                //     return response()->json([
                //         'success' => false,
                //         'message' => 'Echec de validation'
                //     ], 400);
                // }

               $files = $request->file('images');

                foreach($files as $file) {
                    $name= str_replace('-','', date('d-m-Y').time().$file->getClientOriginalName());
                    $file->move($path,$name);

                    $resize = Image::make($path.$name);
                    $resize->resize(null, 627, function ($constraint) {
                        $constraint->aspectRatio();
                    });

                    $images[]= 'products/'.date('FY').'/'.$name;
                }
                
            }  
           
            $image = $request->file('image');
            // dd($request->file('document')[1]);
            $filename = str_replace('-','', date('d-m-Y').uniqid().$image->getClientOriginalName());
            $image->move($path,$filename);
            $image_resize = Image::make($path.$filename)->encode('jpg', 50);
            $image_resize->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
             })->save($path.$filename, '50', 'jpg');
            $logo =  'products/'.date('FY').'/'.$filename;


            // $photo = $request->file("image");
            // $ext = $photo->getClientOriginalExtension();
            // $fileName = rand(10000, 50000) . '.' .$ext;

            // $thumbSm = 'thumb_sm' . rand(10000, 50000) . '.' .$ext;

            // $image = Image::make($request->file('image'));
            // $image->save(public_path().'/storage/products/images/'. $fileName);
            // $image->resize(120, 120);
            // $image->save(public_path().'/storage/products/images/'. $thumbSm);

            $storeData = Profile::where('email', Auth::user()->email)->first();
           
            try {

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
                    'category' =>  $request->category,
                    'image' => $logo,
                    'images' =>  json_encode($images) ?? null,
                    'email' => $storeData->email,//store infos
                    'store_id' => $storeData->store_id,//store infos
                    'location' => $storeData->town,//store infos
               ]);

              return response()->json([
                  "status"=> 200,
                  "msg" => "Success",
                  "data" => $request->all()
              ], 200);
                
            } catch (Exception $e) {

                return response()->json([
                      "status"=> 400,
                      "msg" => $e->getMessage(),
                      "data" => []
                  ], 400);
                
            }


        } 
    }


    public function productReview(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status'=> 'required',
            'product_id' => 'required|numeric',
            'review_rating'=> 'required|numeric',
            'review'=> 'required|string|max:1000',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }else{
            try {
                \DB::table('tbl_review')->insert([
                    'status'=> $request->status,
                    'review_name' => Auth::user()->name,
                    'user_id' => Auth::id(),
                    'product_id' => $request->product_id,
                    'review_rating'=> (int) $request->review_rating,
                    'review'=> $request->review,
                    'created_at'=> NOW(),
                    'updated_at'=> NOW()
               ]);

                $data = \DB::table('tbl_review')->where('user_id', Auth::id())->latest()->take(1)->get();

                foreach($data as $k => $v){
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
            ], 404);
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
        }else{
               if (Auth::user()) {
                  Product::where('id',$request->id)->update([
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
