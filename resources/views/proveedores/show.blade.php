@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-semibold leading-tight text-purple-800">Detalles del Proveedor</h2>
            <a href="{{ route('proveedores.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Volver
            </a>
        </div>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-6">
                <h3 class="text-gray-700 text-sm font-bold mb-2">Nombre</h3>
                <p class="text-gray-900">{{ $proveedor->nombre }}</p>
            </div>

            <div class="mb-6">
                <h3 class="text-gray-700 text-sm font-bold mb-2">Dirección</h3>
                <p class="text-gray-900">{{ $proveedor->direccion }}</p>
            </div>

            <div class="mb-6">
                <h3 class="text-gray-700 text-sm font-bold mb-2">Email</h3>
                <p class="text-gray-900">{{ $proveedor->email }}</p>
            </div>

            <div class="mb-6">
                <h3 class="text-gray-700 text-sm font-bold mb-2">Teléfono</h3>
                <p class="text-gray-900">{{ $proveedor->telefono }}</p>
            </div>

            <div class="mb-6">
                <h3 class="text-gray-700 text-sm font-bold mb-2">NIT</h3>
                <p class="text-gray-900">{{ $proveedor->nit }}</p>
            </div>

            <div class="flex items-center justify-end space-x-4">
                <a href="{{ route('proveedores.edit', $proveedor->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    Editar
                </a>
                <form action="{{ route('proveedores.destroy', $proveedor->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('¿Estás seguro de eliminar este proveedor?')">
                        Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection