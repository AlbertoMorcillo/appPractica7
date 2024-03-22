<?php

namespace App\Http\Controllers; // Indicamos el namespace

use App\Models\Articulo; // Importamos el modelo Articulo
use Illuminate\Http\Request; // Importamos la clase Request.
// La clase Request es la clase principal de Laravel para manejar las solicitudes HTTP.

class ArticuloController extends Controller // Declaramos la clase ArticuloController que extiende de Controller
//Es decir, ArticuloController hereda todas las propiedades y métodos de la clase Controller.
{
    public function index() 
    {
        $articulos = Articulo::paginate(10); // Obtenemos todos los articulos paginados de 10 en 10
        return view('welcome', compact('articulos')); // Retornamos la vista welcome con los articulos.
        // La función compact crea un array asociativo con el nombre de la variable y su valor.
    }

    //El método store lo utilizaremos para guardar un nuevo articulo en la base de datos.

    public function store(Request $request) // Recibimos la solicitud y la clase Request
    {
        $request->validate([ // Validamos los campos del formulario
            'title' => 'required|max:255', // El campo title es requerido y tiene un máximo de 255 caracteres
            'description' => 'required', // El campo description es requerido
        ]);

        $articulo = new Articulo; // Creamos una nueva instancia de Articulo
        $articulo->titulo = $request->title; // Asignamos el valor del campo title a la propiedad titulo
        $articulo->contenido = $request->description; // Asignamos el valor del campo description a la propiedad contenido
        $articulo->user_id = auth()->id(); // Asignamos el id del usuario autenticado a la propiedad user_id
        $articulo->save(); // Guardamos el articulo en la base de datos

        return redirect()->route('dashboard')->with('success', 'Articulo añadido correctamente.'); // Redireccionamos al dashboard con un mensaje de éxito
    }

    public function update(Request $request, Articulo $articulo) // Recibimos la solicitud, el articulo a actualizar
    {
        $request->validate([ 
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        $articulo->titulo = $request->title; // Actualizamos el titulo del articulo
        $articulo->contenido = $request->description; // Actualizamos el contenido del articulo
        $articulo->save(); // Guardamos los cambios

        return redirect()->route('dashboard')->with('success', 'Articulo actualizado correctamente.'); // Redireccionamos al dashboard con un mensaje de éxito
    }

    public function destroy(Articulo $articulo)
    {
        $articulo->delete(); // Eliminamos el articulo de la base de datos

        return redirect()->route('dashboard')->with('success', 'Articulo eliminado correctamente.'); // Redireccionamos al dashboard con un mensaje de éxito
    }
}


?>
