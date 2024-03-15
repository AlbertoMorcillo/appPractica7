<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Articulos') }}
        </h2>
    </x-slot>

    <div class="container mt-4 bg-white">
        <!-- Sección de artículos con paginación -->
        <div class="mt-4">
            @foreach ($articulos as $articulo)
                <div class="card mb-3">
                    <div class="card-body">
                        <!-- Numeración consecutiva de artículos -->
                        <h5 class="card-title">{{ $articulos->firstItem() + $loop->index }}. {{ $articulo->titulo }}</h5>
                        <p class="card-text">{{ $articulo->contenido }}</p>
                    </div>
                </div>
            @endforeach
            <!-- Paginación -->
            <div class="d-flex justify-content-center">
                {{ $articulos->links() }}
            </div>
        </div>
    </div>
</x-app-layout>