<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;

class TaskController extends Controller
{
    public function create(Material $material){
        return view('students.task.create', compact('material'));
    }

    public function store(Request $request, Material $material){
        return $request->all();
    }
}
