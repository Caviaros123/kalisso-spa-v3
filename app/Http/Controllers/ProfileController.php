<?php

namespace App\Http\Controllers;

use \App\Category;
use \App\Product;
use \App\Boutique;
use \App\Profile;
use \App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Image;


class ProfileController extends Controller
{


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'store_name' => ['required', 'string', 'max:255'],
            'store_id' => ['required'],
            'type' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'numeric', 'unique:users'],
            'logo' => ['required', 'image'],
            'images' => ['required', 'image'],
            'document' => ['required', 'image'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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
        return Profile::create([
            'store_name' => $data['name'],
            'store_id' => $data['store_id'],
            'type' => $data['type'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'logo' => $data['logo'],
            'document' => $data['document'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         function slugify($text)
        {
          // replace non letter or digits by -
          $text = preg_replace('~[^\pL\d]+~u', '-', $text);

          // transliterate
          $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

          // remove unwanted characters
          $text = preg_replace('~[^-\w]+~', '', $text);

          // trim
          $text = trim($text, '-');

          // remove duplicate -
          $text = preg_replace('~-+~', '-', $text);

          // lowercase
          $text = strtolower($text);

          if (empty($text)) {
            return 'n-a';
          }

          return $text;
        }
        // $this->validate($request, [
        //     'document' => 'required',
        //     'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        //     'store_name' => 'required',
        //     'type' => 'required',
        //     'description' => 'required',
        //     'store_id' => 'required',
        //     'address' => 'required', 
        //     'country' => 'required',
        //     'town' => 'required',
        //     'phone' => 'required',
        //     'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        //     'document'=> 'required|image|mimes:jpeg,png,jpg|max:2048',
        //     'founder_name' => 'required',
        //     'capital_price' => 'required',
        //     'email' => 'required',
            
        // ]);
        // dd($request->all());
        

        if ($request->file('logo') != null ) {

            if ($request->file('document') != null) {
                $documentRecto = $request->file('document')[0];
                $documentVerso = $request->file('document')[1];

                $filename2 = str_replace('-','', date('d-m-Y').uniqid().$documentRecto->getClientOriginalName());
                $filename3 = str_replace('-','', date('d-m-Y').uniqid().$documentVerso->getClientOriginalName());

                $documentRecto->move(public_path().'/storage/boutique/images/',$filename2);
                $documentVerso->move(public_path().'/storage/boutique/images/',$filename3);

                $image_resize2 = Image::make(public_path().'/storage/boutique/images/'.$filename2);
                $image_resize2->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                 })->save(public_path('/storage/boutique/images/' .$filename2));


                 $image_resize3 = Image::make(public_path().'/storage/boutique/images/'.$filename3);
                 $image_resize3->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                 })->save(public_path('/storage/boutique/images/' .$filename3));


                $document =  json_encode('/storage/boutique/images/'.$filename2);
                $document2 =  json_encode('/storage/boutique/images/'.$filename3);


            } 
            
           
            $image = $request->file('logo');
            

            // dd($request->file('document')[1]);

            $filename = str_replace('-','', date('d-m-Y').uniqid().$image->getClientOriginalName());
           
            $image->move(public_path().'/storage/boutique/images/',$filename);
            

            $image_resize = Image::make(public_path().'/storage/boutique/images/'.$filename);
            $image_resize->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
             })->save(public_path('/storage/boutique/images/' .$filename));

            


            $logo =  json_encode('/storage/boutique/images/'.$filename);
           
            try {

                    Profile::create([
                   
                        'store_name' => $request->store_name,
                        'type' => $request->type,
                        'description' => $request->description,
                        'store_id' => $request->store_id,
                        'adress' => $request->adress, 
                        'country' => $request->country,
                        'town' => $request->town,
                        'phone' => $request->phone,
                        'logo' => $logo ?? '',
                        'document' => $document ?? '',
                        'images' => $document2 ?? '',
                        'founder_name' => $request->founder_name,
                        'capital_price' => $request->capital_price,
                        'email' => $request->email,
                        'slug' => slugify($request->store_name),

                   ]);

                if (auth()->user()) {
                    
                    User::where('email', $request->email)->orWhere('phone', $request->phone)->update( [
                        'store_id' => $request->store_id,
                        'isSeller' => true,
                        'role_id' => 3,
                        'avatar' => 'boutique/images/'.$filename
                        
                    ]);
                } 
                
                
               session()->flash('success_message', 'Félicitations votre boutique est en cours de validation !');

               return redirect('/plans');
                
            } catch (Exception $e) {

                return back()->with('errors', $e->getMessage());
                
            }


        } else {
            

                try {

                    Profile::create([
                   
                        'store_name' => $request->store_name,
                        'type' => $request->type,
                        'description' => $request->description,
                        'store_id' => $request->store_id,
                        'adress' => $request->adress, 
                        'country' => $request->country,
                        'town' => $request->town,
                        'phone' => $request->phone,
                        'logo' => $logo ?? '',
                        'document' => $document ?? '',
                        'images' => $document2 ?? '',
                        'founder_name' => $request->founder_name,
                        'capital_price' => $request->capital_price,
                        'email' => $request->email,
                        'slug' => slugify($request->store_name),

                   ]);

                if (auth()->user()) {
                    
                    User::where('email', $request->email)->orWhere('phone', $request->phone)->update( [
                        'store_id' => $request->store_id,
                        'isSeller' => true,
                        'role_id' => 3,
                        'avatar' => "users/default.png"
                        
                    ]);
                } 
                
                
               session()->flash('success_message', 'Félicitations votre boutique est en cours de validation !');

               return redirect('/plans');
                
            } catch (Exception $e) {

                return back()->with('errors', $e->getMessage());
                
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
        $data = User::findOrFail($id);

        return view('dashboard.profile.index',compact('data'));
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
    public function update(Request $request, $id)
    {
        //
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
