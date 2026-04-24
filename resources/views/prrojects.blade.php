{{-- @extends('layouts.app')

@section('content')

<h2 class="mb-4 fw-bold">My Projects</h2>

<div class="row">
    @foreach($projects as $project)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                
                @if($project->image)
                    <img src="{{ asset('storage/' . $project->image) }}" 
                         class="card-img-top" 
                         style="height:200px; object-fit:cover;">
                @endif

                <div class="card-body">
                    <h5 class="card-title fw-bold">{{ $project->title }}</h5>
                    <p class="card-text text-muted">
                        {{ $project->description }}
                    </p>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection --}}