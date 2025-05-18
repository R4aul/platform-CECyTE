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
    public $alumnos = [];

    public function mount()
    {
        $this->alumnos = [
            [
                'name' => '',
                'paternal_surname' => '',
                'maternal_surname' => '',
                'matriculation' => '',
                'email' => '',
                'password' => '',
                'semester_id' => '',
                'school_year_id' => ''
            ]
        ];
    }

    public function addAlumno()
    {
        $this->alumnos[] = [
            'name' => '',
            'paternal_surname' => '',
            'maternal_surname' => '',
            'matriculation' => '',
            'email' => '',
            'password' => '',
            'semester_id' => '',
            'school_year_id' => ''
        ];
    }

    public function removeAlumno($index)
    {
        unset($this->alumnos[$index]);
        $this->alumnos = array_values($this->alumnos);
    }

    public function submit()
    {
        //return dd($this->alumnos);
        $this->validate([   
            'alumnos.*.name' => 'required|string|max:100',
            'alumnos.*.paternal_surname' => 'required|string|max:100',
            'alumnos.*.maternal_surname' => 'required|string|max:100',
            'alumnos.*.matriculation' => 'required|string|max:14',
            'alumnos.*.email' => 'required|email|unique:users,email',
            'alumnos.*.password' => 'required|string|min:8',
            'alumnos.*semester_id' => 'required',
            'alumnos.*school_year_id' => 'requider'
        ]);

        foreach ($this->alumnos as $alumno) {
            $newStudent = User::create([
                'name' => $alumno['name'],
                'paternal_surname' => $alumno['paternal_surname'],
                'maternal_surname' => $alumno['maternal_surname'],
                'matriculation' => $alumno['matriculation'],
                'email' => $alumno['email'],
                'password' => Hash::make($alumno['password']), // puedes enviar luego el password por email
            ])->assignRole('Alumno');

            Registration::create([
                'user_id' => $newStudent->id,
                'semester_id' => $alumno['semester_id'],
                'school_year_id' => $alumno['school_year_id'],
                'registration_date' => now(),
                'active' => true,
            ]);
        }

        session()->flash('success', 'Alumnos registrados exitosamente.');
        $this->mount(); // reiniciar el formulario
    }


    public function render()
    {
        $semesters = Semester::all();
        $schoolYears = SchoolYear::where('active', true)->get();

        return view('livewire.admin.register-students', compact('semesters', 'schoolYears'));
    }
}
