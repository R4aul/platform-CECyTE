<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('semesters')->insert([
            ['semester_name' => 'Primer Semestre', 'period' => '2024-1', 'created_at' => now(), 'updated_at' => now()],
            ['semester_name' => 'Segundo Semestre', 'period' => '2024-2', 'created_at' => now(), 'updated_at' => now()],
            ['semester_name' => 'Tercer Semestre', 'period' => '2025-1', 'created_at' => now(), 'updated_at' => now()],
            ['semester_name' => 'Cuarto Semestre', 'period' => '2025-1', 'created_at' => now(), 'updated_at' => now()],
            ['semester_name' => 'Quinto Semestre', 'period' => '2025-1', 'created_at' => now(), 'updated_at' => now()],
            ['semester_name' => 'Sexto Semestre', 'period' => '2025-1', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
