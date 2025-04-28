@extends('layouts.app')

@section('content')
<div class="container-fluid fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Listado de Proveedores</h1>
        <div>
            <a href="{{ route('proveedores.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Nuevo Proveedor
            </a>
            <a href="{{ route('proveedores.trash') }}" class="btn btn-secondary ms-2">
                <i class="fas fa-trash me-1"></i> Papelera
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @if($proveedores->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Empresa</th>
                                <th>Contacto</th>
                                <th>Fecha de Creación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($proveedores as $proveedor)
                                <tr>
                                    <td>{{ $proveedor->id }}</td>
                                    <td>{{ $proveedor->nombre }}</td>
                                    <td>{{ $proveedor->empresa }}</td>
                                    <td>{{ $proveedor->contacto }}</td>
                                    <td>{{ $proveedor->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('proveedores.show', $proveedor->id) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('proveedores.edit', $proveedor->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('proveedores.destroy', $proveedor->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Está seguro de eliminar este proveedor?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
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
                    {{ $proveedores->links() }}
                </div>
            @else
                <div class="alert alert-info">
                    No hay proveedores registrados.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Animación específica para la tabla de proveedores
    anime({
        targets: 'tbody tr',
        translateY: [20, 0],
        opacity: [0, 1],
        delay: anime.stagger(50),
        easing: 'easeOutExpo'
    });
</script>
@endsection