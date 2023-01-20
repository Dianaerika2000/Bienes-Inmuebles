<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fotografia extends Model
{
    use HasFactory;
    protected $table='fotografias';
    protected $fillable=([
        'url',
        'detalle',
        'fechaSubida',
        'idInmueble',
    ]);
    public $timestamps=false;
    public function inmueble()
    {
        return $this->belongsTo(Inmueble::class,'idInmueble','id');
    }
}
