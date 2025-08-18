<?php

namespace App\Http\Controllers\writer;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WriterProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class WriterProfileController extends Controller
{
    public function index()
    {
        $user = User::where('user_id', auth()->user()->user_id)
            ->with(['writer_profile'])
            ->first();;
        return view('writer.profile', compact('user'));
    }

    public function profileUpdate(Request $request)
    {
        // 1) Validate
        $request->validate([
            'fullName'  => 'required|string|max:255',
            'bio'       => 'nullable|string|max:500',
            'website'   => 'nullable|url|max:255',
            'new-image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
            'social_media.*' => 'nullable|url|max:255',
        ]);
        $user = auth()->user()->loadMissing('writer_profile');
        $writerProfile = $user->writer_profile ?: new WriterProfile(['user_id' => $user->id]);
        $user->full_name          = $request->input('fullName');
        $writerProfile->bio       = $request->input('bio');
        $writerProfile->website   = $request->input('website');
        $socialLinks = $request->input('social_media', []);
        $writerProfile->social_media_links = json_encode($socialLinks);
        if ($request->hasFile('new-image')) {

            if ($writerProfile->profile_picture && Storage::disk('public')->exists($writerProfile->profile_picture)) {
                Storage::disk('public')->delete($writerProfile->profile_picture);
            }
            $path = $request->file('new-image')->store("profile_pictures/{$user->user_id}", 'public');
            $writerProfile->profile_picture = $path;
        }
        if (!$user->isDirty() && !$writerProfile->isDirty()) {
            Alert::info('No Changes', 'No changes were made to your profile.');
            return back();
        }
        \DB::transaction(function () use ($user, $writerProfile) {
            $user->save();
            $writerProfile->save();
        });
        Alert::success('Success', 'Profile updated successfully');
        return redirect()->route('writer.profile');
    }
}
