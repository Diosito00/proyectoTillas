<!DOCTYPE html>
{{-- html: raíz del documento --}}
{{-- lang="es": indica que el contenido está en español (importante para SEO) --}}
<html lang="es">
<head>
    {{-- charset UTF-8: permite usar tildes, ñ, símbolos especiales --}}
    <meta charset="UTF-8">
    {{-- viewport: hace que la web sea responsive y se adapte a celulares --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- X-UA-Compatible: mejora compatibilidad con navegadores antiguos como Internet Explorer --}}
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    {{-- Bootstrap CSS: framework principal de estilos --}}
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    {{-- Bootstrap Icons: librería para los íconos de usuario, carrito, menú, etc. --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    {{-- CSS propio: cargamos tus estilos personalizados. El ?v=time() evita que el navegador guarde el CSS viejo en caché --}}
    <link rel="stylesheet" href="{{ asset('css/style-navbar.css') }}?v={{ time() }}">
</head>

{{-- NAVBAR 
    nav: etiqueta semántica para navegación principal
    navbar-expand-lg: le dice a Bootstrap que muestre el menú completo en pantallas grandes (PC) y lo colapse en celulares
    custom-navbar: tu clase propia para darle el color de fondo y detalles específicos 
--}}
<nav class="navbar navbar-expand-lg custom-navbar">
    {{-- container-fluid: hace que la barra ocupe el 100% del ancho de la pantalla --}}
    <div class="container-fluid px-4"> 
        
        {{-- LOGO / MARCA 
            navbar-brand: clase especial de Bootstrap para destacar la marca
            d-flex align-items-center gap-2: usa flexbox para alinear la imagen y el texto perfectamente en el centro vertical
        --}}
        <a class="navbar-brand d-flex align-items-center gap-2" href="/">
            <img src="{{ asset('imagenes/Logo-blanco.png') }}" alt="Ícono Tillas" width="35" height="35" class="d-inline-block align-text-top">
            <span class="fw-bold text-uppercase fs-6 tracking-wide text-white">Tillas</span>
        </a>

        {{-- BOTÓN HAMBURGUESA (Solo visible en celulares)
            data-bs-toggle y data-bs-target: son los conectores mágicos de Javascript que le dicen a Bootstrap qué div debe abrir/cerrar al hacer clic 
        --}}
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal" aria-controls="menuPrincipal" aria-expanded="false" aria-label="Navegación">
            <i class="bi bi-list text-white fs-2"></i>
        </button>

        {{-- CONTENEDOR COLAPSABLE (El menú de links) --}}
        <div class="collapse navbar-collapse" id="menuPrincipal">
            {{-- navbar-nav me-auto: "me-auto" empuja automáticamente todo lo que esté a la derecha hacia el borde derecho, separando los links de los botones de usuario --}}
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 center-links">
                <li class="nav-item"><a class="nav-link fs-8" href="/">Inicio</a></li>
                {{-- route('catalogo'): usamos el nombre de la ruta en lugar de la URL quemada para que sea dinámico --}}
                <li class="nav-item"><a class="nav-link fs-8" href="{{ route('catalogo') }}">Catálogo</a></li>
                <li class="nav-item"><a class="nav-link fs-8" href="/comercializacion">Comercialización</a></li>
                <li class="nav-item"><a class="nav-link fs-8" href="/quienes">Quienes somos</a></li>
                <li class="nav-item"><a class="nav-link fs-8" href="/contacto">Contacto</a></li>
                <li class="nav-item"><a class="nav-link fs-8" href="/terminos">Términos de uso</a></li>
            </ul>
        </div>

        {{-- SECCIÓN DERECHA: Botones de Usuario y Carrito 
            pe-lg-2: padding a la derecha solo en PC para que no quede pegado al borde 
        --}}
        <div class="d-flex align-items-center gap-3 pe-lg-2">
            
            {{-- DIRECTIVA @guest: Laravel renderiza esto ÚNICAMENTE si el usuario NO ha iniciado sesión (visitante) --}}
            @guest
                <a href="{{ route('login') }}" class="btn btn-outline-light fw-bold border-0 d-flex align-items-center gap-2 px-3 py-2 rounded-pill">
                    <i class="bi bi-person"></i> 
                    <span>Ingresar</span>
                </a>
            @endguest

            {{-- DIRECTIVA @auth: Laravel renderiza esto ÚNICAMENTE si el usuario SÍ tiene una sesión activa --}}
            @auth
                {{-- BOTÓN DEL CARRITO --}}
                {{-- position-relative: es obligatorio para que el "badge" rojo se posicione en la esquina del ícono --}}
                <a href="{{ route('carrito.index') }}" class="text-white text-decoration-none position-relative d-flex align-items-center mt-1 me-2" title="Mi Carrito">
                    <i class="bi bi-cart3 fs-5"></i>
                    
                    {{-- Lógica del carrito: contamos cuántos elementos hay en el arreglo de la sesión --}}
                    @php $cantidadCarrito = count(session('carrito', [])); @endphp
                    
                    {{-- Si hay al menos 1 producto, dibujamos el circulito rojo (badge) --}}
                    @if($cantidadCarrito > 0)
                        {{-- position-absolute top-0 start-100 translate-middle: clases de Bootstrap para anclar el circulito arriba a la derecha --}}
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger shadow-sm" style="font-size: 0.65rem;">
                            {{ $cantidadCarrito }}
                        </span>
                    @endif
                </a>

                {{-- MENÚ DESPLEGABLE DEL USUARIO (Dropdown) --}}
                <div class="dropdown">
                    {{-- dropdown-toggle: indica que este botón abre un menú --}}
                    <button class="btn btn-outline-light border-0 fw-bold d-flex align-items-center gap-2 px-3 py-2 rounded-pill dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-check-fill"></i>
                        {{-- Auth::user()->name: Imprime el nombre real que está guardado en la base de datos MariaDB --}}
                        <span>{{ Auth::user()->name }}</span>
                    </button>
                    
                    {{-- La cajita blanca que se despliega al hacer clic --}}
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
                        
                        {{-- Validación de Rol: Si el usuario actual es "admin", le mostramos esta opción secreta --}}
                        @if(Auth::user()->rol === 'admin')
                            <li>
                                <a class="dropdown-item fw-bold text-primary" href="{{ route('admin.index') }}">
                                    <i class="bi bi-shield-lock-fill me-2"></i>Panel Admin
                                </a>
                            </li>
                            {{-- Línea divisoria --}}
                            <li><hr class="dropdown-divider"></li>
                        @endif
                        
                        {{-- BOTÓN CERRAR SESIÓN 
                            Debe ser un formulario POST por seguridad, para que un link malicioso no pueda cerrar la sesión del usuario a la fuerza 
                        --}}
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="m-0">
                                @csrf {{-- Token de seguridad obligatorio --}}
                                <button type="submit" class="dropdown-item text-danger fw-bold">
                                    <i class="bi bi-box-arrow-right me-2"></i>Cerrar Sesión
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth
            
        </div>
    </div>
</nav>
</html>