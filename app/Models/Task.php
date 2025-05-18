<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    protected $fillable = [
        'body',
        'material_id',
        'path_task',
        'type_file',
        'user_id',
    ];
    public function materials(){
        return $this->belongsTo(Material::class);
    }

    public function  student(){
        return $this->belongsTo(User::class);
    }
}
