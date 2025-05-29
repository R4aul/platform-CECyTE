<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(Material $material){
        $material = $material->load([
            'tasks'=>['student']
    ]);
        return view('admin.tasks.index', compact('material'));
    }

    public function show(Task $task){
        return view('admin.tasks.show',compact('task'));
   }
}
