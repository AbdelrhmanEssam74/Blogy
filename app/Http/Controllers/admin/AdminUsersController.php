<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUsersController extends Controller
{
    public function index()
    {
        $users = User::with(['role', 'writer_profile'])->get();
        return view('admin.users.index', compact('users'));
    }
}
