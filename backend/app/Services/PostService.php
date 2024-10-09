<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostService
{
    public function __construct()
    {
        if (!Auth::check()) {
            abort(403);
        }
    }

    public function getAll(Request $request, $columns = ['*'], $paginate = true)
    {
        $posts = Post::query();
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 10);

        $posts->when($request->input('q'), function ($query, $search) {
            $query->where('title', 'like', "%{$search}%");
        });

        $posts->when($request->input('user_id'), function ($query, $user_id) {
            $query->where('user_id', $user_id);
        });

        $posts->latest();

        if ($paginate) {
            $posts = $posts->paginate($perPage, $columns, 'page', $page);
        }
        
        return $posts;
    }

    /**
     * Store new post from request data
     *
     * @param array $data. this is from $request->all();
     */
    public function store(array $data){
        $filename = $this->storeImage($data);

        $newPost = new Post();
        $newPost->title = $data['title'];
        $newPost->image = Auth::id() . '/' . $filename;
        $newPost->user_id = Auth::id();
        $newPost->save();

        return $newPost;
    }

    public function update(Post $post, array $data)
    {
        // delete current image
        $this->deleteImage($post);

        // store new image if exist
        if (array_key_exists('image', $data)) {
            $filename = $this->storeImage($data);
            $post->image = $filename;
        }

        $post->title = $data['title'];
        $post->save();

        return $post;
    }

    public function delete(Post $post)
    {
        // delete image
        $this->deleteImage($post);

        $post->comments()->delete();
        $post->likes()->delete();
        $post->delete();
    }

    /**
     * Delete image from post in storage
     *
     * @param Post $post
     * @return bool
     */
    protected function deleteImage(Post $post)
    {
        // ensure image is exist
        if ($post->image) {
            Storage::disk('posts')->delete($post->image);
        }

        return !Storage::disk('posts')->exists($post->image);
    }

    /**
     * Store image in storage
     *
     * @param array $data
     * @return string filename
     */
    protected function storeImage(array $data)
    {
        $filename = Str::random(10) . '_' . $data['image']->getClientOriginalName();
        $file_path = $data['image']->storeAs('/' . Auth::id(), $filename, 'posts');

        if (!$file_path)
        {
            return abort(500);
        }

        return $file_path;
    }
}
