<?php

namespace App\Http\Controllers;

use App\Models\Taller;
use App\Models\Cita;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TallerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Taller::query();

        if ($request->filled('ciudad')) {
            $query->where('ciudad', $request->input('ciudad'));
        }

        if ($request->filled('servicio_id')) {
            $query->whereHas('servicios', function ($q) use ($request) {
                $q->where('id', $request->input('servicio_id'));
            });
        }

        if (Auth::check() && Auth::user()->role === 'taller') {
            $talleres = $query->where('user_id', Auth::id())->get();
        } else {
            $talleres = $query->get();
        }

        $ciudades = Taller::select('ciudad')->distinct()->get();
        $servicios = Servicio::all();

        return view('talleres.index', compact('talleres', 'ciudades', 'servicios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('talleres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'contacto' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'horario_apertura' => 'required',
            'horario_cierre' => 'required',
            'dias_laborables' => 'nullable|array',
        ]);

        $path = $request->file('foto') ? $request->file('foto')->store('fotos', 'public') : null;

        Taller::create([
            'user_id' => Auth::id(),
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'ciudad' => $request->input('ciudad'),
            'contacto' => $request->contacto,
            'descripcion' => $request->descripcion,
            'foto' => $path,
            'lat' => $request->input('lat'),
            'lng' => $request->input('lng'),
            'horario_apertura' => $request->input('horario_apertura'),
            'horario_cierre' => $request->input('horario_cierre'),
            'dias_laborables' => json_encode($request->dias_laborables),
        ]);

        return redirect()->route('talleres.index')->with('success', 'Taller creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $taller = Taller::findOrFail($id);
        return view('talleres.show', compact('taller'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $taller = Taller::where('user_id', Auth::id())->findOrFail($id);
        return view('talleres.edit', compact('taller'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'contacto' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'horario_apertura' => 'required',
            'horario_cierre' => 'required',
            'dias_laborables' => 'nullable|array',
        ]);

        $taller = Taller::where('user_id', Auth::id())->findOrFail($id);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public');
            $taller->foto = basename($path);
        }

        $taller->update([
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'contacto' => $request->contacto,
            'descripcion' => $request->descripcion,
            'foto' => $taller->foto ?? null,
            'lat' => $request->input('lat'),
            'lng' => $request->input('lng'),
            'horario_apertura' => $request->input('horario_apertura'),
            'horario_cierre' => $request->input('horario_cierre'),
            'dias_laborables' => json_encode($request->dias_laborables),
        ]);

        return redirect()->route('talleres.index')->with('success', 'Taller actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $taller = Taller::findOrFail($id);
        $taller->delete();
        return redirect()->route('talleres.index')->with('success', 'Taller eliminado correctamente');
    }

    public function citas($id)
    {
        $taller = Taller::findOrFail($id);

        if (Auth::user()->role !== 'taller' || Auth::id() !== $taller->user_id) {
            return redirect()->route('home')->with('error', 'No tienes permiso para ver esta página.');
        }

        $citas = Cita::where('taller_id', $id)->with('user', 'servicio')->get();
        return view('talleres.citas', compact('taller', 'citas'));
    }

    
}