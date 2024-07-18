<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function addPostForDb(Request $request)
    {
        $userId = Auth::user()->id;
        $title = $request->posttitle;
        $content = $request->postsubject;
        $file = $request->file('validatedCustomFile');
        $fileName = Str::random(10) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images/uploads/post'), $fileName);

        $url = Str::slug($title);
        $originalUrl = $url;
        $count = 1;

        while (Post::where('url', $url)->exists()) {
            $url = $originalUrl . '-' . $count++;
        }
        if (!Auth::user()->can('direct post creation')) {
            Post::create(
                [
                    "publisher_id" => $userId,
                    "title" => $title,
                    "content" => $content,
                    "photo_url" => $fileName,
                    "url" => $url,
                    "status" => 4
                ]
            );
            $message = "Onay bekliyor";


        } else {
            Post::create(
                [
                    "publisher_id" => $userId,
                    "title" => $title,
                    "content" => $content,
                    "photo_url" => $fileName,
                    "url" => $url,
                    "status" => 1
                ]
            );
            $message = "Oluşturuldu";

        }
        return redirect()->intended('GetPosts')->with([
            'message' => $message

        ]);


    }

    public function show($url)
    {
        $post = Post::with(['publisher', 'comments.user'])->where('url', $url)->firstOrFail();
        $formattedCreatedAt = $post->formatted_created_at;
        // dd($post);
        return view('post_detail', compact('post'));
    }

    public function accountshow($personelid)
    {
        $personel = User::with([
            'posts' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }
        ])->where('id', $personelid)->firstOrFail();
        return view('user_account', compact('personel'));
    }

    public function addComment(Request $request)
    {

        $content = $request->content;
        $guest_email = $request->guest_email;
        $guest_name = $request->guest_name;
        $post_id = $request->post_id;
        $reply_id = $request->reply_id;

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            if (trim(empty($reply_id)) || $reply_id == "") {
                Comment::create([
                    "user_id" => $user_id,
                    "post_id" => $post_id,
                    "comment" => $content
                ]);
            } else {
                Comment::create([
                    "user_id" => $user_id,
                    "post_id" => $post_id,
                    "reply_id" => $reply_id,
                    "comment" => $content
                ]);

            }

        } else {
            if (trim(empty($reply_id)) || $reply_id == "") {
                Comment::create([
                    "guest_name" => $guest_name,
                    "guest_email" => $guest_email,
                    "post_id" => $post_id,
                    "comment" => $content
                ]);
            } else {
                Comment::create([
                    "guest_name" => $guest_name,
                    "guest_email" => $guest_email,
                    "post_id" => $post_id,
                    "reply_id" => $reply_id,
                    "comment" => $content
                ]);

            }
        }
    }

    public function getPostsFromDb()
    {
        $posts = Post::with('publisher', 'editor', 'comments.user')
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('posts', compact('posts'));
    }

    public function editPost(Request $request)
    {
        $postId = $request->id;
        $post = Post::where('id', $postId)->get()->firstOrFail();
        // dd($post);
        return view('post_edit', compact("post"));
    }
    public function editPostOfDb(Request $request)
    {
        $postId = $request->editpostid;
        $editposttitle = $request->editposttitle;
        $editpostsubject = $request->editpostsubject;


        if ($request->hasFile('editvalidatedCustomFile')) {
            $file = $request->file('editvalidatedCustomFile');
            $fileName = Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/uploads/post'), $fileName);

            // Eski fotoğrafı silme işlemi
            $post = Post::where('id', $postId)->firstOrFail();
            $oldPhotoPath = public_path('images/uploads/post/' . $post->photo_url);
            if (File::exists($oldPhotoPath)) {
                File::delete($oldPhotoPath);
            }

            // Post kaydını güncelleme
            $post->title = $editposttitle;
            $post->content = $editpostsubject;
            $post->photo_url = $fileName;
            $post->save();
            Post::where('id', $postId)->update([
                "title" => $editposttitle,
                "content" => $editpostsubject,
                "photo_url" => $fileName,
                "editor_id" => Auth::user()->id
            ]);

        } else {
            // Sadece başlık ve içeriği güncelleme
            $post = Post::where('id', $postId)->firstOrFail();
            $post->title = $editposttitle;
            $post->content = $editpostsubject;
            $post->save();
            Post::where('id', $postId)->update([
                "title" => $editposttitle,
                "content" => $editpostsubject,

                "editor_id" => Auth::user()->id
            ]);
        }


    }

    public function postApproval(Request $request)
    {
        $postid=$request->id;
        Post::where('id',$postid)->update(
            ["status"=>1]
        );
        $message="Post Updated.";
        return redirect()->intended('GetPosts')->with([
            'message' => $message
        ]);
        
    }

    public function postCanceled(Request $request){
        $postid=$request->id;
        Post::where('id',$postid)->update(
            ["status"=>3]
        );
        $message="Post Canceled.";
        return redirect()->intended('GetPosts')->with([
            'message' => $message
        ]);
    }

    public function postDeleted(Request $request){
        $postid=$request->id;
        Post::where('id',$postid)->update(
            ["status"=>2]
        );
        $message="Post Deleted.";
        return redirect()->intended('GetPosts')->with([
            'message' => $message
        ]);
    }

}
