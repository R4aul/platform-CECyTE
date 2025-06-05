<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\SchoolYear;
use App\Models\Registration;
use App\Models\Semester;

class RegisterStudents extends Component
{
    public $nuevoAlumno = [
        'name' => '',
        'paternal_surname' => '',
        'maternal_surname' => '',
        'matriculation' => '',
        'email' => '',
        'password' => '',
        'semester_id' => '',
        'school_year_id' => ''
    ];

    public $alumnos = [];

    public function addAlumno()
    {
        $this->validate([
            'nuevoAlumno.name' => 'required|string|max:100',
            'nuevoAlumno.paternal_surname' => 'required|string|max:100',
            'nuevoAlumno.maternal_surname' => 'required|string|max:100',
            'nuevoAlumno.matriculation' => 'required|string|max:14',
            'nuevoAlumno.email' => 'required|email|unique:users,email',
            'nuevoAlumno.password' => 'required|string|min:8',
            'nuevoAlumno.semester_id' => 'required',
            'nuevoAlumno.school_year_id' => 'required',
        ]);

        $this->alumnos[] = $this->nuevoAlumno;

        // Limpiar los campos del formulario
        $this->nuevoAlumno = [
            'name' => '',
            'paternal_surname' => '',
            'maternal_surname' => '',
            'matriculation' => '',
            'email' => '',
            'password' => '',
            'semester_id' => '',
            'school_year_id' => ''
        ];

        $this->resetErrorBag(); // Limpia errores por campo
        $this->resetValidation(); // Limpia errores de validación previos
    }

    public function removeAlumno($index)
    {
        unset($this->alumnos[$index]);
        $this->alumnos = array_values($this->alumnos);
    }

    public function submit()
    {
        $this->validate([
            'alumnos.*.name' => 'required|string|max:100',
            'alumnos.*.paternal_surname' => 'required|string|max:100',
            'alumnos.*.maternal_surname' => 'required|string|max:100',
            'alumnos.*.matriculation' => 'required|string|max:14',
            'alumnos.*.email' => 'required|email|unique:users,email',
            'alumnos.*.password' => 'required|string|min:8',
            'alumnos.*.semester_id' => 'required',
            'alumnos.*.school_year_id' => 'required'
        ]);

        foreach ($this->alumnos as $alumno) {
            $user = User::create([
                'name' => $alumno['name'],
                'paternal_surname' => $alumno['paternal_surname'],
                'maternal_surname' => $alumno['maternal_surname'],
                'matriculation' => $alumno['matriculation'],
                'email' => $alumno['email'],
                'password' => Hash::make($alumno['password']),
            ])->assignRole('Alumno');

            Registration::create([
                'user_id' => $user->id,
                'semester_id' => $alumno['semester_id'],
                'school_year_id' => $alumno['school_year_id'],
                'registration_date' => now(),
                'active' => true,
            ]);
        }

        $this->alumnos = [];
        session()->flash('success', 'Alumnos registrados exitosamente.');
    }

    /**
     * Personalización de nombres de campos para errores.
     */
    protected function validationAttributes()
    {
        return [
            'nuevoAlumno.name' => 'nombre',
            'nuevoAlumno.paternal_surname' => 'apellido paterno',
            'nuevoAlumno.maternal_surname' => 'apellido materno',
            'nuevoAlumno.matriculation' => 'matrícula',
            'nuevoAlumno.email' => 'correo electrónico',
            'nuevoAlumno.password' => 'contraseña',
            'nuevoAlumno.semester_id' => 'semestre',
            'nuevoAlumno.school_year_id' => 'ciclo escolar',

            'alumnos.*.name' => 'nombre',
            'alumnos.*.paternal_surname' => 'apellido paterno',
            'alumnos.*.maternal_surname' => 'apellido materno',
            'alumnos.*.matriculation' => 'matrícula',
            'alumnos.*.email' => 'correo electrónico',
            'alumnos.*.password' => 'contraseña',
            'alumnos.*.semester_id' => 'semestre',
            'alumnos.*.school_year_id' => 'ciclo escolar',
        ];
    }

    public function render()
    {
        return view('livewire.admin.register-students', [
            'semesters' => Semester::all(),
            'schoolYears' => SchoolYear::where('active', true)->get()
        ]);
    }
}
