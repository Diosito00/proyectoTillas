<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Zapatilla | Panel Admin</title>
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
                    <h3 class="fw-bold mb-4">Agregar Nuevo Producto</h3>

                    {{-- Formulario: El enctype es VITAL para subir imágenes --}}
                    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nombre de la zapatilla</label>
                                <input type="text" name="nombre" class="form-control" placeholder="Ej: Topper Terre Kids" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Marca</label>
                                <input type="text" name="marca" class="form-control" placeholder="Ej: Topper" required>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Categoría</label>
                                <select name="categoria" class="form-select" required>
                                    <option value="" disabled selected>Seleccioná una...</option>
                                    <option value="hombre">Hombre</option>
                                    <option value="mujer">Mujer</option>
                                    <option value="nino">Niño</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Deporte / Uso</label>
                                <select name="deporte_uso" class="form-select" required>
                                    <option value="" disabled selected>Seleccioná una...</option>
                                    <option value="running">Running</option>
                                    <option value="urbano">Urbano</option>
                                    <option value="entrenamiento">Entrenamiento</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Precio ($)</label>
                                <input type="number" name="precio" class="form-control" step="0.01" placeholder="Ej: 85000" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Descripción (Opcional)</label>
                            <textarea name="descripcion" class="form-control" rows="3" placeholder="Detalles del producto..."></textarea>
                        </div>

                        <div class="mb-5">
                            <label class="form-label fw-bold">Foto del producto</label>
                            <input type="file" name="imagen" class="form-control" accept="image/jpeg, image/png, image/webp" required>
                            <div class="form-text">Solo formatos JPG, PNG o WEBP. Máximo 2MB.</div>
                        </div>

                        <button type="submit" class="btn btn-dark w-100 py-3 fw-bold text-uppercase tracking-wide rounded-3">
                            Guardar 
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>