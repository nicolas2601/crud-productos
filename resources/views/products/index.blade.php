<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-sky-light leading-tight flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-leaf-green" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                </svg>
                {{ __('Productos') }}
            </h2>
            <a href="{{ route('products.create') }}" class="btn-hover inline-flex items-center px-4 py-2 bg-nature-green border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-leaf-green hover:shadow-lg focus:bg-leaf-green active:bg-nature-green focus:outline-none focus:ring-2 focus:ring-earth-brown focus:ring-offset-2 transition ease-in-out duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 animate-pulse-slow" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                {{ __('Nuevo Producto') }}
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
                                <th class="px-4 py-3">Imagen</th>
                                <th class="px-4 py-3">Nombre</th>
                                <th class="px-4 py-3">Precio</th>
                                <th class="px-4 py-3">Stock</th>
                                <th class="px-4 py-3">Proveedores</th>
                                <th class="px-4 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-mist-gray">
                            @foreach ($products as $product)
                                <tr class="border-b border-forest-dark/60 hover:bg-forest-dark/70 transition duration-200 animate-slide-in-left">
                                    <td class="px-4 py-3">{{ $product->id }}</td>
                                    <td class="px-4 py-3">
                                        @if ($product->image_path)
                                            <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}" class="h-12 w-12 object-cover rounded-full border-2 border-leaf-green animate-pulse-slow">
                                        @else
                                            <div class="h-12 w-12 bg-mist-gray rounded-full flex items-center justify-center border-2 border-stone-gray">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">{{ $product->name }}</td>
                                    <td class="px-4 py-3">${{ number_format($product->price, 2) }}</td>
                                    <td class="px-4 py-3">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-leaf-green text-forest-dark animate-bounce-light">
                                            {{ $product->stock }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ $product->suppliers->count() }}
                                    </td>
                                    <td class="px-4 py-3 flex space-x-3">
                                        <a href="{{ route('products.show', $product) }}" class="text-water-blue hover:text-deep-blue animate-scale-up" title="Ver">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('products.edit', $product) }}" class="text-golden-yellow hover:text-sun-yellow animate-scale-up" title="Editar">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-berry-red hover:text-warm-brown animate-scale-up" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')" title="Eliminar">
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