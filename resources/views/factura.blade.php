<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura Comercial | Tillas</title>
    {{-- Estilos de Bootstrap para armar la estructura rápidamente --}}
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="icon" href="{{ asset('imagenes/Logo-blanco.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    {{-- Estilos personalizados para la factura --}}
    <link rel="stylesheet" href="{{ asset('css/style-factura.css') }}?v={{ time() }}">
</head>
<body>

    {{-- BOTONERA SUPERIOR (No se muestra al imprimir) --}}
    <div class="container no-print mt-4 text-center">
        <a href="{{ route('compras.historial') }}" class="btn btn-secondary btn-sm me-2">
            <i class="bi bi-arrow-left"></i> Volver al Historial
        </a>
        <button onclick="window.print();" class="btn btn-dark btn-sm">
            <i class="bi bi-printer"></i> Imprimir Comprobante
        </button>
    </div>

    {{-- CONTENEDOR DE LA FACTURA --}}
    <div class="invoice-box">
        
        {{-- Encabezado principal del comprobante --}}
        <div class="row align-items-center border-bottom pb-4 mb-4">
            <div class="col-6">
                <span class="invoice-logo text-dark">Tillas <i class="bi bi-radial-gradient"></i></span>
                <p class="text-muted small mb-0">Tienda Oficial de Calzado Urbano<br>Corrientes, Argentina</p>
            </div>
            <div class="col-6 text-end">
                <h4 class="fw-bold text-uppercase text-secondary mb-1">Factura B</h4>
                {{-- Lee el accesor dinámico virtual de tu modelo Venta --}}
                <p class="mb-0 fw-bold">N°: {{ $venta->numero_factura }}</p>
                <p class="text-muted small mb-0">Fecha Emisión: {{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        {{-- Información cruzada del cliente y la logística --}}
        <div class="row mb-4">
            <div class="col-6">
                <h6 class="fw-bold text-muted text-uppercase small">Cliente</h6>
                <p class="mb-0 fw-bold text-dark">{{ auth()->user()->name }}</p>
                <p class="text-muted small mb-0">{{ auth()->user()->email }}</p>
            </div>
            <div class="col-6 text-end">
                <h6 class="fw-bold text-muted text-uppercase small">Datos de Entrega / Pago</h6>
                <p class="mb-0 text-dark small"><i class="bi bi-geo-alt"></i> {{ $venta->direccion }}</p>
                <p class="text-muted small mb-0">Condición: Efectivo / Transferencia</p>
            </div>
        </div>

        {{-- Tabla de artículos comprados --}}
        <table class="table table-borderless border-top border-bottom my-4">
            <thead>
                <tr class="text-muted small text-uppercase">
                    <th>Descripción Producto</th>
                    <th class="text-center">Talle</th>
                    <th class="text-center">Cant.</th>
                    <th class="text-end">Precio Unit.</th>
                    <th class="text-end">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                {{-- Recorre cada zapatilla guardada en el detalle de esta venta específica --}}
                @foreach($venta->detalles as $detalle)
                    <tr>
                        <td class="fw-bold text-dark">
                            {{ $detalle->producto ? $detalle->producto->nombre : 'Producto no disponible' }}
                            @if($detalle->producto)
                                <br><small class="text-muted fw-normal">{{ $detalle->producto->marca }}</small>
                            @endif
                        </td>
                        <td class="text-center">{{ $detalle->talle }}</td>
                        <td class="text-center">{{ $detalle->cantidad }}</td>
                        <td class="text-end">${{ number_format($detalle->precio_unitario, 0, ',', '.') }}</td>
                        <td class="text-end fw-bold">${{ number_format($detalle->precio_unitario * $detalle->cantidad, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Bloque final con la sumatoria del costo total --}}
        <div class="row justify-content-end">
            <div class="col-5 text-end">
                <div class="d-flex justify-content-between border-bottom pb-2 mb-2">
                    <span class="text-muted">Subtotal:</span>
                    <span class="fw-bold">${{ number_format($venta->total, 0, ',', '.') }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fs-5 fw-bold text-dark">Total Neto:</span>
                    <span class="fs-4 fw-bold text-primary">${{ number_format($venta->total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        {{-- Pie de página de validez académica --}}
        <div class="text-center border-top pt-4 mt-5">
            <p class="text-muted small mb-0">Gracias por tu compra en Tillas.</p>
        </div>
    </div>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>