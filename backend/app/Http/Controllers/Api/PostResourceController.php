<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostResourceController extends Controller
{
    public function index(Request $request, PostService $postService)
    {
        $posts = $postService->getAll($request);
        return response()->json([
            'message' => 'success get all post',
            ...$posts->toArray(),
        ]);
    }

    public function store(Request $request, PostService $postService)
    {

        $validator = Validator::make($request->all(), [
            'image' => 'required|image',
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        $post = $postService->store($validator->validated());
        return response()->json([
            'message' => 'success',
            'post' => $post,
        ]);
    }

    public function show(Post $post)
    {
        $post->load(['likes', 'comments', 'user:id,name,username'])
            ->whereHas('comments', function ($query) {
                $query->approved();
            });
        return response()->json([
            'message' => 'success get post',
            'post' => $post,
        ]);
    }

    public function update(Request $request, Post $post, PostService $postService)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        $post = $postService->update($post, $validator->validated());
        return response()->json([
            'message' => 'success update post',
            'post' => $post,
        ]);
    }
}
