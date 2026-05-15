@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>Créer un post</h1>

        @if ($errors->any())

            <div class="alert alert-danger">

                @foreach ($errors->all() as $error)
                    <p class="mb-0">{{ $error }}</p>
                @endforeach

            </div>

        @endif

        <form action="/posts" method="POST">
            @csrf

            <div class="mb-3">
                <label>Contenu :</label>
                <textarea name="content" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Publier</button>
        </form>

    </div>
@endsection
