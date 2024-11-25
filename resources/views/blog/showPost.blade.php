@extends('layouts.app')

@section('title', 'Post')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-lg-4 col-md-6 col-sm-12">
                <div class="card mb-4">
                    <img src="{{ asset('images/' . $post->image) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h3 class="card-title">{{ $post->title }}</h3>
                        By : <span class="text-dark ">{{ $post->user->name }}</span>
                        On <span class="card-text">{{ $post->created_at->format('M d, Y') }}</span>
                        <p class="card-text">{{ $post->content }}</p>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        @if (Auth::user() && Auth::user()->id == $post->user_id)
            <div class="row">
                <div class="col">
                    <div class="d-flex justify-content-start align-items-center">

                        <a href="/blog/{{ $post->slug }}/edit" class="btn btn-outline-primary me-2">Edit Post</a>

                        <form action="/blog/{{ $post->slug }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">Delete Post</button>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    @endif
    </div>
    
@endsection
