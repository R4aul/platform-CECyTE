<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    protected $fillable = [
        'name',
        'start_date',
        'final_date',
        'active'
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
