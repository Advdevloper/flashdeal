<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'user',
            'last_name' => 'patel',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Advantal@123'),
            'otp' => '1234',
            'otp_verified' => '',
            'vander_id' => '1',
            'role_type' => '1',
            'remember_token' => Str::random(10),
        ];
    }
}
