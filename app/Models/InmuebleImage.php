<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InmuebleImage extends Model
{
    use HasFactory;

    // $inmuebleImage -> inmueble
    public function product(){
        return $this->belongsTo(Inmueble::class);
    }

    // accesor
    public function getUrlAttribute(){
        if(substr($this->image, 0, 4) === 'http'){
            return $this->image;
        }
        return '/images/inmuebles/' . $this->image;
    }
}
