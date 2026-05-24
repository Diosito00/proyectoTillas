{{-- Definimos las variables (propiedades) que este componente va a recibir. 
    Algunas tienen un valor por defecto (como null o false) para que no sea obligatorio pasarlas siempre. --}}
@props(['id', 'marca', 'nombre', 'precio', 'imagen', 'precioViejo' => null, 'nuevo' => false, 'descuento' => null])

{{-- col: columna dentro del sistema de grilla de Bootstrap --}}
<div class="col">
    {{-- card: componente visual tipo tarjeta product-card: clase personalizada para estilos propios border-0: elimina el borde por defecto  h-100: hace que todas las tarjetas tengan la misma altura --}}
    <div class="card product-card border-0 h-100">
        {{-- position-relative: permite posicionar elementos encima (badges)  bg-light: fondo gris claro rounded: bordes redondeados overflow-hidden: oculta lo que se salga (ej: imagen zoom) --}}
        <div class="position-relative bg-light rounded overflow-hidden">
            
            {{-- Lógica condicional: Solo muestra la etiqueta "NUEVO" si la variable $nuevo es verdadera --}}
            @if($nuevo)
            {{-- badge: etiqueta visual bg-dark text-white: fondo negro, texto blanco  position-absolute: posición libre dentro del contenedor top-0 start-0: esquina superior izquierda m-3: margen z-1: se asegura que esté por encima de la imagen --}}
                <span class="badge bg-dark text-white position-absolute top-0 start-0 m-3 z-1 px-2 py-1">NUEVO</span>
            @endif
            
            {{-- Lógica condicional: Solo muestra la etiqueta roja si se le pasa un valor a $descuento --}}
            @if($descuento)
            {{-- bg-danger: fondo rojo --}}
                <span class="badge bg-danger text-white position-absolute top-0 start-0 m-3 z-1 px-2 py-1">{{ $descuento }}</span>
            @endif

            
            {{-- Imprimimos la imagen y el nombre dinámicamente asset(): genera la ruta correcta en Laravel alt: texto alternativo (importante para accesibilidad y SEO) card-img-top: estilo Bootstrap para imágenes de cards
            product-img: clase propia (ej: zoom, hover, etc) --}}
            <img src="{{ asset($imagen) }}" class="card-img-top product-img" alt="{{ $nombre }}">
        </div>
        
            {{-- card-body: contenido de la tarjeta px-0: elimina padding horizontal pb-0: elimina padding inferior --}}
        <div class="card-body px-0 pb-0">
            {{-- Marca del producto text-muted: color gris small: texto pequeño mb-1: pequeño margen abajo text-uppercase: todo en mayúsculas tracking-wide: separación de letras (CSS propio) --}}
            <p class="text-muted small mb-1 text-uppercase tracking-wide">{{ $marca }}</p>
            {{-- Nombre del producto fw-bold: negrita fs-6: tamaño de fuente chico --}}
            <h5 class="card-title fw-bold mb-1 fs-6">{{ $nombre }}</h5>
            
            {{-- Lógica condicional para el precio: Si hay un precio viejo, mostramos ambos. Si no, solo mostramos el precio actual. --}}
            @if($precioViejo)
            {{-- d-flex: flexbox  align-items-center: alinea verticalmente gap-2: espacio entre elementos --}}
                <div class="d-flex align-items-center gap-2 mb-3">
                    <p class="card-text fw-bold fs-5 mb-0">${{ $precio }}</p>
                    {{--text-decoration-line-through: línea tachada --}} 
                    <p class="text-decoration-line-through text-muted small mb-0">${{ $precioViejo }}</p>
                </div>
            @else
                <p class="card-text fw-bold fs-5 mb-3">${{ $precio }}</p>
            @endif
            
            <a href="{{ route('producto.show', $id) }}" class="btn btn-dark w-100 fw-bold text-uppercase rounded-0 btn-comprar">Ver Detalles</a>
        </div>
    </div>
</div>