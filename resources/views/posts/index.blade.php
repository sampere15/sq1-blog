@extends('layouts.app')

@section('content')
	<h1>Blog</h1>

	<div class="row">
		@foreach ($posts as $post)
			@include("posts.components.PostItem", $post)
		@endforeach
	</div>

@endsection
