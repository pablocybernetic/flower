@extends('admin/adminlayout')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

@section('container')
    <div class="container">
        <h1>Create New Blog Post</h1>

        <!-- Success or error messages -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form for creating blog post -->
        <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}"
                    required>
                @error('title')
                    <div class="mt-2 alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}">
                @error('slug')
                    <div class="mt-2 alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category_id" class="form-control" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->name }}" {{ old('category_id') == $category->name ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="mt-2 alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="editor">Content</label>
                <div id="editor" style="height: 300px;"></div>
                <input type="hidden" name="content" id="hiddenDescriptionInput">
            </div>
            
            <div class="form-group">
                <label for="featured_image">Image</label>
                <input type="file" name="featured_image" id="image" class="form-control">
                @error('featured_image')
                    <div class="mt-2 alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="meta_title">Meta Title</label>
                <input type="text" name="meta_title" id="meta_title" class="form-control"
                    value="{{ old('meta_title') }}">
                @error('meta_title')
                    <div class="mt-2 alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="meta_description">Meta Description</label>
                <textarea name="meta_description" id="meta_description" class="form-control" rows="3">{{ old('meta_description') }}</textarea>
                @error('meta_description')
                    <div class="mt-2 alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="tags">Tags</label>
                <input type="text" name="tags" id="tags" class="form-control" value="{{ old('tags') }}">
                @error('tags')
                    <div class="mt-2 alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Create Post</button>
            </div>
        </form>
    </div>
    <!-- Include Quill JS -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <script>
        // Initialize Quill
        var quill = new Quill('#editor', {
            theme: 'snow',
        });

        // Update the hidden input field with Quill's HTML content
        quill.on('text-change', function() {
            var hiddenInput = document.getElementById('hiddenDescriptionInput');
            hiddenInput.value = quill.root.innerHTML;
        });
    </script>
@endsection
