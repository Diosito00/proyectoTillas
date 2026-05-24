<!-- Indica que el documento es HTML5 (forma en que el navegador interpreta la página) -->
<!DOCTYPE html>
<!-- Etiqueta principal que contiene toda la página -->
<!-- lang="es" indica que el idioma es español (sirve para SEO y accesibilidad) -->
<html lang="es">
<head>
    <!-- Define la codificación de caracteres (permite usar acentos, ñ, símbolos) -->
    <meta charset="UTF-8">
    <!-- Hace que la página sea responsive (se adapte a celular, tablet y PC) -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Catalogo | Tillas - Zapatillas Urbanas</title>
    <!-- Ícono de la pestaña -->
    <!-- asset() genera la ruta correcta del archivo en Laravel -->
    <link rel="icon" href="{{ asset('imagenes/Logo-blanco.ico') }}" type="image/x-icon">
    <!-- Carga Bootstrap desde el proyecto.-->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <!-- Carga íconos desde internet (CDN) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Carga hoja de estilos propia del proyecto "catalogo.css".-->
    <link rel="stylesheet" href="{{ asset('css/style-catalogo.css') }}?v={{ time() }}">
</head>


<body>
    <!-- Componente Blade: barra de navegación reutilizable -->
    <x-navbar/>
    
    <!-- Contenedor con fondo claro, espacio vertical y borde inferior -->
    <div class="bg-light py-3 border-bottom">
        <!-- Centra el contenido y limita el ancho -->
        <div class="container">
            <!-- Sección de navegación tipo breadcrumb (para accesibilidad) -->
            <nav aria-label="breadcrumb">
                <!-- Lista ordenada con estilo de migas de pan y sin margen inferior -->
                <ol class="breadcrumb mb-0">

                    <li class="breadcrumb-item">
                        <!-- Enlace a la página principal -->
                        <a href="/" class="text-dark text-decoration-none">Inicio</a>
                    </li>
                    <!-- Página actual "catalogo" -->
                    <li class="breadcrumb-item active" aria-current="page">Catálogo</li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- CONTENEDOR PRINCIPAL DEL CATÁLOGO --}}
    <section class="container py-5">
        <!-- Formulario que se usa para filtrar los productos 
        action: envía los datos a la ruta "catalogo" (Laravel genera la URL automáticamente) method="GET": los datos se mandan en la URL (ej: ?categorias=hombre)-->
        <form action="{{ route('catalogo') }}" method="GET" id="formFiltros" class="row g-5">
            
            {{--COLUMNA IZQUIERDA: BARRA DE FILTROS --}}
            <!-- Contenido secundario (barra lateral) ocupa todo en celular y 3 columnas en pantallas grandes -->
            <aside class="col-12 col-lg-3">
                <h4 class="fw-bold mb-4 text-uppercase">Filtros</h4>
                
                {{-- Bloque de Filtro: Categorías --}}
                <div class="mb-4">
                    <h6 class="fw-bold mb-3">Categorías</h6>
                    <div class="form-check mb-2">
                        <!-- Checkbox para filtrar por la categoría "hombre" 
                        name="categorias[]" permite seleccionar varias categorías (se envía como lista) 
                        value="hombre" es el valor que se manda cuando está marcado 
                        Blade: si "hombre" ya estaba seleccionado antes, el checkbox aparece marcado
                        onchange: cuando el usuario hace clic, el formulario se envía automáticamente -->
                        <input class="form-check-input" type="checkbox" name="categorias[]" value="hombre" id="catHombre"
                        {{ in_array('hombre', request('categorias', [])) ? 'checked' : '' }}
                        onchange="document.getElementById('formFiltros').submit();">
                        <!-- Texto asociado al checkbox -->
                        <label class="form-check-label text-muted" for="catHombre">Hombres</label>
                    </div>

                    <div class="form-check mb-2">
                        <!-- Checkbox para filtrar por la categoría "mujer"  name="categorias[]" permite seleccionar varias categorías, value="mujer" es el valor que se envía al marcar
                        Blade: si "mujer" ya estaba seleccionado, queda marcado automáticamente, onchange: al hacer clic, se envía el formulario solo -->
                        <input class="form-check-input" type="checkbox" name="categorias[]" value="mujer" id="catMujer"
                        {{ in_array('mujer', request('categorias', [])) ? 'checked' : '' }}
                        onchange="document.getElementById('formFiltros').submit();">

                        <!-- Texto del checkbox for="catMujer" lo conecta con el input -->
                        <label class="form-check-label text-muted" for="catMujer">Mujeres</label>
                    </div>
                    
                    <!-- Otro checkbox igual, pero para "niño" -->
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="categorias[]" value="nino" id="catNino"
                        {{ in_array('nino', request('categorias', [])) ? 'checked' : '' }}
                        onchange="document.getElementById('formFiltros').submit();">
                        <label class="form-check-label text-muted" for="catNino">Niños</label>
                    </div>

                    <div class="mb-4 border-top pt-4">
                        <!-- Otro checkbox igual, pero para "running" -->
                        <h6 class="fw-bold mb-3">Deporte / Uso</h6>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="deportes[]" value="running" id="depRunning"
                                {{ in_array('running', request('deportes', [])) ? 'checked' : '' }}
                                onchange="document.getElementById('formFiltros').submit();">
                            <label class="form-check-label text-muted" for="depRunning">Running</label>
                        </div>
                        
                        <!-- Otro checkbox igual, pero para "urbano/casual" -->
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="deportes[]" value="urbano" id="depUrbano"
                                {{ in_array('urbano', request('deportes', [])) ? 'checked' : '' }}
                                onchange="document.getElementById('formFiltros').submit();">
                            <label class="form-check-label text-muted" for="depUrbano">Urbano / Casual</label>
                        </div>
                        
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="deportes[]" value="entrenamiento" id="depEntrenamiento"
                                {{ in_array('entrenamiento', request('deportes', [])) ? 'checked' : '' }}
                                onchange="document.getElementById('formFiltros').submit();">
                            <label class="form-check-label text-muted" for="depEntrenamiento">Entrenamiento</label>
                        </div>
                    </div>
                </div>

                {{-- Bloque de Filtro: Marcas --}}
                <div class="mb-4 border-top pt-4">
                    <h6 class="fw-bold mb-3">Marcas</h6>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="marcas[]" value="puma" id="marcaPuma"
                        {{ in_array('puma', request('marcas', [])) ? 'checked' : '' }}
                        onchange="document.getElementById('formFiltros').submit();">
                        <label class="form-check-label text-muted" for="marcaPuma">Puma</label>
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="marcas[]" value="topper" id="marcaTopper"
                        {{ in_array('topper', request('marcas', [])) ? 'checked' : '' }}
                        onchange="document.getElementById('formFiltros').submit();">
                        <label class="form-check-label text-muted" for="marcaTopper">Topper</label>
                    </div>
                </div>

                {{-- Botón para celulares (En PC los filtros se aplican solos al hacer clic gracias al onchange) --}}
                <!-- Este contenido solo aparece si el navegador NO tiene JavaScript -->
                <noscript>
                    <!-- Botón que envía el formulario manualmente  Se usa como alternativa al onchange (auto envío) -->
                    <button type="submit" class="btn btn-dark w-100 mt-3">Aplicar Filtros</button>
                </noscript>

        <!-- Fin de la barra lateral de filtros -->
        </aside>

            {{-- COLUMNA DERECHA: GRILLA DE PRODUCTOS --}}
            <!-- Contenido principal ocupa todo en celular y 9 columnas en pantallas grandes -->
            <main class="col-12 col-lg-9">
                
                {{-- Barra superior de herramientas (Top bar) --}}
                <!-- Contenedor flexible se adapta entre columna y fila según pantalla separa elementos y agrega línea inferior -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 pb-3 border-bottom">
                    
                    {{-- Mostramos la cantidad real de productos usando Blade --}}
                    <!-- Muestra la cantidad total de productos,  Span para resaltar el número, $productos Variable con los productos. ->total() Método que devuelve la cantidad total.-->
                    <p class="text-muted mb-3 mb-md-0">Mostrando <span class="fw-bold text-dark">{{ $productos->total() }}</span> resultados</p>
                    
                    {{-- Select para ordenar los productos --}}
                    <div class="d-flex align-items-center gap-2">
                        <!-- Texto del selector -->
                        <label for="ordenarPor" class="text-nowrap text-muted small">Ordenar por:</label>
                        <!-- Lista desplegable, name: dato que se envía, onchange: al cambiar, se envía el formulario -->
                        <select class="form-select form-select-sm rounded-0 border-dark" name="ordenarPor" id="ordenarPor" onchange="document.getElementById('formFiltros').submit();">
                            <!-- Ordena por productos más recientes -->
                            <option value="recientes" {{ request('ordenarPor') == 'recientes' ? 'selected' : '' }}>Nuevos Ingresos</option>
                            <!-- Ordena de menor a mayor -->
                            <option value="menor_precio" {{ request('ordenarPor') == 'menor_precio' ? 'selected' : '' }}>Menor a Mayor Precio</option>
                            <!-- Ordena de mayor a menor -->
                            <option value="mayor_precio" {{ request('ordenarPor') == 'mayor_precio' ? 'selected' : '' }}>Mayor a Menor Precio</option>
                        </select>
                    </div>
                </div>

                {{-- Grilla de Productos --}}
                <!-- Contenedor de productos en forma de grilla, 1 columna en celular, 3 columnas en pantallas grandes g-4 agrega espacio entre los productos -->
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    
                    {{-- Usamos el bucle foreach para imprimir los componentes --}}
                    <!-- Recorre todos los productos -->
                    @forelse($productos as $producto)
                        <!-- Componente que muestra cada producto, Se le pasan datos: marca, nombre, precio e imagen, number_format formatea el precio (ej: 15000 → 15.000) -->
                        <x-product-card
                            :id="$producto->id" 
                            :marca="$producto->marca" 
                            :nombre="$producto->nombre" 
                            :precio="number_format($producto->precio, 0, ',', '.')" 
                            :imagen="asset('imagenes/' . $producto->imagen_url)" 
                        />

                    <!-- Mensaje si no hay productos -->
                    @empty
                        <div class="col-12 text-center py-5">
                            <p class="text-muted">No se encontraron productos con esos filtros.</p>
                        </div>
                    @endforelse

                </div>

                {{-- PAGINACIÓN BÁSICA DE LARAVEL + BOOTSTRAP --}}
                <!-- Contenedor con margen arriba y centrado -->
                <div class="mt-5 d-flex justify-content-center">
                    <!-- Genera automáticamente la paginación  Laravel crea los botones para cambiar de página -->
                    {{ $productos->links() }}
                </div>

            </main>
        </form>
    </section>

    <!-- Componente Blade: pie de página -->
    <x-footer />
    <!-- Carga el JavaScript de Bootstrap, Permite usar componentes interactivos -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>