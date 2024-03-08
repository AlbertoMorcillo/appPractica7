@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($articulos as $articulo)
            <div class="articulo">
                <h2>{{ $articulo->titulo }}</h2>
                <p>{{ $articulo->contenido }}</p>
            </div>
        @endforeach
        {{ $articulos->links() }}
    </div>
    @if (Auth::guest())
        <div class="d-flex justify-content-end">
            <a href="{{ route('login') }}" class="btn btn-primary">Iniciar sesión</a>
            <a href="{{ route('register') }}" class="btn btn-secondary ml-2">Registrarse</a>
        </div>
    @endif
@endsection
