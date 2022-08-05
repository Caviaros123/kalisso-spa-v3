<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function Callback(Request $request)
    {
        redirect()->back()->with(['success_message' => 'Your payment was accepted']);
    }
}
