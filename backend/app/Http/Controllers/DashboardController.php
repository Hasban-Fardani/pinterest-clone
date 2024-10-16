<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostComment;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $postsCount = Post::count();
        $usersCount = User::count();
        $commentsCount = PostComment::count();
        return view('dashboard', compact('postsCount', 'usersCount', 'commentsCount'));
    }
}
