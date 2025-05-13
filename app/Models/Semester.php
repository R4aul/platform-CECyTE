<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    /** @use HasFactory<\Database\Factories\SemesterFactory> */
    use HasFactory;


    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
