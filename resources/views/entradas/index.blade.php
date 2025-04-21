@extends('layouts.app')

@section('content')
<div class="container-fluid fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Listado de Entradas de Inventario</h1>
        <a href="{{ route('entradas.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Nueva Entrada
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            @if($entradas->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Proveedor</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio Unitario</th>
                                <th>Total</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($entradas as $entrada)
                                <tr>
                                    <td>{{ $entrada->id }}</td>
                                    <td>{{ $entrada->proveedor->nombre }}</td>
                                    <td>{{ $entrada->producto->nombre }}</td>
                                    <td>{{ $entrada->cantidad }}</td>
                                    <td>${{ number_format($entrada->precio_unitario, 2) }}</td>
                                    <td>${{ number_format($entrada->total, 2) }}</td>
                                    <td>{{ $entrada->fecha->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('entradas.show', $entrada->id) }}" class="btn btn-sm btn-info" title="Ver detalles">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('entradas.factura', $entrada->id) }}" class="btn btn-sm btn-primary" title="Ver factura">
                                                <i class="fas fa-file-invoice"></i>
                                            </a>
                                            <a href="{{ route('entradas.pdf', $entrada->id) }}" class="btn btn-sm btn-danger" title="Descargar PDF" target="_blank">
                                                <i class="fas fa-file-pdf"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $entradas->links() }}
                </div>
            @else
                <div class="alert alert-info">
                    No hay entradas de inventario registradas.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Animación específica para la tabla de entradas
    anime({
        targets: 'tbody tr',
        translateY: [20, 0],
        opacity: [0, 1],
        delay: anime.stagger(50),
        easing: 'easeOutExpo'
    });
</script>
@endsection