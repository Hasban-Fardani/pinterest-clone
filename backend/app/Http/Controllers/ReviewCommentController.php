<?php

namespace App\Http\Controllers;

use App\Models\PostComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $reviews = PostComment::query()
            ->with(['user:id,name', 'post:id,title,image'])
            ->latest();

        $reviews->when($request->input('q'), function ($reviews, $search) {
            $reviews->where(function ($query) use ($search) {
                $query->where('comment', 'like', '%' . $search . '%');
                $query->orWhereHas('post', function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%');
                });
            });
        });

        $reviews = $reviews->paginate(10);
        return view('reviews.index', compact('reviews'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PostComment $review)
    {
        $validator = Validator::make($request->all(), [
            'status' => ['required', 'in:approved,rejected']
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $review->update($validator->validated());
        return redirect()->route('reviews.index')->with('success', 'Review updated successfully');
    }
}
