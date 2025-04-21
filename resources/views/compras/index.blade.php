@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <!-- Header con estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gray-800 border-2 border-purple-500 rounded-lg p-6 shadow-lg transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-300 text-sm font-semibold">Total Compras</p>
                        <h3 class="text-2xl font-bold text-white mt-2">{{ $compras->count() }}</h3>
                    </div>
                    <div class="bg-purple-600 rounded-full p-3">
                        <i class="fas fa-shopping-cart text-white text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-gray-800 border-2 border-yellow-500 rounded-lg p-6 shadow-lg transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-yellow-300 text-sm font-semibold">Facturas Pendientes</p>
                        <h3 class="text-2xl font-bold text-white mt-2">{{ $compras->where('estado_factura', 'pendiente')->count() }}</h3>
                    </div>
                    <div class="bg-yellow-600 rounded-full p-3">
                        <i class="fas fa-clock text-white text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-gray-800 border-2 border-red-500 rounded-lg p-6 shadow-lg transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-red-300 text-sm font-semibold">Facturas Vencidas</p>
                        <h3 class="text-2xl font-bold text-white mt-2">{{ $compras->where('estado_factura', 'vencida')->count() }}</h3>
                    </div>
                    <div class="bg-red-600 rounded-full p-3">
                        <i class="fas fa-exclamation-triangle text-white text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header con título y botón -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold leading-tight text-purple-300">Registro de Compras</h2>
                <p class="text-gray-400 mt-2">Gestiona tus compras y facturas de proveedores</p>
            </div>
            <a href="{{ route('compras.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 flex items-center shadow-lg">
                <i class="fas fa-plus-circle mr-2"></i>Nueva Compra
            </a>
        </div>

        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow-2xl rounded-lg overflow-hidden border-2 border-purple-500 bg-gray-900">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-6 py-4 border-b-2 border-purple-300 bg-gray-700 text-left text-sm font-semibold text-purple-200 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-building mr-2"></i>Proveedor
                                </div>
                            </th>
                            <th class="px-6 py-4 border-b-2 border-purple-300 bg-gray-700 text-left text-sm font-semibold text-purple-200 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-file-invoice mr-2"></i>Factura
                                </div>
                            </th>
                            <th class="px-6 py-4 border-b-2 border-purple-300 bg-gray-700 text-left text-sm font-semibold text-purple-200 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-box mr-2"></i>Cantidad
                                </div>
                            </th>
                            <th class="px-6 py-4 border-b-2 border-purple-300 bg-gray-700 text-left text-sm font-semibold text-purple-200 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-dollar-sign mr-2"></i>Total
                                </div>
                            </th>
                            <th class="px-6 py-4 border-b-2 border-purple-300 bg-gray-700 text-left text-sm font-semibold text-purple-200 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-info-circle mr-2"></i>Estado
                                </div>
                            </th>
                            <th class="px-6 py-4 border-b-2 border-purple-300 bg-gray-700 text-left text-sm font-semibold text-purple-200 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-cog mr-2"></i>Acciones
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-700">
                        @foreach($compras as $compra)
                        <tr class="hover:bg-gray-800 transition-all duration-300 transform hover:scale-[1.01] relative group">
                            <td class="px-6 py-5 border-b border-purple-400">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="w-10 h-10 rounded-full bg-purple-600 flex items-center justify-center">
                                            <i class="fas fa-building text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-purple-100 whitespace-no-wrap text-sm font-medium">{{ $compra->proveedor->nombre }}</p>
                                        <p class="text-purple-300 whitespace-no-wrap text-xs flex items-center">
                                            <i class="fas fa-calendar-alt mr-1"></i>
                                            {{ $compra->fecha_compra->format('d/m/Y') }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5 border-b border-purple-400">
                                <div class="space-y-1">
                                    <p class="text-purple-100 whitespace-no-wrap text-sm flex items-center">
                                        <i class="fas fa-file-invoice mr-2"></i>
                                        #{{ $compra->numero_factura }}
                                    </p>
                                    <p class="text-purple-300 whitespace-no-wrap text-xs flex items-center">
                                        <i class="fas fa-clock mr-1"></i>
                                        Vence: {{ $compra->fecha_vencimiento->format('d/m/Y') }}
                                    </p>
                                </div>
                            </td>
                            <td class="px-6 py-5 border-b border-purple-400">
                                <div class="space-y-1">
                                    <p class="text-purple-100 whitespace-no-wrap text-sm flex items-center">
                                        <i class="fas fa-box mr-2"></i>
                                        {{ $compra->cantidad }} unidades
                                    </p>
                                    <p class="text-purple-300 whitespace-no-wrap text-xs flex items-center">
                                        <i class="fas fa-tag mr-1"></i>
                                        $ {{ number_format($compra->precio_unitario, 2) }} c/u
                                    </p>
                                </div>
                            </td>
                            <td class="px-6 py-5 border-b border-purple-400">
                                <div class="bg-gray-800 rounded-lg p-2 border border-purple-400">
                                    <p class="text-purple-100 whitespace-no-wrap text-sm font-bold flex items-center">
                                        <i class="fas fa-dollar-sign mr-2"></i>
                                        $ {{ number_format($compra->total, 2) }}
                                    </p>
                                </div>
                            </td>
                            <td class="px-6 py-5 border-b border-purple-400">
                                <span class="px-4 py-2 text-xs font-semibold rounded-full inline-flex items-center space-x-2
                                    @if($compra->estado_factura == 'pagada') bg-green-200 text-green-800
                                    @elseif($compra->estado_factura == 'pendiente') bg-yellow-200 text-yellow-800
                                    @else bg-red-200 text-red-800
                                    @endif">
                                    <i class="fas fa-circle text-xs"></i>
                                    <span>{{ ucfirst($compra->estado_factura) }}</span>
                                </span>
                            </td>
                            <td class="px-6 py-5 border-b border-purple-400">
                                <div class="flex space-x-4">
                                    <a href="{{ route('compras.show', $compra->id) }}" class="text-blue-400 hover:text-blue-300 transition-all duration-300 transform hover:scale-110" title="Ver detalles">
                                        <i class="fas fa-eye text-lg"></i>
                                    </a>
                                    <a href="{{ route('compras.edit', $compra->id) }}" class="text-yellow-400 hover:text-yellow-300 transition-all duration-300 transform hover:scale-110" title="Editar">
                                        <i class="fas fa-edit text-lg"></i>
                                    </a>
                                    <form action="{{ route('compras.destroy', $compra->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300 transition-all duration-300 transform hover:scale-110" onclick="return confirm('¿Estás seguro de eliminar esta compra?')" title="Eliminar">
                                            <i class="fas fa-trash text-lg"></i>
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

        <!-- Alertas de sesión y facturas vencidas -->
        @if(session('success'))
        <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform transition-all duration-500 ease-in-out">
            <div class="flex items-center space-x-2">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
        @endif

        @if($compras->where('estado_factura', 'vencida')->count() > 0)
        <div class="fixed bottom-4 left-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center space-x-3">
                <i class="fas fa-exclamation-triangle text-xl"></i>
                <div>
                    <h4 class="font-bold">¡Atención!</h4>
                    <p class="text-sm">Tienes {{ $compras->where('estado_factura', 'vencida')->count() }} facturas vencidas</p>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="ml-4 hover:text-red-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection