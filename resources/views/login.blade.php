<!DOCTYPE html>
{{-- lang="es": Define el idioma principal como español. Importante para SEO y accesibilidad. --}}
<html lang="es">
<head>
    {{-- Permite mostrar correctamente caracteres especiales como tildes (á, é) y la ñ. --}}
    <meta charset="UTF-8">
    {{-- Hace que la página sea responsive (se adapta a celulares, tablets y PC). --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Login | Tillas - Zapatillas Urbanas</title>
    
    {{-- Favicon: ícono que aparece en la pestaña del navegador. --}}
    <link rel="icon" href="{{ asset('imagenes/Logo-blanco.ico') }}" type="image/x-icon">

    {{-- BOOTSTRAP CSS --}}
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    {{-- BOOTSTRAP ICONS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    {{-- CSS PROPIO --}}
    <link rel="stylesheet" href="{{ asset('css/style-login.css') }}?v={{ time() }}">
</head>

{{-- body-login: clase personalizada para fondo.
    d-flex align-items-center justify-content-center: centra la tarjeta perfectamente en la pantalla. --}}
<body class="body-login d-flex align-items-center justify-content-center bg-dark">

    {{-- shadow-lg: sombra más grande y difuminada
    p-4 p-md-5: relleno adaptable (normal en móviles, amplio en PC)
    rounded-4: bordes más redondeados y modernos
    bg-white: fondo blanco asegurado --}}
    <div class="login-card shadow-lg p-4 p-md-5 rounded-4 bg-white position-relative" style="width: 100%; max-width: 450px;">
        {{-- position-absolute: Lo saca del flujo normal --}}
        {{-- top-0 start-0: Lo pega arriba a la izquierda --}}
        {{-- m-4: Le da un margen para que no toque los bordes --}}
        {{-- fs-5: Agranda un poquito el ícono --}}
        <a href="/" class="position-absolute top-0 start-0 m-4 text-secondary text-decoration-none" title="Volver al inicio">
            <i class="bi bi-arrow-left fs-5"></i>
        </a>
        <div class="text-center mb-4">
            <img src="{{ asset('imagenes/logo-negro.png') }}" alt="Tillas Símbolo" width="60" class="mb-3">
            
            <h3 class="fw-bold mb-1">Bienvenido de nuevo</h3>
            <p class="text-muted small">Ingresá tus datos para continuar a tu cuenta.</p>
        </div>

        {{-- action="{{ route('login.post') }}": Es la forma correcta en Laravel de enviar datos (usarás esta u otra ruta que definas) --}}
        <form action="{{ route('login.post') }}" method="POST">
            @csrf {{-- Protección obligatoria de Laravel para formularios --}}

                {{-- Bloque de Errores: Si el AuthController devuelve un error, se muestra aquí --}}
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
                {{-- old('email'): Si se equivoca en la clave, Laravel le devuelve el email que ya había escrito para que no tenga que tipear todo de nuevo --}}
                {{-- @error('email') is-invalid @enderror: Pinta el borde de rojo si hay error --}}
                <input type="email" name="email" class="form-control bg-light border-0 rounded-3 @error('email') is-invalid @enderror" id="emailInput" placeholder="Email" value="{{ old('email') }}" required>
                
                {{-- rounded-3: bordes ligeramente redondeados en el input --}}
                <input type="email" name="email" class="form-control bg-light border-0 rounded-3" id="emailInput" placeholder="Email" required>
                <label for="emailInput" class="text-muted"><i class="bi bi-envelope me-2"></i>Correo electrónico</label>
            </div>

            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control bg-light border-0 rounded-3" id="passwordInput" placeholder="Contraseña" required>
                <label for="passwordInput" class="text-muted"><i class="bi bi-lock me-2"></i>Contraseña</label>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4 small">
                <div class="form-check">
                    <input class="form-check-input shadow-none" type="checkbox" value="1" id="rememberMe" name="remember">
                    <label class="form-check-label text-muted" for="rememberMe">
                        Recordarme
                    </label>
                </div>
                <a href="/en-proceso" class="text-dark text-decoration-none fw-bold hover-underline">¿Olvidaste tu contraseña?</a>
            </div>

            {{-- btn-lg: botón más grande
                py-3: más alto (padding Y)
                text-uppercase tracking-wide: letras mayúsculas y separadas para más elegancia --}}
            <button type="submit" class="btn btn-dark btn-lg w-100 rounded-3 text-uppercase fw-bold tracking-wide py-3 mb-4">
                Ingresar <i class="bi bi-arrow-right ms-2"></i>
            </button>
            
            {{-- border-top pt-4: Línea divisoria gris y padding superior --}}
            <div class="text-center border-top pt-4">
                <p class="text-muted small mb-0">
                    ¿Todavía no tenés una cuenta? 
                    <a href="{{ route('registro') }}" class="text-dark fw-bold text-decoration-none ms-1 hover-underline">Registrate acá</a>
                </p>
            </div>
        </form>

    </div>

    {{-- JS DE BOOTSTRAP --}}
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>