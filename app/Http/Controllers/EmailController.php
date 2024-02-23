<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Notifications\EmailNotification;
use Illuminate\Support\Facades\Notification;

class EmailController extends Controller
{
    public function sendWelcomeEmail()
    {
        $title = 'BIIE Tenant Feedback';
        $body = 'Thank you for participating!
        
        
        
        Please do not reply this email';
        

        Mail::to('ariputra@biie.co.id')->send(new WelcomeMail($title, $body));

        return "Email sent successfully!";
    }

    public function send() 
    {
    	$user = User::first();
  
        $project = [
            'greeting' => 'Hi '.$user->name.',',
            'body' => 'This is the project assigned to you.',
            'thanks' => 'Thank you this is from codeanddeploy.com',
            'actionText' => 'View Request',
            'actionURL' => url('/department'),
            'id' => 57
        ];
  
        Notification::send($user, new EmailNotification($project));
   
        dd('Notification sent!');
    }
}
