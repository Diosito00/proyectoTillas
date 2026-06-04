<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Compra | Tillas</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style-navbar.css') }}?v={{ time() }}">
</head>
<body class="bg-light">

    <x-navbar/>

    <div class="container py-5">
        <h2 class="fw-bold mb-4"><i class="bi bi-credit-card me-2"></i>Finalizar tu Compra</h2>

        <div class="row g-4">
            {{-- Columna Izquierda: Formulario de Envío y Pago --}}
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
                    <h5 class="fw-bold mb-3"><i class="bi bi-geo-alt me-2"></i>Datos de Entrega</h5>
                    
                    <form action="{{ route('checkout.procesar') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-bold">Dirección de envío</label>
                            <input type="text" name="direccion" class="form-control py-2" placeholder="Ej: Av. Siempreviva 742" required>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label class="form-label fw-bold">Teléfono de contacto</label>
                                <input type="text" name="telefono" class="form-control py-2" placeholder="Ej: 1123456789" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Código Postal</label>
                                <input type="text" class="form-control py-2" placeholder="Ej: 1425">
                            </div>
                        </div>

                        <h5 class="fw-bold mb-3 border-top pt-4"><i class="bi bi-wallet2 me-2"></i>Método de Pago</h5>
                        <div class="form-check p-3 border rounded-3 mb-4 bg-light d-flex align-items-center gap-3">
                            <input class="form-check-input ms-1" type="radio" name="pago" id="pagoEfectivo" checked>
                            <label class="form-check-label fw-bold" for="pagoEfectivo">
                                <i class="bi bi-cash-coin me-2 text-success"></i> Efectivo / Transferencia (Acordar con el vendedor)
                            </label>
                        </div>

                        <button type="submit" class="btn btn-dark btn-lg w-100 py-3 fw-bold text-uppercase rounded-3">
                            Confirmar y Pagar <i class="bi bi-bag-check-fill ms-2"></i>
                        </button>
                    </form>
                </div>
            </div>

            {{-- Columna Derecha: Resumen del Pedido --}}
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white sticky-top" style="top: 100px;">
                    <h5 class="fw-bold mb-3">Resumen del Pedido</h5>
                    
                    <div class="mb-3 overflow-auto" style="max-height: 250px;">
                        @foreach($carrito as $item)
                            <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                                <div class="d-flex align-items-center">
                                
                                    <img src="{{ asset('imagenes/' . $item['imagen']) }}" alt="{{ $item['nombre'] }}" width="50" height="50" class="rounded object-fit-cover me-3">
                                    <div>
                                        <h6 class="fw-bold mb-0 small">{{ $item['nombre'] }}</h6>
                                        <small class="text-muted">Talle: {{ $item['talle'] }} x {{ $item['cantidad'] }}</small>
                                    </div>
                                </div>
                                <span class="fw-bold small">${{ number_format($item['precio'] * $item['cantidad'], 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-between align-items-center border-top pt-3">
                        <span class="fs-5 fw-bold">Total a pagar:</span>
                        <span class="fs-4 fw-bold text-primary">${{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>