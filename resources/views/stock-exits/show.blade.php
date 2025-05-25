<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-200 leading-tight">
                {{ __('Detalles de Salida de Stock') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('stock-exits.edit', $stockExit) }}" class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    {{ __('Editar') }}
                </a>
                <a href="{{ route('stock-exits.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
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
            <div class="bg-dark-secondary overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-200 mb-4">{{ __('Información de la Salida') }}</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-400 text-sm">{{ __('ID') }}</p>
                            <p class="text-gray-200">{{ $stockExit->id }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">{{ __('Fecha de Salida') }}</p>
                            <p class="text-gray-200">{{ $stockExit->exit_date->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">{{ __('Producto') }}</p>
                            <p class="text-gray-200">
                                <a href="{{ route('products.show', $stockExit->product) }}" class="text-blue-500 hover:text-blue-700">
                                    {{ $stockExit->product->name }}
                                </a>
                            </p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">{{ __('Cantidad') }}</p>
                            <p class="text-gray-200">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    {{ $stockExit->quantity }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">{{ __('Cliente') }}</p>
                            <p class="text-gray-200">
                                @if ($stockExit->client)
                                    <a href="{{ route('clients.show', $stockExit->client) }}" class="text-blue-500 hover:text-blue-700">
                                        {{ $stockExit->client->name }}
                                    </a>
                                @else
                                    N/A
                                @endif
                            </p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">{{ __('Fecha de Registro') }}</p>
                            <p class="text-gray-200">{{ $stockExit->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-gray-400 text-sm">{{ __('Notas') }}</p>
                            <p class="text-gray-200">{{ $stockExit->notes ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>