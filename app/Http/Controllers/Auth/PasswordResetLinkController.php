<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller; //Importa la clase Controller
use Illuminate\Http\RedirectResponse; //Importa la clase RedirectResponse
use Illuminate\Http\Request; //Importa la clase Request
use Illuminate\Support\Facades\Password; //Importa la clase Password. Esta clase se utiliza para el reseteo de contraseñas.
use Illuminate\View\View; //Importa la clase View. Esta clase se utiliza para las vistas.

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password'); //Devuelve la vista auth.forgot-password. Es decir, la vista de solicitud de reseteo de contraseña.
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException //Lanza una excepción de validación.
     */
    public function store(Request $request): RedirectResponse //Define el método store que recibe un objeto Request y devuelve un objeto RedirectResponse.
    {
        $request->validate([
            'email' => ['required', 'email'], //El email es requerido y debe ser un email.
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink( //Envía el link de reseteo de contraseña al email proporcionado.
            $request->only('email') //Obtiene el email del request.
        );

        return $status == Password::RESET_LINK_SENT //Comprueba si el status es RESET_LINK_SENT. 
                    ? back()->with('status', __($status)) //Si es así, redirige a la página anterior con un mensaje de status.
                    : back()->withInput($request->only('email')) //Si no, redirige a la página anterior con el email proporcionado.
                            ->withErrors(['email' => __($status)]); //Además, muestra un mensaje de error con el status.
    }
}
