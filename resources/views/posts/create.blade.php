@extends('layouts.app')

@section('content')
    <h1>Create new Post</h1>

    <form method="POST" action="{{ route('posts.store') }}">
        @csrf
        {{-- Title --}}
        <div class="form-group col-xs-12 col-lg-8">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" placeholder="Title here..." value="{{ old('title') }}" autofocus required>

            @if ($errors->has('title'))
                <span class="help-block error-bold">
                    {{ $errors->first('title') }}
                </span>
            @endif
        </div>
        {{-- Description --}}
        <div class="form-group col-xs-12 col-lg-8">
            <label for="description">Description</label>
            <textarea class="form-control" rows="3" name="description" placeholder="What do you want to tell?" value="{{ old('description') }}" required></textarea>

            @if ($errors->has('description'))
                <span class="help-block error-bold">
                    {{ $errors->first('description') }}
                </span>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Create!</button>
    </form>
@endsection
