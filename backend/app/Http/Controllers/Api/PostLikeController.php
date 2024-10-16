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
    public function __invoke(Request $request, Post $post)
    {
        $like = $post->likes()->where('user_id', $request->user()->id)->first();
        if ($like !== null) {
            $like->delete();
        } else {
            $post->likes()->create([
                'user_id' => $request->user()->id
            ]);
        }

        $type = $like === null ? ' like' : ' unlike';
        return response()->json([
            'message' => 'success' . $type . ' post',
        ]);
    }
}
