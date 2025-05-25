<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-200 leading-tight">
                {{ __('Editar Salida de Stock') }}
            </h2>
            <a href="{{ route('stock-exits.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                {{ __('Volver') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-dark-secondary overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('stock-exits.update', $stockExit) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Producto -->
                            <div>
                                <x-label for="product_id" value="{{ __('Producto') }}" class="text-gray-300" />
                                <select id="product_id" name="product_id" class="block mt-1 w-full border-gray-600 bg-gray-700 text-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">Seleccionar producto</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" {{ old('product_id', $stockExit->product_id) == $product->id ? 'selected' : '' }}>
                                            {{ $product->name }} (Stock actual: {{ $product->stock }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Cliente -->
                            <div>
                                <x-label for="client_id" value="{{ __('Cliente') }}" class="text-gray-300" />
                                <select id="client_id" name="client_id" class="block mt-1 w-full border-gray-600 bg-gray-700 text-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">Seleccionar cliente (opcional)</option>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}" {{ old('client_id', $stockExit->client_id) == $client->id ? 'selected' : '' }}>
                                            {{ $client->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('client_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Cantidad -->
                            <div>
                                <x-label for="quantity" value="{{ __('Cantidad') }}" class="text-gray-300" />
                                <x-input id="quantity" class="block mt-1 w-full bg-gray-700 text-gray-200 border-gray-600" type="number" name="quantity" :value="old('quantity', $stockExit->quantity)" min="1" required />
                                @error('quantity')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Fecha de Salida -->
                            <div>
                                <x-label for="exit_date" value="{{ __('Fecha de Salida') }}" class="text-gray-300" />
                                <x-input id="exit_date" class="block mt-1 w-full bg-gray-700 text-gray-200 border-gray-600" type="date" name="exit_date" :value="old('exit_date', $stockExit->exit_date->format('Y-m-d'))" required />
                                @error('exit_date')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Notas -->
                            <div class="md:col-span-2">
                                <x-label for="notes" value="{{ __('Notas') }}" class="text-gray-300" />
                                <textarea id="notes" name="notes" rows="3" class="block mt-1 w-full border-gray-600 bg-gray-700 text-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('notes', $stockExit->notes) }}</textarea>
                                @error('notes')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-end mt-6">
                            <x-button class="ml-4">
                                {{ __('Actualizar Salida') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>