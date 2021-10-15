<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function Home(){

        // detail about current active user
        // dd(Auth::user());
        // dd(Auth::id());
        // dd(Auth::check());
        $post = new BlogPost();
        $post = BlogPost::all();

        return view('Home.index', compact('post'));
    }

    public function Contact(){
        return view('Home.contact');
    }

    public function Secret(){
        return view('Home.secret');
    }
}


