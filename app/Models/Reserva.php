<?php

// app/Models/Reserva.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id',
        'pelicula_nombre',
        'asiento_numero',
        'fecha'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
