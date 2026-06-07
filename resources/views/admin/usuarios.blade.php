<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios | Panel Admin</title>
    <link rel="icon" href="{{ asset('imagenes/Logo-blanco.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style-navbar.css') }}?v={{ time() }}">
</head>
<body class="bg-light">
    
    <x-navbar/>

    <div class="container-fluid py-4 px-lg-5">
        
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <h2 class="fw-bold m-0"><i class="bi bi-people-fill text-primary me-2"></i>Usuarios Registrados</h2>
            
            <a href="{{ route('admin.index') }}" class="btn btn-outline-dark fw-bold">
                <i class="bi bi-arrow-left me-2"></i>Volver al Inventario
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="ps-4 py-3">ID</th>
                                <th class="py-3">Nombre</th>
                                <th class="py-3">Correo Electrónico</th>
                                <th class="py-3 text-center">Rol</th>
                                <th class="pe-4 py-3 text-end">Fecha de Registro</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($usuarios as $usuario)
                                <tr>
                                    <td class="ps-4 text-muted fw-bold">#{{ $usuario->id }}</td>
                                    <td class="fw-bold">{{ $usuario->name }}</td>
                                    <td>{{ $usuario->email }}</td>
                                    <td class="text-center">
                                        @if($usuario->rol === 'admin')
                                            <span class="badge bg-primary px-3 py-2 rounded-pill"><i class="bi bi-shield-lock-fill me-1"></i> Admin</span>
                                        @else
                                            <span class="badge bg-secondary px-3 py-2 rounded-pill"><i class="bi bi-person-fill me-1"></i> Cliente</span>
                                        @endif
                                    </td>
                                    <td class="pe-4 text-end text-muted">
                                        {{ $usuario->created_at->format('d/m/Y H:i') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        No hay usuarios registrados en el sistema.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            {{-- Paginación --}}
            <div class="card-footer bg-white border-0 py-3">
                {{ $usuarios->links() }}
            </div>
        </div>

    </div>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>