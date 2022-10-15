@extends("layout")

@section('title')
    <h1>{{ $pageTitle }}</h1>
@endsection

@section('content')
    <form method="post" action="{{ route('admin.tag.update') }}">
        @csrf
        <input type="hidden" name="id" value="{{ $id }}">
        <div class="container">
            <div class="row">
                <div class="col">
                    <label for="title">title:</label>
                    <input class="form-control" id="title" name="title" value="{{ $data->title }}">
                    @if($errors->has('title'))
                        @foreach($errors->get('title') as $error)
                            <div class="alert alert-danger" role="alert">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endisset
                </div>
                <div class="col">
                    <label for="slug">slug</label>
                    <input class="form-control" id="slug" name="slug" value="{{ $data->slug }}">
                    @if($errors->has('slug'))
                        @foreach($errors->get('slug') as $error)
                            <div class="alert alert-danger" role="alert">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endisset
                </div>
                <div class="col">
                    <label for="category_id">post</label>
                    <select id="category_id" name="post_id[]" class="form-control" multiple>
                        @foreach($posts as $post)
                            <option
                            @foreach($dataPosts as $dpost)
                                 @if($post->id == $dpost->id) selected
                                        @endif
                            @endforeach
                                        value="{{ $post->id }}">{{ $post->title }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('post_id'))
                        @foreach($errors->get('post_id') as $error)
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
@endsection
