<?php

namespace App\Models\ActionClasses;

use App\Http\Traits\HasImage;
use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CreateUser
{
    use HasImage;

    public function __invoke(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $avatarPath = null;
        if (array_key_exists('avatar',$data))
            $avatarPath = $this->uploadImage($data['avatar'], 'avatar');
            //$avatarPath = Storage::putFileAs('photos',$data['avatar'], 'public');

        $data['avatar'] = $avatarPath;

        return User::create($data);
    }
}
