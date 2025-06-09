<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;


class Subject extends Model
{
    /** @use HasFactory<\Database\Factories\SubjectFactory> */
    use HasFactory;

    protected $fillable = [
       'subject_name',
       'path_image',
       'semester_id',
   ];

   public function image() : Attribute {
        return new Attribute(
            get:function(){
                if ($this->path_image) {
                    //primero estraigo los primeros 8 caracteres y comparo si esos caracteres son iguales a https:// dosnde si es igual que me traiga esa imagen
                    return '/storage/'.$this->path_image;
                    if (substr($this->image_path,0,8) === 'https://') {
                        return $this->image_path;
                    }
                    //me trae la imagen desde storago con la url
                    return Storage::url($this->image_path);
                }
                else {
                    return asset('images/not_found.jpg');
                }
            }
        );
   }

    public function materials(){
        return $this->hasMany(Material::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function semester(){
        return $this->belongsTo(Semester::class);
    }

    public function qualifications(){
        return $this->hasMany(Qualification::class);
    }
}
