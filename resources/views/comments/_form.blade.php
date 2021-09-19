
<div class="mb-2 mt-2">
@auth
    <form method="POST" action="{{ route('posts.comments.store', ['post' => $post->id]) }}">
        @csrf
        
    <div class="form-group">
      <textarea type="text" name="content" value="" class="form-control" placeholder="Enter Comment"></textarea>
    </div>
        <button type="submit" class="btn btn-primary btn-block">Add Comment</button>
    </form>

    {{--  For Comment Errors  --}}
   @component('components.error')
       
   @endcomponent
    @else
    <a href="{{ route('login') }}">Sign in</a> to post Comment!
@endauth
</div> 