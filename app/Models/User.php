<?php

namespace App\Models;

use App\Models\ActionClasses\CreateUser;
use App\Models\ActionClasses\UpdateUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name', 'last_name', 'gender', 'birthday', 'type', 'status', 'avatar', 'phone', 'email', 'password',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFulNameAttribute()
    {
        return $this->first_name . $this->last_name;
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function createUser(array $data)
    {
        $createUserAction = new CreateUser();
        return $createUserAction($data);
    }

    public function updateUser(array $data)
    {
        $updateUserAction = new UpdateUser();
        return $updateUserAction($data, $this);
    }
}
