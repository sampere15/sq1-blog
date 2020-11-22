@extends('layouts.app')

@section('content')
	<h1>Posts</h1>

    @auth
        <a href="{{ route("posts.create") }}" class="btn btn-primary">Create new Post</a>
    @endauth

    <div class="col-xs-12 row">
        @include('posts.partials.postList', $posts)
    </div>

@endsection
