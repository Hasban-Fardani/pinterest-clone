<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

/**
 * Get post detail
 */
class GetPostDetailController extends Controller
{
    public function __invoke(Request $request, Post $post)
    {
        return '';
    }
}
