<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function follow(Request $request)
    {
        $data = $request->validate([
            'following_id' => 'required|integer|exists:users,id',
        ]);

        if (!auth()->user()->following()->where('users.id', $data['following_id'])->exists()) {
            auth()->user()->following()->attach($data['following_id']);
        }


        return redirect()->route('users.index');
    }


    public function unfollow(Request $request)
    {
        $data = $request->validate([
            'following_id' => 'required|integer|exists:users,id',
        ]);

        auth()->user()->following()->detach($data['following_id']);

        return redirect()->route('users.index');
    }


}
