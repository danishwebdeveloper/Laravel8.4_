<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function Home(){
        
        // detail about current active user
        // dd(Auth::user());
        // dd(Auth::id());
        // dd(Auth::check());
        return view('Home.index');
    }

    public function Contact(){
        return view('Home.contact');
    }
}


