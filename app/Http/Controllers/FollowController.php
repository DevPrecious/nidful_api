<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function follow(User $user)
    {
        $user_id = auth()->id();
        $to_follow = $user->id;
        
        if ($user_id == $to_follow) {
            return response([
                'message' => 'You cannot follow yourself',
            ], 422);
        }

        $followw = Follow::where('user_id', $user_id)
            ->where('followed_id', $to_follow)
            ->first();
        if($followw){
            auth()->user()->follow()->delete();
            return response([
                'message' => 'Unfollowed',
                'user' => $user,
            ], 201);
        }else{
            auth()->user()->follow()->create([
                'followed_id' => $to_follow,
            ]);
            return response([
                'message' => 'Followed',
                'user' => $user,
            ], 201);
        }
    }
}
