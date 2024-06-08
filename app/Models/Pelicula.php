<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Asientos; // Importar el modelo Asientos

class Pelicula extends Model
{
    use HasFactory;

    protected $fillable = ['idPelicula', 'nombrePelicula', 'fecha', 'hora'];

    protected static function booted()
    {
        static::created(function ($pelicula) {
            // Número total de asientos que queremos crear
            $numeroAsientos = 20;

            // Iteramos para crear los asientos
            for ($i = 1; $i <= $numeroAsientos; $i++) {
                // Creamos una nueva instancia de Asientos y la guardamos en la base de datos
                $asiento = new Asientos([
                    'idPelicula' => $pelicula->id,
                    'asiento_numero' => $i,
                    'estado' => 'libre',
                    'fecha' => $pelicula->fecha, // Asignamos la fecha de la película
                    'nombre_pelicula' => $pelicula->nombrePelicula, // Asignamos el nombre de la película
                ]);
                $asiento->save();
            }
        });
    }

    public function asientos()
    {
        return $this->hasMany(Asientos::class, 'idPelicula');
    }
}
