<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'ig_url' => 'url',
            'fb_url' => 'url',
        ]);

        $user = auth()->user();

        $dataToUpdate = [
            'ig_url' => $request->ig_url,
            'fb_url' => $request->fb_url,
        ];

        if ($request->hasFile('profile_image')) {
            $request->validate([
                'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $imageName = time() . '.' . $request->profile_image->extension();
            $request->profile_image->move(public_path('images'), $imageName);
            $dataToUpdate['profile_image'] = $imageName;
        }

        $profile = $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            $dataToUpdate
        );

        return response([
            'message' => 'Profile Updated',
            'profile' => $profile,
        ], 201);
    }
}
