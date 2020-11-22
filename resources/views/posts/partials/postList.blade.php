{{-- <div class="col-md-12 col-lg-6" style=" padding: 5px; height: 400px;">
    <div style="border: 1px solid black; border-radius: 10px; height: 100%; width: 100%; padding: 20px">
        <a href="{{ route("posts.show", $post->id) }}"><h3>{{ $post->title }}</h3></a>
        <p>{{ $post->description }}<a href="{{ route("posts.show", $post->id) }}"> Read more...</a></p>
        <p>{{ $post->publication_date }}</p>
        <a href="">{{ $post->user->name }}</a>
    </div>
</div> --}}

@foreach ($posts as $post)
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
