<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Taller;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitaController extends Controller
{
    public function index()
    {
        $citas = Cita::where('user_id', Auth::id())->get();
        return view('citas.index', compact('citas'));
    }

    public function create(Request $request)
    {
        $taller = Taller::findOrFail($request->input('taller_id'));
        $servicios = $taller->servicios;
        return view('citas.create', compact('taller', 'servicios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'taller_id' => 'required|exists:talleres,id',
            'servicio_id' => 'required|exists:servicios,id',
            'descripcion' => 'nullable|string',
            'fecha_hora' => 'required|date|after:now',
        ]);

        Cita::create([
            'user_id' => Auth::id(),
            'taller_id' => $request->input('taller_id'),
            'servicio_id' => $request->input('servicio_id'),
            'descripcion' => $request->input('descripcion'),
            'fecha_hora' => $request->input('fecha_hora'),
        ]);

        return redirect()->route('talleres.citas', $request->input('taller_id'))->with('success', 'Cita reservada correctamente');
    }

    public function show(string $id)
    {
        $cita = Cita::findOrFail($id);
        return view('citas.show', compact('cita'));
    }

    public function edit(string $id)
    {
        $cita = Cita::findOrFail($id);
        $talleres = Taller::all();
        return view('citas.edit', compact('cita', 'talleres'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'taller_id' => 'required|exists:talleres,id',
            'fecha_hora' => 'required|date_format:Y-m-d\TH:i',
            'descripcion' => 'nullable|string',
        ]);

        $cita = Cita::findOrFail($id);
        $cita->update([
            'taller_id' => $request->taller_id,
            'fecha_hora' => $request->fecha_hora,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('citas.index')->with('success', 'Cita actualizada correctamente');
    }

    public function destroy(string $id)
    {
        $cita = Cita::findOrFail($id);
        $cita->delete();
        return redirect()->route('citas.index')->with('success', 'Cita eliminada correctamente');
    }
}
