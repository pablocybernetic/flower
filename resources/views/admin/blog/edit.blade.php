@extends('admin/adminlayout')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

@section('container')
    <div class="container">
        <h1>Edit Blog Post</h1>

        <!-- Success or Error Messages -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.blog.update', $blogPost->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $blogPost->title) }}" required>
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category" id="category_id" class="form-control" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->name }}" {{ $blogPost->category == $category->name ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="content" class="form-control" rows="5" required>{{ old('content', $blogPost->content) }}</textarea>
            </div>

            <!-- Featured Image Section -->
            <div class="form-group">
                <label for="image">Featured Image</label>
                @if($blogPost->featured_image)
                    <div class="mb-2">
                        <img src="{{ asset('/' . $blogPost->featured_image) }}" alt="Featured Image" class="img-fluid" style="max-width: 200px;">
                    </div>
                @endif
                <input type="file" name="featured_image" id="image" class="form-control">
                <small class="text-muted">Upload a new image to replace the current one.</small>
            </div>

            <div class="form-group">
                <label for="meta_title">Meta Title</label>
                <input type="text" name="meta_title" id="meta_title" class="form-control" value="{{ old('meta_title', $blogPost->meta_title) }}">
            </div>

            <div class="form-group">
                <label for="meta_description">Meta Description</label>
                <textarea name="meta_description" id="meta_description" class="form-control" rows="3">{{ old('meta_description', $blogPost->meta_description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="tags">Tags</label>
                <input type="text" name="tags" id="tags" class="form-control" value="{{ old('tags', $blogPost->tags) }}">
            </div>

            <!-- Status Field -->
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="draft" {{ $blogPost->status == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ $blogPost->status == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="archived" {{ $blogPost->status == 'archived' ? 'selected' : '' }}>Archived</option>
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update Post</button>
            </div>
        </form>
    </div>
@endsection
