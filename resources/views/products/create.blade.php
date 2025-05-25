<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-200 leading-tight">
                {{ __('Crear Nuevo Producto') }}
            </h2>
            <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                {{ __('Volver') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-forest-dark/50 text-sky-light overflow-hidden shadow-2xl sm:rounded-lg border border-forest-dark/80 animate-fade-in-up">
                <div class="p-8">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 animate-slide-in-left">
                            <!-- Nombre -->
                            <div>
                                <x-label for="name" value="{{ __('Nombre') }}" class="text-gray-300" />
                                <x-input id="name" class="block mt-1 w-full bg-gray-700 text-gray-200 border-gray-600" type="text" name="name" :value="old('name')" required autofocus />
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Precio -->
                            <div>
                                <x-label for="price" value="{{ __('Precio') }}" class="text-gray-300" />
                                <x-input id="price" class="block mt-1 w-full bg-gray-700 text-gray-200 border-gray-600" type="number" name="price" :value="old('price')" step="0.01" min="0" required />
                                @error('price')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Stock Inicial -->
                            <div>
                                <x-label for="stock" value="{{ __('Stock Inicial') }}" class="text-gray-300" />
                                <x-input id="stock" class="block mt-1 w-full bg-gray-700 text-gray-200 border-gray-600" type="number" name="stock" :value="old('stock', 0)" min="0" required />
                                @error('stock')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Imagen del Producto -->
                            <div>
                                <x-label for="image" value="{{ __('Imagen del Producto') }}" class="text-gray-300" />
                                <input id="image" type="file" name="image" class="block mt-1 w-full bg-gray-700 text-gray-200 border-gray-600 rounded-md shadow-sm">
                                @error('image')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Proveedores -->
                            <div class="md:col-span-2">
                                <x-label for="suppliers" value="{{ __('Proveedores') }}" class="text-gray-300" />
                                <select id="suppliers" name="suppliers[]" multiple class="block mt-1 w-full border-gray-600 bg-gray-700 text-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" {{ in_array($supplier->id, old('suppliers', [])) ? 'selected' : '' }}>
                                            {{ $supplier->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('suppliers')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Descripción -->
                            <div class="md:col-span-2">
                                <x-label for="description" value="{{ __('Descripción') }}" class="text-gray-300" />
                                <textarea id="description" name="description" rows="3" class="block mt-1 w-full border-gray-600 bg-gray-700 text-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-end mt-6">
                            <x-button class="ml-4">
                                {{ __('Guardar Producto') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>