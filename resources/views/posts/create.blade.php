@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>Créer un post</h1>

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
