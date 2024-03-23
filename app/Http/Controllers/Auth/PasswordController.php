<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller; //Importa la clase Controller
use Illuminate\Http\RedirectResponse; //Importa la clase RedirectResponse
use Illuminate\Http\Request; //Importa la clase Request
use Illuminate\Support\Facades\Hash; //Importa la clase Hash. Esta clase se utiliza para el hash de contraseñas.
use Illuminate\Validation\Rules\Password; //Importa la clase Password. Esta clase se utiliza para las reglas de validación de contraseñas.

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse //Define el método update que recibe un objeto Request y devuelve un objeto RedirectResponse.
    {
        $validated = $request->validateWithBag('updatePassword', [ //Valida los datos del request con un bag llamado updatePassword. 
            'current_password' => ['required', 'current_password'], //La contraseña actual es requerida y debe ser la contraseña actual del usuario.
            'password' => ['required', Password::defaults(), 'confirmed'], //La nueva contraseña es requerida, debe cumplir con las reglas de contraseña por defecto y debe ser confirmada.
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']), //Actualiza la contraseña del usuario con la nueva contraseña hasheada.
        ]);

        return back()->with('status', 'password-updated'); //Redirige a la página anterior con un mensaje de status.
    }
}
