{{-- BOTÓN MÓVIL (Solo visible en celulares y tablets pequeñas) --}}
<div class="col-12 d-md-none bg-white p-3 border-bottom d-flex justify-content-between align-items-center shadow-sm">
    <span class="fw-bold text-dark"><i class="bi bi-shield-lock-fill text-primary me-2"></i>Panel Admin</span>
    <button class="btn btn-outline-dark btn-sm fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-expanded="false" aria-controls="sidebarMenu">
        <i class="bi bi-list fs-5 me-1"></i> Menú
    </button>
</div>

{{-- BARRA LATERAL (Le agregamos el id="sidebarMenu") --}}
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-white shadow-sm sidebar-admin collapse pt-4">
    <div class="position-sticky px-3">
        
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mb-3 text-muted text-uppercase fw-bold">
            <span>Menú Principal</span>
        </h6>
        
        <ul class="nav flex-column gap-2 mb-4">
            <li class="nav-item">
                <a class="nav-link fw-bold px-3 py-2 {{ request()->routeIs('admin.index') ? 'active bg-primary text-white rounded-3' : 'text-dark fw-semibold' }}" href="{{ route('admin.index') }}">
                    <i class="bi bi-speedometer2 me-2 {{ request()->routeIs('admin.index') ? 'text-white' : 'text-primary' }}"></i> Inicio
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-bold px-3 py-2 {{ request()->routeIs('admin.inventario') ? 'active bg-primary text-white rounded-3' : 'text-dark fw-semibold' }}" href="{{ route('admin.inventario') }}">
                    <i class="bi bi-box-seam me-2 {{ request()->routeIs('admin.inventario') ? 'text-white' : '' }}"></i> Inventario
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-bold px-3 py-2 {{ request()->routeIs('admin.ventas') ? 'active bg-primary text-white rounded-3' : 'text-dark fw-semibold' }}" href="{{ route('admin.ventas') }}">
                    <i class="bi bi-currency-dollar me-2 {{ request()->routeIs('admin.ventas') ? 'text-white' : 'text-success' }}"></i> Ventas Realizadas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-bold px-3 py-2 {{ request()->routeIs('admin.mensajes') ? 'active bg-primary text-white rounded-3' : 'text-dark fw-semibold' }}" href="{{ route('admin.mensajes') }}">
                    <i class="bi bi-envelope-fill me-2 {{ request()->routeIs('admin.mensajes') ? 'text-white' : 'text-primary' }}"></i> Bandeja de Entrada
                </a>
            </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mb-3 text-muted text-uppercase fw-bold">
            <span>Gestión</span>
        </h6>
        
        <ul class="nav flex-column gap-2 mb-4">
            <li class="nav-item">
                <a class="nav-link fw-bold px-3 py-2 {{ request()->routeIs('admin.create') ? 'active bg-primary text-white rounded-3' : 'text-dark fw-semibold' }}" href="{{ route('admin.create') }}">
                    <i class="bi bi-plus-lg me-2 {{ request()->routeIs('admin.create') ? 'text-white' : 'text-primary' }}"></i> Nueva Zapatilla
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-bold px-3 py-2 {{ request()->routeIs('admin.usuarios') ? 'active bg-primary text-white rounded-3' : 'text-dark fw-semibold' }}" href="{{ route('admin.usuarios') }}">
                    <i class="bi bi-people-fill me-2 {{ request()->routeIs('admin.usuarios') ? 'text-white' : 'text-dark' }}"></i> Usuarios
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-bold px-3 py-2 {{ request()->routeIs('admin.usuarios.create') ? 'active bg-primary text-white rounded-3' : 'text-dark fw-semibold' }}" href="{{ route('admin.usuarios.create') }}">
                    <i class="bi bi-person-plus-fill me-2 {{ request()->routeIs('admin.usuarios.create') ? 'text-white' : 'text-dark' }}"></i> Nuevo Admin
                </a>
            </li>
        </ul>
        
    </div>
</nav>