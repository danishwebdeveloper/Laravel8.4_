


<a href="{{ route('posts.show' , ['post' => $post->id]) }}">
    <h3>{{ $post->title }}</h3>
</a>

<div>
    {{-- Only access to valid person to display Edit button using AuthProviderAuthorization --}}
    @can('update-post', $post)
    {{-- For edit --}}
    <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary">Edit</a>
    @endcan

    {{-- Only access to valid person to display Delete button using AuthProviderAuthorization --}}
    @can('delete-post', $post)   
    {{-- For Delete --}}
    <form class="d-inline" action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" value="Delete" class="btn btn-primary"/>
    </form>
    @endcan
</div>