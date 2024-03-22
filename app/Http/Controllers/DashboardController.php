<?php

namespace App\Http\Controllers; // Namespace

use Illuminate\Http\Request; // Importamos Request.
use Illuminate\Support\Facades\Auth; // Importamos Auth.
use App\Models\Articulo; // Importamos el modelo Articulo.

class DashboardController extends Controller //class DashboardController extiende de Controller. Por lo tanto, hereda todos los metodos de Controller.
{
    /**
     * Show the application dashboard.
     * 
     * 
     * 
     * @return \Illuminate\Contracts\Support\Renderable // Devuelve una vista.
     */
    public function index()
    {
        // Obtiene los artículos del usuario autenticado y los artículos generales.
        $articulos = Articulo::where('user_id', auth()->id())
                    ->orWhereNull('user_id')
                    ->orderBy('created_at', 'desc') // Ordena los resultados por fecha de creación y de forma .
                    ->paginate(5); // Pagina los resultados.
    
        return view('dashboard', ['user' => Auth::user(), 'articulos' => $articulos]); // Devuelve la vista dashboard con los datos del usuario autenticado y los artículos.

    }
    


    public function store(Request $request) // Método para almacenar un artículo.
    {
        $request->validate([
            'articleTitle' => 'required|max:255',
            'articleDescription' => 'required',
        ]);

        $articulo = new Articulo; // Instancia de la clase Articulo.
        $articulo->titulo = $request->articleTitle; // Asigna el título del artículo.
        $articulo->contenido = $request->articleDescription; // Asigna el contenido del artículo.
        $articulo->user_id = Auth::id(); // Autenticar al usuario y obtener su ID
        $articulo->save(); // Guarda el artículo en la base de datos.

        return redirect()->route('dashboard'); // Redirecciona a la vista dashboard.
    }
}
