@extends('layouts.app')

@section('title', 'Listado de Productos')

@section('content')
<div class="container mx-auto px-4 sm:px-8 py-8">
    <div class="flex flex-col md:flex-row items-center justify-between mb-8 space-y-4 md:space-y-0">
        <div>
            <h1 class="text-3xl font-bold text-purple-300">Productos</h1>
            <p class="text-gray-400 mt-1">Gestiona tu catálogo de productos de anime y videojuegos</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('productos.papelera') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-300 flex items-center">
                <i class="fas fa-trash mr-2"></i>Papelera
            </a>
            <a href="{{ route('productos.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg transition duration-300 flex items-center">
                <i class="fas fa-plus-circle mr-2"></i>Nuevo Producto
            </a>
        </div>
    </div>

    <!-- Barra de búsqueda -->
    <div class="mb-8">
        <div class="relative">
            <input type="text" id="searchInput" class="w-full px-4 py-3 pl-12 bg-gray-800 border-2 border-purple-500 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-purple-400 transition duration-300" placeholder="Buscar productos...">
            <div class="absolute left-4 top-3.5 text-gray-400">
                <i class="fas fa-search"></i>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-600 text-white px-4 py-3 rounded-lg mb-6 flex items-center justify-between" role="alert">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
        <button type="button" class="text-white hover:text-gray-200" data-dismiss="alert" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
    </div>
    @endif

    <div class="bg-gray-900 rounded-lg shadow-xl border-2 border-purple-500 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-purple-400">
                <thead>
                    <tr class="bg-gray-800">
                        <th class="px-6 py-4 text-left text-sm font-semibold text-purple-300">Producto</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-purple-300">Categoría</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-purple-300">Stock</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-purple-300">Precio</th>
                        <th class="px-6 py-4 text-right text-sm font-semibold text-purple-300">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-purple-400" id="productosTable">
                    @foreach($productos as $producto)
                    <tr class="hover:bg-gray-800 transition-all duration-300">
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-4">
                                @if($producto->imagen)
                                <img src="{{ Storage::url($producto->imagen) }}" alt="{{ $producto->nombre }}" class="w-12 h-12 rounded-lg object-cover border-2 border-purple-400">
                                @else
                                <div class="w-12 h-12 rounded-lg bg-purple-600 flex items-center justify-center">
                                    <i class="fas fa-box text-white text-xl"></i>
                                </div>
                                @endif
                                <div>
                                    <p class="text-white font-medium">{{ $producto->nombre }}</p>
                                    <p class="text-gray-400 text-sm">{{ Str::limit($producto->descripcion, 50) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-sm text-purple-300 bg-purple-900 rounded-full">{{ $producto->categoria }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-{{ $producto->stock > 10 ? 'green' : 'red' }}-400">{{ $producto->stock }}</span>
                        </td>
                        <td class="px-6 py-4 text-white">${{ number_format($producto->precio, 2) }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end space-x-3">
                                <a href="{{ route('productos.show', $producto) }}" class="text-blue-400 hover:text-blue-300 transition-colors duration-200">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('productos.edit', $producto) }}" class="text-yellow-400 hover:text-yellow-300 transition-colors duration-200">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('productos.destroy', $producto) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300 transition-colors duration-200" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const productosTable = document.getElementById('productosTable');
    const rows = productosTable.getElementsByTagName('tr');

    searchInput.addEventListener('keyup', function(e) {
        const searchTerm = e.target.value.toLowerCase();

        Array.from(rows).forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
});
</script>
@endsection
@endsection