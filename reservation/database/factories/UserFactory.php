<?php
namespace Database\Factories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => 'Mark',
            'email' => 'mark@eventor.com',
            'password' => bcrypt('12345678'),
            'email_verified_at' => now(),
            'remember_token' => "djsfjsolkfsdfsdf",
        ];
    }
}
