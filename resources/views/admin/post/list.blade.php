@extends("layout")

@section('title')
    <h1>{{ $title }}</h1>
@endsection

@section('content')
    <div class="container">
        <a href="{{ route('admin.post.create') }}" class="btn btn-primary">Add Post</a>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Body</th>
                <th scope="col">Created At</th>
                <th scope="col">Updates At</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $i => $post)
                <tr>
                    <th scope="row">{{ $i+1 }}</th>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->body }}</td>
                    <td class="td-date">{{ $post->created_at->format('Y-m-d') }}</td>
                    <td class="td-date">{{ $post->updated_at->format('Y-m-d') }}</td>
                    <td class="col">
                        <a href="{{ route('admin.post.edit', ['id' => $post->id]) }}">edit</a>
                    </td>
                    <td class="col">
                        <a href="{{ route('admin.post.delete', ['id' => $post->id]) }}">delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
