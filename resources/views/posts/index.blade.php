@extends('layouts.app')

@section('content')
	<h1>Blog</h1>

    @auth
        <a href="{{ route("posts.create") }}" class="btn btn-primary">Create new Post</a>
    @endauth

	{{-- <div class="row">
		@foreach ($posts as $post)
			@include("posts.components.PostItem", $post)
		@endforeach
	</div> --}}

    <div class="col-xs-12 row">
        @foreach ($posts as $post)
            <div class="col-xs-12 col-md-6 post-list-item-container">
                <div class="post-list-item">
                    <a href="{{ route("posts.show", $post->id) }}"><h3 style="text-decoration: none">{{ $post->title }}</h3></a>
                    <p>
                        {{ \Illuminate\Support\Str::limit($post->description, $limit = 300, $end = '...') }}
                        <a href="{{ route("posts.show", $post->id) }}">Read More</a>
                    </p>
                    <p><a href="">{{ $post->user->name }}</a> - {{ $post->publication_date }}</p>
                </div>
            </div>
        @endforeach
    </div>

@endsection
