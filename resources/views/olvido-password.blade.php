<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña | Tillas</title>
    <link rel="icon" href="{{ asset('imagenes/Logo-blanco.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style-login.css') }}?v={{ time() }}">
</head>
<body class="body-login d-flex align-items-center justify-content-center bg-dark" style="min-height: 100vh;">

    <div class="login-card shadow-lg p-4 p-md-5 rounded-4 bg-white position-relative" style="width: 100%; max-width: 450px;">
        
        {{-- Flecha para volver al login --}}
        <a href="{{ route('login') }}" class="position-absolute top-0 start-0 m-4 text-secondary text-decoration-none" title="Volver al login">
            <i class="bi bi-arrow-left fs-5"></i>
        </a>

        {{-- PASO 1: Ingresar el Correo Electrónico --}}
        @if(!isset($paso))
            <div class="text-center mb-4">
                <i class="bi bi-shield-lock text-dark fs-1 mb-2 d-block"></i>
                <h3 class="fw-bold mb-1">¿Olvidaste tu contraseña?</h3>
                <p class="text-muted small">Ingresá tu correo electrónico registrado para restablecer tu contraseña en el sistema.</p>
            </div>

            <form action="{{ route('password.email') }}" method="POST">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger small py-2 rounded-3 mb-3">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-floating mb-4">
                    <input type="email" name="email" class="form-control bg-light border-0 rounded-3 @error('email') is-invalid @enderror" id="emailInput" placeholder="Email" value="{{ old('email') }}" required>
                    <label for="emailInput" class="text-muted"><i class="bi bi-envelope me-2"></i>Correo electrónico</label>
                </div>

                <button type="submit" class="btn btn-dark btn-lg w-100 rounded-3 text-uppercase fw-bold tracking-wide py-3">
                    Verificar Cuenta <i class="bi bi-search ms-2"></i>
                </button>
            </form>

        {{-- PASO 2: Cuenta verificada, ingresar nueva clave --}}
        @else
            <div class="text-center mb-4">
                <i class="bi bi-check-circle-fill text-success fs-1 mb-2 d-block"></i>
                <h3 class="fw-bold mb-1">Cuenta Verificada</h3>
                <p class="text-muted small">Se validó correctamente el correo: <strong class="text-dark">{{ $email }}</strong>. Ingresá tu nueva clave de acceso.</p>
            </div>

            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                {{-- Campo oculto para pasar el mail confirmado al controlador --}}
                <input type="hidden" name="email" value="{{ $email }}">

                @if ($errors->any())
                    <div class="alert alert-danger small py-2 rounded-3 mb-3">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control bg-light border-0 rounded-3" id="passwordInput" placeholder="Nueva Contraseña" required>
                    <label for="passwordInput" class="text-muted"><i class="bi bi-lock me-2"></i>Nueva Contraseña</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="password" name="password_confirmation" class="form-control bg-light border-0 rounded-3" id="passwordConfirmInput" placeholder="Confirmar Contraseña" required>
                    <label for="passwordConfirmInput" class="text-muted"><i class="bi bi-lock-fill me-2"></i>Confirmar Contraseña</label>
                </div>

                <button type="submit" class="btn btn-success btn-lg w-100 rounded-3 text-uppercase fw-bold tracking-wide py-3">
                    Actualizar Contraseña <i class="bi bi-check-all ms-2"></i>
                </button>
            </form>
        @endif

    </div>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>