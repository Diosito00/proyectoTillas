<!DOCTYPE html>
<!-- Define el idioma del sitio (español) -->    
<html lang="es">

    <head>
        <!-- Permite usar caracteres especiales como ñ y tildes -->
        <meta charset="UTF-8">
        <!-- Hace que la página sea responsive (se adapte a celulares y tablets) -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Compatibilidad con navegadores antiguos de Microsoft -->
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- Importa Bootstrap (framework CSS para diseño y componentes) -->
        <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">

        <title>Comercialización | Tillas - Zapatillas Urbanas</title>
        <!-- Ícono de la pestaña del navegador -->
        <link rel="icon" href="{{ asset('imagenes/Logo-blanco.ico') }}" type="image/x-icon">
        <!-- CSS propio + cache busting (evita que el navegador use versión vieja) -->
        <link rel="stylesheet" href="{{ asset('css/style-quienes.css') }}?v={{ time() }}">
    </head>

    <!-- Contenido visible -->
    <body>
    <!-- Barra de navegación (componente Blade) -->
    <x-navbar/>

    <!-- position-relative: permite posicionar elementos absolutos adentro bg-dark: fondo negro text-white: texto blanco text-center: centra el texto py-5: padding vertical mb-5: margen inferior overflow-hidden: evita que elementos se salgan del contenedor -->
    <div class="position-relative bg-dark text-white text-center py-5 mb-5 overflow-hidden">
        <!-- Imagen de fondo position-absolute: se posiciona sobre el contenedor w-100 h-100: ocupa todo el ancho y alto opacity: transparencia -->
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: url('{{ asset('imagenes/comercializacion-hero.jpg') }}') center/cover; opacity: 0.3;"></div>
        <!-- container: centra el contenido z-1: pone el contenido encima del fondo -->
        <div class="container position-relative z-1 py-5">
            <!-- display-4: título grande fw-bold: negrita text-uppercase: mayúsculas tracking-wide: separación de letras -->
            <h1 class="display-4 fw-bold mb-3 text-uppercase tracking-wide">Comercialización</h1>
            <!-- lead: texto destacado mx-auto: centra horizontalmente max-width: limita ancho -->
            <p class="lead mb-0 mx-auto" style="max-width: 600px;">
                Conocé en detalle todas nuestras opciones de compra, envío, pago y políticas para que tengas la mejor experiencia en Tillas.
            </p>
        </div>
    </div>
    
    <!-- container: centra contenido py-5: espacio vertical -->
    <div class="container py-5">
        <!-- SECCIÓN ENVÍOS row: fila de Bootstrap align-items-center: centra verticalmente mb-5: separación abajo -->
        <div class="row align-items-center mb-5">
            <!-- Image col-md-6: ocupa la mitad en pantallas medianas -->
            <div class="col-md-6">
                <!-- img-fluid: imagen adaptable rounded: bordes redondeados shadow: sombra -->
                <img src="{{ asset('imagenes/envios.png') }}" class="img-fluid rounded shadow" alt="Envíos">
            </div>
            
            <div class="col-md-6">
                <!-- Ícono fs-1: tamaño grande -->
                <i class="bi bi-truck fs-1 mb-3 text-dark"></i>
                <h4 class="fw-bold mb-3">Envíos</h4>
                <!-- text-muted: gris small: texto chico -->
                <p class="text-muted small">
                Realizamos <strong>envíos a todo el país</strong> mediante servicios de logística confiables,
                asegurando que tu pedido llegue en tiempo y forma, en perfectas condiciones.

                El tiempo de entrega estimado es de 48 a 72 horas hábiles para la mayoría
                de las ciudades, pudiendo variar según la ubicación, la disponibilidad del producto
                y la demanda en fechas especiales (como promociones o eventos).

                Trabajamos con empresas líderes como 
                <strong>Correo Argentino</strong>, <strong>Andreani</strong> y <strong>OCA</strong>,
                lo que nos permite ofrecer una amplia cobertura y diferentes modalidades de envío.

                Una vez realizada la compra, recibirás un correo con toda la información de tu pedido,
                incluyendo el estado del envío y los datos para su seguimiento.
                </p>

                <!-- Lista detallada -->
                <!-- text-muted: gris small: texto chico mt-3: margen arriba -->
                <ul class="text-muted small mt-3">
                    <li>Entrega estimada entre 48 y 72 horas hábiles (puede variar según la zona)</li>
                    <li>Número de seguimiento en tiempo real para controlar tu envío</li>
                    <li><strong>Envío gratis</strong> en compras superiores a $50.000</li>
                    <li>Opción de retiro en sucursal o punto de entrega</li>
                    <li>Embalaje seguro y reforzado para proteger el producto durante el traslado</li>
                    <li>Notificaciones por email sobre el estado del pedido</li>
                    <li>Posibilidad de reprogramar la entrega en caso de ausencia</li>
                </ul>
            </div>
        </div>    
        <!-- SECCIÓN PAGOS (imagen derecha) flex-md-row-reverse: invierte columnas en PC -->
        <div class="row align-items-center mb-5 flex-md-row-reverse">
            <!-- col-md-6: ocupa 6 de 12 columnas (la mitad) en pantallas medianas o más grandes -->
            <div class="col-md-6">
                <!-- img: muestra una imagen src: ruta de la imagen (Laravel usa asset para buscar en /public) img-fluid: hace la imagen responsive rounded: bordes redondeados shadow: agrega sombra alt: texto alternativo (accesibilidad) -->
                <img src="{{ asset('imagenes/pagos.png') }}" class="img-fluid rounded shadow" alt="Pagos">
            </div>
            <!-- Texto -->
            <div class="col-md-6">
                <!-- i: ícono (Bootstrap Icons) - bi bi-credit-card: icono de tarjeta - fs-1: tamaño grande - mb-3: margen inferior - text-dark: color oscuro -->
                <i class="bi bi-credit-card fs-1 mb-3 text-dark"></i>
                <!-- h4: título fw-bold: negrita mb-3: separación abajo -->
                <h4 class="fw-bold mb-3">Formas de Pago</h4>

                <p class="text-muted small">
                Ofrecemos múltiples medios de pago seguros y rápidos para que puedas comprar con total confianza,
                eligiendo la opción que mejor se adapte a tus necesidades.

                Todas las transacciones se procesan a través de plataformas confiables y con sistemas de
                encriptación SSL, garantizando la protección de tus datos personales y financieros en todo momento.

                Además, contamos con confirmación automática en la mayoría de los métodos de pago,
                lo que permite agilizar el procesamiento de tu pedido y reducir los tiempos de preparación y envío.
                </p>

                <!-- Íconos d-flex: activa flexbox gap-3: espacio entre elementos mb-3: margen inferior -->
                <div class="d-flex gap-3 mb-3">
                    <!-- fs-4: tamaño mediano -->
                    <i class="bi bi-credit-card fs-4"></i>
                    <i class="bi bi-bank fs-4"></i>
                    <i class="bi bi-phone fs-4"></i>
                </div>

                <!-- Lista -->
                <ul class="text-muted small">
                    <li>Tarjetas de crédito y débito (<strong>Visa, Mastercard, American Express</strong>)</li>
                    <li>Hasta <strong>6 cuotas sin interés</strong> en productos seleccionados</li>
                    <li>Pagos a través de <strong>MercadoPago</strong> con múltiples opciones disponibles</li>
                    <li>Transferencia bancaria directa con confirmación manual o automática</li>
                    <li>Billeteras virtuales (Ualá, MercadoPago, entre otras)</li>
                    <li>Confirmación inmediata del pago en la mayoría de los casos</li>
                    <li>Posibilidad de guardar métodos de pago para compras futuras (según plataforma)</li>
                </ul>
            </div>
        </div>    
        <!--SECCIÓN CAMBIOS (imagen izquierda)-->
        <!-- row: fila de bootstrap  align-items-center: centra verticalmente mb-5: margen inferior -->
        <div class="row align-items-center mb-5">   
            <!-- Imagen -->
            <div class="col-md-6">
                <img src="{{ asset('imagenes/devolucion.png') }}" class="img-fluid rounded shadow" alt="Cambios">
            </div>
            <!-- Texto -->
            <div class="col-md-6">
                <i class="bi bi-arrow-repeat fs-1 mb-3 text-dark"></i>
                <h4 class="fw-bold mb-3">Política de Cambios</h4>
                <!-- mt-5: margen superior grande -->
                <div class="mt-5">
                    <!-- TEXTO PRINCIPAL -->
                    <p class="text-muted small">
                        Queremos que estés completamente conforme con tu compra. Si el producto no cumple
                        con tus expectativas, podés solicitar un cambio o <strong>devolución de manera simple,
                        rápida y sin complicaciones</strong>.

                        Nuestro proceso está diseñado para ser transparente y ágil, permitiéndote resolver
                        cualquier inconveniente sin demoras innecesarias y con acompañamiento de nuestro equipo.
                    </p>
                    <!-- LISTA DE CONDICIONES -->
                    <ul class="text-muted small">
                        <li>Plazo de hasta 30 días corridos desde la fecha de compra</li>
                        <li>El producto debe estar sin uso, en perfecto estado y con su empaque original</li>
                        <li>Primer cambio sin costo adicional (sujeto a condiciones)</li>
                        <li>Posibilidad de cambio por talle, modelo o producto diferente</li>
                        <li><strong>Devolución del dinero</strong> dentro de los 7 días hábiles</li>
                        <li>Atención personalizada durante todo el proceso</li>
                        <li>En caso de falla o defecto, el cambio es inmediato sin costo</li>
                    </ul>
                </div>
            </div>
        </div> 

        <!--SECCIÓN EXTRA-->
        <!-- g-4: gap entre columnas mb-5: margen inferior -->
        <div class="row g-4 mb-5">
            <!-- col-12: ocupa todo el ancho -->
            <div class="col-12">
                <h4 class="fw-bold text-center mb-4">¿Cómo comprar en Tillas?</h4>
                <!-- g-3: espacio entre columnas -->
                <div class="row g-3 text-center">
                    <div class="col-6 col-md-3">
                        <!-- p-4: padding interno border rounded: bordes redondeados shadow-sm: sombra suave h-100: altura completa bg-white: fondo blanco tarjeta-valor: clase personalizada -->
                        <div class="p-4 border rounded shadow-sm h-100 bg-white tarjeta-valor">
                            <!-- d-block: hace que el ícono ocupe toda la línea -->
                            <i class="bi bi-search fs-1 text-dark mb-3 d-block"></i>
                            <h6 class="fw-bold text-uppercase">1. Elegí</h6>
                            <p class="text-muted small mb-0">Buscá tus zapas favoritas en nuestro catálogo.</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="p-4 border rounded shadow-sm h-100 bg-white tarjeta-valor">
                            <i class="bi bi-cart3 fs-1 text-dark mb-3 d-block"></i>
                            <h6 class="fw-bold text-uppercase">2. Agregá</h6>
                            <p class="text-muted small mb-0">Seleccioná tu talle y sumalas al carrito.</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="p-4 border rounded shadow-sm h-100 bg-white tarjeta-valor">
                            <i class="bi bi-credit-card fs-1 text-dark mb-3 d-block"></i>
                            <h6 class="fw-bold text-uppercase">3. Pagá</h6>
                            <p class="text-muted small mb-0">Completá tus datos y aboná de forma segura.</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="p-4 border rounded shadow-sm h-100 bg-white tarjeta-valor">
                            <i class="bi bi-box-seam fs-1 text-dark mb-3 d-block"></i>
                            <h6 class="fw-bold text-uppercase">4. Recibí</h6>
                            <p class="text-muted small mb-0">¡Listo! Te lo enviamos directo a tu puerta.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SEGURIDAD -->
        <div class="row mb-5">
            <div class="col-12">
                <!-- d-flex: flexbox flex-column: vertical en mobile flex-md-row: horizontal en PC align-items-center: centra vertical justify-content-center: centra horizontal  gap-4: separación  bg-light: fondo gris claro -->
                <div class="p-4 border rounded shadow-sm d-flex flex-column flex-md-row align-items-center justify-content-center gap-4 bg-light">
                    <div class="d-flex gap-3">
                        <!-- text-success: color verde -->
                        <i class="bi bi-shield-check fs-1 text-success"></i>
                        <i class="bi bi-lock fs-1 text-dark"></i>
                    </div>
                    <div class="text-center text-md-start">
                        <h5 class="fw-bold mb-1">Compra 100% Segura</h5>
                        <p class="text-muted small mb-0">Tus datos y transacciones están protegidos con encriptación SSL de extremo a extremo.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- mt-5: margen arriba pt-5: padding arriba border-top: línea superior -->
        <div class="row mt-5 pt-5 border-top">
            <div class="col-12 text-center">
                <h3 class="fw-bold mb-3">¿Todo listo para estrenar tus próximas Tillas?</h3>
                <p class="text-muted mb-4">Descubrí los últimos ingresos y aprovechá nuestras cuotas sin interés.</p>
                <!-- href: ruta btn-dark: botón negro btn-lg: grande rounded-0: sin bordes redondeados px-5: padding horizontal tracking-wide: separación de letras -->
                <a href="{{ route('catalogo') }}" class="btn btn-dark btn-lg px-5 fw-bold text-uppercase tracking-wide">
                    Ir a la tienda
                </a>
            </div>  
        </div> 
    </div>    
        <!-- componente blade del footer -->
        <x-footer/>
        <!-- script: carga javascript bootstrap.bundle: incluye JS + Popper para componentes -->
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    </body>
</html>