<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PostService;
use Illuminate\Http\Request;

/**
 * Get list Post
 */
class GetPostController extends Controller
{
    public function __invoke(Request $request, PostService $postService)
    {
        $posts = $postService->getAll($request);
        return response()->json([
            'message' => 'success get all post',
            ...$posts->toArray(),
        ]);
    }
}
