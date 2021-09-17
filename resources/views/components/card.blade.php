<div class="row mx-1 my-5">
<div class="card">
    <div class="card-header">
        {{ $title }}
    </div>
    <div class="card-body">
        <h5 class="card-title">{{ $subtitle }}</h5>
      <ul class="list-group list-group-flush"> 
        @foreach ($items as $item)
        <li class="list-group-item">
            {{ $item }}
        </li>
        @endforeach
      </ul>
    </div>
  </div>
</div>