<?php

namespace App\Http\Controllers;

use App\Models\User;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Auth;

class WaController extends Controller
{
    //
    public function index(){

        $sid    = getenv("TWILIO_AUTH_SID");
        $token  = getenv("TWILIO_AUTH_TOKEN");
        $wa_from= getenv("TWILIO_WHATSAPP_FROM");
        $recipient = "+6282388322022";
        $twilio = new Client($sid, $token);
        
        $body = "Ada 1 Request yang perlu di verify.\n Untuk lebih lengkap silahkan kunjungi http://biiebigdata.co.id";

        $message =  $twilio->messages->create("whatsapp:$recipient",[
                        "from" => "whatsapp:$wa_from", 
                        "body" => $body]);
        

        return print($message); 
    }
}
