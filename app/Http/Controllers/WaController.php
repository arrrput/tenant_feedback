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

        $apiURL = 'http://localhost:3000/send-message';
        $message = array(
                "message" => "test kirim from gateway",
                "number" => "081262598702"
        );
       
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
