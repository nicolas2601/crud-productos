@extends('layouts.app')

@section('content')
<div class="container-fluid fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Editar Motivo de Salida #{{ $salidaInventario->id }}</h1>
        <a href="{{ route('salidas.show', $salidaInventario->id) }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Volver a Detalles
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('salidas.update', $salidaInventario->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong class="text-muted">Producto:</strong>
                        <p>{{ $salidaInventario->producto->nombre ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong class="text-muted">Cantidad:</strong>
                        <p>{{ $salidaInventario->cantidad }}</p>
                    </div>
                </div>

                 <div class="row mb-3">
                    <div class="col-md-6">
                        <strong class="text-muted">Fecha de Salida:</strong>
                        <p>{{ $salidaInventario->fecha_salida->format('d/m/Y H:i:s') }}</p>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="motivo" class="form-label">Motivo</label>
                    <textarea class="form-control @error('motivo') is-invalid @enderror" id="motivo" name="motivo" rows="3">{{ old('motivo', $salidaInventario->motivo) }}</textarea>
                    @error('motivo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Animación para la tarjeta de edición
    anime({
        targets: '.card',
        opacity: [0, 1],
        translateY: [20, 0],
        duration: 600,
        easing: 'easeOutQuad'
    });
</script>
@endsection