<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estrenos extends Model
{
    use HasFactory;

    protected $fillable = ['idPelicula', 'nombrePelicula'];
}
