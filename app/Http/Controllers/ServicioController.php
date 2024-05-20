<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use App\Models\Taller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servicios = Servicio::all();
        return view('servicios.index', compact('servicios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $talleres = Taller::where('user_id', Auth::id())->get();
        return view('servicios.create', compact('talleres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'taller_id' => 'required|exists:talleres,id',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'precio' => 'required|numeric',
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('servicios', 'public');
        }

        Servicio::create($data);

        return redirect()->route('talleres.show', $data['taller_id'])->with('success', 'Servicio creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $servicio = Servicio::findOrFail($id);
        return view('servicios.show', compact('servicio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $servicio = Servicio::findOrFail($id);
        $talleres = Taller::where('user_id', Auth::id())->get();
        return view('servicios.edit', compact('servicio', 'talleres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'taller_id' => 'required|exists:talleres,id',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'precio' => 'required|numeric',
        ]);

        $servicio = Servicio::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior
            if ($servicio->imagen) {
                Storage::disk('public')->delete($servicio->imagen);
            }
            // Subir la nueva imagen
            $data['imagen'] = $request->file('imagen')->store('servicios', 'public');
        }

        $servicio->update($data);

        return redirect()->route('talleres.show', $servicio->taller_id)->with('success', 'Servicio actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $servicio = Servicio::findOrFail($id);
        // Eliminar la imagen asociada
        if ($servicio->imagen) {
            Storage::disk('public')->delete($servicio->imagen);
        }
        $servicio->delete();
        return redirect()->route('talleres.show', $servicio->taller_id)->with('success', 'Servicio eliminado correctamente');
    }
}
