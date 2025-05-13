<?php

namespace Database\Seeders;

use App\Models\Partial;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        ])->assignRole('Docente');

        User::factory()->create([
            'name' => 'User Test 1',
            'paternal_surname' => 'Escobar',
            'maternal_surname' => 'Hernandez',
            'matriculation' => 'F89382047182934',
            'email' => 'andrearesendizbod@gmail.com',
            'password' => 'Rora031020MH$',
        ])->assignRole('Docente');

        $student = User::factory()->create([
            'name' => 'User Test 2',
            'maternal_surname' => 'Corona',
            'paternal_surname' => 'Hernandez',
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
            'number' => 'Segun parcial',
            'semester_id' => 1,
            'active' => true
        ]);
        Partial::create([
            'number' => 'Tercer parcial',
            'semester_id' => 1,
            'active' => true
        ]);

        Registration::create([
            'user_id' => 2,
            'semester_id' => 1,
            'school_year_id' => 1,
            'registration_date' => now(),
            'active' => true,
        ]);
    }
}
