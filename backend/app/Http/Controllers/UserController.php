<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the user.
     */
    public function index(Request $request)
    {
        $users = User::query()
            ->when($request->input('q'), fn ($query) => $query->where('name', 'like', "%{$request->q}%"))  # search user
            ->when($request->input('role'), fn ($query) => $query->where('role', $request->role))  # filter by role
            ->latest()
            ->paginate(
                perPage: $request->input('per_page', 10),
                page: $request->input('page', 1));

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('users.create')
                ->withErrors($validator)
                ->withInput();
        }

        User::create($validator->validated());

        return redirect()
            ->route('users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        $user->load(['posts', 'comments']);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $user->id,  # ensure username is unique except the current user
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('users.create')
                ->withErrors($validator)
                ->withInput();
        }

        $user->update($validator->validated());

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
}
