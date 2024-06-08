<?php

namespace App\Http\Controllers;

use App\Mail\ReservaHecha;
use App\Models\Asientos;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;
class AsientosController extends Controller
{
    //

    public function getAsientos($idPelicula)
    {
        $asientos = Asientos::where('idPelicula', $idPelicula)->get();
        return response()->json(['asientos' => $asientos]);
    }

    public function reservarAsientos(Request $request)
    {
        $idPelicula = $request->input('idPelicula');
        $asientosSeleccionados = $request->input('asientosSeleccionados');
        $usuarioId = $request->input('usuarioId');
        $nombre = $request->input('nombre');
        $apellidos = $request->input('apellidos');
        $email = $request->input('email');
        $matricula = $request->input('matricula');
        $tarjeta = $request->input('tarjeta');
        $fechaCaducidad = $request->input('fechaCaducidad');
        $cvv = $request->input('cvv');
        $productos = $request->input('productos');
    
        try {
            \DB::transaction(function () use ($idPelicula, $asientosSeleccionados, $usuarioId, $nombre, $apellidos, $email, $matricula, $tarjeta, $fechaCaducidad, $cvv, $productos) {
                foreach ($asientosSeleccionados as $asientoNumero) {
                    Asientos::where('idPelicula', $idPelicula)
                        ->where('asiento_numero', $asientoNumero)
                        ->update(['estado' => 'ocupado', 'usuario_id' => $usuarioId]);
                }
            });

            Mail::to($email)->send(new ReservaHecha($nombre,$apellidos,$matricula,$asientosSeleccionados,$productos));

    
            return response()->json(['mensaje' => 'Asientos reservados exitosamente']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error reservando asientos', 'message' => $e->getMessage()], 500);
        }
    }
    
}
