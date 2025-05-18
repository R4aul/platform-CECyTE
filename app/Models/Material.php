<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Material extends Model
{
    /** @use HasFactory<\Database\Factories\MaterialFactory> */
    use HasFactory;

     protected $fillable = ['material_name','material_description', 'body','fileType', 'path', 'subject_id','user_id'];

     public function subject(){
        return $this->belongsTo(Subject::class);
     }

     public function tasks(){
      return $this->hasMany(Task::class);
     }
}
