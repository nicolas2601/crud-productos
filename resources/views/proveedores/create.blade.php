@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-semibold leading-tight text-purple-800">Crear Nuevo Proveedor</h2>
            <a href="{{ route('proveedores.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Volver
            </a>
        </div>

        <div class="bg-gray-900 shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4 border border-purple-500">
            <form action="{{ route('proveedores.store') }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label class="block text-purple-200 text-sm font-bold mb-2" for="nombre">
                        <i class="fas fa-user mr-2"></i>Nombre
                    </label>
                    <input class="bg-gray-800 shadow appearance-none border border-purple-500 rounded w-full py-3 px-4 text-purple-100 leading-tight focus:outline-none focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50 transition duration-300 @error('nombre') border-red-500 @enderror"
                        id="nombre" type="text" name="nombre" value="{{ old('nombre') }}" required placeholder="Ingrese el nombre del proveedor">
                    @error('nombre')
                        <p class="text-red-400 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-purple-200 text-sm font-bold mb-2" for="direccion">
                        <i class="fas fa-map-marker-alt mr-2"></i>Dirección
                    </label>
                    <input class="bg-gray-800 shadow appearance-none border border-purple-500 rounded w-full py-3 px-4 text-purple-100 leading-tight focus:outline-none focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50 transition duration-300 @error('direccion') border-red-500 @enderror"
                        id="direccion" type="text" name="direccion" value="{{ old('direccion') }}" required placeholder="Ingrese la dirección">
                    @error('direccion')
                        <p class="text-red-400 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-purple-200 text-sm font-bold mb-2" for="telefono">
                        <i class="fas fa-phone mr-2"></i>Teléfono
                    </label>
                    <input class="bg-gray-800 shadow appearance-none border border-purple-500 rounded w-full py-3 px-4 text-purple-100 leading-tight focus:outline-none focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50 transition duration-300 @error('telefono') border-red-500 @enderror"
                        id="telefono" type="text" name="telefono" value="{{ old('telefono') }}" required placeholder="Ingrese el teléfono">
                    @error('telefono')
                        <p class="text-red-400 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-purple-200 text-sm font-bold mb-2" for="email">
                        <i class="fas fa-envelope mr-2"></i>Email
                    </label>
                    <input class="bg-gray-800 shadow appearance-none border border-purple-500 rounded w-full py-3 px-4 text-purple-100 leading-tight focus:outline-none focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50 transition duration-300 @error('email') border-red-500 @enderror"
                        id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="Ingrese el email">
                    @error('email')
                        <p class="text-red-400 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-purple-200 text-sm font-bold mb-2" for="nit">
                        <i class="fas fa-id-card mr-2"></i>NIT
                    </label>
                    <input class="bg-gray-800 shadow appearance-none border border-purple-500 rounded w-full py-3 px-4 text-purple-100 leading-tight focus:outline-none focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50 transition duration-300 @error('nit') border-red-500 @enderror"
                        id="nit" type="text" name="nit" value="{{ old('nit') }}" required placeholder="Ingrese el NIT">
                    @error('nit')
                        <p class="text-red-400 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end space-x-4">
                    <button class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:ring focus:ring-purple-200 focus:ring-opacity-50 transition duration-300 flex items-center" type="submit">
                        <i class="fas fa-save mr-2"></i>Guardar Proveedor
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection