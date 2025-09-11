<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WriterProfile;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminUsersController extends Controller
{
    public function index()
    {
        $users = User::with(['role', 'writer_profile'])->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    // active user status
    public function active($user_id)
    {
        $user = WriterProfile::where('user_id', $user_id)->firstOrFail();
        $user->status = 'active';
        $user->save();
        Alert::success('Success', 'User Activated successfully.');
        return redirect()->back();
    }

    // deactive user status
    public function deactivate($user_id)
    {

        $user = WriterProfile::where('user_id', $user_id)->firstOrFail();
        $user->status = 'inactive';
        $user->save();
        Alert::success('Success', 'User Deactivated successfully.');
        return redirect()->back();
    }
}
