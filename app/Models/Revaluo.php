<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revaluo extends Model
{
    use HasFactory;
    protected $table='revaluos';
    protected $fillable=([
        'descripcion',
        'fechaRevaluo',
        'costo',
        'costoActualizado',
        'depreciacionAcumulada',
        'valorNeto',
        'idInmueble',
    ]);
    public $timestamps=false;
    public function inmueble()
    {
        return $this->belongsTo(Inmueble::class,'idInmueble','id');
    }
}
