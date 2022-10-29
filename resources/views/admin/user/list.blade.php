@extends("layout")

@section('title')
    <h1>{{ $title }}</h1>
@endsection

@section('content')
    <div class="container">
        @foreach($users as $user)
            <div class="row">
                <div class="col">
                    id: {{ $user->id }}
                </div>
                <div class="col">
                    name: {{ $user->name }}
                </div>
                <div class="col">
                    email: {{ $user->email }}
                </div>
                <div class="col">
                    <a href="{{ route('admin.post_by_type.index', ['id' => $user->id, 'postable_type' => 'User']) }}">show posts</a>
                </div>
            </div>
        @endforeach

    </div>
@endsection
