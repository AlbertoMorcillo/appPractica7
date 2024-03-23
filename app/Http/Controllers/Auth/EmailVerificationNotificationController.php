<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse //Define el método store que recibe un objeto Request y devuelve un objeto RedirectResponse.
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME); //Si el email del usuario ya ha sido verificado, redirige a la ruta RouteServiceProvider::HOME.
        }

        $request->user()->sendEmailVerificationNotification(); //Envía una nueva notificación de verificación de email al usuario.

        return back()->with('status', 'verification-link-sent'); //Redirige a la página anterior con un mensaje de status.
    }
}
