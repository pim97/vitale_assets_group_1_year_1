<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Avatar;
use Intervention\Image\Facades\Image;

class AvatarController extends Controller
{

    /**
     * When you upload a new image, the others go inactive
     */
    private function setAvatarsInactive()
    {
        $userId = Auth::user()->id;
        $avatars = Avatar::where('active', 1)->first();
        if (isset($avatars)) {
            $avatars->active = 0;
            $avatars->save();
        }
    }

    /**
     * Returns the amount of images you have uploaded
     * to our database
     */
    private function getAvatarsUploadSize()
    {
        $userId = Auth::user()->id;
        $uploadAmount = Avatar::select('user_id')->where('user_id', $userId)->count();
        return $uploadAmount;
    }

    /**
     * Returns all the avatars uploaded by a user
     */
    private function getAllAvatarsByUser()
    {
        $userId = Auth::user()->id;
        $avatar = Avatar::select('image_url', 'id')->where('user_id', $userId)->get();
        return $avatar;
    }

    /**
     * Returns the avatar that is active
     */
    private function getActiveAvatar()
    {
        $userId = Auth::user()->id;
        $avatar = Avatar::select('image_url')->where('user_id', $userId)->where('active', 1)->get();
        return $avatar;
    }

    /**
     * Deleting the latest added avatar
     */
    private function deleteLatestAvatar()
    {
        $avatars = Avatar::select('id')->orderBy('created_at', 'asc')->get();
        $imageUrl = "";
        if (sizeof($avatars) > 0) {
            $avatarDelete = Avatar::find($avatars[0]['id']);
            $imageUrl = $avatarDelete->image_url;
            $avatarDelete->delete();
            $locationImage = public_path('uploads/avatars/'.$imageUrl);
            unlink($locationImage);
        }
    }

    /**
     * Returns the index of the avatar page
     */
    public function index()
    {
        $avatar = $this->getActiveAvatar();
        $allAvatars = $this->getAllAvatarsByUser();
        $avatar_url = "";
        if (sizeof($avatar) <= 0) {
            $avatar_url = "default.png";
        } else {
            $avatar_url = $avatar[0]->image_url;
        }
        $path = asset('uploads/avatars\\');
        return view('users.avatar.index')->with('avatar_url', $path.$avatar_url)->with('avatars_urls', $allAvatars);
    }

    /**
     * Will update the profile picture to already
     * saved pictures
     */
    public function update($id)
    {
        $this->setAvatarsInactive();
        $avatar = Avatar::find($id);
        $avatar->active = 1;
        $avatar->save();
        $path = asset('uploads/avatars\\');
        session()->flash('message', 'Je avatar is gewijzigd');
        return redirect()->route('users.avatar');
    }

    /**
     * Stores the avatar in the database
     */
    public function store(Request $request)
    {

        //Validating
        $this->validate(
            $request,
            [
            'avatar' => 'required|bail| mimes:jpeg,jpg,png |max:4096',
            ],
            $messages = [
                'required' => 'The :attribute field is required.',
                'mimes' => 'Only jpeg, jpg, png are allowed.'
            ]
        );

        //Setting all the other avatars to inactive
        $this->setAvatarsInactive();

        if ($this->getAvatarsUploadSize() > 2) {
            session()->flash('warning', 'Je kunt maximaal 3 avatars uploaden, de oudste avatar is verwijderd');
            $this->deleteLatestAvatar();
        }

        //Making new avatar and saving in database
        $avatarFile = $request->file('avatar');
        $filename = time() . '.' . $avatarFile->getClientOriginalExtension();
        Image::make($avatarFile)->resize(300, 300)->save(public_path('/uploads/avatars/' . $filename));
        $userId = Auth::user()->id;
        $avatar = new Avatar;
        $avatar->image_url = $filename;
        $avatar->active = true;
        $avatar->user_id = $userId;
        $avatar->save();

        session()->flash('message', 'Je kunt nu gebruik maken van je avatar');
        return redirect()->route('users.avatar');
    }
}
