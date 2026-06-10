<!DOCTYPE html>
<!-- lang="es": indica que el idioma es español -->
<html lang="es">
    <head>
        <!-- Permite mostrar correctamente acentos y caracteres especiales -->
        <meta charset="UTF-8">
        <!-- Hace que la página sea responsive (adaptable a celulares) -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Compatibilidad con navegadores antiguos de Microsoft -->
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- Título de la pestaña -->
        <title>Contacto | Tillas - Zapatillas Urbanas</title>
        <!-- Ícono de la pestaña -->
        <link rel="icon" href="{{ asset('imagenes/Logo-blanco.ico') }}" type="image/x-icon">
        <!-- Bootstrap: framework de estilos -->
        <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style-quienes.css') }}?v={{ time() }}">
    </head>
    
<!-- bg-light: fondo gris claro para toda la página -->
<body class="bg-light">
<!-- Componente Blade: barra de navegación -->
    <x-navbar/>
    <!-- position-relative: permite posicionar elementos internos bg-dark: fondo oscuro text-white: texto blanco text-center: centrado  py-5: padding vertical  mb-5: margen inferior  overflow-hidden: evita que se desborde la imagen -->
    <div class="position-relative bg-dark text-white text-center py-5 mb-5 overflow-hidden">
        <!-- Imagen de fondo position-absolute: ocupa todo el contenedor w-100 h-100: ancho y alto completo opacity: transparencia -->
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: url('{{ asset('imagenes/contacto-hero.jpg') }}') center/cover; opacity: 0.2;"></div>
        <!-- container: centra contenido z-1: asegura que el texto esté encima de la imagen -->
        <div class="container position-relative z-1 py-4">
            <!-- display-4: tamaño grande  fw-bold: negrita text-uppercase: mayúsculas -->
            <h1 class="display-4 fw-bold mb-3 text-uppercase tracking-wide">Contacto</h1>
            <!-- lead: texto destacado  mx-auto: centrado horizontal -->
            <p class="lead mb-0 mx-auto" style="max-width: 600px;">
                ¿Tenés alguna duda o consulta sobre tu pedido? Estamos acá para ayudarte.
            </p>
        </div>
    </div>

    <!-- container: centra  pb-5: padding inferior  mb-5: margen inferior -->
    <div class="container pb-5 mb-5">
        <!-- row: fila g-5: espacio entre columnas -->
        <div class="row g-5">
            <!-- col-lg-7: ocupa 7/12 columnas en pantallas grandes -->
            <div class="col-lg-7">
                <!-- p-4 p-md-5: padding bg-white: fondo blanco shadow-sm: sombra rounded: bordes redondeados h-100: altura completa -->
                <div class="p-4 p-md-5 bg-white shadow-sm border-0 rounded h-100">
                    <h4 class="fw-bold mb-4">Envianos un mensaje</h4>

                    <!-- Muestra mensaje si existe sesión -->
                    @if(session('success'))
                    <!-- alert: mensaje alert-success: color verde d-flex align-items-center: alineación -->
                        <div class="alert alert-success d-flex align-items-center mb-4 border-0 shadow-sm" role="alert">
                            <!-- ícono Bootstrap -->
                            <i class="bi bi-check-circle-fill fs-4 me-3"></i>
                            <div>
                                Hola <strong>{{ session('nombre') }}</strong>, recibimos tu mensaje. 
                                Un asesor de Tillas te escribirá pronto a <strong>{{ session('email') }}</strong>. ¡Gracias!
                            </div>
                        </div>
                    @endif
                    
                    <!-- form: formulario  action: ruta Laravel method="POST": envío de datos -->
                    <form action="{{ route('contacto.store') }}" method="POST">
                        <!-- Token de seguridad contra ataques -->
                        @csrf 
                        
                        <!-- form-floating: etiqueta flotante  mb-3: margen -->
                        <div class="form-floating mb-3">
                            <!-- form-control: input Bootstrap  bg-light: fondo gris border-0: sin borde -->
                            <input type="text" name="nombre" class="form-control bg-light border-0" id="nombreInput" placeholder="Nombre completo" required>
                            <label for="nombreInput" class="text-muted">Nombre completo</label>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control bg-light border-0" id="emailInput" placeholder="Email" required>
                            <label for="emailInput" class="text-muted">Correo electrónico</label>
                        </div>
                        
                        <div class="form-floating mb-4">
                            <textarea name="mensaje" class="form-control bg-light border-0" id="mensajeInput" placeholder="Escribí tu mensaje" style="height: 150px" required></textarea>
                            <label for="mensajeInput" class="text-muted">¿En qué podemos ayudarte?</label>
                        </div>

                        <!-- btn-dark: negro  btn-lg: grande  w-100: ancho completo  rounded-0: sin bordes redondeados py-3: padding vertical -->
                        <button type="submit" class="btn btn-dark btn-lg w-100 text-uppercase fw-bold tracking-wide py-3">
                            Enviar Mensaje 
                            <!-- ícono enviar -->
                            <i class="bi bi-send ms-2"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- col-lg-5: ocupa 5/12 columnas -->
            <div class="col-lg-5">
                <!-- bg-dark: fondo oscuro  text-white: texto blanco shadow-lg: sombra grande d-flex flex-column: estructura vertical -->
                <div class="bg-dark text-white p-4 p-md-5 rounded shadow-lg h-100 d-flex flex-column">

                    <h4 class="fw-bold mb-4 text-uppercase tracking-wide">Información</h4>

                    <!-- list-unstyled: sin viñetas  fs-5: tamaño texto -->
                    <ul class="list-unstyled mb-4 fs-5">
                        <!-- d-flex: alineación horizontal -->
                        <li class="mb-4 d-flex align-items-center">
                            <i class="bi bi-geo-alt fs-3 me-3 text-secondary"></i> 
                            <span>126 Calle Y,<br>Corrientes, Argentina</span>
                        </li>
                        <li class="mb-4 d-flex align-items-center">
                            <i class="bi bi-envelope fs-3 me-3 text-secondary"></i> 
                            <!-- mailto: abre el correo -->
                            <a class="text-white text-decoration-none">info@tillas.com</a>
                        </li>
                        <li class="mb-4 d-flex align-items-center">
                            <i class="bi bi-phone fs-3 me-3 text-secondary"></i> 
                            <span>+54 379 4777777</span>
                        </li>
                        <li class="mb-4 d-flex align-items-center">
                            <i class="bi bi-clock fs-3 me-3 text-secondary"></i> 
                            <span class="fs-6 text-light">Lunes a Viernes: 9:00 a 18:00<br>Sábados: 9:00 a 13:00</span>
                        </li>
                    </ul>

                <!-- gap-3: espacio entre íconos  border-top: línea superior  pt-4: padding arriba -->
                    <div class="d-flex gap-3 mb-4 border-top border-secondary pt-4">
                        <a href="{{ route('en-proceso') }}" class="text-white text-decoration-none" target="blank">
                            <i class="bi bi-instagram fs-4">

                            </i>
                        </a>
                        <a href="{{ route('en-proceso') }}" class="text-white text-decoration-none" target="blank">
                            <i class="bi bi-tiktok fs-4"></i>
                        </a>
                        <a href="{{ route('en-proceso') }}" class="text-white text-decoration-none" target="blank">
                            <i class="bi bi-whatsapp fs-4"></i>
                        </a>
                    </div>

                    <!-- mt-auto: empuja el contenido hacia abajo -->
                    <div class="mt-auto">
                        <!-- overflow-hidden: recorta contenido -->
                        <div class="rounded overflow-hidden shadow-sm" style="height: 200px;">
                            <!-- iframe: inserta mapa de Google  width/height: ocupa todo  loading="lazy": carga diferida -->
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d113271.85966606346!2d-58.910363945934524!3d-27.486255740441585!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94456b79d5bed36b%3A0xfa999f1ef3b40646!2sCorrientes%2C%20Capital%2C%20Corrientes!5e0!3m2!1ses-419!2sar!4v1714080000000!5m2!1ses-419!2sar" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Footer reutilizable -->
    <x-footer/>
    <!-- JS de Bootstrap -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>