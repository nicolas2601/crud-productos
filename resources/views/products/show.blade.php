<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-sky-light leading-tight flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-leaf-green" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                </svg>
                {{ __('Detalles del Producto') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('products.edit', $product) }}" class="btn-hover inline-flex items-center px-4 py-2 bg-sun-yellow border border-transparent rounded-md font-semibold text-xs text-forest-dark uppercase tracking-widest hover:bg-yellow-400 hover:shadow-lg focus:bg-yellow-400 active:bg-sun-yellow focus:outline-none focus:ring-2 focus:ring-earth-brown focus:ring-offset-2 transition ease-in-out duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    {{ __('Editar') }}
                </a>
                <a href="{{ route('products.index') }}" class="btn-hover inline-flex items-center px-4 py-2 bg-mist-gray border border-transparent rounded-md font-semibold text-xs text-forest-dark uppercase tracking-widest hover:bg-gray-400 hover:shadow-lg focus:bg-gray-400 active:bg-mist-gray focus:outline-none focus:ring-2 focus:ring-tech-blue focus:ring-offset-2 transition ease-in-out duration-300">
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
            <div class="bg-forest-dark/50 text-sky-light overflow-hidden shadow-2xl sm:rounded-lg border border-forest-dark/80 animate-fade-in-up">
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Imagen del Producto -->
                        <div class="md:col-span-1">
                            <div class="bg-gray-800 rounded-lg p-4 flex items-center justify-center">
                                @if ($product->image_path)
                                    <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}" class="max-w-full h-auto rounded-md">
                                @else
                                    <div class="h-48 w-48 bg-gray-700 rounded-md flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Información del Producto -->
                        <div class="md:col-span-2">
                            <h3 class="text-lg font-semibold text-gray-200 mb-4">{{ __('Información del Producto') }}</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-gray-400 text-sm">{{ __('ID') }}</p>
                                    <p class="text-gray-200">{{ $product->id }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-sm">{{ __('Nombre') }}</p>
                                    <p class="text-gray-200 font-semibold">{{ $product->name }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-sm">{{ __('Precio') }}</p>
                                    <p class="text-gray-200">${{ number_format($product->price, 2) }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-sm">{{ __('Stock Actual') }}</p>
                                    <p class="text-gray-200">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $product->stock > 10 ? 'bg-green-100 text-green-800' : ($product->stock > 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                            {{ $product->stock }}
                                        </span>
                                    </p>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-sm">{{ __('Fecha de Creación') }}</p>
                                    <p class="text-gray-200">{{ $product->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-sm">{{ __('Última Actualización') }}</p>
                                    <p class="text-gray-200">{{ $product->updated_at->format('d/m/Y H:i') }}</p>
                                </div>
                                <div class="md:col-span-2">
                                    <p class="text-gray-400 text-sm">{{ __('Descripción') }}</p>
                                    <p class="text-gray-200">{{ $product->description ?? 'N/A' }}</p>
                                </div>
                            </div>

                            <!-- Proveedores -->
                            <h3 class="text-lg font-semibold text-gray-200 mt-6 mb-4">{{ __('Proveedores') }}</h3>
                            @if ($product->suppliers->count() > 0)
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach ($product->suppliers as $supplier)
                                        <div class="bg-gray-800 p-3 rounded-md">
                                            <a href="{{ route('suppliers.show', $supplier) }}" class="text-blue-500 hover:text-blue-700 font-medium">
                                                {{ $supplier->name }}
                                            </a>
                                            <p class="text-gray-400 text-sm">{{ $supplier->email }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-400">No hay proveedores asociados a este producto.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Historial de Movimientos -->
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-200 mb-4">{{ __('Historial de Movimientos') }}</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Entradas de Stock -->
                            <div>
                                <h4 class="text-md font-medium text-gray-300 mb-2">{{ __('Últimas Entradas') }}</h4>
                                @if ($product->stockEntries->count() > 0)
                                    <div class="bg-gray-800 rounded-md overflow-hidden">
                                        <table class="min-w-full divide-y divide-gray-700">
                                            <thead class="bg-gray-700">
                                                <tr>
                                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Fecha</th>
                                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Cantidad</th>
                                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Proveedor</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-700">
                                                @foreach ($product->stockEntries->sortByDesc('entry_date')->take(5) as $entry)
                                                    <tr>
                                                        <td class="px-4 py-2 text-sm text-gray-300">{{ $entry->entry_date->format('d/m/Y') }}</td>
                                                        <td class="px-4 py-2 text-sm">
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                                +{{ $entry->quantity }}
                                                            </span>
                                                        </td>
                                                        <td class="px-4 py-2 text-sm text-gray-300">{{ $entry->supplier ? $entry->supplier->name : 'N/A' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p class="text-gray-400">No hay entradas de stock registradas.</p>
                                @endif
                            </div>

                            <!-- Salidas de Stock -->
                            <div>
                                <h4 class="text-md font-medium text-gray-300 mb-2">{{ __('Últimas Salidas') }}</h4>
                                @if ($product->stockExits->count() > 0)
                                    <div class="bg-gray-800 rounded-md overflow-hidden">
                                        <table class="min-w-full divide-y divide-gray-700">
                                            <thead class="bg-gray-700">
                                                <tr>
                                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Fecha</th>
                                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Cantidad</th>
                                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Cliente</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-700">
                                                @foreach ($product->stockExits->sortByDesc('exit_date')->take(5) as $exit)
                                                    <tr>
                                                        <td class="px-4 py-2 text-sm text-gray-300">{{ $exit->exit_date->format('d/m/Y') }}</td>
                                                        <td class="px-4 py-2 text-sm">
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                                -{{ $exit->quantity }}
                                                            </span>
                                                        </td>
                                                        <td class="px-4 py-2 text-sm text-gray-300">{{ $exit->client ? $exit->client->name : 'N/A' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p class="text-gray-400">No hay salidas de stock registradas.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>