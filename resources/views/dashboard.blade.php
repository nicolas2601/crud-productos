<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-tech-accent leading-tight flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-nature-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
            </svg>
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-nature-primary">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-nature-secondary/30 text-tech-accent overflow-hidden shadow-2xl sm:rounded-lg border border-nature-secondary/50 p-8 animate-fade-in-up">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Card de ejemplo 1 -->
                    <div class="bg-earth-tone/60 p-6 rounded-lg shadow-xl border border-earth-tone/80 hover:scale-105 transition duration-300 animate-slide-in-left">
                        <h3 class="font-semibold text-xl text-tech-accent mb-3">Total de Productos</h3>
                        <p class="text-sky-light text-3xl font-bold">150</p>
                    </div>

                    <!-- Card de ejemplo 2 -->
                    <div class="bg-tech-secondary/60 p-6 rounded-lg shadow-xl border border-tech-secondary/80 hover:scale-105 transition duration-300 animate-slide-in-left delay-100">
                        <h3 class="font-semibold text-xl text-tech-accent mb-3">Total de Clientes</h3>
                        <p class="text-sky-light text-3xl font-bold">75</p>
                    </div>

                    <!-- Card de ejemplo 3 -->
                    <div class="bg-forest-gradient-start/60 p-6 rounded-lg shadow-xl border border-forest-gradient-start/80 hover:scale-105 transition duration-300 animate-slide-in-left delay-200">
                        <h3 class="font-semibold text-xl text-tech-accent mb-3">Última Salida</h3>
                        <p class="text-sky-light text-3xl font-bold">Producto X (Cantidad: 10)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
