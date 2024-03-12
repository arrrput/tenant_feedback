<?php

namespace App\Http\Controllers;

use App\Models\User;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class WaController extends Controller
{
    //
    public function index(){

        $apiURL = 'http://localhost:3000/ariputra/messages/send';
        $message = array(
                "jid" => "6281292812357@s.whatsapp.net",
                "type" => "number",
                "message"=> array(
                    "text"=> "test",
                    "mentions"=> array("6281292812357@s.whatsapp.net")
                )
        );
        dd($message);
        $headers = [
            'X-header' => 'value'
        ];
        $response = Http::withHeaders($headers)->post($apiURL, $message);
        $statusCode = $response->status();
        $responseBody = json_decode($response->getBody(), true);
     

        dd($responseBody);
        return response()->json($message, 200);

        return print($message); 
    }
}
