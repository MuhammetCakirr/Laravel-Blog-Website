<div class="col-md-4">
    <a href="single.html" class="h-entry img-5 h-100 gradient">
        <div class="featured-img" style="background-image: url('images/img_1_vertical.jpg');"></div>
        <div class="text">
            <span class="date">Apr. 14th, 2022</span>
            <h2>Why is my internet so slow?</h2>
        </div>
    </a>
</div>

<div class="col-md-4">
    @foreach ($posts as $post)
        <a href="{{ route('posts.show', ['url' => $post->url]) }}" class="h-entry mb-30 v-height gradient">

            <div class="featured-img" style="background-image: url('images/uploads/post/{{$post->photo_url}}');"></div>

            <div class="text">
                <span class="date">{{$post->created_at}}</span>
                <h2>{{$post->title}}</h2>
            </div>
        </a>
    @endforeach
</div>

<div class="col-md-4">
    @foreach ($posts as $post)
        <a href="{{ route('posts.show', ['url' => $post->url]) }}" class="h-entry mb-30 v-height gradient">

            <div class="featured-img" style="background-image: url('images/uploads/post/{{$post->photo_url}}');"></div>

            <div class="text">
                <span class="date">{{$post->created_at}}</span>
                <h2>{{$post->title}}</h2>
            </div>
        </a>
    @endforeach
</div>
