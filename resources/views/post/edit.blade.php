@extends("layout")

@section('title')
    <h1>{{ $pageTitle }}</h1>
@endsection

@section('content')
    <form method="post" action="{{ route('post.update') }}">
        @csrf
        <input type="hidden" name="id" value="{{ $id }}">
        <div class="container">
            <div class="row">
                <div class="col">
                    <label for="title">title:</label>
                    <input class="form-control" id="title" name="title" value="{{ $data['title'] }}">
                    @isset($_SESSION['errors']['title'])
                        @foreach($_SESSION['errors']['title'] as $error)
                            <div class="alert alert-danger" role="alert">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endisset
                </div>
                <div class="col">
                    <label for="slug">slug</label>
                    <input class="form-control" id="slug" name="slug" value="{{ $data['slug'] }}">
                    @isset($_SESSION['errors']['slug'])
                        @foreach($_SESSION['errors']['slug'] as $error)
                            <div class="alert alert-danger" role="alert">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endisset
                </div>
                <div class="col">
                    <label for="body">body</label>
                    <input class="form-control" id="body" name="body" value="{{ $data['body'] }}">
                    @isset($_SESSION['errors']['body'])
                        @foreach($_SESSION['errors']['body'] as $error)
                            <div class="alert alert-danger" role="alert">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endisset
                </div>
                <div class="col">
                    <label for="category_id">category</label>
                    <select id="category_id" name="category_id" class="form-control">
                        @foreach($categories as $category)
                            <option @if($category->id == $data->category_id) selected @endif value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                    @isset($_SESSION['errors']['category_id'])
                        @foreach($_SESSION['errors']['category_id'] as $error)
                            <div class="alert alert-danger" role="alert">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endisset
                </div>
            </div>
            <div class="row">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
    @php
        unset($_SESSION['errors']);
        unset($_SESSION['data']);
    @endphp
@endsection
