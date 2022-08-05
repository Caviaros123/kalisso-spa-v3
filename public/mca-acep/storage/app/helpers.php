<?php
use App\Groupe;
use App\Banque;
use App\Carte;
use App\Models\User;

//formatage du prix avec un point au lieu d'une virgule
function presentPrice($price)
{
    return str_replace(',', '.', number_format($price, 0)) . ' Fcfa';
}



//formatage du prix avec un point au lieu d'une virgule
function phoneNumber($phone)
{
    // add logic to correctly format number here
    // a more robust ways would be to use a regular expression
    //fetch phone to simplify sending
    if (substr($phone, 0, 1) === "+") {

        $phone = str_replace('+', '', $phone);
    } elseif (substr($phone, 0, 2) === "00") {

        $phone = str_replace('00', '', $phone);
    }

    return $phone;
}


//formatage du prix avec un point au lieu d'une virgule
function activity($action, $status, $data)
{
    $user_admin = User::where('id', 1)->first();

    // add logic to correctly format number here
    // a more robust ways would be to use a regular expression
    //fetch phone to simplify sending
        
    if ($action) {
        if ($action == 'withdrawl') {

            if ($user_admin) {
                // code...
                try {
                    Banque::where('user_id', 1)->insert([
                        'soldes' => $user_admin->soldes + $data->amount,
                    ]);

                    DB::table('transaction')->insert([
                        'type' => $type,
                        'status' => $data->status,
                        'text' => $data->text,
                        'action' => $data->action,
                        'created_at'=> NOW(),
                        'updated_at'=> NOW()
                    ]);
                } catch (Exception $e) {
                    return false;
                }
               
            }
        }else if ($action == 'deposit') {

            if ($user_admin) {
                // code...
                try {
                     Banque::where('user_id', 1)->insert([
                        'soldes' => $user_admin->soldes ,
                    ]);

                     DB::table('transaction')->insert([
                        'type' => $type,
                        'status' => $data->status,
                        'text' => $data->text,
                        'action' => $data->action,
                        'created_at'=> NOW(),
                        'updated_at'=> NOW()
                    ]);
                } catch (Exception $e) {
                    return false;
                }
               
            }
        }else if ($action == 'decouvert') {

            if ($user_admin) {
                // code...
                try {
                     Banque::where('user_id', 1)->insert([
                        'soldes' => $user_admin->soldes + $data->amount,
                    ]);

                     DB::table('transaction')->insert([
                        'type' => $type,
                        'status' => $data->status,
                        'text' => $data->text,
                        'action' => $data->action,
                        'created_at'=> NOW(),
                        'updated_at'=> NOW()
                    ]);
                } catch (Exception $e) {
                    return false;
                }
            }
        }else{
               
            // code...
            try {
                DB::table('transaction')->insert([
                    'action' => $action,
                    'status' => $status,
                    'playload' => json_encode($data),
                    'created_by'=> auth()->id(),
                    'created_at'=> NOW(),
                    'updated_at'=> NOW()
                ]);
            } catch (Exception $e) {
                return $e;
            }
        }
    } else {

       return false;
    }

}