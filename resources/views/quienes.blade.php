<!DOCTYPE html>
<!-- lang="es": indica que el contenido está en español (importante para SEO y accesibilidad) -->
<html lang="es">
<head>
    <!-- charset="UTF-8": permite mostrar correctamente acentos, ñ, etc -->
    <meta charset="UTF-8">
    
    <!-- Hace que la página sea responsive (se adapte a celulares) -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Título que aparece en la pestaña del navegador -->
    <title>Quiénes Somos | Tillas - Tienda de Zapatillas Urbanas</title>
    
    <!-- Ícono de la pestaña -->
    <link rel="icon" href="{{ asset('imagenes/Logo-blanco.ico') }}" type="image/x-icon">
    
    <!-- Bootstrap: framework CSS para estilos y diseño -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    
    <!-- CSS propio -->
    <!-- ?v={{ time() }}: evita que el navegador use una versión vieja del CSS -->

    <link rel="stylesheet" href="{{ asset('css/style-quienes.css') }}?v={{ time() }}">
</head>

<body>
    <!-- Componente Blade: navbar reutilizable -->
    <x-navbar/>
    <!-- SECCIÓN HERO (portada) , position-relative: permite posicionar elementos internos con absolute bg-dark: fondo negro text-white: texto blanco text-center: centra el contenido  py-5: padding vertical mb-5: margen inferior overflow-hidden: oculta desbordes -->
    <div class="position-relative bg-dark text-white text-center py-5 mb-5 overflow-hidden">
        <!-- Fondo con imagen, position-absolute: se posiciona sobre el contenedor w-100 h-100: ocupa todo el tamaño opacity: 0.2: transparencia -->
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: url('{{ asset('imagenes/hero-quienes.jpg') }}') center/cover; opacity: 0.2;"></div>
        <!-- container: centra contenido z-1: lo pone por encima del fondo  py-5: padding -->
        <div class="container position-relative z-1 py-5">
            <!-- display-4: tamaño grande, fw-bold: negrita text-uppercase: mayúsculas tracking-wide: espacio entre letras (CSS propio) -->
            <h1 class="display-4 fw-bold mb-3 text-uppercase tracking-wide">Nuestra Esencia</h1>
            
            <!-- lead: texto destacado  mx-auto: centra horizontalmente max-width: limita ancho del texto -->
            <p class="lead mb-0 mx-auto" style="max-width: 600px;">
                En <strong>Tillas</strong> nos dedicamos a ofrecer zapatillas que combinan estilo urbano, comodidad y calidad, pensadas para acompañarte en cada paso.
            </p>
        </div>
    </div>

    <!-- container: contenido centrado -->
    <!-- py-5: espacio vertical -->
    <div class="container py-5">
        <!-- SECCIÓN MISIÓN / VISIÓN / VALORES, row: fila g-4: espacio entre columnas text-center: centra texto mb-5: margen inferior pb-5: padding abajo border-bottom: línea divisoria -->
        <div class="row g-4 text-center mb-5 pb-5 border-bottom">
            <!-- col-md-4: ocupa 1/3 en pantallas medianas -->
            <div class="col-md-4">
                <!-- p-5: padding  bg-light: fondo claro rounded: bordes redondeados  shadow-sm: sombra h-100: misma altura tarjeta-valor: animación personalizada -->
                <div class="p-5 bg-light border-0 rounded shadow-sm h-100 tarjeta-valor">
                    <!-- Ícono display-4: tamaño grande d-block: ocupa toda la línea -->
                    <i class="bi bi-bullseye display-4 mb-4 d-block text-dark"></i>
                    <!-- Subtítulo: Misión h4: encabezado (subtítulo)  fw-bold: negrita text-uppercase: todo en mayúsculas  mb-3: margen inferior -->
                    <h4 class="fw-bold text-uppercase mb-3">Misión</h4>
                    <!-- p: párrafo text-muted: texto gris mb-0: sin margen inferior -->
                    <p class="text-muted mb-0">
                        Brindar productos de alta calidad que se adapten a las tendencias actuales, garantizando confort y durabilidad en cada paso.
                    </p>
                </div>
            </div>

            <!-- col-md-4: ocupa 1/3 del ancho en pantallas medianas -->
            <div class="col-md-4">
                <!-- p-5: padding interno  bg-light: fondo claro border-0: sin borde rounded: bordes redondeados shadow-sm: sombra suave h-100: misma altura que las otras columnas tarjeta-valor: clase personalizada (animación o estilo extra) -->
                <div class="p-5 bg-light border-0 rounded shadow-sm h-100 tarjeta-valor">
                    <!-- i: ícono bi bi-eye: ícono de Bootstrap Icons display-4: tamaño grande mb-4: margen inferior d-block: ocupa toda la línea text-dark: color oscuro -->
                    <i class="bi bi-eye display-4 mb-4 d-block text-dark"></i>
                    <h4 class="fw-bold text-uppercase mb-3">Visión</h4>
                    <p class="text-muted mb-0">
                        Ser reconocidos como una de las principales tiendas de zapatillas urbanas a nivel nacional, destacándonos por nuestro servicio y calidad.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-5 bg-light border-0 rounded shadow-sm h-100 tarjeta-valor">
                    <!-- bi-heart: ícono de corazón -->
                    <i class="bi bi-heart display-4 mb-4 d-block text-dark"></i>
                    <h4 class="fw-bold text-uppercase mb-3">Valores</h4>
                    <p class="text-muted mb-0">
                        Compromiso con el cliente, innovación constante, responsabilidad y pasión por la moda urbana.
                    </p>
                </div>
            </div>

        </div>

        <!-- SECCIÓN HISTORIA, row: fila  align-items-center: centra verticalmente py-4: padding vertical -->
        <div class="row align-items-center py-4">
            <!-- col-md-6: mitad de ancho mb-4: margen abajo en mobile mb-md-0: sin margen en desktop pe-md-5: padding derecho -->
            <div class="col-md-6 mb-4 mb-md-0 pe-md-5">
                <!-- img: imagen width="50": tamaño mb-3: margen inferior  d-none d-md-block: oculta en mobile, muestra en desktop -->
                <img src="{{ asset('imagenes/logo-negro.png') }}" alt="Tillas Símbolo" width="50" class="mb-3 d-none d-md-block">
                <!-- text-center: centra d-md-none: visible solo en mobile -->
                <div class="text-center d-md-none mb-3">
                    <img src="{{ asset('imagenes/logo-negro.png') }}" alt="Tillas Símbolo" width="50">
                </div>

                <!-- h6: subtítulo pequeño tracking-wide: espacio entre letras text-muted: gris -->
                <h6 class="text-uppercase tracking-wide text-muted mb-2">De donde venimos</h6>
                <!-- display-6: tamaño grande -->
                <h3 class="fw-bold mb-4 display-6">Nuestra Historia</h3>
                <!-- fs-5: tamaño de fuente más grande -->
                <p class="text-muted fs-5">
                    Tillas nace como un emprendimiento enfocado en brindar una experiencia de compra simple, segura y moderna. 
                </p>
                <p class="text-muted">
                    Desde nuestros inicios, buscamos acercar a nuestros clientes productos de calidad que reflejen su estilo personal. No se trata solo de calzado, se trata de la actitud con la que pisás la calle.
                </p>
                <p class="text-muted">
                    Con el paso del tiempo, fuimos creciendo y ampliando nuestro catálogo, incorporando nuevas marcas y tendencias del mundo urbano y deportivo para ofrecerte siempre lo mejor.
                </p>
                
                <p class="text-muted mb-0">
                    Nacimos en Corrientes con una idea clara: acercar a nuestros clientes productos de calidad... Hoy, enviamos a todo el país manteniendo la misma atención personalizada del primer día.
                </p>    
            </div>

            <div class="col-md-6">
                <!-- permite posicionar elementos internos -->
                <div class="position-relative">
                <!-- img-fluid: responsive rounded: bordes redondeados shadow-lg: sombra grande -->
                    <img src="{{ asset('imagenes/historia-tillas.jpg') }}" class="img-fluid rounded shadow-lg" alt="Historia de Tillas">
                    
                    <!-- position-absolute: sobre la imagen bottom-0 start-0: esquina inferior izquierda bg-dark text-white: fondo negro, texto blanco p-3: padding m-3: margen rounded: bordes redondeados shadow: sombra d-none d-lg-block: solo visible en pantallas grandes -->
                    <div class="position-absolute bottom-0 start-0 bg-dark text-white p-3 m-3 rounded shadow d-none d-lg-block">
                        <p class="mb-0 fw-bold text-uppercase small">Pisando fuerte<br>desde el día 1</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- mt-5: margen superior pt-5: padding superior text-center: centrado border-top: línea arriba -->
        <div class="row mt-5 pt-5 text-center border-top">
            <!-- ocupa todo el ancho -->
            <div class="col-12">
                <h4 class="fw-bold mb-3">¿Listo para encontrar tu estilo?</h4>
                <p class="text-muted mb-4">Ya conocés nuestra historia, ahora te invitamos a conocer nuestros productos.</p>
                <!-- a: enlace route('catalogo'): ruta Laravel btn-dark: boton negro btn-lg: grande rounded-0: sin bordes redondeados px-5: padding horizontal fw-bold: negrita -->
                <a href="{{ route('catalogo') }}" class="btn btn-dark btn-lg px-5 fw-bold text-uppercase">
                    Ver el Catálogo
                </a>
            </div>
        </div>

    </div> 
    <!-- Componente Blade: footer reutilizable -->
    <x-footer/>
    <!-- Script JS de Bootstrap: habilita componentes interactivos -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>