@extends('layouts.app')

@section('title', 'Editar Producto')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('productos.index') }}">Productos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar: {{ $producto->nombre }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h1 class="card-title h5 mb-0">Editar Producto</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('productos.update', $producto) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre', $producto->nombre) }}" required>
                            @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="4" required>{{ old('descripcion', $producto->descripcion) }}</textarea>
                            @error('descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="precio" class="form-label">Precio <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" step="0.01" min="0" class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio" value="{{ old('precio', $producto->precio) }}" required>
                                        @error('precio')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="stock" class="form-label">Stock <span class="text-danger">*</span></label>
                                    <input type="number" min="0" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock', $producto->stock) }}" required>
                                    @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="categoria" class="form-label">Categoría <span class="text-danger">*</span></label>
                                    <select class="form-select @error('categoria') is-invalid @enderror" id="categoria" name="categoria" required>
                                        <option value="" disabled>Seleccionar categoría</option>
                                        <option value="Anime" {{ old('categoria', $producto->categoria) == 'Anime' ? 'selected' : '' }}>Anime</option>
                                        <option value="Videojuego" {{ old('categoria', $producto->categoria) == 'Videojuego' ? 'selected' : '' }}>Videojuego</option>
                                        <option value="Manga" {{ old('categoria', $producto->categoria) == 'Manga' ? 'selected' : '' }}>Manga</option>
                                        <option value="Figura" {{ old('categoria', $producto->categoria) == 'Figura' ? 'selected' : '' }}>Figura</option>
                                        <option value="Coleccionable" {{ old('categoria', $producto->categoria) == 'Coleccionable' ? 'selected' : '' }}>Coleccionable</option>
                                        <option value="Ropa" {{ old('categoria', $producto->categoria) == 'Ropa' ? 'selected' : '' }}>Ropa</option>
                                        <option value="Accesorio" {{ old('categoria', $producto->categoria) == 'Accesorio' ? 'selected' : '' }}>Accesorio</option>
                                    </select>
                                    @error('categoria')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="franquicia" class="form-label">Franquicia</label>
                                    <input type="text" class="form-control @error('franquicia') is-invalid @enderror" id="franquicia" name="franquicia" value="{{ old('franquicia', $producto->franquicia) }}" placeholder="Ej: Naruto, Final Fantasy">
                                    @error('franquicia')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="imagen" class="form-label">Imagen del producto</label>
                            @if($producto->imagen)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="img-thumbnail" style="max-height: 150px;">
                                <div class="form-text">Imagen actual. Sube una nueva imagen para reemplazarla.</div>
                            </div>
                            @endif
                            <input type="file" class="form-control @error('imagen') is-invalid @enderror" id="imagen" name="imagen" accept="image/*">
                            <div class="form-text">Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB</div>
                            @error('imagen')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input @error('es_destacado') is-invalid @enderror" type="checkbox" id="es_destacado" name="es_destacado" value="1" {{ old('es_destacado', $producto->es_destacado) ? 'checked' : '' }}>
                                <label class="form-check-label" for="es_destacado">
                                    Marcar como producto destacado
                                </label>
                                @error('es_destacado')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle me-1"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-save me-1"></i> Actualizar Producto
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection