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
        $type = $like === null ? ' like' : ' unlike';
        if ($like !== null) {
            $like->delete();
        } else {
            $post->likes()->create([
                'user_id' => $request->user()->id
            ]);
        }

        return response()->json([
            'message' => 'success' . $type . ' post',
        ]);
    }
}
