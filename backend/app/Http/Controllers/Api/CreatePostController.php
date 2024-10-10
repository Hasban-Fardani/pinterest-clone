<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Create Post
 */
class CreatePostController extends Controller
{
    public function __invoke(Request $request, PostService $postService)
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
}
