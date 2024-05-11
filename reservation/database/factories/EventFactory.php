<?php
namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition()
    {
        $baseDate = Carbon::now()->addDays(5); // Mevcut tarihe 5 gün ekleniyor

        $date = $baseDate->toDateString(); // Tarih olarak alınıyor
        $time = $this->faker->randomElement(['20:00', '21:00', '22:00']); // Rastgele bir saat seçiliyor

        // Tarih ve saat birleştirilerek Carbon nesnesi oluşturuluyor
        $expireDateTime = Carbon::createFromFormat('Y-m-d H:i', $date . ' ' . $time);

        return [
            'user_id' => \App\Models\User::factory(),
            'name' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'date' => $date,
            'time' => $time,
            'expire_at' => $expireDateTime,
        ];
    }
}
