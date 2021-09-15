@extends('layouts.app')

@section('title', 'Contact Page')

@section('content')
    <h2>Contact Us Page</h2>

    {{-- only access to is_amdin --}}
    @can('home-secret')
    <a href="{{ route('secret.page') }}">
        <p>Special Link Only Accessible to Admin!</p>
    </a>
    @endcan
@endsection