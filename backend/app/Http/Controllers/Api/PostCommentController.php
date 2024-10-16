<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/**
 * Create Post Comment
 */
class PostCommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $validator = Validator::make($request->all(), [
            'comment' => 'required|string',
        ]);

        $validatedData = $validator->validated();
        $validatedData['user_id'] = Auth::id();
        $post->comments()->create($validatedData);
        return response()->json([
            'message' => 'success create comment',
        ]);
    }

    public function update(Request $request, Post $post, PostComment $comment)
    {
        if ($comment->user()->id !== $request->user()->id) {
            return response()->json([
                'message' => 'forbidden',
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'body' => 'required|string',
        ]);

        $comment->update($validator->validated());
        return response()->json([
            'message' => 'success update comment',
        ]);
    }

    public function delete(Post $post, PostComment $comment)
    {
        $comment->load('user');
        if ($comment->user()->id !== auth()->user()->id) {
            return response()->json([
                'message' => 'forbidden',
            ], 403);
        }

        $comment->delete();
        return response()->json([
            'message' => 'success delete comment',
        ]);
    }
}
