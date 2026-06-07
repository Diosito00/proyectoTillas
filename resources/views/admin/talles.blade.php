<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock: {{ $producto->nombre }} | Panel Admin</title>
    <link rel="icon" href="{{ asset('imagenes/Logo-blanco.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style-navbar.css') }}?v={{ time() }}">
</head>
<body class="bg-light">
    
    <x-navbar/>

    <div class="container py-4 px-lg-5">
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <a href="{{ route('admin.index') }}" class="text-decoration-none text-muted">
                <i class="bi bi-arrow-left me-2"></i>Volver al panel
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            {{-- Columna Izquierda: Información y Formulario --}}
            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-sm rounded-4 mb-4 p-3 text-center">
                    <img src="{{ asset('imagenes/' . $producto->imagen_url) }}" alt="{{ $producto->nombre }}" class="img-fluid rounded-3 mb-3 object-fit-cover" style="height: 200px; width: 100%;">
                    <h5 class="fw-bold mb-1">{{ $producto->nombre }}</h5>
                    <span class="badge bg-dark mb-2">{{ $producto->marca }}</span>
                    <p class="text-muted mb-0">ID Producto: #{{ $producto->id }}</p>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h6 class="fw-bold mb-3"><i class="bi bi-box-arrow-in-down me-2"></i>Ingreso de Mercadería</h6>
                    <form action="{{ route('admin.talles.store', $producto->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Número de Talle</label>
                            <input type="number" name="talle" class="form-control" placeholder="Ej: 40" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">Cantidad de Pares</label>
                            <input type="number" name="stock" class="form-control" placeholder="Ej: 5" min="1" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100 fw-bold">
                            Cargar Stock <i class="bi bi-plus-circle ms-2"></i>
                        </button>
                    </form>
                </div>
            </div>

            {{-- Columna Derecha: Inventario Actual --}}
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                        <h5 class="fw-bold"><i class="bi bi-boxes text-primary me-2"></i>Inventario Actual</h5>
                    </div>
                    <div class="card-body p-0 mt-3">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-uppercase small">
                                <tr>
                                    <th class="ps-4 py-3">Talle</th>
                                    <th class="py-3 text-center">Stock Disponible</th>
                                    <th class="py-3 text-center">Estado</th>
                                    <th class="pe-4 py-3 text-end">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($talles as $item)
                                    <tr>
                                        <td class="ps-4 fw-bold fs-5">{{ $item->talle }}</td>
                                        <td class="text-center fw-bold">{{ $item->stock }} pares</td>
                                        <td class="text-center">
                                            @if($item->stock > 5)
                                                <span class="badge bg-success-subtle text-success px-2 py-1">Óptimo</span>
                                            @elseif($item->stock > 0)
                                                <span class="badge bg-warning-subtle text-warning px-2 py-1">Poco Stock</span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger px-2 py-1">Agotado</span>
                                            @endif
                                        </td>
                                        <td class="pe-4 text-end">
                                            <button class="btn btn-sm btn-outline-danger" title="Eliminar Talle">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-muted">
                                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                            Aún no hay talles registrados para esta zapatilla.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>