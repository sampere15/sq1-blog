<div class="col-md-12 col-lg-6" style=" padding: 5px; height: 400px;">
    <div style="border: 1px solid black; border-radius: 10px; height: 100%; width: 100%; padding: 20px">
        <a href=""><h3>{{ $blog->title }}</h3></a>
        <p>{{ $blog->description }}<a href=""> Read more...</a></p>
        <p>{{ $blog->publication_date }}</p>
        <a href="">{{ $blog->user->name }}</a>
    </div>
</div>
