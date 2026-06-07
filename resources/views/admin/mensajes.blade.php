<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bandeja de Entrada | Panel Admin</title>
    <link rel="icon" href="{{ asset('imagenes/Logo-blanco.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style-navbar.css') }}?v={{ time() }}">
</head>
<body class="bg-light">
    
    <x-navbar/>

    <div class="container py-4 px-lg-5">
        
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <h2 class="fw-bold m-0"><i class="bi bi-envelope-paper-fill text-primary me-2"></i>Consultas Recibidas</h2>
            
            <a href="{{ route('admin.index') }}" class="btn btn-outline-dark fw-bold">
                <i class="bi bi-arrow-left me-2"></i>Volver al Panel
            </a>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @forelse($mensajes as $mensaje)
                        <div class="list-group-item list-group-item-action p-4 border-bottom">
                            <div class="d-flex w-100 justify-content-between align-items-center mb-2">
                                <h5 class="mb-1 fw-bold">
                                    <i class="bi bi-person-circle text-secondary me-2"></i>{{ $mensaje->nombre }}
                                </h5>
                                <small class="text-muted fw-bold">{{ $mensaje->created_at->format('d/m/Y H:i') }}</small>
                            </div>
                            <h6 class="mb-3 text-primary"><i class="bi bi-envelope-at me-2"></i>{{ $mensaje->email }}</h6>
                            
                            {{-- Contenedor del mensaje con diseño de "cita" --}}
                            <div class="p-3 bg-light rounded-3 border-start border-4 border-primary">
                                <p class="mb-0" style="white-space: pre-wrap;">{{ $mensaje->mensaje }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                            <h5 class="fw-bold">Bandeja Vacía</h5>
                            <p>Aún no has recibido consultas a través del formulario de contacto.</p>
                        </div>
                    @endforelse
                </div>
            </div>
            
            <div class="card-footer bg-white border-0 py-3">
                {{ $mensajes->links() }}
            </div>
        </div>

    </div>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>