<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class PanelCotroller extends Controller
{
    public function index(){
        $subjectsMaterials = Subject::has('materials')->with('materials')->get();
        //return $subjectsMaterials;
        return view('students.panel-alumnos',compact('subjectsMaterials'));
    }
}
