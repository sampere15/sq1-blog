@extends('layouts.app')

@section('content')

    <div class="row" style="margin-top: 10px; margin-bottom: 10px">
        <div class="pull-left">
            <a href="{{ url()->previous() }}" class="btn btn-lg btn-secondary">
                Go Back
            </a>
        </div>
    </div>

    <h2>{{ $post->title }}</h2>
    <p>{{ $post->description }}</p>
    <p>{{ $post->publication_date }}</p>
    <a href="">{{ $post->user->name }}</a>
@endsection
