<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Carrito | Tillas</title>
    <link rel="icon" href="{{ asset('imagenes/Logo-blanco.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style-inicio.css') }}?v={{ time() }}">
</head>
<body class="bg-light">
    <x-navbar/>

    <div class="container py-5 my-5">
        <h2 class="fw-bold text-uppercase tracking-wide mb-4">Mi Carrito de Compras</h2>
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4 border-0 shadow-sm rounded-3" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ $errors->first() }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(count($carrito) > 0)
            <div class="row">
                <div class="col-lg-8 mb-4">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="card-body p-0">
                            <table class="table table-hover mb-0 align-middle">
                                <thead class="table-light text-muted small text-uppercase">
                                    <tr>
                                        <th class="ps-4 py-3">Producto</th>
                                        <th class="py-3 text-center">Talle</th>
                                        <th class="py-3 text-center">Cantidad</th>
                                        <th class="py-3 text-end pe-4">Precio unitario</th>
                                        <th class="py-3 text-center"></th> {{-- Columna para el botón eliminar --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($carrito as $id => $item)
                                        <tr>
                                            <td class="ps-4 py-3 d-flex align-items-center">
                                                <img src="{{ asset('imagenes/' . $item['imagen']) }}" alt="{{ $item['nombre'] }}" width="60" class="rounded me-3 object-fit-cover">
                                                <span class="fw-bold">{{ $item['nombre'] }}</span>
                                            </td>
                                            <td class="py-3 text-center text-muted">{{ $item['talle'] }}</td>
                                            {{-- Columna de Cantidad Interactiva --}}
                                            <td class="align-middle">
                                                <form action="{{ route('carrito.actualizar') }}" method="POST" class="m-0">
                                                    @csrf
                                                    @method('PUT')
                                                    {{-- Enviamos el ID único de este renglón oculto --}}
                                                    <input type="hidden" name="id_unico" value="{{ $id }}">
                                                    
                                                    {{-- Input numérico que envía el formulario automáticamente al cambiar --}}
                                                    <input type="number" name="cantidad" value="{{ $item['cantidad'] }}" 
                                                        min="1" class="form-control text-center mx-auto fw-bold shadow-sm" 
                                                        style="width: 80px;" 
                                                        onchange="this.form.submit()" 
                                                        title="Modificar cantidad">
                                                </form>
                                            </td>
                                            <td class="py-3 text-end pe-4 fw-bold">
                                                ${{ number_format($item['precio'], 0, ',', '.') }}
                                            </td>

                                            {{-- NUEVA CELDA: Botón de Eliminar --}}
                                            <td class="py-3 text-center">
                                                <form action="{{ route('carrito.eliminar') }}" method="POST" class="d-inline">
                                                    @csrf
                                                    {{-- Mandamos el ID oculto al controlador --}}
                                                    <input type="hidden" name="id_unico" value="{{ $id }}">
                                                    
                                                    <button type="submit" class="btn btn-link text-danger p-0" title="Eliminar producto">
                                                        <i class="bi bi-trash3-fill fs-5"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 bg-white p-4">
                        <h5 class="fw-bold mb-4 border-bottom pb-3">Resumen</h5>
                        
                        <div class="d-flex justify-content-between mb-3 text-muted">
                            <span>Subtotal</span>
                            <span>${{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-4 text-muted">
                            <span>Envío</span>
                            <span class="text-success fw-bold">Gratis</span>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-4 border-top pt-3">
                            <span class="fw-bold fs-5">Total</span>
                            <span class="fw-bold fs-4">${{ number_format($total, 0, ',', '.') }}</span>
                        </div>

                        <form action="{{ route('checkout') }}" method="POST">
                            @csrf
                            <!-- <button type="submit" class="btn btn-dark w-100 py-3 rounded-3 fw-bold text-uppercase tracking-wide">
                                Finalizar Compra <i class="bi bi-lock-fill ms-2"></i>
                            </button> -->

                            
                            {{-- ENLACE AL CHECKOUT:
                                Redirige al cliente desde la vista de control del carrito hacia el formulario de pago.
                                Usa las clases nativas 'btn-lg' y 'w-100' de Bootstrap para ocupar todo el ancho de forma responsiva. --}}
                            <a href="{{ route('checkout') }}" class="btn btn-dark btn-lg w-100 py-3 fw-bold text-uppercase">
                                Proceder al Pago <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center bg-white p-5 rounded-4 shadow-sm">
                <i class="bi bi-cart-x display-1 text-muted mb-3 d-block"></i>
                <h4 class="fw-bold">Tu carrito está vacío</h4>
                <p class="text-muted mb-4">¡Parece que todavía no elegiste tus próximas Tillas!</p>
                <a href="{{ route('catalogo') }}" class="btn btn-dark px-4 py-2 text-uppercase fw-bold rounded-3">Ir al Catálogo</a>
            </div>
        @endif
    </div>

    <x-footer/>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>