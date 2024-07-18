<section class="section posts-entry posts-entry-sm bg-light">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-uppercase text-black">More Blog Posts</div>
        </div>
        <div class="row">
            @foreach ($randomPosts as $item)
            <div class="col-md-6 col-lg-3">
                <div class="blog-entry">
                    <a href="{{ route('posts.show', ['url' => $item->url]) }}" class="img-link">
                        <img src="http://127.0.0.1:8000/images/uploads/post/{{ $item->photo_url }}" alt="Image" class="img-fluid">
                    </a>
                    <span class="date">{{$item->created_at}}</span>
                    <h2><a href="single.html">{{$item->title}}</p>
                    <p><a href="{{ route('posts.show', ['url' => $item->url]) }}" class="read-more">Continue Reading</a></p>
                </div>
            </div>
            @endforeach


        </div>
    </div>
</section>