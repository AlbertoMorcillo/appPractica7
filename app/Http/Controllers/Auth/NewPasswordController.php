<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller; //Importa la clase Controller
use Illuminate\Auth\Events\PasswordReset; //Importa la clase PasswordReset. Esta clase se utiliza para el evento de reseteo de contraseña.
use Illuminate\Http\RedirectResponse; //Importa la clase RedirectResponse
use Illuminate\Http\Request; //Importa la clase Request
use Illuminate\Support\Facades\Hash; //Importa la clase Hash. Esta clase se utiliza para el hash de contraseñas.
use Illuminate\Support\Facades\Password; //Importa la clase Password. Esta clase se utiliza para el reseteo de contraseñas.
use Illuminate\Support\Str; //Importa la clase Str. Esta clase se utiliza para generar cadenas aleatorias. 
use Illuminate\Validation\Rules; //Importa la clase Rules. Esta clase se utiliza para las reglas de validación.
use Illuminate\View\View; //Importa la clase View. Esta clase se utiliza para las vistas.

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View //Define el método create que recibe un objeto Request y devuelve un objeto View.
    {
        return view('auth.reset-password', ['request' => $request]); //Devuelve la vista auth.reset-password con el request como parámetro.
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse //Define el método store que recibe un objeto Request y devuelve un objeto RedirectResponse.
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()], //La contraseña es requerida, debe ser confirmada y debe cumplir con las reglas de contraseña por defecto.
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset( //Resetea la contraseña del usuario.
            $request->only('email', 'password', 'password_confirmation', 'token'), //Obtiene los datos del request. 
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60), //Genera un token aleatorio para recordar la sesión.
                ])->save();

                event(new PasswordReset($user)); //Lanza el evento PasswordReset con el usuario como parámetro.
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $status == Password::PASSWORD_RESET //Comprueba si el status es PASSWORD_RESET.
                    ? redirect()->route('login')->with('status', __($status)) //Si es así, redirige a la ruta login con un mensaje de status.
                    : back()->withInput($request->only('email')) //Si no, redirige a la página anterior con el email proporcionado.
                            ->withErrors(['email' => __($status)]); //Además, muestra un mensaje de error con el status.
    }
}
