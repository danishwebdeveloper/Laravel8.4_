
{{-- Combined error for all  --}}
@if ($errors->any())
<div class="mb-3">
    <ul class="list-group">
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
           {{ $error }}
          </div>
        @endforeach
    </ul>
</div>
@endif