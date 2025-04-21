@extends('layouts.app')

@section('content')
<div class="container-fluid fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Papelera de Proveedores</h1>
        <a href="{{ route('proveedores.index') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left me-1"></i> Volver al Listado
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            @if($proveedoresTrashed->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Empresa</th>
                                <th>Contacto</th>
                                <th>Fecha de Eliminación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($proveedoresTrashed as $proveedor)
                                <tr>
                                    <td>{{ $proveedor->id }}</td>
                                    <td>{{ $proveedor->nombre }}</td>
                                    <td>{{ $proveedor->empresa }}</td>
                                    <td>{{ $proveedor->contacto }}</td>
                                    <td>{{ $proveedor->deleted_at->format('d/m/Y H:i:s') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <form action="{{ route('proveedores.restore', $proveedor->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-success" title="Restaurar">
                                                    <i class="fas fa-trash-restore"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('proveedores.force-delete', $proveedor->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Está seguro de eliminar permanentemente este proveedor?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Eliminar permanentemente">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $proveedoresTrashed->links() }}
                </div>
            @else
                <div class="alert alert-info">
                    No hay proveedores en la papelera.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Animación específica para la tabla de proveedores en papelera
    anime({
        targets: 'tbody tr',
        translateY: [20, 0],
        opacity: [0, 1],
        delay: anime.stagger(50),
        easing: 'easeOutExpo'
    });
</script>
@endsection