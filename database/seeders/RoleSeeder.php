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
        $role1 = Role::create(['name'=>'Administrador']);
        $role2 = Role::create(['name'=>'Docente']);
        $role3 = Role::create(['name'=>'Alumno']);
        
        Permission::create(['name'=>'dashboard'])->syncRoles([$role1, $role2]);

        //rutas asignadas a los administradores y docentes
        //Admin/TeacherController
        Permission::create(['name'=>'teachers.index'])->syncRoles([$role1]);
        Permission::create(['name'=>'teachers.create'])->syncRoles([$role1]);
        Permission::create(['name'=>'teachers.store'])->syncRoles([$role1]);
        Permission::create(['name'=>'teachers.edit'])->syncRoles([$role1]);
        Permission::create(['name'=>'teachers.update'])->syncRoles([$role1]);
        Permission::create(['name'=>'teachers.destroy'])->syncRoles([$role1]);

        //Admin/StudentController
        Permission::create(['name'=>'students.index'])->syncRoles([$role1]);
        Permission::create(['name'=>'students.create'])->syncRoles([$role1]);
        Permission::create(['name'=>'students.store'])->syncRoles([$role1]);
        Permission::create(['name'=>'students.edit'])->syncRoles([$role1]);
        Permission::create(['name'=>'students.update'])->syncRoles([$role1]);
        Permission::create(['name'=>'students.destroy'])->syncRoles([$role1]);
        
        Permission::create(['name'=>'materials.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'materials.create'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'materials.store'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'materials.show'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'materials.edit'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'materials.update'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'materials.destroy'])->syncRoles([$role1,$role2]);
    

        Permission::create(['name'=>'subjects.index'])->syncRoles([$role1]);
        Permission::create(['name'=>'subjects.edit'])->syncRoles([$role1]);
        Permission::create(['name'=>'subjects.update'])->syncRoles([$role1]);
        
        Permission::create(['name'=>'schoolYears.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'schoolYears.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'schoolYears.store'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'schoolYears.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'schoolYears.update'])->syncRoles([$role1, $role2]);
    

        Permission::create(['name'=>'semesters.index'])->syncRoles([$role1]);
        Permission::create(['name'=>'semesters.advanceStudent'])->syncRoles([$role1]);
        

        Permission::create(['name'=>'register.students'])->syncRoles([$role1]);
        
        Permission::create(['name'=>'qualifications.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'qualifications.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'qualifications.store'])->syncRoles([$role1, $role2]);

        Permission::create(['name'=>'admin.task.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'admin.task.show'])->syncRoles([$role1, $role2]);
        
        //permisos asignados a alumnos
        Permission::create(['name'=>'panel.alumnos'])->assignRole($role3);
        Permission::create(['name'=>'students.task.create'])->assignRole($role3);
        Permission::create(['name'=>'students.task.store'])->assignRole($role3);
        Permission::create(['name'=>'students.qualifications.index'])->assignRole($role3);
    }
}
