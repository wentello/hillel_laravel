@extends("layout")

@section('title')
    <h1>{{ $title }}</h1>
@endsection

@section('content')
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Body</th>
                <th scope="col">PostType</th>
                <th scope="col">Created At</th>
                <th scope="col">Updates At</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $i => $post)
                <tr>
                    <th scope="row">{{ $i+1 }}</th>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->body }}</td>
                    <td>{{ $postable_type }}</td>
                    <td class="td-date">{{ $post->created_at->format('Y-m-d') }}</td>
                    <td class="td-date">{{ $post->updated_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
