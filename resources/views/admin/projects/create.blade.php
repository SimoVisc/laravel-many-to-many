@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="py-4">
            <h1>Create Project</h1>
            @include('partials.errors')

            <div class="mt-4">
                <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="10">{{ old('description') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="menager" class="form-label">Menager</label>
                        <input type="text" class="form-control" id="menager" name="menager"
                            value="{{ old('menager') }}">
                    </div>
                    <div class="mb-3">
                        <label for="cover_image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="cover_image" name="cover_image"
                            value="{{ old('cover_image') }}">
                    </div>
                    <div class="mb-3">
                        <label for="type_id" class="form-label">Type</label>
                        <select class="form-select" name="type_id" id="type_id">
                            <option value="">No type</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <div class="mb-2">Technology</div>
                        @foreach ($technologies as $technology)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="{{ $technology->slug }}"
                                    name="technologies[]" value="{{ $technology->id }}"
                                    {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}>
                                <label class="form-check-label"
                                    for="{{ $technology->slug }}">{{ $technology->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection
