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
    
  <div class="row">  
      <div class="col-6">
    @forelse ($posts as $key => $post)
              {{-- @dump($post->comment_count);     --}}
    {{--  @break($key = 2)  --}}
        {{--  @continue($key = 1)  --}}
        @if ($post->comment_count)
        <b>Added</b> {{ $post->created_at->diffForHumans() }}
        <b>By</b>    {{ $post->user->name }}
        <p>Comment on Post: {{ $post->comment_count }}</p>
        @else 
        <p>No Comment Yet!</p> 
        @endif
        
        {{--  Using the partial template, And always inside the foreach loop --}}
        @include('Posts.Partials.post', [])
    @empty
        No Post Yet!
    @endforelse
</div>


<div class="col-6">
    <div class="card">
        <div class="card-header">
            Most Commented Posts!
        </div>
        <div class="card-body">
          <ul class="list-group list-group-flush"> 
            @foreach ($mostCommented as $post)
           <a href="{{ route('posts.show', ['post' => $post->id]) }}"> <li class="list-group-item">{{ $post->title }}</li> </a>
            @endforeach
          </ul>
        </div>
      </div>
</div>

</div>
@endsection
