<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\On; 

class TeacherComponent extends Component
{
    public $teacherId;
    public $confirmingDelete = false;

    #[On('confirmDelete')] 
    public function confirmDelete($id)
    {
        $this->teacherId = $id;
        $this->confirmingDelete = true;
    }

    public function deleteTeacher()
    {
        User::findOrFail($this->teacherId)->delete();
        $this->confirmingDelete = false;
        session()->flash('message', 'Docente eliminado correctamente.');
        $this->emit('refreshPage');
    }
    public function render()
    {
        return view('livewire.teacher-component');
    }
}