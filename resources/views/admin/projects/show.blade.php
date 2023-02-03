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
            @if ($project->cover_image)
                <img class="w-25" src="{{ asset("storage/$project->cover_image") }}" alt="{{ $project->name }}">
            @endif
            <p class="mt-2">{{ $project->description }}</p>
        </div>
    </div>
@endsection
