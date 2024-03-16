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
        $user = Auth::user();
        $articulos = Articulo::paginate(5);

        return view('dashboard', ['user' => $user, 'articulos' => $articulos]);
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
        $articulo->user_id = auth()->id();
        $articulo->save();

        return redirect('/dashboard')->with('status', 'Artículo guardado con éxito');
    }

}