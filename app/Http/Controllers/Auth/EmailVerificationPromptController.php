<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View //Define el método __invoke que recibe un objeto Request y devuelve un objeto RedirectResponse o View.
    {
        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(RouteServiceProvider::HOME) //Si el email del usuario ya ha sido verificado, redirige a la ruta RouteServiceProvider::HOME.
                    : view('auth.verify-email'); //Si no, devuelve la vista auth.verify-email. Es decir, la vista de verificación de email.
    }
}
