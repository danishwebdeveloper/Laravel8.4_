@extends('layouts.app')

{{--  $Post from router as define in return section  --}}
@section('title', "Laravel Posts Page")

@section('content')

    {{--  @foreach ($posts as $post)
        <div>
            {{ $post['title'] }}
        </div>
    @endforeach  --}}

    {{--  It react same as if exist otheriw3se show no post found  --}}
    
    
    @forelse ($posts as $key => $post)
              {{-- @dump($post->comment_count);     --}}
    {{--  @break($key = 2)  --}}
        {{--  @continue($key = 1)  --}}
        @if ($post->comment_count)
        <p>Comment on Post: {{ $post->comment_count }}</p>
        @else 
        <p>No Comment Yet!</p> 
        @endif
        
        {{--  Using the partial template, And always inside the foreach loop --}}
        @include('Posts.Partials.post', [])
    @empty
        No Post Yet!
    @endforelse

@endsection
