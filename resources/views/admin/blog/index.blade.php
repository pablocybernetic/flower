@extends('admin/adminlayout')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

@section('container')

    <div class="container">
        <h1 style="color: aliceblue">All Blog Posts</h1>
        <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">Create New Blog Post</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Category</th>
                    <th>Featured Image</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blogPosts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->slug }}</td>
                        <td>{{ $post->category ?? 'No Category' }}</td>
                        <td>
                            @if ($post->featured_image)
                                <img src="{{ asset($post->featured_image) }}" alt="Featured Image" style="width: 50px; height: auto; border-radius: 5px;">
                            @else
                                <span>No Image</span>
                            @endif
                        </td>
                        <td>{{ $post->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('admin.blog.edit', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.blog.destroy', $post->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
