<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    $articulos = \App\Models\Articulo::paginate(5);

    return view('dashboard', ['user' => $user, 'articulos' => $articulos]);
}
}