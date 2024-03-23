<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller; //Importa la clase Controller
use App\Providers\RouteServiceProvider; //Importa la clase RouteServiceProvider
use Illuminate\Auth\Events\Verified; //Importa la clase Verified. Esta clase se utiliza para el evento de verificación de email.
use Illuminate\Foundation\Auth\EmailVerificationRequest; //Importa la clase EmailVerificationRequest. Esta clase se utiliza para la verificación de email.
use Illuminate\Http\RedirectResponse; //Importa la clase RedirectResponse

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse //Define el método __invoke que recibe un objeto EmailVerificationRequest y devuelve un objeto RedirectResponse.
    //_invoke es un método mágico que se ejecuta cuando se llama a un objeto como una función.
    {
        if ($request->user()->hasVerifiedEmail()) { //Comprueba si el email del usuario ya ha sido verificado.
            return redirect()->intended(RouteServiceProvider::HOME.'?verified=1'); //Redirige a la ruta RouteServiceProvider::HOME con un parámetro verified=1 en la URL. 
        }

        if ($request->user()->markEmailAsVerified()) { //Marca el email del usuario como verificado. 
            event(new Verified($request->user())); //Lanza el evento Verified con el usuario como parámetro. 
        }

        return redirect()->intended(RouteServiceProvider::HOME.'?verified=1'); //Redirige a la ruta RouteServiceProvider::HOME con un parámetro verified=1 en la URL.
    }
}
