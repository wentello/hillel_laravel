<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $title = 'Users';
        $users = User::all();

        return view('/admin/user/list', [
            'title' => $title,
            'users' => $users,
        ]);
    }
}
