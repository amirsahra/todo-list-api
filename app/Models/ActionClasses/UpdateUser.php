<?php

namespace App\Models\ActionClasses;

use App\Http\Traits\HasImage;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UpdateUser
{
    use HasImage;

    public function __invoke(array $data,User $user): bool
    {
        if (array_key_exists('password',$data))
            $data['password'] = Hash::make($data['password']);

        if (array_key_exists('avatar',$data)){
            $avatarPath = $this->updateImage($data['avatar'], 'avatar',$user->avatar);
            $data['avatar'] = $avatarPath;
        }

        return $user->update($data);
    }
}
