<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-sky-light leading-tight flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-water-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                {{ __('Proveedores') }}
            </h2>
            <a href="{{ route('suppliers.create') }}" class="btn-hover inline-flex items-center px-4 py-2 bg-tech-blue border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-water-blue hover:shadow-lg focus:bg-water-blue active:bg-tech-blue focus:outline-none focus:ring-2 focus:ring-tech-purple focus:ring-offset-2 transition ease-in-out duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 animate-pulse-slow" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                {{ __('Nuevo Proveedor') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-forest-dark/50 text-sky-light overflow-hidden shadow-2xl sm:rounded-lg border border-forest-dark/80 animate-fade-in-up">
                <div class="p-8">
                    <table class="datatable w-full text-left rounded-lg overflow-hidden">
                        <thead class="bg-forest-green text-white">
                            <tr>
                                <th class="px-4 py-3">ID</th>
                                <th class="px-4 py-3">Nombre</th>
                                <th class="px-4 py-3">Contacto</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">Teléfono</th>
                                <th class="px-4 py-3">Productos</th>
                                <th class="px-4 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-mist-gray">
                            @foreach ($suppliers as $supplier)
                                <tr class="border-b border-forest-dark/60 hover:bg-forest-dark/70 transition duration-200 animate-slide-in-left">
                                    <td class="px-4 py-3">{{ $supplier->id }}</td>
                                    <td class="px-4 py-3">{{ $supplier->name }}</td>
                                    <td class="px-4 py-3">{{ $supplier->contact_name ?? 'N/A' }}</td>
                                    <td class="px-4 py-3">{{ $supplier->email ?? 'N/A' }}</td>
                                    <td class="px-4 py-3">{{ $supplier->phone ?? 'N/A' }}</td>
                                    <td class="px-4 py-3">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-leaf-green text-forest-dark animate-bounce-light">
                                            {{ $supplier->products_count }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 flex space-x-3">
                                        <a href="{{ route('suppliers.show', $supplier) }}" class="text-water-blue hover:text-deep-blue animate-scale-up" title="Ver">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('suppliers.edit', $supplier) }}" class="text-golden-yellow hover:text-sun-yellow animate-scale-up" title="Editar">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-berry-red hover:text-warm-brown animate-scale-up" onclick="return confirm('¿Estás seguro de que deseas eliminar este proveedor?')" title="Eliminar">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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