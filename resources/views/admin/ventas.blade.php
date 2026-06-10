<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Ventas | Panel Admin</title>
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
                <div class="mb-4 d-flex justify-content-between align-items-center">
                    <h2 class="fw-bold m-0"><i class="bi bi-currency-dollar text-success me-2"></i>Ventas Realizadas</h2>
                </div>

                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="ps-4 py-3">N° Factura</th>
                                        <th class="py-3">Cliente</th>
                                        <th class="py-3">Email</th>
                                        <th class="py-3">Fecha y Hora</th>
                                        <th class="py-3 text-end">Total Facturado</th>
                                        <th class="pe-4 py-3 text-center">Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($ventas as $venta)
                                        <tr>
                                            <td class="ps-4 text-muted fw-bold">#{{ str_pad($venta->id, 6, '0', STR_PAD_LEFT) }}</td>
                                            <td class="fw-bold">{{ $venta->user->name ?? 'Cliente Eliminado' }}</td>
                                            <td>{{ $venta->user->email ?? 'N/A' }}</td>
                                            <td>{{ $venta->created_at->format('d/m/Y H:i') }} hs</td>
                                            <td class="text-end fw-bold text-success fs-5">
                                                ${{ number_format($venta->total, 0, ',', '.') }}
                                            </td>
                                            <td class="pe-4 text-center">
                                                {{-- Badge dinámico para simular el flujo logístico --}}
                                                <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-bold">
                                                    <i class="bi bi-check2-circle me-1"></i> Aprobado
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-5 text-muted">
                                                <i class="bi bi-cash-stack fs-1 d-block mb-2"></i>
                                                Aún no se han registrado transacciones comerciales.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    {{-- Paginación --}}
                    <div class="card-footer bg-white border-0 py-3">
                        {{ $ventas->links() }}
                    </div>
                </div>
            </main>    
        </div>    
    </div>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>