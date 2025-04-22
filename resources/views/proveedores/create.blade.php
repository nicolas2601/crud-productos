@extends('layouts.app')

@section('content')
<div class="container-fluid fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Crear Nuevo Proveedor</h1>
        <a href="{{ route('proveedores.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Volver al Listado
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('proveedores.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="empresa" class="form-label">Empresa</label>
                    <input type="text" class="form-control @error('empresa') is-invalid @enderror" id="empresa" name="empresa" value="{{ old('empresa') }}" required>
                    @error('empresa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="contacto" class="form-label">Contacto</label>
                    <input type="text" class="form-control @error('contacto') is-invalid @enderror" id="contacto" name="contacto" value="{{ old('contacto') }}" required placeholder="Teléfono o correo electrónico">
                    @error('contacto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="productos" class="form-label">Productos que provee</label>
                    <select multiple class="form-select @error('productos') is-invalid @enderror" id="productos" name="productos[]" size="5">
                        @foreach ($productos as $producto)
                            <option value="{{ $producto->id }}" {{ in_array($producto->id, old('productos', [])) ? 'selected' : '' }}>
                                {{ $producto->nombre }}
                            </option>
                        @endforeach
                    </select>
                    <small class="form-text text-muted">Mantén presionada la tecla Ctrl (o Cmd en Mac) para seleccionar múltiples productos.</small>
                    @error('productos')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @error('productos.*') {{-- Para errores de validación de cada elemento del array --}}
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Animación para el formulario
    anime({
        targets: '.card',
        scale: [0.9, 1],
        opacity: [0, 1],
        duration: 800,
        easing: 'easeOutElastic(1, .8)'
    });
</script>
@endsection