<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name'=>'Docente']);
        $role2 = Role::create(['name'=>'Alumno']);
        
        Permission::create(['name'=>'dashboard'])->assignRole($role1);
        Permission::create(['name'=>'panel.alumnos'])->assignRole($role2);
        

        //rutas asignadas a los administradores y docentes
        Permission::create(['name'=>'teachers.index']);
        Permission::create(['name'=>'teachers.create']);
        Permission::create(['name'=>'teachers.store']);
        Permission::create(['name'=>'teachers.edit']);
        Permission::create(['name'=>'teachers.update']);
        Permission::create(['name'=>'teachers.destroy']);


        Permission::create(['name'=>'students.index']);
        Permission::create(['name'=>'students.create']);
        Permission::create(['name'=>'students.store']);
        Permission::create(['name'=>'students.edit']);
        Permission::create(['name'=>'students.update']);
        Permission::create(['name'=>'students.destroy']);
        
        Permission::create(['name'=>'materials.index']);
        Permission::create(['name'=>'materials.create']);
        Permission::create(['name'=>'materials.store']);
        Permission::create(['name'=>'materials.show']);
        Permission::create(['name'=>'materials.edit']);
        Permission::create(['name'=>'materials.update']);
        Permission::create(['name'=>'materials.destroy']);
    

        Permission::create(['name'=>'subjects.index']);
        Permission::create(['name'=>'subjects.edit']);
        Permission::create(['name'=>'subjects.update']);
        
        Permission::create(['name'=>'schoolYears.index']);
        Permission::create(['name'=>'schoolYears.create']);
        Permission::create(['name'=>'schoolYears.store']);
        Permission::create(['name'=>'schoolYears.edit']);
        Permission::create(['name'=>'schoolYears.update']);
    

        Permission::create(['name'=>'semesters.index']);
        Permission::create(['name'=>'semesters.advanceStudent']);
        

        Permission::create(['name'=>'register.students']);
        
        Permission::create(['name'=>'qualifications.index']);
        Permission::create(['name'=>'qualifications.create']);
        Permission::create(['name'=>'qualifications.store']);
    }
}
