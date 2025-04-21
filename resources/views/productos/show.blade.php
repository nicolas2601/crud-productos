@extends('layouts.app')

@section('content')
<div class="container-fluid fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Detalles del Producto</h1>
        <div>
            <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning">
                <i class="fas fa-edit me-1"></i> Editar
            </a>
            <a href="{{ route('productos.index') }}" class="btn btn-secondary ms-2">
                <i class="fas fa-arrow-left me-1"></i> Volver al Listado
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Información del Producto</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th class="bg-light" style="width: 30%">ID</th>
                            <td>{{ $producto->id }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Nombre</th>
                            <td>{{ $producto->nombre }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Descripción</th>
                            <td>{{ $producto->descripcion ?: 'No disponible' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Stock</th>
                            <td>{{ $producto->stock }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Precio</th>
                            <td>${{ number_format($producto->precio, 2) }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Proveedor</th>
                            <td>
                                <a href="{{ route('proveedores.show', $producto->proveedor_id) }}">
                                    {{ $producto->proveedor->nombre }} ({{ $producto->proveedor->empresa }})
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light">Fecha de Creación</th>
                            <td>{{ $producto->created_at->format('d/m/Y H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Última Actualización</th>
                            <td>{{ $producto->updated_at->format('d/m/Y H:i:s') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Estadísticas</h5>
                </div>
                <div class="card-body d-flex flex-column justify-content-center">
                    <div class="row text-center">
                        <div class="col-md-6 mb-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Stock Actual</h5>
                                    <h2 class="display-4">{{ $producto->stock }}</h2>
                                    <p class="card-text">unidades</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Valor en Inventario</h5>
                                    <h2 class="display-4">${{ number_format($producto->stock * $producto->precio, 2) }}</h2>
                                    <p class="card-text">total</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="progress" style="height: 25px;">
                            @php
                                $stockLevel = $producto->stock;
                                $stockClass = 'bg-danger';
                                $stockText = 'Bajo';
                                
                                if ($stockLevel > 50) {
                                    $stockClass = 'bg-success';
                                    $stockText = 'Alto';
                                } elseif ($stockLevel > 20) {
                                    $stockClass = 'bg-warning';
                                    $stockText = 'Medio';
                                }
                                
                                $stockPercentage = min(100, $stockLevel);
                            @endphp
                            <div class="progress-bar {{ $stockClass }}" role="progressbar" style="width: {{ $stockPercentage }}%" aria-valuenow="{{ $stockLevel }}" aria-valuemin="0" aria-valuemax="100">
                                Nivel de Stock: {{ $stockText }} ({{ $stockLevel }})
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Historial de Entradas</h5>
                </div>
                <div class="card-body">
                    @if($producto->entradas->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Proveedor</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unitario</th>
                                        <th>Total</th>
                                        <th>Fecha</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($producto->entradas as $entrada)
                                        <tr>
                                            <td>{{ $entrada->id }}</td>
                                            <td>{{ $entrada->proveedor->nombre }}</td>
                                            <td>{{ $entrada->cantidad }}</td>
                                            <td>${{ number_format($entrada->precio_unitario, 2) }}</td>
                                            <td>${{ number_format($entrada->total, 2) }}</td>
                                            <td>{{ $entrada->fecha->format('d/m/Y') }}</td>
                                            <td>
                                                <a href="{{ route('entradas.factura', $entrada->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-file-invoice"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            Este producto no tiene entradas de inventario registradas.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Animaciones para las tarjetas
    anime({
        targets: '.card',
        translateY: [20, 0],
        opacity: [0, 1],
        delay: anime.stagger(100),
        easing: 'easeOutExpo'
    });
    
    // Animación para las filas de las tablas
    anime({
        targets: 'tbody tr',
        translateX: [20, 0],
        opacity: [0, 1],
        delay: anime.stagger(50),
        easing: 'easeOutQuad'
    });
</script>
@endsection