@extends('template')
@section('body')
<section class="section bg-light">
    @php
        $postGroups = $posts->chunk(5);
    @endphp
        <div class="container">
            <div class="row align-items-stretch retro-layout">
                @foreach ($posts as $post)
                <div class="col-md-4"> 
                        <a href="{{ route('posts.show', ['url' => $post->url]) }}" class="h-entry mb-30 v-height gradient">
                            <div class="featured-img" style="background-image: url('images/uploads/post/{{$post->photo_url}}');"></div>
                            <div class="text">
                                <span class="date">{{$post->created_at}}</span>
                                <h2>{{$post->title}}</h2>
                            </div>
                        </a>
                </div>
                @endforeach

            </div>
        </div>
</section>
@endsection