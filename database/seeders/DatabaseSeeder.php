<?php

namespace Database\Seeders;

use App\Models\Partial;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Registration;
use App\Models\SchoolYear;

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
        ])->assignRole('Administrador');

        User::factory()->create([
            'name' => 'Andrea Guadalupe',
            'paternal_surname' => 'Rodriguez',
            'maternal_surname' => 'Resendiz',
            'email' => 'andrearesendizbod@gmail.com',
            'password' => 'Rora031020MH$',
        ])->assignRole('Administrador');

        $student = User::factory()->create([
            'name' => 'Jose',
            'maternal_surname' => 'Corona',
            'paternal_surname' => 'Hernandez',
            'matriculation' => 'password',
            'email' => 'test2@example.com',
            'password' => 'password',
        ])->assignRole('Alumno');

        SchoolYear::create([
            'name' => 'test',
            'start_date' => now(),
            'final_date' => now(),
            'active' => true
        ]);

        Partial::create([
            'number' => 'Primer parcial',
            'semester_id' => 1,
            'active' => true
        ]);
        Partial::create([
            'number' => 'Segundo parcial',
            'semester_id' => 1,
            'active' => true
        ]);
        Partial::create([
            'number' => 'Tercer parcial',
            'semester_id' => 1,
            'active' => true
        ]);

        Registration::create([
            'user_id' => $student->id,
            'semester_id' => 1,
            'school_year_id' => 1,
            'registration_date' => now(),
            'active' => true,
        ]);
    }
}
