<!-- resources/views/components/Comments.blade.php -->

@props(['comments'])

<ul class="comment-list">
    @foreach ($comments as $comment)
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
                @if ($comment->replies->count() > 0)
                    <x-comments :comments="$comment->replies" />
                @endif
            </div>
        </li>
    @endforeach
</ul>
