@extends('layouts.app')

@section('content')
<div class="container-fluid fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Registrar Nueva Entrada de Inventario</h1>
        <a href="{{ route('entradas.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Volver al Listado
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('entradas.store') }}" method="POST" id="entradaForm">
                @csrf
                <div class="mb-3">
                    <label for="proveedor_id" class="form-label">Proveedor</label>
                    <select class="form-select @error('proveedor_id') is-invalid @enderror" id="proveedor_id" name="proveedor_id" required>
                        <option value="">Seleccione un proveedor</option>
                        @foreach($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}" {{ old('proveedor_id') == $proveedor->id ? 'selected' : '' }}>
                                {{ $proveedor->nombre }} ({{ $proveedor->empresa }})
                            </option>
                        @endforeach
                    </select>
                    @error('proveedor_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="producto_id" class="form-label">Producto</label>
                    <select class="form-select @error('producto_id') is-invalid @enderror" id="producto_id" name="producto_id" required {{ old('proveedor_id') ? '' : 'disabled' }}>
                        <option value="">Primero seleccione un proveedor</option>
                        @if(old('proveedor_id') && $productos->count() > 0)
                            @foreach($productos as $producto)
                                <option value="{{ $producto->id }}" {{ old('producto_id') == $producto->id ? 'selected' : '' }}>
                                    {{ $producto->nombre }} - Stock actual: {{ $producto->stock }} - Precio: ${{ number_format($producto->precio, 2) }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    @error('producto_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" class="form-control @error('cantidad') is-invalid @enderror" id="cantidad" name="cantidad" value="{{ old('cantidad', 1) }}" min="1" required>
                        @error('cantidad')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="precio_unitario" class="form-label">Precio Unitario</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control @error('precio_unitario') is-invalid @enderror" id="precio_unitario" name="precio_unitario" value="{{ old('precio_unitario', 0.00) }}" min="0" step="0.01" required>
                            @error('precio_unitario')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" class="form-control @error('fecha') is-invalid @enderror" id="fecha" name="fecha" value="{{ old('fecha', date('Y-m-d')) }}" required>
                    @error('fecha')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Resumen</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Subtotal</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="text" class="form-control" id="subtotal" readonly value="0.00">
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Total</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="text" class="form-control" id="total" readonly value="0.00">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Registrar Entrada
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

    // Cargar productos por proveedor
    document.getElementById('proveedor_id').addEventListener('change', function() {
        const proveedorId = this.value;
        const productoSelect = document.getElementById('producto_id');
        
        if (proveedorId) {
            // Habilitar el select de productos
            productoSelect.disabled = false;
            productoSelect.innerHTML = '<option value="">Cargando productos...</option>';
            
            // Realizar petición AJAX
            fetch(`{{ route('get.productos.by.proveedor') }}?proveedor_id=${proveedorId}`)
                .then(response => response.json())
                .then(data => {
                    productoSelect.innerHTML = '<option value="">Seleccione un producto</option>';
                    
                    if (data.length > 0) {
                        data.forEach(producto => {
                            const option = document.createElement('option');
                            option.value = producto.id;
                            option.textContent = `${producto.nombre} - Stock actual: ${producto.stock} - Precio: $${parseFloat(producto.precio).toFixed(2)}`;
                            option.dataset.precio = producto.precio;
                            productoSelect.appendChild(option);
                        });
                    } else {
                        productoSelect.innerHTML = '<option value="">No hay productos disponibles para este proveedor</option>';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    productoSelect.innerHTML = '<option value="">Error al cargar productos</option>';
                });
        } else {
            // Deshabilitar el select de productos
            productoSelect.disabled = true;
            productoSelect.innerHTML = '<option value="">Primero seleccione un proveedor</option>';
        }
    });

    // Actualizar precio unitario al seleccionar un producto
    document.getElementById('producto_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        if (selectedOption && selectedOption.dataset.precio) {
            document.getElementById('precio_unitario').value = parseFloat(selectedOption.dataset.precio).toFixed(2);
        } else {
            document.getElementById('precio_unitario').value = '0.00';
        }
        calcularTotal();
    });

    // Calcular total al cambiar cantidad o precio
    document.getElementById('cantidad').addEventListener('input', calcularTotal);
    document.getElementById('precio_unitario').addEventListener('input', calcularTotal);

    function calcularTotal() {
        const cantidad = parseFloat(document.getElementById('cantidad').value) || 0;
        const precioUnitario = parseFloat(document.getElementById('precio_unitario').value) || 0;
        
        const subtotal = cantidad * precioUnitario;
        const total = subtotal; // En este caso son iguales, pero podría incluir impuestos, etc.
        
        document.getElementById('subtotal').value = subtotal.toFixed(2);
        document.getElementById('total').value = total.toFixed(2);
    }

    // Calcular total inicial
    calcularTotal();
</script>
@endsection