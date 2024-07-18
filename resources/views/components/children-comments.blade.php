<!-- resources/views/components/children-comments.blade.php -->

<ul class="children">
    @foreach ($replies as $reply)
        <li class="comment">
            <div class="vcard">
                @php
                    if ($reply->user_id == null || empty($reply->user_id)) {
                        $replyAvatarUrl = 'https://static.thenounproject.com/png/642902-200.png';
                        $replyUsername = $reply->guest_name;
                    } else {
                        $replyAvatarUrl = 'http://127.0.0.1:8000/images/uploads/user/' . $reply->user->photo_url;
                        $replyUsername = $reply->user->fname . ' ' . $reply->user->lname;
                    }
                @endphp
                <img src="{{ $replyAvatarUrl }}">
            </div>
            <div class="comment-body">
                <h3>{{ $replyUsername }}</h3>
                <div class="meta">{{ $reply->created_at }}</div>
                <p>{{ $reply->comment }}</p>
                <p><a href="#" class="reply rounded" data-content="{{ $reply->id }}" data-user-name="{{ $replyUsername }}">Reply</a></p>
                
                {{-- Check for replies to this reply --}}
                @php
                    $subReplies = \App\Models\Comment::where('reply_id', $reply->id)->get();
                @endphp

                @if ($subReplies->count() > 0)
                    <x-children-comments :replies="$subReplies" />
                @endif
            </div>
        </li>
    @endforeach
</ul>
