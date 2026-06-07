<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Zapatilla | Panel Admin</title>
    <link rel="icon" href="{{ asset('imagenes/Logo-blanco.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style-navbar.css') }}?v={{ time() }}">
</head>
<body class="bg-light">
    
    <x-navbar/>

    <div class="container py-4 px-lg-5">
        <div class="mb-4">
            <a href="{{ route('admin.index') }}" class="text-decoration-none text-muted">
                <i class="bi bi-arrow-left me-2"></i>Volver al panel
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5">
                    <h3 class="fw-bold mb-4">Modificar Producto: <span class="text-primary">{{ $producto->nombre }}</span></h3>

                    <form action="{{ route('admin.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') 

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nombre</label>
                                <input type="text" name="nombre" class="form-control" value="{{ $producto->nombre }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Marca</label>
                                <input type="text" name="marca" class="form-control" value="{{ $producto->marca }}" required>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Categoría</label>
                                <select name="categoria" class="form-select" required>
                                    <option value="hombre" {{ $producto->categoria == 'hombre' ? 'selected' : '' }}>Hombre</option>
                                    <option value="mujer" {{ $producto->categoria == 'mujer' ? 'selected' : '' }}>Mujer</option>
                                    <option value="nino" {{ $producto->categoria == 'nino' ? 'selected' : '' }}>Niño</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Deporte / Uso</label>
                                <select name="deporte_uso" class="form-select" required>
                                    <option value="running" {{ $producto->deporte_uso == 'running' ? 'selected' : '' }}>Running</option>
                                    <option value="urbano" {{ $producto->deporte_uso == 'urbano' ? 'selected' : '' }}>Urbano</option>
                                    <option value="entrenamiento" {{ $producto->deporte_uso == 'entrenamiento' ? 'selected' : '' }}>Entrenamiento</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Precio ($)</label>
                                <input type="number" name="precio" class="form-control" step="0.01" value="{{ $producto->precio }}" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Descripción</label>
                            <textarea name="descripcion" class="form-control" rows="3">{{ $producto->descripcion }}</textarea>
                        </div>

                        <div class="mb-5 d-flex align-items-center gap-3 bg-light p-3 rounded-3 border">
                            <img src="{{ asset('imagenes/' . $producto->imagen_url) }}" alt="Foto actual" width="60" class="rounded object-fit-cover">
                            <div class="flex-grow-1">
                                <label class="form-label fw-bold mb-1">Reemplazar foto (Opcional)</label>
                                <input type="file" name="imagen" class="form-control form-control-sm" accept="image/jpeg, image/png, image/webp">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-3 fw-bold text-uppercase tracking-wide rounded-3">
                            Guardar Modificaciones <i class="bi bi-arrow-clockwise ms-2"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>