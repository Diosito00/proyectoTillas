<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración | Tillas</title>
    <link rel="icon" href="{{ asset('imagenes/Logo-blanco.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style-navbar.css') }}?v={{ time() }}">
</head>
<body class="bg-light">
    
    {{-- Reutilizamos tu Navbar --}}
    <x-navbar/>

    <div class="container-fluid py-4 px-lg-5">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold m-0"><i class="bi bi-shield-lock text-primary me-2"></i>Panel de Control</h2>
            
            {{-- Este botón aún no hace nada, lo programaremos en el siguiente paso --}}
            <a href="{{ route('admin.create') }}" class="btn btn-primary fw-bold">
                <i class="bi bi-plus-lg me-2"></i>Nueva Zapatilla
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4 border-0 shadow-sm rounded-3" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        {{-- Tabla de Inventario --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="ps-4 py-3">ID</th>
                                <th class="py-3">Producto</th>
                                <th class="py-3">Marca</th>
                                <th class="py-3">Categoría</th>
                                <th class="py-3">Precio</th>
                                <th class="pe-4 py-3 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($productos as $producto)
                                <tr>
                                    <td class="ps-4 text-muted fw-bold">#{{ $producto->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('imagenes/' . $producto->imagen_url) }}" alt="{{ $producto->nombre }}" width="40" height="40" class="rounded object-fit-cover me-3">
                                            <span class="fw-bold">{{ $producto->nombre }}</span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-secondary">{{ $producto->marca }}</span></td>
                                    <td class="text-capitalize">{{ $producto->categoria }}</td>
                                    <td class="fw-bold">${{ number_format($producto->precio, 0, ',', '.') }}</td>
                                    <td class="pe-4 text-center">
                                        {{-- Botones de acción (Aún sin conexión) --}}
                                        <div class="btn-group shadow-sm">
                                            <a href="/en-proceso" class="btn btn-sm btn-outline-dark" title="Editar">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        No hay productos registrados en la base de datos.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            {{-- Paginación de Laravel --}}
            <div class="card-footer bg-white border-0 py-3">
                {{ $productos->links() }}
            </div>
        </div>

    </div>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>