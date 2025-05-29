<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class Task extends Model
{
    protected $fillable = [
        'body',
        'material_id',
        'path_task',
        'type_file',
        'user_id',
    ];

    public function formatDate() : Attribute {
        return new Attribute(
           get: fn () => Carbon::parse($this->created_at)
            ->locale(App::getLocale()) // Asegúrate de que esté en 'es'
            ->isoFormat('D [de] MMMM [de] YYYY') // Ej: 25 de mayo de 2025 
        );
    }

    public function materials(){
        return $this->belongsTo(Material::class);
    }

    public function student(){
        return $this->belongsTo(User::class,'user_id');
    }
}
