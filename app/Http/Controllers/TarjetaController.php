<?php

namespace App\Http\Controllers;

use App\Models\Tarjeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TarjetaController extends Controller
{
    public function store(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'numero' => 'required|string|size:16',
            'fecha_caducidad' => 'required|date',
            'cvv' => 'required|string|size:3',
        ]);

        // Obtener el ID del usuario autenticado
        $userId = Auth::id();

        // Crear una nueva tarjeta asociada al usuario actual
        $tarjeta = new Tarjeta([
            'id_usuario' => $userId,
            'numero' => $request->numero,
            'fecha_caducidad' => $request->fecha_caducidad,
            'cvv' => $request->cvv,
        ]);

        // Guardar la tarjeta en la base de datos
        $tarjeta->save();

        // Retornar la tarjeta creada como respuesta
        return response()->json($tarjeta, 201);
    }

    public function getTarjetasPorUsuario($userId)
    {
        // Obtener las tarjetas asociadas al usuario
        $tarjetas = Tarjeta::where('id_usuario', $userId)->get();

        // Retornar las tarjetas como respuesta
        return response()->json(['tarjetas' => $tarjetas], 200);
    }

    public function deleteTarjeta($tarjetaId)
    {
        // Obtener la tarjeta por su ID
        $tarjeta = Tarjeta::find($tarjetaId);

        // Verificar si la tarjeta existe y si pertenece al usuario autenticado
        if (!$tarjeta || $tarjeta->id_usuario !== Auth::id()) {
            return response()->json(['message' => 'Tarjeta no encontrada'], 404);
        }

        // Eliminar la tarjeta
        $tarjeta->delete();

        // Retornar una respuesta exitosa
        return response()->json(['message' => 'Tarjeta eliminada exitosamente'], 200);
    }
}
