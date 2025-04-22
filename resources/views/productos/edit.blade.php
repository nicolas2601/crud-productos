@extends('layouts.app')

@section('content')
<div class="container-fluid fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Editar Producto</h1>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Volver al Listado
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('productos.update', $producto->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre', $producto->nombre) }}" required>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="3">{{ old('descripcion', $producto->descripcion) }}</textarea>
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock', $producto->stock) }}" min="0" required>
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio" value="{{ old('precio', $producto->precio) }}" min="0" step="0.01" required>
                            @error('precio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="proveedores" class="form-label">Proveedores</label>
                    <select multiple class="form-select @error('proveedores') is-invalid @enderror" id="proveedores" name="proveedores[]" size="5">
                        @php
                            // Obtener los IDs de los proveedores actualmente asociados al producto
                            $proveedoresProducto = $producto->proveedores->pluck('id')->toArray();
                        @endphp
                        @foreach ($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}" {{ in_array($proveedor->id, old('proveedores', $proveedoresProducto)) ? 'selected' : '' }}>
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
                        <i class="fas fa-save me-1"></i> Actualizar
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