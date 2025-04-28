@extends('layouts.app')

@section('content')
<div class="container-fluid fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Detalles del Proveedor</h1>
        <div>
            <a href="{{ route('proveedores.edit', $proveedor->id) }}" class="btn btn-warning">
                <i class="fas fa-edit me-1"></i> Editar
            </a>
            <a href="{{ route('proveedores.index') }}" class="btn btn-secondary ms-2">
                <i class="fas fa-arrow-left me-1"></i> Volver al Listado
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Información del Proveedor</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th class="bg-light" style="width: 30%">ID</th>
                            <td>{{ $proveedor->id }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Nombre</th>
                            <td>{{ $proveedor->nombre }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Empresa</th>
                            <td>{{ $proveedor->empresa }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Contacto</th>
                            <td>{{ $proveedor->contacto }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Fecha de Creación</th>
                            <td>{{ $proveedor->created_at->format('d/m/Y H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Última Actualización</th>
                            <td>{{ $proveedor->updated_at->format('d/m/Y H:i:s') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Productos Asociados</h5>
                </div>
                <div class="card-body">
                    @if($proveedor->productos->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Stock</th>
                                        <th>Precio</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($proveedor->productos as $producto)
                                        <tr>
                                            <td>{{ $producto->id }}</td>
                                            <td>{{ $producto->nombre }}</td>
                                            <td>{{ $producto->stock }}</td>
                                            <td>${{ number_format($producto->precio, 2) }}</td>
                                            <td>
                                                <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            Este proveedor no tiene productos asociados.
                        </div>
                    @endif
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
                    @if($proveedor->entradas->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unitario</th>
                                        <th>Total</th>
                                        <th>Fecha</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($proveedor->entradas as $entrada)
                                        <tr>
                                            <td>{{ $entrada->id }}</td>
                                            <td>{{ $entrada->producto->nombre }}</td>
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
                            Este proveedor no tiene entradas de inventario registradas.
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