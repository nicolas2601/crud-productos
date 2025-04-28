@extends('layouts.app')

@section('content')
<div class="container-fluid fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Detalles de la Entrada #{{ $entrada->id }}</h1>
        <div>
            <a href="{{ route('entradas.factura', $entrada->id) }}" class="btn btn-primary">
                <i class="fas fa-file-invoice me-1"></i> Ver Factura
            </a>
            <a href="{{ route('entradas.pdf', $entrada->id) }}" class="btn btn-danger ms-2" target="_blank">
                <i class="fas fa-file-pdf me-1"></i> Descargar PDF
            </a>
            <a href="{{ route('entradas.index') }}" class="btn btn-secondary ms-2">
                <i class="fas fa-arrow-left me-1"></i> Volver al Listado
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Información de la Entrada</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th class="bg-light" style="width: 30%">ID</th>
                            <td>{{ $entrada->id }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Fecha</th>
                            <td>{{ $entrada->fecha->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Proveedor</th>
                            <td>
                                <a href="{{ route('proveedores.show', $entrada->proveedor_id) }}">
                                    {{ $entrada->proveedor->nombre }} ({{ $entrada->proveedor->empresa }})
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light">Producto</th>
                            <td>
                                <a href="{{ route('productos.show', $entrada->producto_id) }}">
                                    {{ $entrada->producto->nombre }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light">Cantidad</th>
                            <td>{{ $entrada->cantidad }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Precio Unitario</th>
                            <td>${{ number_format($entrada->precio_unitario, 2) }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Subtotal</th>
                            <td>${{ number_format($entrada->subtotal, 2) }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Total</th>
                            <td>${{ number_format($entrada->total, 2) }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Fecha de Registro</th>
                            <td>{{ $entrada->created_at->format('d/m/Y H:i:s') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Resumen de la Operación</h5>
                </div>
                <div class="card-body d-flex flex-column justify-content-center">
                    <div class="row text-center">
                        <div class="col-md-6 mb-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Cantidad</h5>
                                    <h2 class="display-4">{{ $entrada->cantidad }}</h2>
                                    <p class="card-text">unidades</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Total</h5>
                                    <h2 class="display-4">${{ number_format($entrada->total, 2) }}</h2>
                                    <p class="card-text">valor</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-info mt-3">
                        <i class="fas fa-info-circle me-2"></i> Esta entrada ha incrementado el stock del producto <strong>{{ $entrada->producto->nombre }}</strong> en <strong>{{ $entrada->cantidad }}</strong> unidades.
                    </div>
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
    
    // Animación para las estadísticas
    anime({
        targets: '.display-4',
        innerHTML: [0, el => el.innerHTML],
        easing: 'linear',
        round: true,
        duration: 1500
    });
</script>
@endsection