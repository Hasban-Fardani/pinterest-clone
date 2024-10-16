<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Upload Post Image
 */
class PostImageController extends Controller
{
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|max:2048',  // 2MB
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
            ], 422);
        }

        $image = $validator->validated()['image'];
        $image->storeAs('./', $image->hashName(), 'posts');
        return response()->json([
            'message' => 'success upload image',
            'image' => $image->url(),
        ]);
    }
}
