<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistema de Inventario') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    <style>
        /* Tema Futurista Natural */
        :root {
            --bg-primary: #1a202c; /* dark-space */
            --bg-secondary: #0a3d2e; /* forest-deep */
            --text-light: #e2e8f0; /* light-mist */
            --text-accent: #00ffcc; /* futuristic-green */
            --border-color: #233554; /* Azul grisáceo - mantener o ajustar si es necesario */
            --primary-color: #00ffcc; /* futuristic-green para acentos */
            --success-color: #36d1dc; /* Cian - mantener o ajustar si es necesario */
            --danger-color: #ff6b6b; /* Rojo coral - mantener o ajustar si es necesario */
            --warning-color: #ffd166; /* Amarillo - mantener o ajustar si es necesario */
            --card-bg: #0a3d2e; /* forest-deep */
            --card-border: #233554; /* Borde de tarjeta - mantener o ajustar si es necesario */
        }

        body {
            background-color: var(--bg-primary);
            color: var(--text-light);
            font-family: 'figtree', sans-serif; /* Usar la fuente existente */
        }

        .bg-dark-secondary {
            background-color: var(--bg-secondary);
        }

        .dark\:bg-gray-800 {
             background-color: var(--card-bg);
        }

        .dark\:text-gray-200 {
            color: var(--text-light);
        }

        .dark\:text-gray-700 {
             color: var(--text-light);
        }

        .dark\:border-gray-700 {
            border-color: var(--border-color);
        }

        .border-dark {
            border-color: var(--border-color);
        }

        .text-muted {
            color: var(--text-muted);
        }

        /* Personalización de DataTables para tema futurista natural */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_processing,
        .dataTables_wrapper .dataTables_paginate {
            color: var(--text-light);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: var(--text-light) !important;
            border-color: var(--border-color);
        }

         .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: var(--primary-color) !important;
            color: var(--bg-primary) !important;
            border-color: var(--primary-color);
        }

        table.dataTable tbody tr {
            background-color: var(--bg-secondary);
            color: var(--text-light);
        }

        table.dataTable.stripe tbody tr.odd {
            background-color: var(--bg-primary);
        }

        table.dataTable.hover tbody tr:hover,
        table.dataTable.hover tbody tr.odd:hover,
        table.dataTable.even:hover {
            background-color: rgba(100, 255, 218, 0.1) !important; /* Verde menta semi-transparente */
        }

        table.dataTable thead th,
        table.dataTable thead td,
        table.dataTable tfoot th,
        table.dataTable tfoot td {
            background-color: var(--bg-secondary);
            color: var(--text-accent);
            border-color: var(--border-color);
        }

        /* Personalización de formularios */
        .form-input,
        .form-select,
        .form-textarea {
            background-color: var(--bg-secondary);
            border-color: var(--border-color);
            color: var(--text-light);
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(100, 255, 218, 0.2);
        }

        /* Estilos para los enlaces del dashboard */
        .dashboard-link {
            background: linear-gradient(135deg, #3a7bd5, #00d2ff); /* Degradado azul */
            color: white;
            border-radius: 0.5rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .dashboard-link:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .dashboard-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.1);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .dashboard-link:hover::before {
            opacity: 1;
        }

        /* Colores específicos para cada enlace */
        .dashboard-link.products {
             background: linear-gradient(135deg, #64ffda, #36d1dc); /* Verde menta a cian */
        }

        .dashboard-link.suppliers {
            background: linear-gradient(135deg, #a8ff78, #78ffd6); /* Verde claro a turquesa */
        }

        .dashboard-link.clients {
            background: linear-gradient(135deg, #f7b733, #fc4a1a); /* Amarillo a naranja */
        }

        .dashboard-link.stock-entries {
            background: linear-gradient(135deg, #fc00ff, #00dbde); /* Magenta a cian */
        }

        .dashboard-link.stock-exits {
            background: linear-gradient(135deg, #ff4e50, #f9d423); /* Rojo a amarillo */
        }

        /* Animación simple */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.02); }
            100% { transform: scale(1); }
        }

        .animate-pulse-subtle:hover {
            animation: pulse 1s infinite ease-in-out;
        }

    </style>
</head>
<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-dark">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-dark-secondary shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Flash Messages -->
        @if (session('success'))
            <div class="max-w-7xl mx-auto mt-4 px-4 sm:px-6 lg:px-8">
                <div class="bg-green-500 text-white p-4 rounded-md shadow-sm">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="max-w-7xl mx-auto mt-4 px-4 sm:px-6 lg:px-8">
                <div class="bg-red-500 text-white p-4 rounded-md shadow-sm">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>

    <!-- Inicialización de DataTables -->
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

    @stack('scripts')
</body>
</html>