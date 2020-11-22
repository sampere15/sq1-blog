@extends('layouts.app')

@section('content')

    @include("partials.goback")

	<h1>{{ $user->name }}'s Posts</h1>

    @auth
        <a href="{{ route("posts.create") }}" class="btn btn-primary">Create new Post</a>
    @endauth

    <div class="col-xs-12 row">
        @include('posts.partials.postList', $posts)
    </div>

@endsection
