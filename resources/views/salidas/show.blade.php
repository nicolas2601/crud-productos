@extends('layouts.app')

@section('content')
<div class="container-fluid fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Detalles de Salida de Inventario #{{ $salidaInventario->id }}</h1>
        <div>
            <a href="{{ route('salidas.edit', $salidaInventario->id) }}" class="btn btn-warning me-2">
                <i class="fas fa-edit me-1"></i> Editar Motivo
            </a>
            <a href="{{ route('salidas.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Volver al Listado
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong class="text-muted">ID:</strong>
                    <p>{{ $salidaInventario->id }}</p>
                </div>
                <div class="col-md-6">
                    <strong class="text-muted">Fecha de Salida:</strong>
                    <p>{{ $salidaInventario->fecha_salida->format('d/m/Y H:i:s') }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <strong class="text-muted">Producto:</strong>
                    <p>
                        @if($salidaInventario->producto)
                            <a href="{{ route('productos.show', $salidaInventario->producto->id) }}">{{ $salidaInventario->producto->nombre }}</a>
                        @else
                            <span class="text-danger">Producto no encontrado</span>
                        @endif
                    </p>
                </div>
                <div class="col-md-6">
                    <strong class="text-muted">Cantidad:</strong>
                    <p>{{ $salidaInventario->cantidad }}</p>
                </div>
            </div>

            <div class="mb-3">
                <strong class="text-muted">Motivo:</strong>
                <p>{{ $salidaInventario->motivo ?? 'No especificado' }}</p>
            </div>

            <hr>

            <div class="row">
                 <div class="col-md-6">
                    <strong class="text-muted">Registrado:</strong>
                    <p>{{ $salidaInventario->created_at->diffForHumans() }} ({{ $salidaInventario->created_at->format('d/m/Y H:i') }})</p>
                </div>
                 <div class="col-md-6">
                    <strong class="text-muted">Última Actualización:</strong>
                    <p>{{ $salidaInventario->updated_at->diffForHumans() }} ({{ $salidaInventario->updated_at->format('d/m/Y H:i') }})</p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Animación para la tarjeta de detalles
    anime({
        targets: '.card',
        opacity: [0, 1],
        translateY: [20, 0],
        duration: 600,
        easing: 'easeOutQuad'
    });
</script>
@endsection