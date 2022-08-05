<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use RegistersUsers;
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

     
        $data = $request->all();

        $validate = Validator::make($data, [
            'role_id' => ['required', 'numeric', 'max:1'],
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'birthdate' => ['required', 'date'],
            'firstname' => ['required', 'string', 'max:255'],
            'type' => ['required',  'numeric', 'max:1'],
            'phone' => ['required', 'numeric', 'max:12', 'min:9'],
            'cellule' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        // dd($validate);
        if ($validate) {
            # code...
            try {
                User::create([
                    'role_id' => $request->role_id,
                    'gender' => $request->gender,
                    'birthdate' => $request->birthdate,
                    'name' => $request->name,
                    'firstname' => $request->firstname,
                    'type' => $request->type,
                    'email' => $request->email ?? null,
                    'avatar' => 'users/default.png',
                    'password' => Hash::make($request->password),
                    'phone' => phoneNumber($request->phone),
                    'addess' => $request->address,
                    'cellule' => $request->cellule,
                    'created_by' => $request->created_by,
                    'remember_token' => csrf_token(),
                    'code' => null
        
                ]);
                session()->flash('success', 'Vous avez ajouter un nouvel utilisateur');

            } catch (\Throwable $th) {
                return back()->with('errors', $th);
            }
             
            
        }else{
            return back()->with('errors', ' echec de validation');
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->get();
        return back()->with('data', compact('user'));
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
        User::where('id', $id)->delete();
        return back()->with('success', 'Vous avez supprimer membre');
    }
}
