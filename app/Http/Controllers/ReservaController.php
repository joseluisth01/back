<?php
namespace App\Http\Controllers;

use App\Models\Pelicula;
use Carbon\Carbon;
use App\Models\Asientos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum'); // Usar Sanctum para autenticación
    }

    public function getReservasPorUsuario()
    {
        $usuarioId = Auth::id();
        $reservas = Asientos::where('usuario_id', $usuarioId)->with('pelicula')->get();

        $reservas->transform(function ($reserva) {
            $reserva->fecha = Carbon::parse($reserva->fecha)->toDateString();
            return $reserva;
        });

        return response()->json(['reservas' => $reservas], 200);
    }


    public function cancelarReserva($id)
    {
        try {
            $reserva = Asientos::findOrFail($id);
            if ($reserva->usuario_id !== Auth::id()) {
                return response()->json(['error' => 'No autorizado'], 403);
            }
            $reserva->estado = 'libre';
            $reserva->usuario_id = null; // Liberar el asiento
            $reserva->save();
            return response()->json(['mensaje' => 'Reserva cancelada correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'No se pudo cancelar la reserva'], 500);
        }
    }

    public function getPeliculaPorId($idPelicula)
    {
        $pelicula = Pelicula::where('id', $idPelicula)->first();
    
        if (!$pelicula) {
            return response()->json(['error' => 'Película no encontrada'], 404);
        }
    
        return response()->json(['pelicula' => $pelicula], 200);
    }
    

}
