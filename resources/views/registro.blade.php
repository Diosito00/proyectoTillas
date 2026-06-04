<!DOCTYPE html>
{{-- html: raíz del documento --}}
{{-- lang="es": indica que el contenido está en español (importante para SEO) --}}
<html lang="es">
<head>
    {{-- charset UTF-8: permite usar tildes, ñ, símbolos especiales --}}
    <meta charset="UTF-8">
    {{-- viewport: hace que la web sea responsive y se adapte a celulares --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro | Tillas</title>
    <link rel="icon" href="{{ asset('imagenes/Logo-blanco.ico') }}" type="image/x-icon">
    {{-- Bootstrap CSS: framework principal de estilos --}}
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    {{-- Bootstrap Icons: librería para los íconos de usuario, llaves, etc. --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    {{-- CSS propio: cargamos estilos personalizados para el Login y Registro --}}
    <link rel="stylesheet" href="{{ asset('css/style-login.css') }}?v={{ time() }}">
</head>
<body class="body-login d-flex align-items-center justify-content-center bg-dark" style="min-height: 100vh;">

    {{-- TARJETA DE REGISTRO
        login-card: clase personalizada para el contenedor blanco 
        d-flex, justify-content, align-items: centran todo el módulo en pantalla --}}
    <div class="login-card shadow-lg p-4 p-md-5 rounded-4 bg-white position-relative" style="width: 100%; max-width: 500px;">
        {{-- BOTÓN VOLVER
            position-absolute: clava la flecha arriba a la izquierda de la tarjeta --}}
        <a href="/" class="position-absolute top-0 start-0 m-4 text-secondary text-decoration-none" title="Volver al inicio">
            <i class="bi bi-arrow-left fs-5"></i>
        </a>

        <div class="text-center mb-4">
            <img src="{{ asset('imagenes/logo-negro.png') }}" alt="Tillas Símbolo" width="60" class="mb-3">
            <h3 class="fw-bold mb-1">Crea tu cuenta</h3>
            <p class="text-muted small">Registrate para poder gestionar tu carrito y realizar compras.</p>
        </div>

        {{-- ERRORES DE VALIDACIÓN
            @if ($errors->any()): Laravel revisa si el controlador rebotó el formulario por datos inválidos
            @foreach: recorre la lista de fallas (ej: contraseña corta o email ya registrado) y las muestra en rojo --}}
        @if ($errors->any())
            <div class="alert alert-danger p-2 small rounded-3 mb-3 border-0">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORMULARIO DE REGISTRO
            route('registro.post'): apunta a la ruta POST que procesa los datos en el AuthController
            @csrf: inyecta un campo oculto con un token de seguridad obligatorio para prevenir ataques CSRF --}}
        <form action="{{ route('registro.post') }}" method="POST">
            @csrf

            {{-- Campo: Nombre Completo
                value="{{ old('name') }}": mantiene el texto escrito si la página se recarga por algún error --}}
            <div class="form-floating mb-3">
                <input type="text" name="name" class="form-control bg-light border-0 rounded-3" id="nameInput" placeholder="Nombre" value="{{ old('name') }}" required>
                <label for="nameInput" class="text-muted"><i class="bi bi-person me-2"></i>Nombre completo</label>
            </div>

            {{-- Campo: Correo Electrónico --}}
            <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control bg-light border-0 rounded-3" id="emailInput" placeholder="Email" value="{{ old('email') }}" required>
                <label for="emailInput" class="text-muted"><i class="bi bi-envelope me-2"></i>Correo electrónico</label>
            </div>

            {{-- Campo: Contraseña --}}
            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control bg-light border-0 rounded-3" id="passwordInput" placeholder="Contraseña" required>
                <label for="passwordInput" class="text-muted"><i class="bi bi-lock me-2"></i>Contraseña (mínimo 6 caracteres)</label>
            </div>

            {{-- Campo: Confirmar Contraseña
                name="password_confirmation": Laravel exige este nombre exacto para compararlo automáticamente con 'password' --}}
            <div class="form-floating mb-4">
                <input type="password" name="password_confirmation" class="form-control bg-light border-0 rounded-3" id="passwordConfirmInput" placeholder="Repetir Contraseña" required>
                <label for="passwordConfirmInput" class="text-muted"><i class="bi bi-lock-fill me-2"></i>Confirmar contraseña</label>
            </div>

            {{-- BOTÓN DE ENVÍO --}}
            <button type="submit" class="btn btn-dark btn-lg w-100 rounded-3 text-uppercase fw-bold tracking-wide py-3 mb-4">
                Registrarme <i class="bi bi-person-plus ms-2"></i>
            </button>
            
            {{-- ENLACE AL LOGIN
                Permite al usuario cambiar de pantalla si ya posee una cuenta creada anteriormente --}}
            <div class="text-center border-top pt-4">
                <p class="text-muted small mb-0">
                    ¿Ya tenés una cuenta? 
                    <a href="{{ route('login') }}" class="text-dark fw-bold text-decoration-none ms-1 hover-underline">Iniciá sesión acá</a>
                </p>
            </div>
        </form>

    </div>

    {{-- Bootstrap JS Bundle: incluye Popper, necesario para interactividad y efectos de Bootstrap --}}
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>