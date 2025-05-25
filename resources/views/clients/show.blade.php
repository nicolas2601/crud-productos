<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-200 leading-tight">
                {{ __('Detalles del Cliente') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('clients.edit', $client) }}" class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    {{ __('Editar') }}
                </a>
                <a href="{{ route('clients.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
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
            <!-- Información del Cliente -->
            <div class="bg-dark-secondary overflow-hidden shadow-xl sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-200 mb-4">{{ __('Información del Cliente') }}</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-400 text-sm">{{ __('Nombre') }}</p>
                            <p class="text-gray-200">{{ $client->name }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">{{ __('Email') }}</p>
                            <p class="text-gray-200">{{ $client->email ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">{{ __('Teléfono') }}</p>
                            <p class="text-gray-200">{{ $client->phone ?? 'N/A' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-gray-400 text-sm">{{ __('Dirección') }}</p>
                            <p class="text-gray-200">{{ $client->address ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Historial de Compras -->
            <div class="bg-dark-secondary overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-200 mb-4">{{ __('Historial de Compras') }}</h3>
                    @if($client->stockExits->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-700">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">{{ __('ID') }}</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">{{ __('Producto') }}</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">{{ __('Cantidad') }}</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">{{ __('Precio Total') }}</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">{{ __('Fecha') }}</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">{{ __('Notas') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-700">
                                    @foreach($client->stockExits as $exit)
                                        <tr>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-200">{{ $exit->id }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-200">{{ $exit->product->name }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-200">{{ $exit->quantity }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-200">${{ number_format($exit->total_price, 2) }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-200">{{ $exit->created_at->format('d/m/Y H:i') }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-200">{{ $exit->notes ?? 'N/A' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-400">{{ __('Este cliente no tiene compras registradas.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>