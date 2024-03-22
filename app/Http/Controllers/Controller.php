<?php

namespace App\Http\Controllers; // Namespace

use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Importamos AuthorizesRequests. Proporciona metodos de autorizacion.
use Illuminate\Foundation\Validation\ValidatesRequests; // Importamos ValidatesRequests. Proporciona metodos de validacion.
use Illuminate\Routing\Controller as BaseController;  // Importamos BaseController. Proporciona metodos de controlador.

class Controller extends BaseController //class Controller extiende de BaseController. Por lo tanto, hereda todos los metodos de BaseController.
{
    use AuthorizesRequests, ValidatesRequests; // Utilizamos AuthorizesRequests y ValidatesRequests. 
}
