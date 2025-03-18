<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subjects')->insert([
            ['subject_name' => 'Ciencias Sociales I', 'semester_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['subject_name' => 'Cultura Digital I', 'semester_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['subject_name' => 'Humanidades I', 'semester_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['subject_name' => 'Inglés I', 'semester_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['subject_name' => 'La materia y sus interacciones CNEYT I', 'semester_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['subject_name' => 'Lengua y Comunicación I', 'semester_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['subject_name' => 'Pensamiento Matemático I', 'semester_id' => 1, 'created_at' => now(), 'updated_at' => now()],
        


            ['subject_name' => 'Ciencias Sociales II', 'semester_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['subject_name' => 'Conservación De La Energía Y Su Interacción Con La Materia CNEYT II', 'semester_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['subject_name' => 'Cultura Digital II', 'semester_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['subject_name' => 'Humanidades II', 'semester_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['subject_name' => 'Inglés II', 'semester_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['subject_name' => 'Lengua Y Comunicación II', 'semester_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['subject_name' => 'Pensamiento Matemático II', 'semester_id' => 2, 'created_at' => now(), 'updated_at' => now()],
        


            ['subject_name' => 'Ecosistemas, interacciones, energía y dinámica CNEYT III', 'semester_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['subject_name' => 'Humanidades III', 'semester_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['subject_name' => 'Inglés III', 'semester_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['subject_name' => 'Lengua y Comunicación III', 'semester_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['subject_name' => 'Pensamiento Matemático III', 'semester_id' => 3, 'created_at' => now(), 'updated_at' => now()],
        

            ['subject_name' => 'Ciencias Sociales III', 'semester_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['subject_name' => 'Conciencia Histórica I', 'semester_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['subject_name' => 'Inglés IV', 'semester_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['subject_name' => 'Reacciones Químicas Conservación De La Materia En La Formación De Nuevas Sustancias CNEYT IV', 'semester_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['subject_name' => 'Temas Selectos De Matemáticas ', 'semester_id' => 4, 'created_at' => now(), 'updated_at' => now()],
        


            ['subject_name' => 'Conciencia Histórica II', 'semester_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['subject_name' => 'Inglés V', 'semester_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['subject_name' => 'La energía en los procesos de la vida diaria CNEYT V', 'semester_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['subject_name' => 'Temas selectos de matemáticas II', 'semester_id' => 5, 'created_at' => now(), 'updated_at' => now()],
        

            ['subject_name' => 'Conciencia Histórica III', 'semester_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['subject_name' => 'Cultura Digital III', 'semester_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['subject_name' => 'Organismos, Estructuras Y Procesos. Herencia Y Evolución Biológica CNEYT VI', 'semester_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['subject_name' => 'Temas Selectos De Matemáticas III', 'semester_id' => 6, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
