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

    <div class="container-fluid">
        <div class="row">
            <x-sidebar/>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-5 py-4">
                <div class="mb-4 d-flex justify-content-between align-items-center">
                    <h2 class="fw-bold m-0"><i class="bi bi-people-fill text-primary me-2"></i>Usuarios Registrados</h2>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ $errors->first() }}
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
                                                {{-- Formulario de cambio rápido de rol --}}
                                                <form action="{{ route('admin.usuarios.updateRol', $usuario->id) }}" method="POST" class="m-0">
                                                    @csrf
                                                    @method('PUT')
                                                    
                                                    <select name="rol" 
                                                        class="form-select form-select-sm d-inline-block w-auto rounded-pill fw-bold border-0 shadow-sm text-center
                                                        {{ $usuario->rol === 'admin' ? 'bg-primary text-white' : 'bg-secondary text-white' }}"
                                                        onchange="this.form.submit()" 
                                                        {{ $usuario->id === auth()->id() ? 'disabled' : '' }} 
                                                        title="Cambiar rol">
                                                        
                                                        <option value="admin" class="bg-white text-dark" {{ $usuario->rol === 'admin' ? 'selected' : '' }}>
                                                            🛡️ Admin
                                                        </option>
                                                        <option value="cliente" class="bg-white text-dark" {{ $usuario->rol === 'cliente' ? 'selected' : '' }}>
                                                            👤 Cliente
                                                        </option>
                                                    </select>
                                                </form>
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
            </main>        
        </div>
    </div>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>