@extends('admin/adminlayout')
@section('container')


<div class="container my-5">
    <h1 class="mb-4 text-center">Categories</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <div class="mb-3 col-12">
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Create New Category</a>
        </div>
        @forelse($categories as $category)
            <div class="mb-4 col-md-4 col-sm-6">
                <div class="card category-card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $category->name }}</h5>
                        <p class="card-text">{{ Str::limit($category->description, 100) }}</p>
                        <a href="{{ route('admin.categories.show', $category->slug,) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('admin.categories.edit', $category->slug,) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.categories.destroy',$category->slug) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" 
                                onclick="return confirm('Are you sure you want to delete this category?');">Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center">No categories found.</p>
            </div>
        @endforelse
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection()
