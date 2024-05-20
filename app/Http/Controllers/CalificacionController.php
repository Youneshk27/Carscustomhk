<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calificacion;
use Illuminate\Support\Facades\Auth;

class CalificacionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'taller_id' => 'required|exists:talleres,id',
            'rating' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string',
        ]);

        if (Auth::user()->isUsuario()) {
            Calificacion::create([
                'user_id' => Auth::id(),
                'taller_id' => $request->input('taller_id'),
                'rating' => $request->input('rating'),
                'comentario' => $request->input('comentario'),
            ]);

        return redirect()->route('talleres.show', $request->input('taller_id'))->with('success', 'Calificación y comentario añadidos correctamente');
    }

        return redirect()->back()->with('error', 'Solo los usuarios pueden calificar y comentar');
    }
}