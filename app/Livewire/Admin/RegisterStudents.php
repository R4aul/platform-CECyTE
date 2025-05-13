<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterStudents extends Component
{
    public $alumnos = [];

    public function mount()
    {
        $this->alumnos = [
            ['name' => '',
            'paternal_surname' => '',
            'maternal_surname' => '',
            'matriculation' => '',
            'email' => '',
            'password' => '']
        ];
    }

    public function addAlumno()
    {
        $this->alumnos[] = [
            'name' => '',
            'paternal_surname' =>'',
            'maternal_surname' => '',
            'matriculation' => '',
            'email' => '',
            'password' => ''
        ];
    }

    public function removeAlumno($index)
    {
        unset($this->alumnos[$index]);
        $this->alumnos = array_values($this->alumnos);
    }

    public function submit()
    {
        return dd($this->alumnos);
        $this->validate([
            'alumnos.*.name' => 'required|string|max:100',
            'alumnos.*.paternal_surname' => 'required|string|max:100',
            'alumnos.*.maternal_surname' => 'required|string|max:100',
            'alumnos.*.matriculation' => 'required|string|max:14',
            'alumnos.*.email' => 'required|email|unique:users,email',
            'alumnos.*.password' => 'required|string|min:8',
        ]);

        foreach ($this->alumnos as $alumno) {
            User::create([
                'name' => $alumno['email'],
                'paternal_surname' => $alumno['paternal_surname'],
                'maternal_surname' => $alumno['maternal_surname'],
                'matriculation' => $alumno['matriculation'],
                'email' => $alumno['email'],
                'password' => Hash::make($alumno['password']), // puedes enviar luego el password por email
            ]);
        }

        session()->flash('success', 'Alumnos registrados exitosamente.');
        $this->mount(); // reiniciar el formulario
    }


    public function render()
    {
        return view('livewire.admin.register-students');
    }
}
