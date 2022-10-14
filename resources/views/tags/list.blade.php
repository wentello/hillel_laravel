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
                <th scope="col">Tag</th>
                <th scope="col">Post Title</th>
                <th scope="col">Post Slug</th>
                <th scope="col">Created At</th>
                <th scope="col">Updates At</th>
            </tr>
            </thead>
            <tbody>
            @foreach($arrPostTags as $i => $postTag)
                <tr>
                    <th scope="row">{{ $i+1 }}</th>
                    <td>{{ $tag->title }}</td>
                    <td>{{ $postTag[$tag->id]->title }}</td>
                    <td>{{ $postTag[$tag->id]->slug }}</td>
                    <td class="td-date">{{ $objPostTags[$i]->created_at->format('Y-m-d') }}</td>
                    <td class="td-date">{{ $objPostTags[$i]->updated_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
