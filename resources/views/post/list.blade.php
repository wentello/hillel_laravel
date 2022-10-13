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
                <th scope="col">Author</th>
                <th scope="col">Category</th>
                <th scope="col">Body</th>
                <th scope="col">Created At</th>
                <th scope="col">Updates At</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $i => $post)
                <tr>
                    <th scope="row">{{ $i+1 }}</th>
                    <td>{{ $post->title }}</td>
                    <td>
                        @foreach($users as $user)
                            @if($user->id == $post->user_id)
                                <a href="{{ route('post.author',['author' => $user->id]) }}">{{ $user->name }}</a>
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach($categories as $category)
                            @if($category->id == $post->category_id)
                                <a href="{{ route('category.index',['category' => $category->id]) }}">{{ $category->title }}</a>
                            @endif
                        @endforeach
                    </td>
                    <td>{{ $post->body }}</td>
                    <td class="td-date">{{ $post->created_at->format('Y-m-d') }}</td>
                    <td class="td-date">{{ $post->updated_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
