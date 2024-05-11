<?php
use App\Models\Event;

use Illuminate\Database\Seeder;
use App\Models\Registration;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Kullanıcılar oluştur
        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678'),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'john',
            'email' => 'john@eventor.com',
            'password' => bcrypt('12345678'),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Mark',
            'email' => 'mark@eventor.com',
            'password' => bcrypt('12345678'),
        ]);


        // Event'leri ve Registration'ları oluştur
        \App\Models\User::all()->each(function ($user) {
            Event::factory(3)->create(['user_id' => $user->id]);
        });
    }
}
