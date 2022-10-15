@extends("layout")

@section('title')
    <h1>{{ $title }}</h1>
@endsection

@section('content')
    <div class="container">
        <a href="{{ route('admin.tag.create') }}" class="btn btn-primary">Add Tag</a>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Slug</th>
                <th scope="col">Created At</th>
                <th scope="col">Updates At</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tags as $i => $tag)
                <tr>
                    <th scope="row">{{ $i+1 }}</th>
                    <td>{{ $tag->title }}</td>
                    <td>{{ $tag->slug }}</td>
                    <td class="td-date">{{ $tag->created_at->format('Y-m-d') }}</td>
                    <td class="td-date">{{ $tag->updated_at->format('Y-m-d') }}</td>
                    <td class="col">
                        <a href="{{ route('admin.tag.edit', ['id' => $tag->id]) }}">edit</a>
                    </td>
                    <td class="col">
                        <a href="{{ route('admin.tag.delete', ['id' => $tag->id]) }}">delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
