@extends('admin/adminlayout')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

@section('container')
<div class="container mt-5">
    <h2 class="text-custom">Edit About Us</h2>
    <form action="{{ route('about.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
    
        <!-- Title -->
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ $abouts->title }}" required>
        </div>
    
        <!-- Subtitle -->
        <div class="form-group">
            <label for="subtitle">Subtitle</label>
            <input type="text" id="subtitle" name="subtitle" class="form-control" value="{{ $abouts->subtitle }}">
        </div>
    
        <!-- Description -->
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control" rows="5">{{ $abouts->description }}</textarea>
        </div>
    
        <!-- Features -->
        <div class="form-group">
            <label for="features">Features (Comma Separated)</label>
            <input type="text" id="features" name="features" class="form-control" 
            value="{{ is_array($abouts->features) ? implode(', ', $abouts->features) : $abouts->features }}">
            <small class="text-muted">Example: Sustainable Products, Fast Delivery, Customer Care, Expert Guidance</small>
        </div>
    
        <!-- Images -->
        <h4 class="mt-4">Images</h4>
        <div class="form-group">
            <label for="image1">Image1 241 by 362px</label>
            <input type="file" id="image1" name="image1" class="form-control">
            @if($abouts->image1)
                <img src="{{ asset($abouts->image1) }}" alt="Image 1" class="mt-2" width="100">
            @endif
        </div>
    
        <div class="form-group">
            <label for="image2">Image2 337 by 450px</label>
            <input type="file" id="image2" name="image2" class="form-control">
            @if($abouts->image2)
                <img src="{{ asset($abouts->image2) }}" alt="Image 2" class="mt-2" width="100">
            @endif
        </div>
    
        <div class="form-group">
            <label for="image3">Image3 600 by 401px</label>
            <input type="file" id="image3" name="image3" class="form-control">
            @if($abouts->image3)
                <img src="{{ asset($abouts->image3) }}" alt="Image 3" class="mt-2" width="100">
            @endif
        </div>
    
        <!-- Save Button -->
        <button type="submit" class="mt-3 btn btn-custom">Save Changes</button>
        <a href="{{ route('about.index') }}" class="mt-3 btn btn-secondary">Cancel</a>
    </form>
    
</div>
@endsection

<style>
    .text-custom {
        color: #28a745 !important;
    }
    .btn-custom {
        background-color: #28a745;
        color: white;
        border: none;
    }
    .btn-custom:hover {
        background-color: #218838;
    }
</style>
