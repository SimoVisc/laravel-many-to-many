@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="py-4">
            <h1>Edit {{ $project->name }}</h1>
            @include('partials.errors')
            <div class="mt-4">
                <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', $project->name) }}">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="10">{{ old('description', $project->description) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="menager" class="form-label">Menager</label>
                        <input type="text" class="form-control" id="menager" name="menager"
                            value="{{ old('description', $project->menager) }}">
                    </div>
                    <div class="mb-3">
                        <label for="cover_image" class="form-label">Image</label>
                        <div>
                            <img id="output" width="100" class="mb-2"
                                @if ($project->cover_image) src="{{ asset("storage/$project->cover_image") }}" @endif />
                            <script>
                                var loadFile = function(event) {
                                    var reader = new FileReader();
                                    reader.onload = function() {
                                        var output = document.getElementById('output');
                                        output.src = reader.result;
                                    };
                                    reader.readAsDataURL(event.target.files[0]);
                                };
                            </script>
                        </div>
                        @if ($project->cover_image)
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="no_image"
                                    name="no_image">
                                <label class="form-check-label" for="no_image">No Image</label>
                            </div>
                        @endif

                        <input type="file" class="form-control" id="cover_image" name="cover_image"
                            value="{{ old('cover_image') }}" onchange="loadFile(event)">

                        <script>
                            const inputCheckbox = document.getElementById('no_image');
                            const inputFile = document.getElementById('cover_image');
                            inputCheckbox.addEventListener('change', function() {
                                if (inputCheckbox.checked) {
                                    inputFile.disabled = true;
                                } else {
                                    inputFile.disabled = false;
                                }
                            });
                        </script>
                    </div>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
