<?php

namespace App\Models\ActionClasses;

use App\Http\Traits\HasImage;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUser
{
    use HasImage;

    public function __invoke(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $avatarPath = null;
        if (array_key_exists('avatar',$data))
            $avatarPath = $this->uploadImage($data['avatar'], 'avatar');

        $data['avatar'] = $avatarPath;

        return User::create($data);
    }
}
