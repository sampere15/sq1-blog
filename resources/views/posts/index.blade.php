@extends('layouts.app')

@section('content')
	<h1>Posts</h1>

    <div class="row">
        <div class="col-sm-6">
            @auth
                <a href="{{ route("posts.create") }}" class="btn btn-primary">Create new Post</a>
            @endauth
        </div>
        <div class="col-sm-6">

            <form id="sortform" method="POST" action="{{ route("posts.index") }}">
                @csrf
                @method("GET")
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Post order: </label>
                    <div class="col-sm-9">
                        <select name="postsort" class="form-control form-control-sm" onchange="this.form.submit()">
                            <option value="desc" {{ $postsort === "desc" ? "selected" : "" }}>Last created first</option>
                            <option value="asc" {{ $postsort === "asc" ? "selected" : "" }}>First created first</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="col-xs-12 row">
        @include('posts.partials.postList', [$posts, $postsort])
    </div>

@endsection
