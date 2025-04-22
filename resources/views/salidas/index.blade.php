@extends('layouts.app')

@section('content')
<div class="container-fluid fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Listado de Salidas de Inventario</h1>
        <a href="{{ route('salidas.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Registrar Nueva Salida
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Fecha Salida</th>
                            <th>Motivo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($salidas as $salida)
                            <tr>
                                <td>{{ $salida->id }}</td>
                                <td>{{ $salida->producto->nombre ?? 'Producto no encontrado' }}</td>
                                <td>{{ $salida->cantidad }}</td>
                                <td>{{ $salida->fecha_salida->format('d/m/Y H:i') }}</td>
                                <td>{{ $salida->motivo ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('salidas.show', $salida->id) }}" class="btn btn-sm btn-info me-1" title="Ver Detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('salidas.edit', $salida->id) }}" class="btn btn-sm btn-warning me-1" title="Editar Motivo">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    {{-- No se incluye botón de eliminar según rutas --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No hay salidas de inventario registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Paginación --}}
            @if ($salidas->hasPages())
                <div class="d-flex justify-content-center mt-3">
                    {{ $salidas->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Animación para la tabla
    anime({
        targets: '.table tbody tr',
        translateY: [50, 0],
        opacity: [0, 1],
        delay: anime.stagger(100), // Retraso escalonado para cada fila
        easing: 'easeOutExpo'
    });
</script>
@endsection