<?php

namespace App\Http\Controllers;

use App\Banque;
use App\Models\User;
use App\Groupe;
use Composer\Util\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\VarDumper\Cloner\Data;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $bank = Banque::all();

        $user = User::all();
        
        
        
        return view('pages.banque.index')->with(compact('user', 'bank'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexGroup()
    {

        $bank = Groupe::all();

        $user = User::all();
        
        
        return view('pages.banque.group.index')->with(compact('user', 'bank'));
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
        // dd($request->all());
        $data = $request->all();
        $id = $request->get('user_id');
        $account_id = $request->get('account_id');
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
                'soldes' => ['required', 'numeric', 'max:1'],
                'account_id' => ['required', 'string', 'max:255'],
                'name' => ['required', 'string', 'max:255'],
                'created_by' => ['required', 'numeric',  'min:1']

            ]);

            if ($validate) {
                try {
                    Groupe::create([
                        'code' => $request->account_id,
                        'name' => $request->name,
                        'status' => 'actif',
                        'type' => 'banque',
                        'amount' => $request->soldes,
                        'leader_1' => $request->user_id[0],
                        'leader_2' => $request->user_id[1],
                        'leader_3' => $request->user_id[2],
                        'created_by' => auth()->id(),
                    ]);

                    activity($request->submit, $status='success', $request->all());

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
        $data = $request->all();
        $id = $request->get('user_id');
        $account_id = $request->get('account_id');
        $user = User::where('id', $id)->first();
        $check = Banque::where('user_id', $id)->orWhere('account_id', $account_id)->first();

        // dd($user ? 'trouvé' : 'pas trouvé');
        
        if (!$user) {   
            return back()->with('errors', 'Echec cette utilisateur n\'existe pas');
        }
        if ($check) {
            return back()->with('errors', 'Echec cette utilisateur à déja un compte');
        }else {

            $validate = Validator::make($data, [
                'user_id' => ['required', 'numeric', 'min:1'],
                'soldes' => ['required', 'numeric', 'max:1'],
                'account_id' => ['required', 'string', 'max:255'],
                'created_by' => ['required', 'numeric',  'min:1']

            ]);
            // dd($validate);
            if ($validate) {
                try {
                    Banque::create([
                        'user_id' => $request->user_id,
                        'soldes' => $request->soldes,
                        'account_id' => $request->account_id,
                        'account_type' => $request->account_type,
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
        $getUser = Banque::where('id', $id)->first();

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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showGroup($id)
    {
        $getUser = Groupe::where('id', $id)->first();

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

    
    public function updateGroup(Request $request)
    {
        // dd($request->all());
        $check = Groupe::where('id', $request->user_id)->first();
        $amount = $request->amount;
        $taxe = ($amount * 3) / 100;
        // dd($request->all());
        $decouvert = $check->decouvert + $amount;
        $deposit_courant = $check->amount + $amount;
        $deposit_epargne = $check->epargne + $amount;
        // $withdrawl_courant = $check->amount - $request->amount;
        // $withdrawl_epargne = $check->epargne - $request->amount;

        $withdrawl_courant_calculated =  $check->amount - $amount;
        $withdrawl_epargne_calculated =  $check->epargne - $amount;

        $total_withdrawl_courant = $withdrawl_courant_calculated -  $taxe;
        $total_withdrawl_epargne = $withdrawl_epargne_calculated -  $taxe;


        if ($check && $request->amount >= 500 ) {
            if ($request->submit == 'bank_deposit') {
                if ($request->type ==  'courant') {
                    Groupe::where('id', $request->user_id)->update([
                        'amount' => $deposit_courant
                    ]);
                    //ACTIVITY
                    return back()->with('success', 'vous avez éffectuer un dépot avec succès');
                }elseif ($request->type ==  'epargne') {
                    Groupe::where('id', $request->user_id)->update([
                        'epargne' => $deposit_epargne
                    ]);
                    //ACTIVITY AND SEND INTO GENERAL ACCOUNT
                    return back()->with('success', 'vous avez éffectuer un dépot avec succès');
                }
            }if ($request->submit == 'bank_group_decouvert') {
                if ($request->type ==  'courant') {
                    Groupe::where('id', $request->user_id)->update([
                        'decouvert' => $decouvert
                    ]);
                    //ACTIVITY
                    return back()->with('success', 'vous avez éffectuer un dépot avec succès');
                }elseif ($request->type ==  'epargne') {
                    Groupe::where('id', $request->user_id)->update([
                        'decouvert' => $decouvert
                    ]);
                    //ACTIVITY AND SEND INTO GENERAL ACCOUNT
                    return back()->with('success', 'vous avez éffectuer un dépot avec succès');
                }
            }else if ($request->submit == 'bank_withdrawl') {
                if ($request->type ==  'courant') {
                    Groupe::where('id', $request->user_id)->update([
                        'amount' => $total_withdrawl_courant
                    ]);
                    //ACTIVITY
                    return back()->with('success', 'vous avez éffectuer un retrait avec succès');
                }elseif ($request->type ==  'epargne') {
                    Groupe::where('id', $request->user_id)->update([
                        'epargne' => $total_withdrawl_epargne
                    ]);
                    //ACTIVITY AND SEND INTO GENERAL ACCOUNT
                    return back()->with('success', 'vous avez éffectuer un retrait avec succès');
                }
            }
        }else{
            return back()->withErrors(collection(['Erreur ce compte n\'a pas été trouver ou le montant du dépot est trop faible']));
        }
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
        $check = Banque::where('user_id', $request->user_id)->first();
         // dd($request->all());
        $amount = $request->amount;
        $taxe = ($amount * 3) / 100;
        // dd($request->all());
        $deposit = $check->decouvert + $amount;
        // $withdrawl_courant = $check->amount - $request->amount;
        // $withdrawl_epargne = $check->epargne - $request->amount;

        $withdrawl_courant_calculated =  $check->amount - $amount;
        $withdrawl_epargne_calculated =  $check->epargne - $amount;

        $total_withdrawl_courant = $withdrawl_courant_calculated -  $taxe;
        $total_withdrawl_epargne = $withdrawl_epargne_calculated -  $taxe;

 // -------------------> CHECK AMOUNT
        if ($amount < 500) {

         return back()->with('errors', 'Le montant du depot ne peut pas être inferieur à 500 Fcfa');

        }else {

 // -------------------> START DEPOSIT
        if ($request->submit == 'bank_deposit') {

            if ($check->decouvert != 0) {

                if ($request->type == 'courant') {
                    if ($check->decouvert < $request->amount) {

                        $data = $request->amount -  $check->decouvert;

                        Banque::where('user_id', $request->user_id)->update([
                            'decouvert' => 0,
                            'soldes' => $data,
                        ]);

                        return back()->with('success', 'Vous avez efectuer un dépot et : '.$check->decouvert);

                    }
                }else {
                    if ($check->epargne == 0) {
                        Banque::where('user_id', $request->user_id)->update([
                            'epargne' => $request->amount
                        ]);
                    }else {
                        Banque::where('user_id', $request->user_id)->update([
                            'epargne' => $check->epargne + $request->amount
                        ]);
                    }
                }

                
            }else {
                if ($request->type == 'courant') {
                    if ($check->soldes > 0) {
                        Banque::where('user_id', $request->user_id)->update([
                            'soldes' => $check->soldes + $request->amount
                        ]);
                    }else{
                        Banque::where('user_id', $request->user_id)->update([
                            'soldes' => $request->amount
                        ]);
                    }
                    
                }else if ($request->type == 'epargne'){

                    if ($check->epargne == 0) {
                        Banque::where('user_id', $request->user_id)->update([
                            'epargne' => $request->amount
                        ]);
                    }else {
                        Banque::where('user_id', $request->user_id)->update([
                            'epargne' => $check->epargne + $request->amount
                        ]);
                    }
                    
                }
            }

            return back()->with('success', 'Vous avez efectuer un dépot');

            
 // -------------------> END DEPOSIT

 // -------------------> START WITHDRAWL
        }else if ($request->submit == 'bank_decouvert') {
            // dd($deposit);
            if ($request->type ==  'courant') {
                Banque::where('user_id', $request->user_id)->update([
                    'decouvert' => $deposit
                ]);
                //ACTIVITY
                return back()->with('success', 'vous avez éffectuer un dépot avec succès');
            }elseif ($request->type ==  'epargne') {
                Banque::where('user_id', $request->user_id)->update([
                    'decouvert' => $deposit
                ]);
                //ACTIVITY AND SEND INTO GENERAL ACCOUNT
                return back()->with('success', 'vous avez éffectuer un dépot avec succès');
            }
        }elseif ($request->submit == 'bank_withdrawl') {

         if ($request->type == 'courant') {

            if ($check->soldes > 0 && $request->amount <= $check->soldes) {

                $amount = $request->amount;
                $taxes = ($amount * 3) / 100 ;
                $calculated =  $check->soldes - $amount;

                $total = $calculated -  $taxes;

                if ($request->amount == $check->soldes) {
                    Banque::where('user_id', $request->user_id)->update([
                        'decouvert' => str_replace('-', '', $total),
                        'soldes' => 0
                    ]);

                     if ($check->decouvert != 0) {
                        return back()->with('success', 'Vous avez efectuer un retrait égale au montant au soldes de ce comptes vous avez une dette de: '.$check->decouvert);
                    }

                    
                }

                Banque::where('user_id', $request->user_id)->update([
                    'soldes' => $total
                ]);
             }else{

                    return back()->with('errors', 'Echec de la demande le solde du compte est inferieur au montant du retrait');
            
                        // return response()->json([
                        //     'success' => false,
                        //     'message' => "Echec de la demande le solde du compte est égale a 0"
                        // ]);
            
        }
        
    }else if ($request->type == 'epargne'){

        if ($check->epargne == 0 || $request->amount > $check->epargne) {
            return back()->with('errors', 'Echec de la demande le solde du compte est inferieur au montant du retrait');
        }else {
            Banque::where('user_id', $request->user_id)->update([
                'epargne' => $check->epargne - $request->amount
            ]);
        }
        
    }
    return back()->with('success', 'Vous avez efectuer un retrait avec success');



 // -------------------> END WITHDRAWL     

  // -------------------> START TRANSFERT  
}elseif ($request->submit == 'bank_transfert') {




  // -------------------> END TRANSFERT  
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
          $getUser = Banque::where('id', $id)->delete();

          return back()->with('success', 'Vous avez supprimer un compte avec success');
    }


     public function destroyGroup($id)
    {
          $getUser = Groupe::where('id', $id)->delete();

          return back()->with('success', 'Vous avez supprimer un compte groupe avec success');
    }




  public function getAmount($id)
  { 
   $getUser = Banque::where('user_id', $id)->first();

   $getUser->soldes ==  0 ? $getUser->soldes = "0" : $getUser->soldes;

   if ($getUser->soldes != 0) {
    $amount = [
        'courant'=> $getUser->soldes,
        'epargne' =>$getUser->epargne,
        'decouvert' =>$getUser->decouvert
    ];

    return response()->json([
        'success' => true,
        'data' => json_encode($amount)
    ]);

}else if($getUser->soldes == "0"){


    if ($getUser->decouvert != 0) {
        $amount = [
            'courant'=> $getUser->decouvert,
            'epargne' =>$getUser->epargne,
            'decouvert' =>$getUser->decouvert
        ];
    }else {
     $amount = [
        'courant'=> 0,
        'epargne' =>$getUser->epargne,
        'decouvert' =>$getUser->decouvert
    ];
}


return response()->json([
    'success' => true,
    'data' => json_encode($amount)
]);
}

}

public function getGroupAmount($id)
{
    $getUser = Groupe::find($id);

    if ($getUser->amount != 0) {
        $data = [
            'amount'=> $getUser->amount,
            'epargne' =>$getUser->epargne,
            'decouvert' =>$getUser->decouvert
        ];

        return response()->json([
            'success' => true,
            'data' => json_encode($data)
        ]);

    }else if($getUser->amount == 0){


        if ($getUser->decouvert != 0) {
            $data = [
                'amount'=> $getUser->decouvert,
                'epargne' =>$getUser->epargne,
                'decouvert' =>$getUser->decouvert
            ];
        }else {
         $data = [
            'amount'=> 0,
            'epargne' =>$getUser->epargne,
            'decouvert' =>$getUser->decouvert
        ];
    }


    return response()->json([
        'success' => true,
        'data' => json_encode($data)
    ]);
}
}
}

