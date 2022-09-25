<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\Post;
use App\Notifications\NewPostNotify;
use Illuminate\Support\Facades\Notification;
use App\Model\user\Subscriber;
use Illuminate\Notifications\Notifiable;
 
class UpdatedController extends Controller
{
 
    public function store(Request $request)
    {
       //Save your new post here . after posting then send mail to the subscriber
 
        $subscribers = Subscriber::all(); //Retrieving all subscribers
 
        foreach($subscribers as $subscriber){
            Notification::route('mail' , $subscriber->email) //Sending mail to subscriber
                          ->notify(new NewPostNotify($posts)); //With new post
 
        return redirect()->back();
      }
    }
}
