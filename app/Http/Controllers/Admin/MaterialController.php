<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Subject;
use Mockery\Matcher\Subset;

class MaterialController extends Controller
{
    public function index(Subject $subject){
        $subject->with('materials');
        return view('admin.materials.index',compact('subject'));
    }

    public function create(Subject $subject){
        return view('admin.materials.create', compact('subject'));
    }

    public function store(Request $request, Subject $subject){
        return $request->all();
        return view('admin.materials.index',compact('subject'));
    }

    public function edit(Material $material){
        return view('admin.materials.edit',compact('material'));
    }

    public function update(Material $material, Request $request){
        return view('admin.materials.edit',compact('material'));
    }
}

