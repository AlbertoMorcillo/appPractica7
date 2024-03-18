<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Http\Request;

class ArticuloController extends Controller
{
    public function index()
    {
        $articulos = Articulo::paginate(10); 
        return view('welcome', compact('articulos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        $articulo = new Articulo;
        $articulo->titulo = $request->title;
        $articulo->contenido = $request->description;
        $articulo->user_id = auth()->id();
        $articulo->save();

        return redirect()->route('dashboard')->with('success', 'Articulo añadido correctamente.');
    }

    public function update(Request $request, Articulo $articulo)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        $articulo->titulo = $request->title;
        $articulo->contenido = $request->description;
        $articulo->save();

        return redirect()->route('dashboard')->with('success', 'Articulo actualizado correctamente.');
    }

    public function destroy(Articulo $articulo)
    {
        $articulo->delete();

        return redirect()->route('dashboard')->with('success', 'Articulo eliminado correctamente.');
    }
}


?>
