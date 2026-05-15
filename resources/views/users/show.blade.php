@extends('layouts.app')

@section('content')

    <div class="container" style="max-width: 800px;">

        <!-- En-tête du profil -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h1 class="fw-bold mb-0">{{ $user->name }}</h1>
                    </div>

                    <!-- Bouton Follow/Unfollow (si ce n'est pas son profil) -->
                    @if(auth()->id() !== $user->id)
                        @if(auth()->user()->following()->where('users.id', $user->id)->exists())
                            <form action="{{ route('user.unfollow') }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="following_id" value="{{ $user->id }}">
                                <button class="btn btn-danger rounded-pill">
                                    Unfollow
                                </button>
                            </form>
                        @else
                            <form action="{{ route('user.follow') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="following_id" value="{{ $user->id }}">
                                <button class="btn btn-primary rounded-pill">
                                    Follow
                                </button>
                            </form>
                        @endif
                    @endif
                </div>

                <!-- Statistiques -->
                <div class="row text-center">
                    <div class="col-md-4">
                        <div>
                            <strong class="fs-5">{{ $user->posts->count() }}</strong>
                            <p class="text-muted mb-0">Posts</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div>
                            <strong class="fs-5">{{ $user->followers->count() }}</strong>
                            <p class="text-muted mb-0">Followers</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div>
                            <strong class="fs-5">{{ $user->following->count() }}</strong>
                            <p class="text-muted mb-0">Following</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Liste des posts -->
        <h2 class="fw-bold mb-3">Posts</h2>

        @forelse($posts as $post)

            <div class="card mb-3 border-0 shadow-sm rounded-4">
                <div class="card-body p-4">

                    <p class="fs-5 mb-3">{{ $post->content }}</p>

                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            {{ $post->created_at->diffForHumans() }}
                        </small>

                        <span class="text-muted">
                            ❤️ {{ $post->likes->count() }}
                        </span>
                    </div>

                </div>
            </div>

        @empty
            <div class="alert alert-info">
                Cet utilisateur n'a pas encore publié de posts.
            </div>
        @endforelse

    </div>

@endsection
