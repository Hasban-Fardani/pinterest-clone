<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Like a Post
 */
class PostLikeController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $post->likes()->create([
            'user_id' => $request->user()->id
        ]);

        return response()->json([
            'message' => 'success like post',
        ]);
    }

    public function delete(Post $post)
    {
        $post->likes()->where('user_id', Auth::id())->delete();
        return response()->json([
            'message' => 'success unlike post',
        ]);
    }
}
