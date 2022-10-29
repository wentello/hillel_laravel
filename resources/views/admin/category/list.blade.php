@extends("layout")

@section('title')
    <h1>{{ $title }}</h1>
@endsection

@section('content')
    <div class="container">
        <a href="{{ route('admin.category.create') }}" class="btn btn-primary">Add Category</a>
        @foreach($categories as $category)
            <div class="row">
                <div class="col">
                    id: {{ $category->id }}
                </div>
                <div class="col">
                    title: {{ $category->title }}
                </div>
                <div class="col">
                    slug: {{ $category->slug }}
                </div>
                <div class="col">
                    <a href="{{ route('admin.category.edit', ['id' => $category->id]) }}">edit</a>
                </div>
                <div class="col">
                    <a href="{{ route('admin.category.delete', ['id' => $category->id]) }}">delete</a>
                </div>
                <div class="col">
                    <a href="{{ route('admin.post_by_type.index', ['id' => $category->id, 'postable_type' => 'Category']) }}">show posts</a>
                </div>
            </div>
        @endforeach

    </div>
@endsection
