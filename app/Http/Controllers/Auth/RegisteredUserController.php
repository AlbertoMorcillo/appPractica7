<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller; //Importa la clase Controller
use App\Models\User; //Importa la clase User
use App\Providers\RouteServiceProvider; //Importa la clase RouteServiceProvider
use Illuminate\Auth\Events\Registered; //Importa la clase Registered. Esta clase se utiliza para el evento de registro de usuario.
use Illuminate\Http\RedirectResponse; //Importa la clase RedirectResponse
use Illuminate\Http\Request; //Importa la clase Request
use Illuminate\Support\Facades\Auth; //Importa la clase Auth
use Illuminate\Support\Facades\Hash; //Importa la clase Hash. Esta clase se utiliza para el hash de contraseñas.
use Illuminate\Validation\Rules; //Importa la clase Rules. Esta clase se utiliza para las reglas de validación.
use Illuminate\View\View; //Importa la clase View. Esta clase se utiliza para las vistas.

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View //Define el método create que devuelve un objeto View.
    {
        return view('auth.register'); //Devuelve la vista auth.register. Es decir, la vista de registro.
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException //Lanza una excepción de validación. 
     */
    public function store(Request $request): RedirectResponse //Define el método store que recibe un objeto Request y devuelve un objeto RedirectResponse. 
    {
        $request->validate([ //Valida los datos del request
            'name' => ['required', 'string', 'max:255'], //El nombre es requerido, debe ser una cadena y tener un máximo de 255 caracteres.
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class], //El email es requerido, debe ser una cadena en minúsculas, debe ser un email y tener un máximo de 255 caracteres. Además, debe ser único en la tabla users.
            'password' => ['required', 'confirmed', Rules\Password::defaults()], //La contraseña es requerida, debe ser confirmada y debe cumplir con las reglas de contraseña por defecto.
        ]);

        $user = User::create([ //Crea un nuevo usuario con los datos del request
            'name' => $request->name, 
            'email' => $request->email,
            'password' => Hash::make($request->password), //Hash de la contraseña para almacenarla de forma segura.
        ]);

        event(new Registered($user)); //Lanza el evento Registered con el usuario como parámetro. 

        Auth::login($user); //Inicia sesión con el nuevo usuario.

        return redirect(RouteServiceProvider::HOME); //Redirige a la ruta RouteServiceProvider::HOME.
    }
}
