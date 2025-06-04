<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class TaskController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            'auth', // obligatorio para todo el controlador
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('admin.tasks.index'), only: ['index']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('admin.tasks.show'), only: ['show']),
        ];
    }
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
