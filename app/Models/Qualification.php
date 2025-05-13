<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    protected $fillable = [
        'user_id',
        'partial_id',
        'subject_id',
        'grade',
    ];

    public function student(){
        return $this->belongsTo(User::class);
    }

    public function partial() {
       return $this->belongsTo(Partial::class); 
    }

    public function subject() {
       return $this->belongsTo(Subject::class); 
    }
}
