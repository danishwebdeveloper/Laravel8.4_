
 {{-- Page only access to is_amdin --}}
@can('home-secret')
@extends('layouts.app')

@section('title', 'Contact Page')

@section('content')
    <h2>Contact Us Page</h2>

   
        <p>Secret email for the user is here!
           <b>Secretadminemail@gmail.com</b> 
        </p>
    
@endsection
@endcan