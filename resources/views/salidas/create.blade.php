@extends('layouts.app')

@section('content')
<div class="container-fluid fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Registrar Nueva Salida de Inventario</h1>
        <a href="{{ route('salidas.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Volver al Listado
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('salidas.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="producto_id" class="form-label">Producto</label>
                    <select class="form-select @error('producto_id') is-invalid @enderror" id="producto_id" name="producto_id" required>
                        <option value="">Seleccione un producto...</option>
                        @foreach ($productos as $producto)
                            <option value="{{ $producto->id }}" {{ old('producto_id') == $producto->id ? 'selected' : '' }} data-stock="{{ $producto->stock }}">
                                {{ $producto->nombre }} (Stock: {{ $producto->stock }})
                            </option>
                        @endforeach
                    </select>
                    @error('producto_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="cantidad" class="form-label">Cantidad</label>
                    <input type="number" class="form-control @error('cantidad') is-invalid @enderror" id="cantidad" name="cantidad" value="{{ old('cantidad', 1) }}" min="1" required>
                    @error('cantidad')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small id="stock-disponible" class="form-text text-muted"></small> {{-- Para mostrar stock dinámicamente --}}
                </div>

                <div class="mb-3">
                    <label for="motivo" class="form-label">Motivo (Opcional)</label>
                    <textarea class="form-control @error('motivo') is-invalid @enderror" id="motivo" name="motivo" rows="3">{{ old('motivo') }}</textarea>
                    @error('motivo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check me-1"></i> Registrar Salida
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Script para mostrar el stock disponible al seleccionar un producto
    const productoSelect = document.getElementById('producto_id');
    const cantidadInput = document.getElementById('cantidad');
    const stockInfo = document.getElementById('stock-disponible');

    productoSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const stock = selectedOption.getAttribute('data-stock');
        if (stock) {
            stockInfo.textContent = `Stock disponible: ${stock}`;
            cantidadInput.max = stock; // Opcional: limitar la cantidad máxima en el input
        } else {
            stockInfo.textContent = '';
            cantidadInput.removeAttribute('max');
        }
    });

    // Disparar el evento change al cargar la página si hay un producto seleccionado
    if (productoSelect.value) {
        productoSelect.dispatchEvent(new Event('change'));
    }

    // Animación
    anime({
        targets: '.card',
        translateY: [50, 0],
        opacity: [0, 1],
        duration: 800,
        easing: 'easeOutExpo'
    });
</script>
@endsection