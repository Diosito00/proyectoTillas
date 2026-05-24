<!DOCTYPE html>
<!-- html: raíz del documento lang="es": idioma español -->
<html lang="es">
<head>
    <!-- charset UTF-8: permite usar tildes, ñ, símbolos -->
    <meta charset="UTF-8">
    <!-- viewport: hace que el diseño sea responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Compatibilidad con navegadores antiguos -->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS: estilos base -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <!-- FontAwesome: librería de íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- CSS propio del footer -->
    <link rel="stylesheet" href="{{ asset('css/style-footer.css') }}?v={{ time() }}">
</head>

<!-- footer: etiqueta semántica para el pie de página cat-footer: clase personalizada -->
<footer class="cat-footer">
    <!-- container: centra el contenido  py-5: padding arriba y abajo -->
    <div class="container py-5">
        <!-- row: fila de Bootstrap g-4: separación entre columnas -->
        <div class="row g-4">
            <!-- BLOQUE MARCA col-12: ocupa todo en celular  col-md-3: ocupa 1/4 en PC -->
            <div class="col-12 col-md-3">
                <!-- Contenedor del logo -->
                <div class="footer-brand">
                    <!-- Imagen del logo asset(): ruta dinámica en Laravel -->
                    <img src="{{ asset('imagenes/Logo-blanco.png') }}" alt="tillas logo">
                    <!-- Nombre de la marca -<span>: Etiqueta en línea (no genera saltos de línea) ideal para aplicar estilos a fragmentos de texto pequeños, como el nombre de la marca. -->
                    <span class="footer-brand-name">Tillas</span>
                </div>
                <!-- Subtítulo o slogan -->
                <div class="footer-tagline">zapatillas store</div>
            </div>

            <!-- BLOQUE SOBRE NOSOTROS -->
            <div class="col-12 col-md-3">
                <h6>Sobre Nosotros</h6>
                <p>
                    Tillas es una plataforma especializada en calzados deportivos.
                    Diseñada para mujeres, hombres y niños, ofrecemos compras seguras y recomendaciones expertas.
                </p>
            </div>

            <!-- BLOQUE CONTACTO -->
            <div class="col-12 col-md-3">
                <h6>Contactanos</h6>
                <div class="contact-item">
                    {{-- <i> con clases de FontAwesome: 
                        fas: Significa "Font Awesome Solid" (íconos rellenados).
                        fa-envelope, fa-phone, fa-map-marker-alt: Son los nombres específicos de cada ícono. --}}
                    <i class="fas fa-envelope"></i>
                    <span>info@tillas.com</span>
                </div>
                <div class="contact-item">
                    <i class="fas fa-phone"></i>
                    <span>+54 379 4777777</span>
                </div>
                <div class="contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>126 Calle Y, Corrientes, Argentina</span>
                </div>
            </div>

            <!-- BLOQUE REDES SOCIALES -->
            <div class="col-12 col-md-3">
                <h6>Redes Sociales</h6>
                {{-- d-flex gap-2: Activa Flexbox. Pone todos los botones de redes sociales en una sola línea horizontal y les agrega una separación nivel 2 entre ellos. --}}
                <div class="d-flex gap-2">
                    
                    {{-- aria-label="...": Esta etiqueta no se ve en la pantalla, pero es leída por los programas para personas con discapacidad visual, indicándoles hacia dónde lleva el enlace, ya que no hay texto visible, solo un ícono. --}}
                    <a href="{{ route('en-proceso') }}" class="social-link" aria-label="Facebook" target="blank">
                        {{-- fab: Significa "Font Awesome Brands" (para íconos de logotipos de empresas/marcas registradas). --}}
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="{{ route('en-proceso') }}" class="social-link" aria-label="Twitter" target="blank">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="{{ route('en-proceso') }}" class="social-link" aria-label="Instagram" target="blank">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="{{ route('en-proceso') }}" class="social-link" aria-label="LinkedIn" target="blank">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Bottom bar (Barra Inferior de Copyright y Legales) --}}
        <div class="footer-bottom">
            <!-- &copy;: símbolo de copyright -->
            <!-- date('Y'): año automático -->
            <span>&copy; {{ date('Y') }} Tillas. Todos los derechos reservados.</span>
            
            <div class="d-flex gap-3">
                <a href="/privacidad">Política de Privacidad</a>
                <a href="/terminos">Términos de Servicio</a>
            </div>
        </div>
    </div>
</footer>
</html>