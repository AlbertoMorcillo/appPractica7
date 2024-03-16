<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Articulo; // Asegúrate de agregar esta línea

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Obtiene los artículos del usuario autenticado y los artículos generales.
        $articulos = Articulo::where('user_id', auth()->id())
                    ->orWhereNull('user_id')
                    ->orderBy('created_at', 'desc') // Ordena los resultados por fecha de creación.
                    ->paginate(5); // Pagina los resultados.
    
        return view('dashboard', ['user' => Auth::user(), 'articulos' => $articulos]);
    }
    


    public function store(Request $request)
    {
        $request->validate([
            'articleTitle' => 'required|max:255',
            'articleDescription' => 'required',
        ]);

        $articulo = new Articulo;
        $articulo->titulo = $request->articleTitle;
        $articulo->contenido = $request->articleDescription;
        $articulo->user_id = Auth::id(); // Autenticar al usuario y obtener su ID
        $articulo->save();

        return redirect()->route('dashboard');
    }
}
