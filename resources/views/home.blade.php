@extends("layout")

@section('title')
    <h1>{{ $title }}</h1>
@endsection

@section('content')
    <div class="container">
        <a href="{{ route('category.index') }}" class="btn btn-primary">Categories</a>
        <a href="{{ route('tag.index') }}" class="btn btn-primary">Tags</a>
        <a href="{{ route('post.index') }}" class="btn btn-primary">Post</a>
    </div>
@endsection
