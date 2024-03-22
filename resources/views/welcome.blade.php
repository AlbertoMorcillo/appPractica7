<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Home</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
                <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">

        <!-- jQuery library -->
        <script defer src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script defer src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script defer src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    </head>
    <body class="antialiased"> 
    <div class="container mt-4">
            @if (Route::has('login')) <!-- Verifica si existe una ruta llamada login -->
                <div class="d-flex justify-content-end">
                    @auth <!-- Verifica si el usuario está autenticado -->
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary">Dashboard</a> <!-- Redirecciona a la ruta dashboard si el usuario esta autenticado -->
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary">Log in</a> <!-- Redirecciona a la ruta login -->
                        @if (Route::has('register')) <!-- Verifica si existe una ruta llamada register -->
                            <a href="{{ route('register') }}" class="btn btn-secondary ml-2">Register</a> <!-- Redirecciona a la ruta register -->
                        @endif
                    @endauth
                </div>
            @endif
            
            <!-- Sección de artículos con paginación -->
            <div class="mt-4">
                @foreach ($articulos as $articulo) <!-- Recorre los artículos -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <!-- Numeración consecutiva de artículos -->
                            <h5 class="card-title">{{ $articulos->firstItem() + $loop->index }}. {{ $articulo->titulo }}</h5> <!-- Muestra el número de artículo y el título -->
                            <p class="card-text">{{ $articulo->contenido }}</p> <!-- Muestra el contenido del artículo -->
                        </div>
                    </div>
                @endforeach
                <!-- Paginación -->
                <div class="d-flex justify-content-center">
                    {{ $articulos->links() }} <!-- Genera los enlaces de paginación -->
                </div>
            </div>
        </div>
</div>
</body>
</html>