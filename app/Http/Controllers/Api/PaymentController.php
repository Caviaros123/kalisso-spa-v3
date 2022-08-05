<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\StoreResource;
use App\Models\Profile;

class PaymentController extends Controller
{
    public function getEpayData()
    {

         // init
    $acid="167";
    $key = "eb53195f1b3a37c5d4330bcac3e05b28b3926c26";
    $token = "46fd45e4160e46ab9221f481e5149ecd3c90eac6";
    $sign = md5($token . $key);
    $signature = $sign;
    $currency = "XAF";
    $datetrans = date('Y-m-d H:i:s');
    $emailId = "caviaros123@gmail.com";
    $successurl="https://kalisso.com/merci";
    $cancelurl="https://kalisso.com/erreur";


    //merge
    $data = [
        "url" => "https://epaycongo.com/payment",
        //"amount" => $req->amount ?? $req['amount'],
        "signature" => $signature,
        "acid" => $acid,
        "emailId" => $emailId,
        "successurl" => $successurl,
        "cancelurl" => $cancelurl,
        "currency" => $currency,
        //"Reference" => $req->Reference ?? $req->reference,
    ];

    //$req->merge($data);
        //dd($request->all());
        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }
}
