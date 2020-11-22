@extends('layouts.app')

@section('content')
    <h1>Import Post from API</h1>

    <span>Example: https://sq1-api-test.herokuapp.com/posts</span>

    <form method="POST" action="{{ route('posts.storeimport') }}">
        @csrf
        {{-- URL --}}
        <div class="form-group col-xs-12 col-lg-8">
            <label for="url">URL</label>
            <input
                type="text"
                class="form-control"
                name="url"
                placeholder="Insert API url to import posts..."
                value="{{ old('url') }}"
                autofocus
                required
            >

            @if ($errors->has('url'))
                <span class="help-block error-bold">
                    {{ $errors->first('url') }}
                </span>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Import!</button>
    </form>
@endsection
