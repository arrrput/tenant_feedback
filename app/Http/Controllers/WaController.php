<?php

namespace App\Http\Controllers;

use Twilio\Rest\Client;

class WaController extends Controller
{
    //
    public function index(){

        $sid    = getenv("TWILIO_AUTH_SID");
        $token  = getenv("TWILIO_AUTH_TOKEN");
        $wa_from= getenv("TWILIO_WHATSAPP_FROM");
        $twilio = new Client($sid, $token);
        $recipient = "+6282388322022";
        
        $body = "Hello, Hendri the brengsek the meta jungler";

        return $twilio->messages->create("whatsapp:$recipient",["from" => "whatsapp:$wa_from", "body" => $body]);
    }
}
