<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partial extends Model
{
    protected $fillable = [
        'number',
        'semester_id',
        'active'
    ];

    public function qualifications(){
        return $this->hasMany(Qualification::class);
    }
}
