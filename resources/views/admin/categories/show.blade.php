@extends('admin/adminlayout')

@section('container')

<div class="container my-5">
    <div class="p-4 category-details-card">
        <h1>{{ $category->name }}</h1>
        <p><strong>Slug:</strong> {{ $category->slug }}</p>
        <p><strong>Description:</strong> {{ $category->description }}</p>

        <div class="d-flex justify-content-between">
            <a href="{{ route('categories.edit', $category->slug) }}" class="btn btn-warning">Edit Category</a>
            <form action="{{ route('categories.destroy', $category->slug) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" 
                    onclick="return confirm('Are you sure you want to delete this category?');">Delete Category
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
