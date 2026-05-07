@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>Modifier le post</h1>

        <form action="/posts/{{ $post->id }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <textarea name="content" class="form-control">{{ $post->content }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>

    </div>
@endsection
