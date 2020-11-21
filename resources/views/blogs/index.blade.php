@extends('layouts.app')

@section('content')
	<h1>Blogs</h1>

	<div class="row">
		@foreach ($blogs as $blog)
			@include("blogs.components.BlogItem", $blog)
		@endforeach
	</div>

@endsection
