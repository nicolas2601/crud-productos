@extends('layouts.app')

@section('content')
<div class="container-fluid fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Listado de Productos</h1>
        <div class="float-right mb-3">
            <a class="btn btn-success" href="{{ route('productos.create') }}">Crear Producto</a>
            <a class="btn btn-warning" href="{{ route('productos.trash') }}">Papelera</a>
            <a class="btn btn-info" href="{{ route('salidas.create') }}">Registrar Salida</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @if($productos->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Stock</th>
                                <th>Precio</th>
                                <th>Proveedor</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productos as $producto)
                                <tr>
                                    <td>{{ $producto->id }}</td>
                                    <td>{{ $producto->nombre }}</td>
                                    <td>{{ Str::limit($producto->descripcion, 30) }}</td>
                                    <td>{{ $producto->stock }}</td>
                                    <td>${{ number_format($producto->precio, 2) }}</td>
                                    <td>{{ $producto->proveedores->first()->nombre ?? 'N/A' }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Está seguro de eliminar este producto?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $productos->links() }}
                </div>
            @else
                <div class="alert alert-info">
                    No hay productos registrados.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Animación específica para la tabla de productos
    anime({
        targets: 'tbody tr',
        translateY: [20, 0],
        opacity: [0, 1],
        delay: anime.stagger(50),
        easing: 'easeOutExpo'
    });
</script>
@endsection