<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-black-200 leading-tight">
                {{ __('Artículos') }}
            </h2>
            <!-- Botón para abrir el modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addArticleModal">
                Añadir artículo
            </button>
        </div>
    </x-slot>

    <div class="container mt-4 bg-white">
        <!-- Sección de artículos con paginación -->
        <div class="mt-4">
            @foreach ($articulos as $articulo)
            <div class="card mb-3">
                <div class="card-body">
                    <!-- Numeración consecutiva de artículos -->
                    <h2 class="card-title font-bold text-primary">{{ $articulos->firstItem() + $loop->index }}. {{ $articulo->titulo }}</h2>
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

    <!-- Modal para añadir artículo -->
    <div class="modal fade" id="addArticleModal" tabindex="-1" role="dialog" aria-labelledby="addArticleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addArticleModalLabel">Añadir artículo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('guardar-articulo') }}">
                        @csrf <!-- Token CSRF -->
                        <div class="form-group">
                            <label for="articleTitle">Título del artículo</label>
                            <input type="text" class="form-control" id="articleTitle" name="articleTitle" placeholder="Introduce el título del artículo" required>
                        </div>
                        <div class="form-group">
                            <label for="articleDescription">Descripción del artículo</label>
                            <textarea class="form-control" id="articleDescription" name="articleDescription" rows="3" placeholder="Introduce la descripción del artículo" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar artículo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>