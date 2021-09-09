@extends('layouts.app')

@section('title', 'Update Post')

@section('content')
{{-- <h1>Hello there</h1> --}}
    <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST">
        @csrf
        @method('PUT')
        
        @include('Posts.Partials.form')

        <div><input type="submit" value="Update"/></div>
    </form>
@endsection


