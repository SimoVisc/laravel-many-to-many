@extends('layouts.admin')

@section('content')
    <div class="card text-center mt-4">
        <div class="card-header">
            <h1>{{ $project->name }}</h1>
        </div>
        <div class="card-body">
            <h3>
                @if ($project->type)
                    Type: <a href="{{ route('admin.types.show', $project->type) }}">{{ $project->type->name }}</a>
                @else
                    No type
                @endif
            </h3>
            @if ($project->technologies->isNotEmpty())
                <div class="mt-4 d-flex justify-content-center align-items-center">
                    <h3>Technology:</h3>
                    @foreach ($project->technologies as $technology)
                        <span class="badge bg-secondary m-3">{{ $technology->name }}</span>
                    @endforeach
                </div>
            @endif
            @if ($project->cover_image)
                <img class="w-25" src="{{ asset("storage/$project->cover_image") }}" alt="{{ $project->name }}">
            @endif
            <p class="mt-2">{{ $project->description }}</p>
        </div>
    </div>
@endsection
