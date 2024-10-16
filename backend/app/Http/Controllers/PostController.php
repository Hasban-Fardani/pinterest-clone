<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, PostService $postService)
    {
        $posts = $postService->getAll($request);
        return view('posts.index', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, PostService $postService)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  # max 2MB
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $post = $postService->store($request->all());

        return redirect()->route('posts.index')->with('success', 'Post ' . $post->title . ' successfully created.');
    }

    public function update(Post $post, Request $request, PostService $postService)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  # max 2MB
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $postService->update($post, $request->all());

        return redirect()->back()->with('success', 'Post ' . $post->title . ' successfully updated.');
    }

    public function destroy(Post $post, PostService $postService)
    {
        $postService->delete($post);

        return redirect()->back()->with('success', 'Post ' . $post->title . ' successfully deleted.');
    }
}
