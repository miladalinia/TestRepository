<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('post.create');
    }

    public function createPost(Request $request)
    {
        $post = new Post;
        $post->title = $request->title;
        $post->user_id = $request->user_id;
        $post->save();

        // broadcast(new PostCreated($post));
        // event(new PostCreated($post));

        return response()->json([
            'message' => 'New post created'
        ]);
    }

    public function modalTest()
    {
        return view('modal');
    }
}
