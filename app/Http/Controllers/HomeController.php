<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {

        $posts = Post::with('publisher')->where('status',1)->orderBy('created_at','DESC')->get();
        // foreach ($posts as $post) {
        //     dd($post->publisher->fname);
        // }
        return view('index', compact('posts'));

    }
}
