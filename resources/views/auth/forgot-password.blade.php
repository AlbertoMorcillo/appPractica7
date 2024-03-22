<x-guest-layout> 
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}"> <!-- Formulario para enviar el enlace de restablecimiento de contraseña. La ruta password.email maneja el envío del enlace de restablecimiento de contraseña. -->
        @csrf <!-- Token de seguridad para proteger la aplicación contra ataques de falsificación de solicitudes en sitios cruzados-->

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" /> <!-- Etiqueta para el campo de correo electrónico. El _() es para la internacionalización. Buscará una traducción para la cadena 'Email' en los archivos de idioma de tu aplicación. -->
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus /> <!-- Campo de correo electrónico -->
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div> 

        <div class="flex items-center justify-between mt-4">
            <a href="{{ url()->previous() }}" class="text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-50">
                {{ __('Go Back') }} <!-- Enlace para volver atrás -->
            </a>
            <x-primary-button>
                {{ __('Email Password Reset Link') }} <!-- Botón para enviar el enlace de restablecimiento de contraseña -->
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>