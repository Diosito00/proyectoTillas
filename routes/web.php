<?php
// Importa la clase Route para definir rutas en Laravel
use Illuminate\Support\Facades\Route;
// Importa Request para manejar datos enviados en formularios (POST)
use Illuminate\Http\Request;
// Importa el controlador de productos y autenticacion en login
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\CarritoController;

// Ruta principal del sitio ("/")
// Cuando alguien entra a la raíz, devuelve la vista 'inicio'
Route::get('/', function () {
    return view('inicio');
});

// Ruta "/quienes" que muestra la vista 'quienes'
Route::get('/quienes', function(){
    return view('quienes');
});

// Ruta "/comercializacion" que muestra la vista correspondiente
Route::get('/comercializacion', function(){
    return view('comercializacion');
});

// Ruta "/contacto" que muestra el formulario de contacto
Route::get('/contacto', function(){
    return view('contacto');
});

// Ruta "/terminos" que muestra términos y condiciones
Route::get('/terminos', function(){
    return view('terminos');
});

// Ruta "/privacidad" que muestra políticas de privacidad
Route::get('/privacidad', function(){
    return view('privacidad');
});

// Cuando entren a /catalogo, ejecuta la función 'index' del CatalogoController
Route::get('/catalogo', [CatalogoController::class, 'index'])->name('catalogo');

// El {id} es un parámetro dinámico que capturará el número de la zapatilla
Route::get('/producto/{id}', [CatalogoController::class, 'show'])->name('producto.show');

// Ruta "/en-proceso" que muestra una vista de proceso en curso
// Se le asigna un nombre para poder referenciarla fácilmente
Route::get('/en-proceso', function () {
    return view('en-proceso');
})->name('en-proceso');

// Ruta POST "/contacto"
// Se ejecuta cuando se envía el formulario de contacto
Route::post('/contacto', function (Request $request) {
    // Redirige a la ruta 'contacto.exito'
    // y envía datos del formulario (nombre y email)
    return redirect()->route('contacto.exito')->with([
        'nombre' => $request->nombre,
        'email' => $request->email
    ]);
})->name('contacto.enviar');

// Ruta GET "/contacto/exito"
// Muestra una vista de confirmación luego de enviar el formulario
Route::get('/contacto/exito', function () {
    return view('contacto-exito');
})->name('contacto.exito');

// Route::get('/login', function () {
//     return view('login');
// });

// Rutas de Autenticación (Públicas)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Todo lo que esté dentro de este grupo requiere iniciar sesión
Route::middleware('auth')->group(function () {
    
    // Ruta para procesar el formulario cuando hacen clic en "Agregar al carrito"
    Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    
    // Ruta para ver la página del carrito (la armaremos después)
    Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
    
    // Ruta para eliminar un producto específico del carrito
    Route::post('/carrito/eliminar', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');

    // Ruta para procesar la compra final
    Route::post('/checkout', [CarritoController::class, 'procesarCompra'])->name('checkout');
});