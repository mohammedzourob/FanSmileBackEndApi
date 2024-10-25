<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'idNumber'=>'11',
            'idPersonal'=>'2113',
            'description'=>'Doctor',
            'specialization'=>'doctor',
            'dob'=>'1111-11-11',
            'gender'=>'male',
            'phone'=>'123132112',
            'address'=>'egypt',
            'experience'=>'22',
            'photo'=>'photo'
        ]);
    }
}