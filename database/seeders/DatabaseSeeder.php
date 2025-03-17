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

        
        $this->call([
            RoleSeeder::class,
            SemesterSeeder::class,
            SubjectSeeder::class
        ]);

        User::factory()->create([
            'name' => 'User Test 1',
            'paternal_surname' => 'Escobar',
            'maternal_surname' => 'Hernandez',
            'email' => 'test@example.com',
            'password' => 'password',
        ])->assignRole('Docente');

        User::factory()->create([
            'name' => 'User Test 2',
            'maternal_surname' => 'Corona',
            'paternal_surname' => 'Hernandez',
            'email' => 'test2@example.com',
            'password' => 'password',
        ])->assignRole('Alumno');
    }
}
