<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    /** @use HasFactory<\Database\Factories\SubjectFactory> */
    use HasFactory;

    public function materials(){
        return $this->hasMany(Material::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
