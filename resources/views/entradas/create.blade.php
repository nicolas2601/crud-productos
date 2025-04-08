@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <!-- Header con título -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold leading-tight text-purple-300">Nueva Entrada de Productos</h2>
                <p class="text-gray-400 mt-2">Registra las entradas de productos al inventario</p>
            </div>
        </div>

        <!-- Formulario de entrada -->
        <div class="bg-gray-800 border-2 border-purple-500 rounded-lg shadow-lg p-6">
            <form action="{{ route('entradas.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Producto y Cantidad -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="producto_id" class="block text-sm font-medium text-purple-300 mb-2">
                            <i class="fas fa-box mr-2"></i>Producto
                        </label>
                        <select id="producto_id" name="producto_id" required class="w-full bg-gray-700 border-2 border-purple-400 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-purple-500 transition-colors">
                            <option value="">Selecciona un producto</option>
                            @foreach($productos as $producto)
                                <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="cantidad" class="block text-sm font-medium text-purple-300 mb-2">
                            <i class="fas fa-sort-amount-up mr-2"></i>Cantidad
                        </label>
                        <input type="number" id="cantidad" name="cantidad" required min="1" class="w-full bg-gray-700 border-2 border-purple-400 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-purple-500 transition-colors" placeholder="Ingresa la cantidad">
                    </div>
                </div>

                <!-- Fecha y Observación -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="fecha" class="block text-sm font-medium text-purple-300 mb-2">
                            <i class="fas fa-calendar-alt mr-2"></i>Fecha
                        </label>
                        <input type="date" id="fecha" name="fecha" required class="w-full bg-gray-700 border-2 border-purple-400 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-purple-500 transition-colors">
                    </div>

                    <div>
                        <label for="observacion" class="block text-sm font-medium text-purple-300 mb-2">
                            <i class="fas fa-comment-alt mr-2"></i>Observación
                        </label>
                        <textarea id="observacion" name="observacion" rows="1" class="w-full bg-gray-700 border-2 border-purple-400 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-purple-500 transition-colors resize-none" placeholder="Agrega una observación"></textarea>
                    </div>
                </div>

                <!-- Alerta de Factura Electrónica -->
                <div class="bg-blue-900 border-2 border-blue-400 rounded-lg p-4 mt-6">
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-blue-400 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="text-blue-300 font-semibold">Soporte de Factura Electrónica</h4>
                            <p class="text-blue-200 text-sm mt-1">Esta entrada será registrada con soporte electrónico. Asegúrate de tener los documentos necesarios.</p>
                        </div>
                    </div>
                </div>

                <!-- Botones de acción -->
                <div class="flex justify-end space-x-4 mt-6">
                    <a href="{{ route('productos.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 flex items-center">
                        <i class="fas fa-times mr-2"></i>Cancelar
                    </a>
                    <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 flex items-center">
                        <i class="fas fa-save mr-2"></i>Guardar Entrada
                    </button>
                </div>
            </form>
        </div>

        <!-- Alertas de validación -->
        @if($errors->any())
        <div class="bg-red-500 text-white px-6 py-4 rounded-lg mt-6">
            <div class="flex items-center space-x-2">
                <i class="fas fa-exclamation-triangle"></i>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection