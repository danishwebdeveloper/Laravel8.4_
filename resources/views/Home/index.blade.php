@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
    <h1>
        Display BlogPost With Name and Content

    </h1>
    @foreach ($post as $posts)
       <b> Post Title:</b> {{ $posts->title }}
       <br/>
       <b> Post Content:</b>{{ $posts->content }}
        <br/>
        <br/>
    @endforeach
@endsection
