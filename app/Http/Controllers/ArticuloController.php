<?php

namespace App\Http\Controllers;
use App\Models\Articulo;
use Illuminate\Http\Request;

class ArticuloController extends Controller
{
    public function index()
    {
        $articulos = Articulo::paginate(10); // Ajusta el número de artículos por página según sea necesario
        return view('welcome', compact('articulos'));
    }
}
