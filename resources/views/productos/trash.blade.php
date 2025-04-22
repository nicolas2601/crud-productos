@extends('layouts.app')

@section('content')
<div class="container-fluid fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Papelera de Productos</h1>
        <a href="{{ route('productos.index') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left me-1"></i> Volver al Listado
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            @if($productosTrashed->count() > 0)
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
                                <th>Fecha de Eliminación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productosTrashed as $producto)
                                <tr>
                                    <td>{{ $producto->id }}</td>
                                    <td>{{ $producto->nombre }}</td>
                                    <td>{{ Str::limit($producto->descripcion, 30) }}</td>
                                    <td>{{ $producto->stock }}</td>
                                    <td>${{ number_format($producto->precio, 2) }}</td>
                                    <td>{{ $producto->proveedores->first()->nombre ?? 'N/A' }}</td>
                                    <td>{{ $producto->deleted_at->format('d/m/Y H:i:s') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <form action="{{ route('productos.restore', $producto->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-success" title="Restaurar">
                                                    <i class="fas fa-trash-restore"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('productos.force-delete', $producto->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Está seguro de eliminar permanentemente este producto?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Eliminar permanentemente">
                                                    <i class="fas fa-times"></i>
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
                    {{ $productosTrashed->links() }}
                </div>
            @else
                <div class="alert alert-info">
                    No hay productos en la papelera.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Animación específica para la tabla de productos en papelera
    anime({
        targets: 'tbody tr',
        translateY: [20, 0],
        opacity: [0, 1],
        delay: anime.stagger(50),
        easing: 'easeOutExpo'
    });
</script>
@endsection