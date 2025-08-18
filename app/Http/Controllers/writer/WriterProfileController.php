<?php

namespace App\Http\Controllers\writer;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WriterProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class WriterProfileController extends Controller
{
    public function index()
    {
        $user = User::where('user_id', auth()->user()->user_id)
            ->with('writer_profile')
            ->firstOrFail();

        return view('writer.profile', compact('user'));
    }

    public function profileUpdate(Request $request)
    {
        // 1) Validate
        $request->validate([
            'fullName' => 'required|string|max:255',
            'bio' => 'nullable|string|max:500',
            'website' => 'nullable|url|max:255',
            'new-image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
            'social_media.*' => 'nullable|url|max:255',
        ]);

        $user = auth()->user()->loadMissing('writer_profile');
        $writerProfile = $user->writer_profile ?: new WriterProfile(['user_id' => $user->user_id]);

        // Update data
        $user->full_name = $request->input('fullName');
        $writerProfile->bio = $request->input('bio');
        $writerProfile->website = $request->input('website');

        // Social links
        $socialLinks = $request->input('social_media', []);
        $writerProfile->social_media_links = json_encode($socialLinks);

        // Profile picture
        if ($request->hasFile('new-image')) {
            if ($writerProfile->profile_picture && Storage::disk('public')->exists($writerProfile->profile_picture)) {
                Storage::disk('public')->delete($writerProfile->profile_picture);
            }
            $path = $request->file('new-image')->store("profile_pictures/{$user->user_id}", 'public');
            $writerProfile->profile_picture = $path;
        }

        // Check if anything changed
        if (!$user->isDirty() && !$writerProfile->isDirty()) {
            Alert::info('No Changes', 'No changes were made to your profile.');
            return back()->with('active_tab', 'profile');
        }

        // Save with transaction
        DB::transaction(function () use ($user, $writerProfile) {
            $user->save();
            $writerProfile->save();
        });

        Alert::success('Success', 'Profile updated successfully');
        return redirect()->route('writer.profile')->with('active_tab', 'profile');
    }

    public function accountUpdate(Request $request)
    {
        $user = auth()->user();

        // validate request -> email (allow current email)
        $request->validate([
            'email' => "required|email|unique:users,email,{$user->user_id},user_id",
        ]);

        $user->email = $request->input('email');

        if (!$user->isDirty()) {
            Alert::info('No Changes', 'No changes were made to your account.');
            return back()->with('active_tab', 'account');
        }

        $user->save();

        Alert::success('Success', 'Account updated successfully');
        return redirect()->route('writer.profile')->with('active_tab', 'account');
    }


    public function securityUpdate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('active_tab', 'security');
        }

        $user = auth()->user();

        // Check current password
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return back()
                ->withInput()
                ->withErrors(['current_password' => 'Current password is incorrect.'])
                ->with('active_tab', 'security');
        }

        // Prevent using the same password
        if (Hash::check($request->input('new_password'), $user->password)) {
            return back()
                ->withInput()
                ->withErrors(['new_password' => 'New password cannot be the same as the current password.'])
                ->with('active_tab', 'security');
        }


        // Update password
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        Alert::success('Success', 'Password updated successfully.');
        return redirect()
            ->route('writer.profile')
            ->with('active_tab', 'security');
    }

}
