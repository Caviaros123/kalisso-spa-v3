<?php namespace 

App\Http\Controllers; 
use Illuminate\Http\Request; 
use App\Contact; 
use Mail; 
use App\User;

class ContactController extends Controller { 


    public function index()
    {
       return view('contacts.index');
    }

      public function getContact() { 

            return view('contact_us'); 
     } 

      public function saveContact(Request $request) { 

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'phone_number' => 'required',
            'message' => 'required'
        ]);

        $contact = new Contact;

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->phone_number = $request->phone_number;
        $contact->message = $request->message;

        $contact->save();


        \Mail::send('emails.contact_email',
             array(
                 'name' => $request->get('name'),
                 'email' => $request->get('email'),
                 'subject' => $request->get('subject'),
                 'phone_number' => $request->get('phone_number'),
                 'user_message' => $request->get('message'),
             ), function($message) use ($request)
               {
                  $message->from($request->email);
                  $message->to('support@kalisso.com');
                  $message->subject($request->get('subject'));
               });
        
        return back()->with('success_message', 'Merci de nous avoir nous contacter!');

    }

    public function sendNotification(Request $request)
    {
        // dd($request->all());
        $users = User::all();
        $phone = $request['phone'];
        $message = $request['message']; 
        
            # code...
            // ->where('isSeller', true)
            if ($request['phone']) {  
                # code...
                
                foreach ($users as $user) {
                    //get username
                    $phone = $user->phone;
                    $name = $user->name ?? $user->lastname;
                    //final message
                    $contents = $message; 
                   
            
                      try {
                          
                              $sms = array(
                                'client'=>    'caviaros123',
                                'password'=>    'FilsdeDieu1995@',
                                'phone'=>    $phone,// The number that will receive the text message
                                'from'=>    'Kalisso.com',// The sender of the SMS
                                'affiliate' => '999',
                                'text' => utf8_decode(urldecode($contents)), // The content of the text message
                              );

                              $context = stream_context_create(array(
                                'http' => array(
                                  'method' => 'POST',
                                  'header'  => "Content-type: application/x-www-form-urlencoded",
                                  'content' => http_build_query($sms),
                              )));

                              $response = file_get_contents("https://api.wirepick.com/httpsms/send", false, $context);
                    

                              


                               } catch (Exception $e) {
                              
                                  // dd($th);
                                  return back()->withErrors(['Une erreur est survenue lors de l\'envoi des messages a tous les membres de kalisso.com'.$e]);
                              
                              }


                           
                        }

                         \DB::table('messages')->insert([
                              'type' => 'sms',
                              'status' => 'all members',
                              'message' => $contents,
                              'response' => $response ?? ''
                          ]);

                              
                        return back()->with('success_message', 'Votre sms à bien été envoyer a tous les membres de kalisso.com'.$response);
                        

            }else{
                 //fetch phone to simplify sending
                   $contents = $message;

                        try {
                          
                             // SEND SMS
                          foreach ($users as $user) {

                            $phone = $user->phone;
                            $sms = array(
                              'client'=>    'caviaros123',
                              'password'=>    'FilsdeDieu1995@',
                              'phone'=>    $phone,// The number that will receive the text message
                              'from'=>    'Kalisso.com',// The sender of the SMS
                              'affiliate' => '999',
                              'text' => utf8_decode(urldecode($contents)), // The content of the text message
                            );

                            $context = stream_context_create(array(
                              'http' => array(
                                'method' => 'POST',
                                'header'  => "Content-type: application/x-www-form-urlencoded",
                                'content' => http_build_query($sms),
                            )));

                            $response = file_get_contents("https://api.wirepick.com/httpsms/send", false, $context);
                  
                            $response = $send->getBody();

                          }
                 
                            //  \DB::table('messages')->insert([
                            //     'type' => 'sms',
                            //     'status' => 'all members',
                            //     'message' => $contents,
                            //     'response' => $response ?? ''
                            // ]);
                          return back()->with('success_message', 'Message envoyer à tous les membres de kalisso.com');
                        
                        
                        } catch (\Throwable $th) {
                        
                    //     // dd($th);
                            return back()->withErrors(['Une erreur est survenue lors de l\'envoi des messages a tous les membres de kalisso.com'.$th]);
                        
                        }
                     
            }
                    // dump(json_encode($count)) ;
                        
    }
}