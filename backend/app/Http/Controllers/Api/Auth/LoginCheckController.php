<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Check if user is authenticated
 * 
 * @authenticated
 */
class LoginCheckController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'authenticated' =>  $user !== null,
            'user' => $user,
            'token' => $user->createToken('authToken')->plainTextToken,
        ]);
    }
}
