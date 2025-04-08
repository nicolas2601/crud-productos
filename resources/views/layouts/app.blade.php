<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Tienda Anime y Videojuegos')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    @yield('styles')
</head>
<body>
    <header class="bg-gray-900 text-white">
        <nav class="container mx-auto px-6 py-3">
            <div class="flex items-center justify-between">
                <a class="text-xl font-bold" href="{{ url('/') }}">
                    <i class="fas fa-gamepad mr-2"></i>Anime Store
                </a>
                <div class="hidden md:flex space-x-6">
                    <a class="hover:text-purple-400 {{ request()->routeIs('productos.*') ? 'text-purple-400' : '' }}" href="{{ route('productos.index') }}">
                        <i class="fas fa-box mr-1"></i>Productos
                    </a>
                    <a class="hover:text-purple-400 {{ request()->routeIs('proveedores.*') ? 'text-purple-400' : '' }}" href="{{ route('proveedores.index') }}">
                        <i class="fas fa-truck mr-1"></i>Proveedores
                    </a>
                    <a class="hover:text-purple-400 {{ request()->routeIs('entradas.*') ? 'text-purple-400' : '' }}" href="{{ route('entradas.create') }}">
                        <i class="fas fa-plus-circle mr-1"></i>Nueva Entrada
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-white py-8 mt-8">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <h5 class="text-xl font-bold"><i class="fas fa-gamepad mr-2"></i>Anime Store</h5>
                    <p class="text-gray-400">Tu tienda de productos de anime y videojuegos favorita.</p>
                </div>
                <div class="text-gray-400">
                    <p>&copy; {{ date('Y') }} Anime Store. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Custom JS -->
    <script src="{{ asset('js/app.js') }}"></script>
    
    @yield('scripts')
</body>
</html>