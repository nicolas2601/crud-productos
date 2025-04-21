@extends('layouts.app')

@section('styles')
<style>
    .factura {
        border: 1px solid #dee2e6;
        padding: 2rem;
        background-color: #fff;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    .factura-header {
        border-bottom: 2px solid #4a6cf7;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
    }
    .factura-title {
        font-size: 2rem;
        color: #4a6cf7;
        font-weight: bold;
    }
    .factura-subtitle {
        color: #6c757d;
    }
    .factura-info {
        margin-bottom: 2rem;
    }
    .factura-table th {
        background-color: #f8f9fa;
    }
    .factura-footer {
        margin-top: 2rem;
        padding-top: 1rem;
        border-top: 1px solid #dee2e6;
    }
    .sello {
        border: 2px dashed #dc3545;
        color: #dc3545;
        display: inline-block;
        padding: 0.5rem 1rem;
        font-weight: bold;
        transform: rotate(-15deg);
        position: absolute;
        top: 50%;
        right: 10%;
        font-size: 1.5rem;
        opacity: 0.7;
    }
    @media print {
        .no-print {
            display: none;
        }
        body {
            background-color: white;
        }
        .factura {
            box-shadow: none;
            border: none;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4 no-print">
        <h1 class="h3">Factura de Entrada #{{ $entrada->id }}</h1>
        <div>
            <button onclick="window.print()" class="btn btn-secondary">
                <i class="fas fa-print me-1"></i> Imprimir
            </button>
            <a href="{{ route('entradas.pdf', $entrada->id) }}" class="btn btn-danger ms-2" target="_blank">
                <i class="fas fa-file-pdf me-1"></i> Descargar PDF
            </a>
            <a href="{{ route('entradas.index') }}" class="btn btn-primary ms-2">
                <i class="fas fa-arrow-left me-1"></i> Volver al Listado
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="factura position-relative">
                <div class="sello">PAGADO</div>
                
                <div class="factura-header d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="factura-title">FACTURA</h1>
                        <p class="factura-subtitle">Sistema de Gestión de Inventario</p>
                    </div>
                    <div class="text-end">
                        <h2>Factura #{{ $entrada->id }}</h2>
                        <p class="mb-0">Fecha: {{ $entrada->fecha->format('d/m/Y') }}</p>
                    </div>
                </div>

                <div class="row factura-info">
                    <div class="col-md-6">
                        <h5>Proveedor:</h5>
                        <p><strong>{{ $entrada->proveedor->nombre }}</strong></p>
                        <p>Empresa: {{ $entrada->proveedor->empresa }}</p>
                        <p>Contacto: {{ $entrada->proveedor->contacto }}</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <h5>Detalles de la Entrada:</h5>
                        <p>Fecha de Registro: {{ $entrada->created_at->format('d/m/Y H:i:s') }}</p>
                        <p>ID de Entrada: {{ $entrada->id }}</p>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered factura-table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-end">Precio Unitario</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <strong>{{ $entrada->producto->nombre }}</strong><br>
                                    <small>{{ $entrada->producto->descripcion }}</small>
                                </td>
                                <td class="text-center">{{ $entrada->cantidad }}</td>
                                <td class="text-end">${{ number_format($entrada->precio_unitario, 2) }}</td>
                                <td class="text-end">${{ number_format($entrada->subtotal, 2) }}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Subtotal:</strong></td>
                                <td class="text-end">${{ number_format($entrada->subtotal, 2) }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                <td class="text-end"><strong>${{ number_format($entrada->total, 2) }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="factura-footer">
                    <div class="row">
                        <div class="col-md-8">
                            <h5>Notas:</h5>
                            <p>Esta factura es un comprobante de la entrada de inventario registrada en el sistema.</p>
                            <p>El stock del producto ha sido actualizado automáticamente.</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <p class="mb-0">Generado por:</p>
                            <p><strong>Sistema de Gestión de Inventario</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Animaciones para la factura
    anime({
        targets: '.factura',
        translateY: [20, 0],
        opacity: [0, 1],
        duration: 800,
        easing: 'easeOutExpo'
    });
    
    // Animación para el sello
    anime({
        targets: '.sello',
        scale: [0, 1],
        rotate: [-30, -15],
        opacity: [0, 0.7],
        duration: 1000,
        delay: 500,
        easing: 'easeOutElastic(1, .8)'
    });
</script>
@endsection