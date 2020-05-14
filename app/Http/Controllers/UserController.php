<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index()
    {

        $users = User::withCount('products')->get();
//        return $users;
        return view('users.index', ['users' => $users]);
    }
}
