@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-8">

        @foreach($posts as $post)

            <div class="card mb-4 border-0 shadow-sm rounded-4">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center mb-2">

                        <h5 class="fw-bold mb-0">
                            <a href="/users/{{ $post->user->id }}" class="text-decoration-none text-dark">
                                {{ $post->user->name }}
                            </a>
                        </h5>

                        <small class="text-muted">
                            {{ $post->created_at->diffForHumans() }}
                        </small>
                    </div>

                    <p class="fs-5 mb-4">
                        {{ $post->content }}
                    </p>


                    <div class="d-flex gap-2 align-items-center">

                    <span class="text-muted">
                        ❤️ {{ $post->likes->count() }} likes
                    </span>

                        @if(auth()->user()->likes()->where('posts.id', $post->id)->exists())

                            <form action="{{ route('posts.like') }}" method="POST">
                                @csrf

                                <input type="hidden" name="post_id" value="{{ $post->id }}">

                                @if(auth()->user()->likes->contains($post->id))

                                    <button class="btn btn-sm btn-outline-danger">
                                        Unlike
                                    </button>

                                @else

                                    <button class="btn btn-sm btn-outline-primary">
                                        Like
                                    </button>

                                @endif

                            </form>
                        @else

                            <form action="{{ route('posts.like') }}" method="POST">
                                @csrf

                                <input type="hidden" name="post_id" value="{{ $post->id }}">

                                <button class="btn btn-sm btn-outline-primary">
                                    Like
                                </button>
                            </form>

                        @endif

                        @if(auth()->id() === $post->user_id)

                            <a href="/posts/{{ $post->id }}/edit" class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <form action="/posts/{{ $post->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        Delete
                                    </button>
                            </form>

                        @endif

                    </div>

                </div>

            </div>

        @endforeach

    </div>


        <div class="col-md-4">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body">

                    <h5 class="fw-bold mb-3">
                        Suggestions
                    </h5>

                    @foreach($suggestedUsers as $user)

                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <a href="/users/{{ $user->id }}"
                               class="text-decoration-none text-dark fw-bold">

                                {{ $user->name }}

                            </a>

                            <form action="{{ route('user.follow') }}" method="POST">

                                @csrf

                                <input type="hidden"
                                       name="following_id"
                                       value="{{ $user->id }}">

                                <button class="btn btn-sm btn-primary rounded-pill">
                                    Follow
                                </button>

                            </form>

                        </div>

                    @endforeach

                    <hr>

                    <form action="/users" method="GET">

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search users..."
                        >

                    </form>

                </div>

            </div>

        </div>

    </div>

    </div>
@endsection
