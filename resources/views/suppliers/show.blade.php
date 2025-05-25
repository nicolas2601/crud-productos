<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-sky-light leading-tight flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-water-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                {{ __('Detalles del Proveedor') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('suppliers.edit', $supplier) }}" class="btn-hover inline-flex items-center px-4 py-2 bg-sun-yellow border border-transparent rounded-md font-semibold text-xs text-forest-dark uppercase tracking-widest hover:bg-yellow-400 hover:shadow-lg focus:bg-yellow-400 active:bg-sun-yellow focus:outline-none focus:ring-2 focus:ring-earth-brown focus:ring-offset-2 transition ease-in-out duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    {{ __('Editar') }}
                </a>
                <a href="{{ route('suppliers.index') }}" class="btn-hover inline-flex items-center px-4 py-2 bg-mist-gray border border-transparent rounded-md font-semibold text-xs text-forest-dark uppercase tracking-widest hover:bg-gray-400 hover:shadow-lg focus:bg-gray-400 active:bg-mist-gray focus:outline-none focus:ring-2 focus:ring-tech-blue focus:ring-offset-2 transition ease-in-out duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    {{ __('Volver') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Información del Proveedor -->
            <div class="bg-dark-secondary overflow-hidden shadow-xl sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-200 mb-4">{{ __('Información del Proveedor') }}</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-400 text-sm">{{ __('Nombre') }}</p>
                            <p class="text-gray-200">{{ $supplier->name }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">{{ __('Nombre de Contacto') }}</p>
                            <p class="text-gray-200">{{ $supplier->contact_name ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">{{ __('Email') }}</p>
                            <p class="text-gray-200">{{ $supplier->email ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">{{ __('Teléfono') }}</p>
                            <p class="text-gray-200">{{ $supplier->phone ?? 'N/A' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-gray-400 text-sm">{{ __('Dirección') }}</p>
                            <p class="text-gray-200">{{ $supplier->address ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Productos del Proveedor -->
            <div class="bg-dark-secondary overflow-hidden shadow-xl sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-200 mb-4">{{ __('Productos Suministrados') }}</h3>
                    @if($supplier->products->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-700">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">{{ __('ID') }}</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">{{ __('Imagen') }}</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">{{ __('Nombre') }}</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">{{ __('Precio') }}</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">{{ __('Stock') }}</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">{{ __('Acciones') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-700">
                                    @foreach($supplier->products as $product)
                                        <tr>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-200">{{ $product->id }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap">
                                                @if ($product->image_path)
                                                    <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}" class="h-10 w-10 object-cover rounded-md">
                                                @else
                                                    <div class="h-10 w-10 bg-gray-700 rounded-md flex items-center justify-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-200">{{ $product->name }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-200">${{ number_format($product->price, 2) }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $product->stock > 10 ? 'bg-green-100 text-green-800' : ($product->stock > 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                    {{ $product->stock }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-200">
                                                <a href="{{ route('products.show', $product) }}" class="text-blue-500 hover:text-blue-700">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-400">{{ __('Este proveedor no tiene productos asociados.') }}</p>
                    @endif
                </div>
            </div>

            <!-- Historial de Entradas -->
            <div class="bg-forest-dark/50 text-sky-light overflow-hidden shadow-2xl sm:rounded-lg border border-forest-dark/80 animate-fade-in-up">
                <div class="p-8">
                    <h3 class="text-lg font-semibold text-gray-200 mb-4">{{ __('Historial de Entradas') }}</h3>
                    @if($supplier->stockEntries->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-700">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">{{ __('ID') }}</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">{{ __('Producto') }}</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">{{ __('Cantidad') }}</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">{{ __('Fecha') }}</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">{{ __('Notas') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-700">
                                    @foreach($supplier->stockEntries as $entry)
                                        <tr>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-200">{{ $entry->id }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-200">{{ $entry->product->name }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-200">{{ $entry->quantity }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-200">{{ $entry->created_at->format('d/m/Y H:i') }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-200">{{ $entry->notes ?? 'N/A' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-400">{{ __('No hay registros de entradas para este proveedor.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>