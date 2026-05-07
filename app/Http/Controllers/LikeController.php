<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggle(Request $request)
    {
        $userId = auth()->id();
        $postId = $request->post_id;

        $like = Like::where('user_id', $userId)
            ->where('post_id', $postId)
            ->first();

        if ($like) {
            $like->delete();
            return redirect()->back();
        }

        Like::create([
            'user_id' => $userId,
            'post_id' => $postId
        ]);

        return redirect()->back();

    }

}
