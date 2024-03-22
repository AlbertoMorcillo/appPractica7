<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" /> <!-- Muestra un mensaje de estado de la sesión. -->

    <form method="POST" action="{{ route('login') }}"> <!-- Formulario para iniciar sesión. La ruta login maneja la autenticación de los usuarios. -->
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" /> <!-- Etiqueta para el campo de correo electrónico. El _() es para la internacionalización. Buscará una traducción para la cadena 'Email' en los archivos de idioma de la aplicación. -->
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" /> <!-- Etiqueta para el campo de contraseña. El _() es para la internacionalización. Buscará una traducción para la cadena 'Password' en los archivos de idioma de la aplicación. -->

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" /> 

            <x-input-error :messages="$errors->get('password')" class="mt-2" /> <!-- Muestra los errores de validación del campo de contraseña. -->
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span> <!-- Etiqueta para el campo de recordar sesión. El _() es para la internacionalización. Buscará una traducción para la cadena 'Remember me' en los archivos de idioma de la aplicación. -->
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request')) <!-- Comprueba si la ruta password.request existe en la aplicación. -->
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }} <!-- Enlace para restablecer la contraseña. -->
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }} <!-- Botón para iniciar sesión. El _() es para la internacionalización. Buscará una traducción para la cadena 'Log in' en los archivos de idioma de la aplicación. -->
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
