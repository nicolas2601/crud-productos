@extends('layouts.app')

@section('styles')
<style>
    .hero-section {
        background: linear-gradient(135deg, #4a6cf7 0%, #6a3093 100%);
        color: white;
        padding: 5rem 0;
        border-radius: 0.5rem;
        margin-bottom: 3rem;
    }
    .feature-card {
        transition: all 0.3s ease;
        height: 100%;
    }
    .feature-card:hover {
        transform: translateY(-10px);
    }
    .feature-icon {
        font-size: 2.5rem;
        margin-bottom: 1.5rem;
        color: #4a6cf7;
    }
    .stats-card {
        border-left: 5px solid #4a6cf7;
    }
</style>
@endsection

@section('content')
<div class="container-fluid fade-in">
    <!-- Hero Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="hero-section text-center">
                <h1 class="display-4 mb-3">Sistema de Gestión de Inventario</h1>
                <p class="lead mb-4">Administra tus proveedores, productos y entradas de inventario de manera eficiente</p>
                <div class="mt-4">
                    <a href="{{ route('entradas.create') }}" class="btn btn-light btn-lg me-2">
                        <i class="fas fa-plus-circle me-2"></i>Nueva Entrada
                    </a>
                    <a href="{{ route('productos.index') }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-box me-2"></i>Ver Productos
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="row mb-5">
        <div class="col-12 text-center mb-4">
            <h2>Características Principales</h2>
            <p class="text-muted">Descubre todas las funcionalidades que nuestro sistema ofrece</p>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card feature-card">
                <div class="card-body text-center">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4>Gestión de Proveedores</h4>
                    <p>Administra la información de tus proveedores, incluyendo datos de contacto y productos asociados.</p>
                    <a href="{{ route('proveedores.index') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-right me-1"></i> Ir a Proveedores
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card feature-card">
                <div class="card-body text-center">
                    <div class="feature-icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <h4>Control de Productos</h4>
                    <p>Mantén un registro detallado de tus productos, incluyendo stock, precios y proveedores.</p>
                    <a href="{{ route('productos.index') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-right me-1"></i> Ir a Productos
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card feature-card">
                <div class="card-body text-center">
                    <div class="feature-icon">
                        <i class="fas fa-truck-loading"></i>
                    </div>
                    <h4>Entradas de Inventario</h4>
                    <p>Registra las entradas de productos al inventario y genera facturas automáticamente.</p>
                    <a href="{{ route('entradas.index') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-right me-1"></i> Ir a Entradas
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="row mb-5">
        <div class="col-12 text-center mb-4">
            <h2>Estadísticas del Sistema</h2>
            <p class="text-muted">Resumen de la información registrada en el sistema</p>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted">Total de Proveedores</h6>
                            <h2 class="counter">{{ \App\Models\Proveedor::count() }}</h2>
                        </div>
                        <div>
                            <i class="fas fa-users fa-3x text-primary opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted">Total de Productos</h6>
                            <h2 class="counter">{{ \App\Models\Producto::count() }}</h2>
                        </div>
                        <div>
                            <i class="fas fa-box fa-3x text-primary opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted">Entradas Registradas</h6>
                            <h2 class="counter">{{ \App\Models\Entrada::count() }}</h2>
                        </div>
                        <div>
                            <i class="fas fa-truck-loading fa-3x text-primary opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Animación para las tarjetas de características
    anime({
        targets: '.feature-card',
        translateY: [50, 0],
        opacity: [0, 1],
        delay: anime.stagger(100),
        easing: 'easeOutExpo'
    });
    
    // Animación para la sección de héroe
    anime({
        targets: '.hero-section',
        translateY: [30, 0],
        opacity: [0, 1],
        duration: 1000,
        easing: 'easeOutQuad'
    });
    
    // Animación para los contadores de estadísticas
    anime({
        targets: '.counter',
        innerHTML: [0, el => el.innerHTML],
        easing: 'linear',
        round: true,
        duration: 2000
    });
</script>
@endsection
