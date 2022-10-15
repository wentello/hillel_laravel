@extends("layout")

@section('title')
    <h1>{{ $title }}</h1>
@endsection

@section('content')
    <div class="container">
        <a href="{{ route('admin.category.index') }}" class="btn btn-primary">Categories</a>
        <a href="{{ route('admin.tag.index') }}" class="btn btn-primary">Tags</a>
        <a href="{{ route('admin.post.index') }}" class="btn btn-primary">Post</a>
        <a href="{{ route('auth.logout') }}" class="btn btn-primary">Logout</a>
    </div>
@endsection
