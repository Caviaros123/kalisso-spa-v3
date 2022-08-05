<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carte;
use App\Groupe;
use App\Models\User;
use Composer\Util\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class CarteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.carte.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexGroup()
    {
        return view('pages.carte.group.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function storeGroup (Request $request)
    {
        //dd($request->all());
        $data = $request->all();
        $id = $request->get('user_id');
        $account_id = $request->get('code');
        $user = User::whereIn('id', $id)->get();
        $check = Groupe::find($account_id);

        if (!$user) {   
            return back()->with('errors', 'Echec ces utilisateurs n\'existe pas');
        }else if ($check) {
            return back()->with('errors', 'Echec ce groupe existe déja');
        }else{
            $validate = Validator::make($data, [
                'code' => ['required', 'string', 'max:255'],
                'user_id' => ['required'],
                'amount' => ['required', 'numeric', 'max:1'],
                'name' => ['required', 'string', 'max:255'],
                'created_by' => ['required', 'numeric',  'min:1']
            ]);

            if ($validate) {
                try {
                    Groupe::create([
                        'code' => $account_id,
                        'name' => $request->name,
                        'status' => 'actif',
                        'type' => 'carte',
                        'day' => $request->day,
                        'amount' => $request->amount,
                        'amount_fixed' => $request->amount,
                        'leader_1' => $request->user_id[0],
                        'leader_2' => $request->user_id[1],
                        'leader_3' => $request->user_id[2],
                        'created_by' => auth()->id(),
                    ]);
                    session()->flash('success', 'Vous avez ajouter un groupe');

                    return back();
                } catch (\Exception $e) {
                    return back()->withErrors('Echec de création du groupe' . $e->getMessage());
                }
            }
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

        //dd($request->all());
        $data = $request->all();
        $id = $request->get('user_id');
        $code = $request->get('code');
        $user = User::where('id', $id)->first();
        $check = Carte::where('user_id', $id)->orWhere('code', $code)->first();

        // dd($user ? 'trouvé' : 'pas trouvé');
  
            if (!$user) {   
                return back()->with('errors', 'Echec cette utilisateur n\'existe pas');
            }
            if ($check) {
                return back()->with('errors', 'Echec cette utilisateur à déja un compte');
            }else {

                $validate = Validator::make($data, [
                    'user_id' => ['required', 'numeric', 'min:1'],
                    'amount' => ['required', 'numeric'],
                    'amount_fixed' => ['required', 'numeric'],
                    'code' => ['required', 'string', 'max:255'],
                    'day' => ['required',  'numeric'],
                    'created_by' => ['required', 'numeric', 'min:1']
                ]);
                // dd($validate);
                if ($validate) {
                    try {
                        Carte::create([
                            'user_id' => $request->user_id,
                            'amount' => $request->amount,
                            'amount_fixed' => $request->amount_fixed,
                            'code' => $request->code,
                            'day' => $request->day,
                            'created_by' => auth()->id()
                        ]);
                        session()->flash('success', 'Vous avez ajouter un compte');

                        return back();
                    } catch (\Exception $e) {
                        return back()->withErrors('Echec de création du compte' . $e->getMessage());
                    }
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
        $getUser = Carte::where('id', $id)->first();

        $userName = User::where('id', $getUser->user_id)->first();
        $created_by = User::where('id', $getUser->created_by)->first();

        $getUser['user_id'] = $userName->name;
        $getUser['created_by'] = $created_by->name;

        if ($getUser != null) {
           return response()->json([
                'success' => true,
                'data' => json_encode($getUser)
            ], 200);
        } else{
             return response()->json([
                'success' => false,
                'data' => json_encode($getUser)
            ], 400);
        }
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
        $id = $request->user_id;
        $account_id = $request->code;
        $user = User::where('id', $id)->first();
        $check = Carte::where('user_id', $id)->first();
        if (!$user) {
            return back()->with('errors', 'Echec cette utilisateur n\'existe pas');
        }
        // dd($check ? 'trouvé'.$check : 'pas trouvé');
        if ($request->submit == 'scorecard_deposit') {
            if ($check)  {

                $request->validate([
                    'user_id' => ['required', 'numeric', 'min:1'],
                    'amount' => ['required', 'numeric'],
                    'created_by' => ['required', 'numeric', 'min:1'],

                ]);

                // dd($request->all());

                try {
                   if ($request->amount == $check->amount_fixed && $check->day != 0) {
                       Carte::where('user_id', $id)->update([
                            'amount' => $check->amount + $request->amount,
                            'updated_by' => $request->created_by,
                            'day' => $check->day - 1,
                        ]);
                   }else{
                        return back()->withErrors('Echec du dépot dans ce compte le montant du dépot n\'est pas le bon');
                   }
                    session()->flash('success', 'Vous avez effectuer un dépot');

                    return back();
                } catch (\Exception $e) {
                    return back()->withErrors('Echec du dépot dans ce compte' . $e->getMessage());
                }
            }
        } elseif($request->submit == 'scorecard_withdrawl') {
            if ($check)  {

                $request->validate([
                    'user_id' => ['required', 'numeric', 'min:1'],
                    'amount' => ['required', 'numeric'],
                    'created_by' => ['required', 'numeric', 'min:1'],
                ]);

                // dd($request->all());

                try {
                   if ($request->amount == ($check->amount - $check->amount_fixed) && $check->day != 0) {
                       Carte::where('user_id', $id)->update([
                            'amount' => $check->amount - $request->amount,
                            'updated_by' => $request->created_by,
                            'day' => 0,
                        ]);
                   }else{
                        return back()->withErrors('Echec du retrait dans ce compte le montant du retrait n\'est pas le bon');
                   }
                    session()->flash('success', 'Vous avez effectuer un retrait');

                    return back();
                } catch (\Exception $e) {
                    return back()->withErrors('Echec du retrait dans ce compte' . $e->getMessage());
                }
            }
        }
        
        
       
    }


    public function updateGroup(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'numeric', 'min:1'],
            'amount' => ['required', 'numeric'],
            'created_by' => ['required', 'numeric', 'min:1'],

        ]);

        $id = $request->user_id;
        $account_id = $request->code;
        $user = User::where('id', $id)->first();
        $check = Groupe::where('id', $id)->first();

        
        if (!$check) {
            return back()->with('errors', 'Ce groupe n\'existe pas');
        }
        // dd($check ? 'trouvé'.$check : 'pas trouvé');
        if ($request->submit == 'scorecard_group_deposit') {
          
                // dd($request->all());
                try {
                   if ($request->amount == $check->amount_fixed && $check->day != 0) {
                       Groupe::where('id', $id)->where('type', 'carte')->update([
                            'amount' => $check->amount + $request->amount,
                            'updated_by' => $request->created_by,
                            'day' => $check->day - 1,
                        ]);
                   }else{
                        return back()->withErrors('Echec du dépot dans ce compte le montant du dépot n\'est pas le bon');
                   }
                    session()->flash('success', 'Vous avez effectuer un dépot');

                    return back();
                } catch (\Exception $e) {
                    return back()->withErrors('Echec du dépot dans ce compte' . $e->getMessage());
                }
            
        } elseif($request->submit == 'scorecard_group_withdrawl') {
            
                $request->validate([
                    'user_id' => ['required', 'numeric', 'min:1'],
                    'amount' => ['required', 'numeric'],
                    'created_by' => ['required', 'numeric', 'min:1'],
                ]);

                // dd($request->all());

                try {
                   if ($request->amount == ($check->amount - $check->amount_fixed) && $check->day != 0) {
                       Groupe::where('id', $id)->where('type', 'carte')->update([
                            'amount' => $check->amount - $request->amount,
                            'updated_by' => $request->created_by,
                            'day' => 0,
                        ]);
                   }else{
                        return back()->withErrors('Echec du retrait dans ce compte le montant du retrait n\'est pas le bon');
                   }
                    session()->flash('success', 'Vous avez effectuer un retrait');

                    return back();
                } catch (\Exception $e) {
                    return back()->withErrors('Echec du retrait dans ce compte' . $e->getMessage());
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
       $getUser = Carte::where('id', $id)->delete();

        return back()->with('success', 'Vous avez supprimer un compte avec success');
    }


    public function destroyGroup($id)
    {
          $getUser = Groupe::find($id)->delete();

          return back()->with('success', 'Vous avez supprimer une carte de groupe avec success');
    }


    public function getAmount($id)
    {
        $getUser = Carte::where('user_id', $id)->first();

     
            $data = [
                'amount'=> $getUser->amount,
                'amount_fixed' =>$getUser->amount_fixed,
                'status' => $getUser->day > 0 ? true : false,
            ];
            

            return response()->json([
                'success' => true,
                'data' => json_encode($data)
            ]);
    
       
    }



    public function getGroupAmount($id)
    {
        $getUser = Groupe::where('id', $id)->where('type', 'carte')->first();

        return response()->json([
            'success' => true,
            'data' => json_encode($getUser)
        ]);
    
       
    }
}
