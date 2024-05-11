<?php
namespace Database\Factories;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'name' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'date' => '2024-08-15',
            'time' => $this->faker->randomElement(['20:00', '21:00', '22:00']),
            'expire_at' => null,
        ];
    }
}
