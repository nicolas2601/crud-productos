@extends('layouts.app')

@section('content')
<div class="container-fluid fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Crear Nuevo Producto</h1>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Volver al Listado
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('productos.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="3">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="stock" class="form-label">Stock Inicial</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock', 0) }}" min="0" required>
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="categoria" class="form-label">Categoría</label>
                        <input type="text" class="form-control @error('categoria') is-invalid @enderror" id="categoria" name="categoria" value="{{ old('categoria') }}">
                        @error('categoria')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio" value="{{ old('precio', 0.00) }}" min="0" step="0.01" required>
                            @error('precio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="proveedores" class="form-label">Proveedores</label>
                    <select multiple class="form-select @error('proveedores') is-invalid @enderror" id="proveedores" name="proveedores[]" size="5">
                        @foreach ($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}" {{ in_array($proveedor->id, old('proveedores', [])) ? 'selected' : '' }}>
                                {{ $proveedor->nombre }} ({{ $proveedor->empresa }})
                            </option>
                        @endforeach
                    </select>
                    <small class="form-text text-muted">Mantén presionada la tecla Ctrl (o Cmd en Mac) para seleccionar múltiples proveedores.</small>
                    @error('proveedores')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @error('proveedores.*') {{-- Para errores de validación de cada elemento del array --}}
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