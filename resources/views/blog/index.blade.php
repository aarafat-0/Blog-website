@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    <h1>All Posts</h1>
    <div class="container">
        @if (Auth::check())
            <a href="/blog/create" class="btn btn-outline-success">Add Post</a>
        @else
            <a href="/login" class="btn btn-outline-primary">Login to Add Post</a>
        @endif
        <hr>
        @foreach ($posts as $post)
            <div class="row">
                <div class="col col-lg-4 col-md-6 col-sm-12">
                    <div class="card mb-4">
                        <img src="images/{{ $post->image }}" class="card-img-top" alt="...">
                        @error('image')
                            {{ $message }}
                        @enderror
                        <div class="card-body">
                            <h3 class="card-title">{{ $post->title }}</h3>
                            <p class="card-text">{{ $post->content }}</p>
                            By : <span class="text-dark ">{{ $post->user->name }}</span>
                            On <span class="card-text">{{ $post->created_at->format('M d, Y') }}</span>
                            <br>
                            last update : <small class="text-body-secondary  ">
                                {{ $post->updated_at->diffForHumans() }}</small>
                            <br>
                            <a href="/blog/{{ $post->slug }}"><button class="btn btn-outline-dark">Read More</button></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

@endsection
