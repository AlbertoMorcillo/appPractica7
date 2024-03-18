<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Artículos') }}
        </h2>
        <!-- Botón para abrir el modal de añadir artículo -->
        <button type="button" class="btn btn-success" style="background-color: #28a745; border-color: #28a745;" data-toggle="modal" data-target="#addArticleModal">
            Añadir artículo
        </button>
    </x-slot>

    <div class="container mt-4 bg-white">
        <!-- Listado de artículos -->
        @foreach ($articulos as $index => $articulo)
        <div class="card mb-3">
            <div class="card-body">
                <!-- Título y contenido del artículo -->
                <h2 class="card-title font-bold text-primary">{{ $articulos->firstItem() + $index }}. {{ $articulo->titulo }}</h2>
                <p class="card-text">{{ $articulo->contenido }}</p>

                <!-- Botón de editar -->
                <button class="btn btn-warning" data-toggle="modal" data-target="#editArticleModal-{{ $articulo->id }}">
                    Editar
                </button>

                <!-- Botón y formulario de eliminar -->
                <form action="{{ route('articulos.destroy', $articulo->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="background-color: #dc3545; color: white; border-color: #dc3545;">
                        Eliminar
                    </button>
                </form>
            </div>
        </div>

        <!-- Modal de edición de artículo -->
        <div class="modal fade" id="editArticleModal-{{ $articulo->id }}" tabindex="-1" aria-labelledby="editArticleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editArticleModalLabel">Editar artículo</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('articulos.update', $articulo->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="title">Título del artículo</label>
                                <input type="text" class="form-control" name="title" value="{{ $articulo->titulo }}" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Descripción del artículo</label>
                                <textarea class="form-control" name="description" rows="3" required>{{ $articulo->contenido }}</textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <!-- Paginación -->
        <div class="d-flex justify-content-center">
            {{ $articulos->links() }}
        </div>
    </div>

    <!-- Modal de añadir artículo -->
    <div class="modal fade" id="addArticleModal" tabindex="-1" aria-labelledby="addArticleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addArticleModalLabel">Añadir artículo</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('articulos.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="title">Título del artículo</label>
                            <input type="text" class="form-control" name="title" placeholder="Introduce el título del artículo" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción del artículo</label>
                            <textarea class="form-control" name="description" rows="3" placeholder="Introduce la descripción del artículo" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success">Añadir artículo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
