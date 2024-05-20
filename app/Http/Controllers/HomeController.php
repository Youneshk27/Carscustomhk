<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taller;
use App\Models\Servicio;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $query = Taller::query();

        // Filtrar por ciudad o nombre de garaje
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('ciudad', 'LIKE', "%{$search}%")
                  ->orWhere('nombre', 'LIKE', "%{$search}%");
            });
        }

        // Filtrar por usuario si es un taller
        if (Auth::check() && Auth::user()->role === 'taller') {
            $query->where('user_id', Auth::id());
        }


        $talleres = $query->get();
        $servicios = Servicio::all(); // Obtener todos los servicios

        return view('home', compact('talleres', 'servicios'));
    }
}
