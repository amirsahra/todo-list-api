<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends FakerSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $isCreateAdmin = Config::get('todosettings.create_default_admin');
        $isCreateMembers = Config::get('todosettings.create_fake_member');

        if ($isCreateAdmin)
            $this->createDefaultAdmin();

        if ($isCreateMembers)
            $this->insertFakeMemberUsers(Config::get('todosettings.number_fake_data.user'));
    }

    private function insertFakeMemberUsers(int $numberOfFAkeUsers)
    {
        for ($i = 0; $i < $numberOfFAkeUsers; $i++) {
            $this->createFakeMember();
        }
    }

    private function createFakeMember()
    {
        $isMale = $this->faker->boolean;
        User::create([
            'first_name' => ($isMale) ? $this->faker->firstNameMale() : $this->faker->firstNameFemale(),
            'last_name' => $this->faker->lastName(),
            'gender' => ($isMale) ? 'male' : 'female',
            'phone' => $this->faker->unique()->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'birthday' => $this->faker->dateTimeBetween('-50 years'),
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('123456789'),
            'remember_token' => Str::random(10),
        ]);
    }

    private function createDefaultAdmin()
    {
        $adminData = Config::get('todosettings.default_admin');
        $adminData['password'] = Hash::make($adminData['password']);
        User::create($adminData);
    }
}
