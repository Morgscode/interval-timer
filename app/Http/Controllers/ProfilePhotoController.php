<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\User;

class ProfilePhotoController extends Controller
{
    public function update(Request $request, int $user_id)
    {

        $request->validate([
            'profile_picture' => 'required|file|max:5000|mimes:jpg,png,gif,jpeg,webp'
        ]);

        $user = User::where('id', $user_id)->firstOrFail();

        if ($user->profile_picture) {

            Storage::delete($user->profile_picture);

            $user->profile_picture = null;

            $user->save();
        }

        // lets find out how big our image is
        $image_size = getimagesize($request->profile_picture);

        if ($image_size[0] > 850 || $image_size[1] > 850) {
            $errors['profile_picture'] = 'Please ensure your picture no larger than 850px in height or width';
            return redirect()->route('dashboard')->withErrors($errors);
        }
 
        $path = $request->file('profile_picture')->store('profile-pictures', 'public');

        $user->profile_picture = $path;

        $user->save();

        if ( ! $request->expectsJson() ) {
            return redirect()->route('dashboard');
        } else {
            return [
                'status' => 'success',
                'data' => $user
            ];
        }
    }
}
