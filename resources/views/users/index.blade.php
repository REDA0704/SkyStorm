@extends('layouts.app')

@section('content')

    <div class="container" style="max-width: 700px;">

        <h1 class="mb-4 fw-bold">
            Users
        </h1>

        @foreach($users as $user)

            <div class="card mb-3 border-0 shadow-sm rounded-4">

                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>
                        <a href="/users/{{ $user->id }}" class="text-decoration-none text-dark fw-bold fs-5">
                            {{ $user->name }}
                        </a>
                    </div>

                    @if(auth()->id() !== $user->id)
                        @if(auth()->user()->following()->where('users.id', $user->id)->exists())

                            <form action="{{ route('user.unfollow') }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <input type="hidden" name="following_id" value="{{ $user->id }}">

                                <button class="btn btn-danger rounded-pill px-4">
                                    Unfollow
                                </button>
                            </form>

                    @else

                        <form action="{{ route('user.follow') }}" method="POST">
                            @csrf

                            <input type="hidden" name="following_id" value="{{ $user->id }}">

                            <button class="btn btn-primary rounded-pill px-4">
                                Follow
                            </button>
                        </form>
                        @endif
                    @endif
                </div>
            </div>
        @endforeach
    </div>

@endsection
