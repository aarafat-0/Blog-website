@extends('layouts.app')

@section('content')
    <div class="home">
        <div>
            <h1>Home Page</h1>
            <p>welcome to my blog website</p>
            <a href="{{ route('blog.index') }}" class="btn btn-primary">Start Reading </a>
        </div>
    </div>

    <div class="recent">
        <h1>Recent Posts</h1>
        <div class="container">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex deserunt quae modi nostrum, qui quidem, vel minima
            ratione assumenda necessitatibus veritatis praesentium nobis fuga doloremque hic voluptas, facere nesciunt
            veniam!
        </div>
    </div>
@endsection
