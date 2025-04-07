@extends('layouts.app')

@section('title', 'Papelera de Productos')

@section('styles')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
@endsection

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="display-5 fw-bold">Papelera</h1>
            <p class="text-muted">Productos eliminados temporalmente</p>
        </div>
        <div class="col-md-6 text-md-end d-flex align-items-center justify-content-md-end">
            <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>Volver a Productos
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            @if($productosEliminados->isEmpty())
            <div class="text-center py-5">
                <i class="bi bi-trash text-muted" style="font-size: 3rem;"></i>
                <h3 class="mt-3">La papelera está vacía</h3>
                <p class="text-muted">No hay productos eliminados para mostrar</p>
                <a href="{{ route('productos.index') }}" class="btn btn-primary mt-2">
                    <i class="bi bi-arrow-left me-2"></i>Volver a Productos
                </a>
            </div>
            @else
            <table id="productos-papelera-table" class="table table-striped dt-responsive nowrap w-100">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Eliminado el</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productosEliminados as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td>
                            @if($producto->imagen)
                            <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="img-thumbnail" width="50">
                            @else
                            <span class="badge bg-secondary">Sin imagen</span>
                            @endif
                        </td>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->categoria }}</td>
                        <td>${{ number_format($producto->precio, 2) }}</td>
                        <td>{{ $producto->deleted_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <form action="{{ route('productos.restaurar', $producto->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-success" title="Restaurar">
                                        <i class="bi bi-arrow-counterclockwise"></i>
                                    </button>
                                </form>
                                <form action="{{ route('productos.eliminar-permanente', $producto->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar permanentemente este producto? Esta acción no se puede deshacer.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Eliminar permanentemente">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#productos-papelera-table').DataTable({
            responsive: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
            }
        });
    });
</script>
@endsection