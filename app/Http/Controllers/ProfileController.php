<?php

namespace App\Http\Controllers; //Define el namespace

use App\Http\Requests\ProfileUpdateRequest; //Importa la clase ProfileUpdateRequest
use Illuminate\Http\RedirectResponse; //Importa la clase RedirectResponse
use Illuminate\Http\Request; //Importa la clase Request 
use Illuminate\Support\Facades\Auth; //Importa la clase Auth
use Illuminate\Support\Facades\Redirect; //Importa la clase Redirect
use Illuminate\View\View; //Importa la clase View

class ProfileController extends Controller //Define la clase ProfileController que extiende de Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View //Define el método edit que recibe un objeto Request y devuelve un objeto View
    {
        return view('profile.edit', [ //Devuelve la vista profile.edit con los datos del usuario autenticado
            'user' => $request->user(), //Obtiene el usuario autenticado
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse //Define el método update que recibe un objeto ProfileUpdateRequest y devuelve un objeto RedirectResponse
    {
        $request->user()->fill($request->validated()); //Rellena los datos del usuario con los datos validados del request

        if ($request->user()->isDirty('email')) { //Dirty es un método de Eloquent que comprueba si un atributo ha cambiado desde que se cargó el modelo
            $request->user()->email_verified_at = null; //Si ha cambiado, establece la fecha de verificación del email a null
        }

        $request->user()->save(); //Guarda los cambios en la base de datos

        return Redirect::route('profile.edit')->with('status', 'profile-updated'); //Redirige a la ruta profile.edit con un mensaje de estado
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse //Define el método destroy que recibe un objeto Request y devuelve un objeto RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'], 
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

?>