<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Email extends Controller
{
    public function index(){

        $data = ['name'=>'MuhammadDanish', 'detail'=> 'Hello Danish'];
       Mail::send('email', $data, function ($message){
        //    $message->from('john@johndoe.com', 'John Doe');
        //    $message->sender('john@johndoe.com', 'John Doe');
           $message->to('danishbutt.uos@gmail.com', 'Muhammad Danish');
        //    $message->cc('john@johndoe.com', 'John Doe');
        //    $message->bcc('john@johndoe.com', 'John Doe');
        //    $message->replyTo('john@johndoe.com', 'John Doe');
           $message->subject('First Email as Subject');
        //    $message->priority(3);
        //    $message->attach('pathToFile');
       });
    }
}
