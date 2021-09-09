


    <div class="form-group">
      <label for="exampleInputEmail1">Title</label>
      <input type="text" name="title" value="{{ old('title', optional($post ?? null)->title) }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter title">
      <small id="emailHelp" class="form-text text-muted">We'll never share with anyone else.</small>
    </div>

        {{-- Specific field error --}}
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <textarea name="content" class="form-control" placeholder="Please enter content">{{ old('content', optional($post ?? null)->content) }}</textarea>
    </div>

        {{-- Combined error for all  --}}
        @if ($errors->any())
            <div class="mb-3">
                <ul class="list-group">
                    @foreach ($errors->all() as $error)
                            <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

