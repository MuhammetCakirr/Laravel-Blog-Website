@extends('template')
@section('body')
    <div class="site-cover site-cover-sm same-height overlay single-page"
        style="background-image: url('http://127.0.0.1:8000/images/uploads/post/{{ $post->photo_url }}');">
        <div class="container">
            <div class="row same-height justify-content-center">
                <div class="col-md-6">
                    <div class="post-entry text-center">
                        <h1 class="mb-4">{{ $post->title }}</h1>
                        <div class="post-meta align-items-center text-center">
                            <figure class="author-figure mb-0 me-3 d-inline-block"><img
                                    src="http://127.0.0.1:8000/images/uploads/post/{{ $post->photo_url }}" alt="Image"
                                    class="img-fluid"></figure>
                            <span
                                class="d-inline-block mt-1">{{ 'By ' . $post->publisher->fname . ' ' . $post->publisher->lname }}</span>
                            <span>&nbsp;-&nbsp; {{ $post->formatted_created_at }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="container">

            <div class="row blog-entries element-animate">

                <div class="col-md-12 col-lg-8 main-content">
                    @php
                        $content = $post->content;
                        $length = strlen($content);
                        $halfLength = ceil($length / 2);
                        $firstHalf = substr($content, 0, $halfLength);
                        $secondHalf = substr($content, $halfLength);
                        $firstHalf = rtrim($firstHalf, '. ') . '. ';
                        $secondHalf = '. ' . ltrim($secondHalf, '. ');
                    @endphp
                    <div class="post-content-body">
                        <p>{{ trim($firstHalf) }}</p>
                        <div class="row my-4">
                            <div class="col-md-12 mb-4">
                                <img src="http://127.0.0.1:8000/images/uploads/post/{{ $post->photo_url }}"
                                    alt="Image placeholder" class="img-fluid rounded" style="width: 300px; object-fit: cover"> 
                            </div>

                        </div>
                        <p>{{ trim($secondHalf) }}</p>
                    </div>
                    <div class="pt-5 comment-wrap">
                        <h3 class="mb-5 heading"> {{ count($post->comments) . ' ' . 'Comments' }}</h3>
                        <ul class="comment-list">
                            @foreach ($post->comments->where('reply_id', null) as $comment)
                                <li class="comment">
                                    <div class="comment-body">
                                        <div class="vcard">
                                            @php
                                                if ($comment->user_id == null || empty($comment->user_id)) {
                                                    $avatarUrl = 'https://static.thenounproject.com/png/642902-200.png';
                                                    $username = $comment->guest_name;
                                                } else {
                                                    $avatarUrl = 'http://127.0.0.1:8000/images/uploads/user/' . $comment->user->photo_url;
                                                    $username = $comment->user->fname . ' ' . $comment->user->lname;
                                                }
                                            @endphp
                                            <img src="{{ $avatarUrl }}">
                                        </div>
                                        <h3>{{ $username }}</h3>
                                        <div class="meta">{{ $comment->created_at }}</div>
                                        <p>{{ $comment->comment }}</p>
                                        <p><a href="#" class="reply rounded" data-content="{{ $comment->id }}" data-user-name="{{ $username }}">Reply</a></p>
                                        
                                        {{-- Display replies --}}
                                        @php
                                            $replies = \App\Models\Comment::where('reply_id', $comment->id)->get();
                                        @endphp
                                        @if ($replies->count() > 0)
                                            <x-children-comments :replies="$replies" />
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        
                        
                        
                        <!-- END comment-list -->

                        <div class="comment-form-wrap pt-5" id="leavecommentcontainer">
                            <h3 class="mb-5">Leave a comment</h3>
                            <form action="{{ route('AddComment') }}" method="POST" class="p-5 bg-light">
                                @csrf
                                <div id="replyIndicator" style="display: none; position: relative; border-radius: 10px">
                                    <h3 class="mb-5" style="text-align: center" id="answerp">Reply to Muhammet 👇</h3>
                                    <button type="button" id="closeReplyIndicator" style="position: absolute; right: 10px; top: 10px; background: none; border: 1px solid black; border-radius: 50%; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; font-size: 20px; cursor: pointer;">&times;</button>
                                </div>
                                @if (!Auth::check())
                                <div class="form-group">
                                    <label for="name">Name *</label>
                                    <input type="text" class="form-control" id="guest_name" name="guest_name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email *</label>
                                    <input type="email" class="form-control" id="guest_email" name="guest_email">
                                </div>
                                @endif
                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea name="content" id="message" cols="30" rows="10" class="form-control"></textarea>
                                </div>
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <input type="hidden" name="reply_id" id="reply_id" >
                                <div class="form-group">
                                    <input type="submit" value="Post Comment" class="btn btn-primary">
                                </div>

                            </form>
                        </div>
                    </div>

                </div>

                <!-- END main-content -->

                <div class="col-md-12 col-lg-4 sidebar">

                    <!-- END sidebar-box -->
                    <div class="sidebar-box">
                        <div class="bio text-center">
                            <img src="http://127.0.0.1:8000/images/uploads/user/{{ $post->publisher->photo_url }}"
                                alt="Image Placeholder" class="img-fluid mb-3">
                            <div class="bio-body">
                                <h2>{{ $post->publisher->fname . ' ' . $post->publisher->lname }}</h2>
                                <p class="mb-4">{{ $post->publisher->preface }}</p>
                                <p><a href="{{ route('staffs.show', ['id' => $post->publisher->id]) }}"
                                        class="btn btn-primary btn-sm rounded px-2 py-2">Read my bio</a></p>

                            </div>
                        </div>
                    </div>

                    <!-- END sidebar-box -->
                    {{-- <div class="sidebar-box">
                        <h3 class="heading">Popular Posts</h3>
                        <div class="post-entry-sidebar">
                            <ul>
                                <li>
                                    <a href="">
                                        <img src="images/img_1_sq.jpg" alt="Image placeholder" class="me-4 rounded">
                                        <div class="text">
                                            <h4>There’s a Cool New Way for Men to Wear Socks and Sandals</h4>
                                            <div class="post-meta">
                                                <span class="mr-2">March 15, 2018 </span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <img src="images/img_2_sq.jpg" alt="Image placeholder" class="me-4 rounded">
                                        <div class="text">
                                            <h4>There’s a Cool New Way for Men to Wear Socks and Sandals</h4>
                                            <div class="post-meta">
                                                <span class="mr-2">March 15, 2018 </span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <img src="images/img_3_sq.jpg" alt="Image placeholder" class="me-4 rounded">
                                        <div class="text">
                                            <h4>There’s a Cool New Way for Men to Wear Socks and Sandals</h4>
                                            <div class="post-meta">
                                                <span class="mr-2">March 15, 2018 </span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div> --}}
                    <!-- END sidebar-box -->

                    {{-- <div class="sidebar-box">
                        <h3 class="heading">Categories</h3>
                        <ul class="categories">
                            <li><a href="#">Food <span>(12)</span></a></li>
                            <li><a href="#">Travel <span>(22)</span></a></li>
                            <li><a href="#">Lifestyle <span>(37)</span></a></li>
                            <li><a href="#">Business <span>(42)</span></a></li>
                            <li><a href="#">Adventure <span>(14)</span></a></li>
                        </ul>
                    </div> --}}
                    <!-- END sidebar-box -->


                </div>
                <!-- END sidebar -->

            </div>
        </div>
    </section>


    <!-- Start posts-entry -->
    @include('postdetail_header')
    <!-- End posts-entry -->
    <script>
 document.addEventListener('DOMContentLoaded', function() {
        const replyLinks = document.querySelectorAll('.reply');
        const replyIdInput = document.getElementById('reply_id');
        const replyIndicator = document.getElementById('replyIndicator');
        const closeReplyIndicator = document.getElementById('closeReplyIndicator');
        var answerp=document.getElementById('answerp');

        replyLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const commentId = this.getAttribute('data-content');
                const commentname =this.getAttribute('data-user-name');
                if (replyIdInput) {
                    replyIdInput.value = commentId;
                    answerp.innerHTML="Reply to " + commentname + "👇"
                }
                if (replyIndicator) {
                    replyIndicator.style.display = 'block';
                    
                }
                const commentContainer = document.getElementById('leavecommentcontainer');
                if (commentContainer) {
                    commentContainer.scrollIntoView({ behavior: 'smooth' });
                    commentContainer.focus();
                }
            });
        });

        closeReplyIndicator.addEventListener('click', function() {
            if (replyIdInput) {
                replyIdInput.value = '';
            }
            if (replyIndicator) {
                replyIndicator.style.display = 'none';
            }
        });
    });
    </script>
@endsection
