<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control | Tillas</title>
    <link rel="icon" href="{{ asset('imagenes/Logo-blanco.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style-navbar.css') }}?v={{ time() }}">
</head>
<body class="bg-light">
    
    <x-navbar/>

    <div class="container-fluid">
        <div class="row">
            <x-sidebar/>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-5 py-4">
                
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-3 mb-4 border-bottom">
                    <div>
                        <h1 class="fw-bold m-0 text-dark">¡Hola, {{ Auth::user()->name ?? 'Administrador' }}! 👋</h1>
                        <p class="text-muted mt-1 mb-0">Bienvenido al panel de control de Tillas. Aquí tienes el resumen de tu negocio.</p>
                    </div>
                </div>

                {{-- 1. Tarjetas de Resumen (KPIs) --}}
                <div class="row g-3 mb-5">
                    
                    {{-- Tarjeta: Dinero Ingresado --}}
                    <div class="col-md-6 col-xl-3">
                        <div class="card bg-success text-white border-0 shadow-sm rounded-4 p-4 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="fw-bold mb-0 text-uppercase tracking-wide">Ingresos Totales</h6>
                                <i class="bi bi-cash-coin fs-3 opacity-50"></i>
                            </div>
                            <h2 class="fw-bold mb-0">${{ number_format($totalVentas, 0, ',', '.') }}</h2>
                        </div>
                    </div>

                    {{-- Tarjeta: Zapatillas Activas --}}
                    <div class="col-md-6 col-xl-3">
                        <div class="card bg-primary text-white border-0 shadow-sm rounded-4 p-4 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="fw-bold mb-0 text-uppercase tracking-wide">Catálogo</h6>
                                <i class="bi bi-box-seam fs-3 opacity-50"></i>
                            </div>
                            <h2 class="fw-bold mb-0">{{ $totalProductos }} <span class="fs-6 fw-normal">Modelos</span></h2>
                        </div>
                    </div>

                    {{-- Tarjeta: Usuarios Registrados --}}
                    <div class="col-md-6 col-xl-3">
                        <div class="card bg-dark text-white border-0 shadow-sm rounded-4 p-4 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="fw-bold mb-0 text-uppercase tracking-wide">Clientes</h6>
                                <i class="bi bi-people-fill fs-3 opacity-50"></i>
                            </div>
                            <h2 class="fw-bold mb-0">{{ $totalUsuarios }} <span class="fs-6 fw-normal">Cuentas</span></h2>
                        </div>
                    </div>

                    {{-- Tarjeta: Alertas de Stock --}}
                    <div class="col-md-6 col-xl-3">
                        <div class="card {{ $alertasStock > 0 ? 'bg-danger' : 'bg-secondary' }} text-white border-0 shadow-sm rounded-4 p-4 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="fw-bold mb-0 text-uppercase tracking-wide">Alertas de Stock</h6>
                                <i class="bi bi-exclamation-triangle-fill fs-3 opacity-50"></i>
                            </div>
                            <h2 class="fw-bold mb-0">{{ $alertasStock }} <span class="fs-6 fw-normal">Talles bajos</span></h2>
                        </div>
                    </div>

                </div>

                {{-- 2. Tablas de Actividad Reciente --}}
                <div class="row g-4 mb-4">
                    
                    {{-- Columna Izquierda: Últimas 5 Ventas --}}
                    <div class="col-lg-7">
                        <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                            <div class="card-header bg-white border-bottom-0 pt-4 pb-2 px-4 d-flex justify-content-between align-items-center">
                                <h5 class="fw-bold m-0"><i class="bi bi-cart-check-fill text-success me-2"></i>Últimas Ventas</h5>
                                <a href="{{ route('admin.ventas') }}" class="btn btn-sm btn-outline-dark fw-bold rounded-pill px-3">Ver todo</a>
                            </div>
                            <div class="card-body p-0 mt-2">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="table-light text-muted small text-uppercase">
                                            <tr>
                                                <th class="ps-4 py-3">Cliente</th>
                                                <th class="py-3">Fecha</th>
                                                <th class="pe-4 py-3 text-end">Monto</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($ultimasVentas as $venta)
                                                <tr>
                                                    <td class="ps-4 fw-bold">{{ $venta->user->name ?? 'Usuario Eliminado' }}</td>
                                                    <td class="text-muted small">{{ $venta->created_at->format('d/m/Y') }}</td>
                                                    <td class="pe-4 text-end fw-bold text-success">${{ number_format($venta->total, 0, ',', '.') }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center py-4 text-muted">Aún no hay ventas registradas.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Columna Derecha: Últimos Mensajes --}}
                    <div class="col-lg-5">
                        <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                            <div class="card-header bg-white border-bottom-0 pt-4 pb-2 px-4 d-flex justify-content-between align-items-center">
                                <h5 class="fw-bold m-0"><i class="bi bi-chat-left-text-fill text-primary me-2"></i>Mensajes Recientes</h5>
                                <a href="{{ route('admin.mensajes') }}" class="btn btn-sm btn-outline-primary fw-bold rounded-pill px-3">Ver inbox</a>
                            </div>
                            <div class="card-body p-0 mt-2">
                                <div class="list-group list-group-flush">
                                    @forelse($ultimosMensajes as $mensaje)
                                        <div class="list-group-item px-4 py-3">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <span class="fw-bold">{{ $mensaje->nombre }}</span>
                                                <small class="text-muted">{{ $mensaje->created_at->diffForHumans() }}</small>
                                            </div>
                                            <p class="mb-0 small text-truncate text-muted" style="max-width: 250px;">{{ $mensaje->mensaje }}</p>
                                        </div>
                                    @empty
                                        <div class="text-center py-4 text-muted">No hay mensajes recientes en la bandeja.</div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>