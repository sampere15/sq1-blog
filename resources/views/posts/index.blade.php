@extends('layouts.app')

@section('content')
	<h1>Blog</h1>

    @auth
        <a href="{{ route("posts.create") }}" class="btn btn-primary">Create new Post</a>
    @endauth

	<div class="row">
		@foreach ($posts as $post)
			@include("posts.components.PostItem", $post)
		@endforeach
	</div>

@endsection
