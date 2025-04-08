@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-bold leading-tight text-purple-300">Lista de Proveedores</h2>
            <a href="{{ route('proveedores.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 flex items-center">
                <i class="fas fa-plus-circle mr-2"></i>Nuevo Proveedor
            </a>
        </div>

        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow-2xl rounded-lg overflow-hidden border-2 border-purple-500 bg-gray-900">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-6 py-4 border-b-2 border-purple-300 bg-gray-700 text-left text-sm font-semibold text-purple-200 uppercase tracking-wider">Nombre</th>
                            <th class="px-6 py-4 border-b-2 border-purple-300 bg-gray-700 text-left text-sm font-semibold text-purple-200 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-4 border-b-2 border-purple-300 bg-gray-700 text-left text-sm font-semibold text-purple-200 uppercase tracking-wider">Teléfono</th>
                            <th class="px-6 py-4 border-b-2 border-purple-300 bg-gray-700 text-left text-sm font-semibold text-purple-200 uppercase tracking-wider">NIT</th>
                            <th class="px-6 py-4 border-b-2 border-purple-300 bg-gray-700 text-left text-sm font-semibold text-purple-200 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-700">
                        @foreach($proveedores as $proveedor)
                        <tr class="hover:bg-gray-800 transition-all duration-300 transform hover:scale-[1.01]">
                            <td class="px-6 py-5 border-b border-purple-400">
                                <p class="text-purple-100 whitespace-no-wrap text-sm font-medium">{{ $proveedor->nombre }}</p>
                            </td>
                            <td class="px-6 py-5 border-b border-purple-400">
                                <p class="text-purple-100 whitespace-no-wrap text-sm">{{ $proveedor->email }}</p>
                            </td>
                            <td class="px-6 py-5 border-b border-purple-400">
                                <p class="text-purple-100 whitespace-no-wrap text-sm">{{ $proveedor->telefono }}</p>
                            </td>
                            <td class="px-6 py-5 border-b border-purple-400">
                                <p class="text-purple-100 whitespace-no-wrap text-sm">{{ $proveedor->nit }}</p>
                            </td>
                            <td class="px-6 py-5 border-b border-purple-400">
                                <div class="flex space-x-4">
                                    <a href="{{ route('proveedores.show', $proveedor->id) }}" class="text-blue-400 hover:text-blue-300 transition-all duration-300 transform hover:scale-110" title="Ver detalles">
                                        <i class="fas fa-eye text-lg"></i>
                                    </a>
                                    <a href="{{ route('proveedores.edit', $proveedor->id) }}" class="text-yellow-400 hover:text-yellow-300 transition-all duration-300 transform hover:scale-110" title="Editar">
                                        <i class="fas fa-edit text-lg"></i>
                                    </a>
                                    <form action="{{ route('proveedores.destroy', $proveedor->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300 transition-all duration-300 transform hover:scale-110" onclick="return confirm('¿Estás seguro de eliminar este proveedor?')" title="Eliminar">
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
    </div>
</div>
@endsection