<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getUser()
    {
        $user = Auth::user();

        if ($user) {
            return response()->json([
                'nombre' => $user->nombre,
                'apellidos' => $user->apellidos,
                'email' => $user->email,
                'matricula' => $user->matricula
            ], 200);
        } else {
            return response()->json(['error' => 'Usuario no autenticado'], 401);
        }
    }
}
