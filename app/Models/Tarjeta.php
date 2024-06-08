<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarjeta extends Model
{
    use HasFactory;

    protected $fillable = ['id_usuario', 'numero', 'fecha_caducidad', 'cvv'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
