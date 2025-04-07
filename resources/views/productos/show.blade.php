@extends('layouts.app')

@section('title', $producto->nombre)

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('productos.index') }}">Productos</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $producto->nombre }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-5">
            <div class="card shadow-sm mb-4">
                <div class="card-body text-center p-4">
                    @if($producto->imagen)
                    <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="img-fluid rounded mb-3" style="max-height: 300px;">
                    @else
                    <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 300px;">
                        <i class="bi bi-image text-secondary" style="font-size: 5rem;"></i>
                    </div>
                    @endif

                    @if($producto->es_destacado)
                    <div class="position-absolute top-0 end-0 p-2">
                        <span class="badge bg-primary"><i class="bi bi-star-fill"></i> Producto Destacado</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h1 class="card-title h3 fw-bold">{{ $producto->nombre }}</h1>
                    
                    <div class="d-flex align-items-center mb-3">
                        <span class="badge bg-primary me-2">{{ $producto->categoria }}</span>
                        @if($producto->franquicia)
                        <span class="badge bg-secondary">{{ $producto->franquicia }}</span>
                        @endif
                    </div>

                    <h2 class="h4 text-primary fw-bold mb-3">${{ number_format($producto->precio, 2) }}</h2>

                    <div class="mb-4">
                        @if($producto->stock > 10)
                        <span class="badge bg-success"><i class="bi bi-check-circle"></i> En stock ({{ $producto->stock }} disponibles)</span>
                        @elseif($producto->stock > 0)
                        <span class="badge bg-warning"><i class="bi bi-exclamation-circle"></i> Pocas unidades ({{ $producto->stock }} disponibles)</span>
                        @else
                        <span class="badge bg-danger"><i class="bi bi-x-circle"></i> Agotado</span>
                        @endif
                    </div>

                    <h3 class="h5 fw-bold">Descripción</h3>
                    <p class="card-text">{{ $producto->descripcion }}</p>

                    <div class="d-flex mt-4">
                        <a href="{{ route('productos.edit', $producto) }}" class="btn btn-warning me-2">
                            <i class="bi bi-pencil me-1"></i> Editar
                        </a>
                        <form action="{{ route('productos.destroy', $producto) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash me-1"></i> Eliminar
                            </button>
                        </form>
                        <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary ms-auto">
                            <i class="bi bi-arrow-left me-1"></i> Volver
                        </a>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mt-4">
                <div class="card-body">
                    <h3 class="h5 fw-bold">Detalles del producto</h3>
                    <table class="table table-sm">
                        <tbody>
                            <tr>
                                <th style="width: 150px;">ID:</th>
                                <td>{{ $producto->id }}</td>
                            </tr>
                            <tr>
                                <th>Categoría:</th>
                                <td>{{ $producto->categoria }}</td>
                            </tr>
                            <tr>
                                <th>Franquicia:</th>
                                <td>{{ $producto->franquicia ?? 'No especificada' }}</td>
                            </tr>
                            <tr>
                                <th>Creado:</th>
                                <td>{{ $producto->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Actualizado:</th>
                                <td>{{ $producto->updated_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection