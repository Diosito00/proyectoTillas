<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $producto->nombre }} | Tillas</title>
    <link rel="icon" href="{{ asset('imagenes/Logo-blanco.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
    <x-navbar/>

    <div class="container py-2 my-2">
    {{-- Alerta de Éxito al agregar al carrito --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4 border-0 shadow-sm rounded-3" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                
                {{-- Botón rápido para ir a pagar --}}
                <a href="{{ route('carrito.index') }}" class="btn btn-sm btn-success ms-3 fw-bold text-uppercase">
                    Ver Carrito <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger mb-4 rounded-3 border-0">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ $errors->first() }}
            </div>
        @endif

        <a href="{{ route('catalogo') }}" class="text-dark text-decoration-none mb-4 d-inline-block">
            <i class="bi bi-arrow-left me-2"></i>Volver al catálogo
        </a>

        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <div class="bg-light rounded p-4 text-center">
                    <img src="{{ asset('imagenes/' . $producto->imagen_url) }}" class="img-fluid rounded shadow-sm" alt="{{ $producto->nombre }}">
                </div>
            </div>

            <div class="col-md-6 ps-md-5">
                <p class="text-muted text-uppercase tracking-wide mb-1 fw-bold">{{ $producto->marca }}</p>
                <h1 class="display-5 fw-bold mb-3">{{ $producto->nombre }}</h1>
                <h3 class="fw-bold mb-4 fs-2">${{ number_format($producto->precio, 0, ',', '.') }}</h3>
                
                <p class="text-muted mb-5 lh-lg">{{ $producto->descripcion }}</p>

                <form action="{{ route('carrito.agregar', $producto->id) }}" method="POST">
                    @csrf 
                    <input type="hidden" name="producto_id" value="{{ $producto->id }}">               
                    {{-- Selector de Talle con información visible --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Seleccioná tu talle:</label>
                        <select name="talle_id" class="form-select rounded-3" required>
                            <option value="" disabled selected>Elegí un talle</option>
                            @foreach($producto->talles as $talle)
                                @if($talle->stock > 0)
                                    <option value="{{ $talle->id }}">
                                        Talle {{ $talle->talle }} (Quedan {{ $talle->stock }} pares)
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    {{-- Input de Cantidad Libre --}}
                    <div class="mb-4">
                        <label class="form-label fw-bold">Cantidad:</label>
                        <input type="number" name="cantidad" class="form-control text-center rounded-3" value="1" min="1" style="width: 100px;" required>
                        <small class="text-muted mt-1 d-block">Ingresá una cantidad menor o igual al stock del talle elegido.</small>
                    </div>
                    <button type="submit" class="btn btn-dark w-100 py-3 fw-bold fs-5 rounded-3">
                        AGREGAR AL CARRITO <i class="bi bi-cart-plus ms-2"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <x-footer />
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>