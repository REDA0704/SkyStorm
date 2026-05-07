@extends('layouts.app')

@section('content')

    <div class="container">

        <h1>{{ $user->name }}</h1>

        <div class="mb-4">

            <strong>{{ $user->followers->count() }}</strong> followers

            |

            <strong>{{ $user->following->count() }}</strong> following

            |

            <strong>{{ $user->posts->count() }}</strong> posts

        </div>

        @foreach($posts as $post)

            <div class="card mb-3">
                <div class="card-body">

                    <p>{{ $post->content }}</p>

                    <small>
                        Posté {{ $post->created_at->diffForHumans() }}
                    </small>

                </div>
            </div>

        @endforeach

    </div>

@endsection
