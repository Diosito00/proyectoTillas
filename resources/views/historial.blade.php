<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Compras | Tillas</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="icon" href="{{ asset('imagenes/Logo-blanco.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/style-navbar.css') }}?v={{ time() }}">
</head>
<body class="bg-light">

    <x-navbar/>

    <div class="container py-5" style="margin-top: 80px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0"><i class="bi bi-bag-check text-dark me-2"></i>Mis Compras</h2>
            <a href="{{ route('catalogo') }}" class="btn btn-outline-dark btn-sm rounded-3">
                <i class="bi bi-arrow-left me-1"></i> Seguir comprando
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4 border-0 shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="submit" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($compras->isEmpty())
            <div class="card border-0 shadow-sm rounded-4 text-center p-5 bg-white">
                <i class="bi bi-emoji-frown fs-1 text-muted mb-3"></i>
                <h4 class="fw-bold">Todavía no realizaste ninguna compra</h4>
                <p class="text-muted mb-4">Explorá nuestro catálogo dinámico y encontrá tus tillas favoritas.</p>
                <div>
                    <a href="{{ route('catalogo') }}" class="btn btn-dark px-4 py-2 rounded-3 text-uppercase fw-bold small">Ver catálogo</a>
                </div>
            </div>
        @else
            @foreach($compras as $compra)
                <div class="card border-0 shadow-sm rounded-4 mb-4 bg-white overflow-hidden">
                    {{-- Encabezado de la Tarjeta de Compra --}}
                    <div class="card-header bg-dark text-white p-3 d-flex flex-wrap justify-content-between align-items-center gap-2">
                        <div>
                            <span class="text-muted small text-uppercase tracking-wider">Pedido N° #{{ $compra->id }}</span>
                            <div class="small text-white-50">Fecha: {{ \Carbon\Carbon::parse($compra->fecha)->format('d/m/Y H:i') }}</div>
                        </div>
                        <div class="text-md-end">
                            <span class="text-white-50 small d-block">Total abonado:</span>
                            <span class="fs-5 fw-bold text-warning">${{ number_format($compra->total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    {{-- Cuerpo con los productos comprados --}}
                    <div class="card-body p-4">
                        <p class="text-muted small mb-3"><i class="bi bi-truck me-2"></i><strong>Dirección de entrega:</strong> {{ $compra->direccion }}</p>
                        
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <thead class="table-light rounded-3 small text-muted text-uppercase">
                                    <tr>
                                        <th>Producto</th>
                                        <th class="text-center">Talle</th>
                                        <th class="text-center">Cantidad</th>
                                        <th class="text-end">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($compra->detalles as $detalle)
                                        <tr class="border-bottom">
                                            <td>
                                                <div class="d-flex align-items-center py-2">
                                                    @if($detalle->producto)
                                                        <img src="{{ asset('imagenes/' . $detalle->producto->imagen_url) }}" alt="" width="50" height="50" class="rounded object-fit-cover me-3 bg-light">
                                                        <div>
                                                            <h6 class="fw-bold mb-0 small">{{ $detalle->producto->nombre }}</h6>
                                                            <small class="text-muted">{{ $detalle->producto->marca }}</small>
                                                        </div>
                                                    @else
                                                        <span class="text-muted small">Producto no disponible</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="text-center fw-bold text-secondary small">{{ $detalle->talle }}</td>
                                            <td class="text-center font-monospace">{{ $detalle->cantidad }}</td>
                                            <td class="text-end fw-bold text-dark">${{ number_format($detalle->precio_unitario * $detalle->cantidad, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>