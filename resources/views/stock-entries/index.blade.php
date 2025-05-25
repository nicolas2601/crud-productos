<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-sky-light leading-tight flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-autumn-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                </svg>
                {{ __('Entradas de Stock') }}
            </h2>
            <a href="{{ route('stock-entries.create') }}" class="btn-hover inline-flex items-center px-4 py-2 bg-autumn-orange border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-sun-yellow hover:shadow-lg focus:bg-sun-yellow active:bg-autumn-orange focus:outline-none focus:ring-2 focus:ring-earth-brown focus:ring-offset-2 transition ease-in-out duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 animate-pulse-slow" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                {{ __('Nueva Entrada') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-forest-dark/30 text-sky-light overflow-hidden shadow-xl sm:rounded-lg border border-forest-dark/60 hover:scale-105 transition duration-300 animate-fade-in">
                <div class="p-6">
                    <table class="datatable w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left">ID</th>
                                <th class="px-4 py-2 text-left">Producto</th>
                                <th class="px-4 py-2 text-left">Proveedor</th>
                                <th class="px-4 py-2 text-left">Cantidad</th>
                                <th class="px-4 py-2 text-left">Fecha</th>
                                <th class="px-4 py-2 text-left">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stockEntries as $entry)
                                <tr>
                                    <td class="px-4 py-2">{{ $entry->id }}</td>
                                    <td class="px-4 py-2">{{ $entry->product->name }}</td>
                                    <td class="px-4 py-2">{{ $entry->supplier ? $entry->supplier->name : 'N/A' }}</td>
                                    <td class="px-4 py-2">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-leaf-green text-sky-light">
                                            {{ $entry->quantity }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2">{{ $entry->entry_date->format('d/m/Y') }}</td>
                                    <td class="px-4 py-2 flex space-x-2">
                                        <a href="{{ route('stock-entries.show', $entry) }}" class="text-water-blue hover:text-deep-blue animate-scale-up">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('stock-entries.edit', $entry) }}" class="text-golden-yellow hover:text-sun-yellow animate-scale-up">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('stock-entries.destroy', $entry) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-berry-red hover:text-warm-brown animate-scale-up" onclick="return confirm('¿Estás seguro de que deseas eliminar esta entrada de stock?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function() {
            $('.datatable').DataTable({
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
                }
            });
        });
    </script>
    @endpush
</x-app-layout>