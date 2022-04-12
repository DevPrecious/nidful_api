<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return response([
            'user' => auth()->user(),
            'profile' => auth()->user()->profile,
<<<<<<< HEAD
            'product' => auth()->user()->products
=======
            'following' => auth()->user()->followers->count(),
>>>>>>> ca08bc31c176e59628fcd9641e8c086585115e1d
        ], 201);
    }
}