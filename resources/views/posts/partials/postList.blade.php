@if($postsort === "asc")
    @foreach ($posts->sortBy("publication_date") as $post)
        <div class="col-xs-12 col-md-6 post-list-item-container">
            <div class="post-list-item">
                <a href="{{ route("posts.show", $post->id) }}"><h3 style="text-decoration: none">{{ $post->title }}</h3></a>
                <p>
                    {{ \Illuminate\Support\Str::limit($post->description, $limit = 300, $end = '...') }}
                    <a href="{{ route("posts.show", $post->id) }}">Read More</a>
                </p>
                <p><a href="{{ route("user.posts", $post->user->id) }}">{{ $post->user->name }}</a> - {{ $post->publication_date }}</p>
            </div>
        </div>
    @endforeach
@else
    @foreach ($posts->sortByDesc("publication_date") as $post)
        <div class="col-xs-12 col-md-6 post-list-item-container">
            <div class="post-list-item">
                <a href="{{ route("posts.show", $post->id) }}"><h3 style="text-decoration: none">{{ $post->title }}</h3></a>
                <p>
                    {{ \Illuminate\Support\Str::limit($post->description, $limit = 300, $end = '...') }}
                    <a href="{{ route("posts.show", $post->id) }}">Read More</a>
                </p>
                <p><a href="{{ route("user.posts", $post->user->id) }}">{{ $post->user->name }}</a> - {{ $post->publication_date }}</p>
            </div>
        </div>
    @endforeach
@endif
