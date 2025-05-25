<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gaming-accent leading-tight flex items-center animate-neon-pulse">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-gaming-accent-alt animate-float" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z" />
            </svg>
            <span class="animate-rgb-shift">{{ __('Gaming Hardware Dashboard') }}</span>
        </h2>
    </x-slot>

    <div class="py-12 bg-gaming-primary bg-opacity-95 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1IiBoZWlnaHQ9IjUiPgo8cmVjdCB3aWR0aD0iNSIgaGVpZ2h0PSI1IiBmaWxsPSIjMTIxMjEyIj48L3JlY3Q+CjxwYXRoIGQ9Ik0wIDVMNSAwWk02IDRMNCA2Wk0tMSAxTDEgLTFaIiBzdHJva2U9IiMyMjIiIHN0cm9rZS13aWR0aD0iMSI+PC9wYXRoPgo8L3N2Zz4=')]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gaming-secondary/80 backdrop-blur-sm text-gaming-text overflow-hidden shadow-2xl sm:rounded-lg border border-gaming-accent/30 p-8 animate-blur-in">
                <!-- Título de sección con efecto neón -->
                <h2 class="text-2xl font-bold mb-8 text-gaming-accent animate-neon-pulse text-center">ESTADÍSTICAS DE HARDWARE</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Card 1: Productos Gaming -->
                    <div class="bg-gradient-to-br from-gaming-gradient-1-start to-gaming-gradient-1-end p-6 rounded-lg shadow-[0_0_15px_rgba(255,0,120,0.5)] border border-gaming-accent/50 hover:scale-105 hover:shadow-[0_0_25px_rgba(255,0,120,0.7)] transition-all duration-300 animate-zoom-in group">
                        <div class="flex justify-between items-start">
                            <h3 class="font-semibold text-xl text-gaming-text mb-3 group-hover:text-gaming-accent-alt transition-colors duration-300">Hardware Gaming</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gaming-accent-alt animate-float" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <p class="text-gaming-text text-4xl font-bold mt-2 group-hover:text-gaming-accent transition-colors duration-300 animate-neon-pulse">150</p>
                        <p class="text-gaming-text-muted text-sm mt-2">Productos en inventario</p>
                        <div class="mt-4 h-2 w-full bg-gaming-border rounded-full overflow-hidden">
                            <div class="h-full bg-gaming-accent animate-pulse-slow" style="width: 75%"></div>
                        </div>
                    </div>

                    <!-- Card 2: Clientes Gamers -->
                    <div class="bg-gradient-to-br from-gaming-gradient-2-start to-gaming-gradient-2-end p-6 rounded-lg shadow-[0_0_15px_rgba(0,255,255,0.5)] border border-gaming-accent-alt/50 hover:scale-105 hover:shadow-[0_0_25px_rgba(0,255,255,0.7)] transition-all duration-300 animate-zoom-in delay-100 group">
                        <div class="flex justify-between items-start">
                            <h3 class="font-semibold text-xl text-gaming-text mb-3 group-hover:text-gaming-accent transition-colors duration-300">Gamers Registrados</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gaming-accent animate-float" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <p class="text-gaming-text text-4xl font-bold mt-2 group-hover:text-gaming-accent-alt transition-colors duration-300 animate-neon-pulse">75</p>
                        <p class="text-gaming-text-muted text-sm mt-2">Clientes activos</p>
                        <div class="mt-4 h-2 w-full bg-gaming-border rounded-full overflow-hidden">
                            <div class="h-full bg-gaming-accent-alt animate-pulse-slow" style="width: 60%"></div>
                        </div>
                    </div>

                    <!-- Card 3: Última Venta -->
                    <div class="bg-gradient-to-br from-gaming-gradient-3-start to-gaming-gradient-3-end p-6 rounded-lg shadow-[0_0_15px_rgba(255,61,0,0.5)] border border-gaming-error/50 hover:scale-105 hover:shadow-[0_0_25px_rgba(255,61,0,0.7)] transition-all duration-300 animate-zoom-in delay-200 group">
                        <div class="flex justify-between items-start">
                            <h3 class="font-semibold text-xl text-gaming-text mb-3 group-hover:text-gaming-warning transition-colors duration-300">Última Venta</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gaming-warning animate-float" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="mt-2">
                            <p class="text-gaming-text text-xl font-bold group-hover:text-gaming-warning transition-colors duration-300 animate-neon-pulse">RTX 4090 Ti</p>
                            <div class="flex justify-between mt-1">
                                <p class="text-gaming-text-muted text-sm">Cantidad:</p>
                                <p class="text-gaming-warning font-medium">2 unidades</p>
                            </div>
                            <div class="flex justify-between">
                                <p class="text-gaming-text-muted text-sm">Cliente:</p>
                                <p class="text-gaming-warning font-medium">Pro Gamer Team</p>
                            </div>
                            <div class="flex justify-between">
                                <p class="text-gaming-text-muted text-sm">Fecha:</p>
                                <p class="text-gaming-warning font-medium">Hoy, 14:30</p>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-end">
                            <button class="text-xs bg-gaming-error/20 hover:bg-gaming-error/40 text-gaming-warning px-3 py-1 rounded-full transition-colors duration-300 flex items-center">
                                <span>Ver detalles</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Sección de Tendencias -->
                <div class="mt-12">
                    <h3 class="text-xl font-bold mb-6 text-gaming-accent-alt animate-neon-pulse">TENDENCIAS DE HARDWARE</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 animate-slide-in-bottom delay-300">
                        <!-- Gráfico de Tendencias (Simulado) -->
                        <div class="bg-gaming-secondary/60 p-6 rounded-lg border border-gaming-border">
                            <h4 class="text-gaming-text font-medium mb-4">Productos Más Vendidos</h4>
                            <!-- Barra 1 -->
                            <div class="mb-3">
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm text-gaming-text-muted">Tarjetas Gráficas</span>
                                    <span class="text-sm text-gaming-success">42%</span>
                                </div>
                                <div class="h-2 w-full bg-gaming-border rounded-full overflow-hidden">
                                    <div class="h-full bg-gaming-success animate-pulse-slow" style="width: 42%"></div>
                                </div>
                            </div>
                            <!-- Barra 2 -->
                            <div class="mb-3">
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm text-gaming-text-muted">Procesadores</span>
                                    <span class="text-sm text-gaming-accent">28%</span>
                                </div>
                                <div class="h-2 w-full bg-gaming-border rounded-full overflow-hidden">
                                    <div class="h-full bg-gaming-accent animate-pulse-slow" style="width: 28%"></div>
                                </div>
                            </div>
                            <!-- Barra 3 -->
                            <div class="mb-3">
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm text-gaming-text-muted">Periféricos</span>
                                    <span class="text-sm text-gaming-accent-alt">18%</span>
                                </div>
                                <div class="h-2 w-full bg-gaming-border rounded-full overflow-hidden">
                                    <div class="h-full bg-gaming-accent-alt animate-pulse-slow" style="width: 18%"></div>
                                </div>
                            </div>
                            <!-- Barra 4 -->
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm text-gaming-text-muted">Otros</span>
                                    <span class="text-sm text-gaming-warning">12%</span>
                                </div>
                                <div class="h-2 w-full bg-gaming-border rounded-full overflow-hidden">
                                    <div class="h-full bg-gaming-warning animate-pulse-slow" style="width: 12%"></div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Próximos Lanzamientos -->
                        <div class="bg-gaming-secondary/60 p-6 rounded-lg border border-gaming-border">
                            <h4 class="text-gaming-text font-medium mb-4">Próximos Lanzamientos</h4>
                            <ul class="space-y-3">
                                <li class="flex items-center justify-between p-2 rounded-lg bg-gaming-primary/50 hover:bg-gaming-primary transition-colors duration-300">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-gaming-accent flex items-center justify-center text-gaming-text mr-3 animate-pulse-slow">1</div>
                                        <span class="text-gaming-text">RTX 5090 Ultra</span>
                                    </div>
                                    <span class="text-xs text-gaming-accent-alt px-2 py-1 rounded-full bg-gaming-accent-alt/10">En 15 días</span>
                                </li>
                                <li class="flex items-center justify-between p-2 rounded-lg bg-gaming-primary/50 hover:bg-gaming-primary transition-colors duration-300">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-gaming-accent-alt flex items-center justify-center text-gaming-text mr-3 animate-pulse-slow">2</div>
                                        <span class="text-gaming-text">AMD Ryzen 9000X</span>
                                    </div>
                                    <span class="text-xs text-gaming-accent px-2 py-1 rounded-full bg-gaming-accent/10">En 30 días</span>
                                </li>
                                <li class="flex items-center justify-between p-2 rounded-lg bg-gaming-primary/50 hover:bg-gaming-primary transition-colors duration-300">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-gaming-warning flex items-center justify-center text-gaming-text mr-3 animate-pulse-slow">3</div>
                                        <span class="text-gaming-text">Teclado Quantum RGB</span>
                                    </div>
                                    <span class="text-xs text-gaming-warning px-2 py-1 rounded-full bg-gaming-warning/10">En 45 días</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
