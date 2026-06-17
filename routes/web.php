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
use App\Http\Controllers\ContactoController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminController;
use App\Models\Producto;

// Ruta principal del sitio ("/")
Route::get('/', function () {
    // Traemos los 4 productos más recientes, PERO exigimos que tengan stock
    $nuevosProductos = Producto::whereHas('talles', function ($query) {
        $query->where('stock', '>', 0);
    })
    ->orderBy('created_at', 'desc')
    ->take(4)
    ->get();
    
    return view('inicio', compact('nuevosProductos'));
})->name('inicio');

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

// --- RUTAS DE AUTENTICACIÓN PÚBLICAS ---
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// --- REGISTRO DE USUARIOS ---
// Muestra el formulario de registro visual para nuevos clientes.
Route::get('/registro', [AuthController::class, 'showRegisterForm'])->name('registro');
// Recibe los datos de registro, encripta la contraseña y crea el usuario en la base de datos.
Route::post('/registro', [AuthController::class, 'register'])->name('registro.post');


// --- RECUPERACIÓN DE CONTRASEÑA ---
// Muestra el formulario inicial para ingresar el correo
Route::get('/olvido-contrasena', [AuthController::class, 'showOlvidoForm'])->name('password.request');
// Procesa el correo enviado y simula la verificación de cuenta
Route::post('/olvido-contrasena', [AuthController::class, 'procesarOlvido'])->name('password.email');
// Actualiza la contraseña encriptada en la base de datos controlando que no se repita
Route::post('/reiniciar-contrasena', [AuthController::class, 'procesarReinicio'])->name('password.update');


// --- ZONA DE ADMINISTRACIÓN (VIP) ---
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->group(function () {
    // Carga la vista real del panel de administración corporativo
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    
    // La tabla de Inventario
    Route::get('/inventario', [AdminController::class, 'inventario'])->name('admin.inventario');

    // Ruta para ver el listado de usuarios
    Route::get('/usuarios', [AdminController::class, 'usuarios'])->name('admin.usuarios');
    
    // Rutas para que el admin cree otros administradores
    Route::get('/usuarios/nuevo', [AdminController::class, 'createUsuario'])->name('admin.usuarios.create');
    Route::post('/usuarios/nuevo', [AdminController::class, 'storeUsuario'])->name('admin.usuarios.store');
    Route::put('/usuarios/{id}/rol', [AdminController::class, 'updateRol'])->name('admin.usuarios.updateRol');
    
    // Ruta para mostrar el formulario vacío de carga de calzados
    Route::get('/productos/crear', [AdminController::class, 'create'])->name('admin.create');
    
    // Ruta oculta (POST) para recibir los datos del formulario y la foto de la zapatilla
    Route::post('/productos', [AdminController::class, 'store'])->name('admin.store');
    
    // Rutas para gestionar el stock de un producto específico
    Route::get('/productos/{id}/talles', [AdminController::class, 'talles'])->name('admin.talles');
    Route::post('/productos/{id}/talles', [AdminController::class, 'guardarTalle'])->name('admin.talles.store');
    
    // Rutas para Modificaciones (U) y Baja (D)
    Route::get('/productos/{id}/editar', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/productos/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/productos/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    
    // Ruta para eliminar un talle
    Route::delete('/talles/{id}', [AdminController::class, 'destroyTalle'])->name('admin.talles.destroy');
    
    // Bandeja de entrada de contactos
    Route::get('/mensajes', [AdminController::class, 'mensajes'])->name('admin.mensajes');

    // Eliminar un mensaje de contacto
    Route::delete('/mensajes/{id}', [AdminController::class, 'destroyMensaje'])->name('admin.mensajes.destroy');
    
    // Historial de ventas realizadas
    Route::get('/ventas', [AdminController::class, 'ventas'])->name('admin.ventas');
});

// --- RUTAS DE COMPRA Y SESIÓN PROTEGIDAS (Solo Clientes Logueados) ---
// Todo lo que esté dentro de este grupo requiere iniciar sesión obligatoriamente
Route::middleware(['auth'])->group(function () {
    
    // Rutas del Carrito de Compras
    Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
    Route::post('/carrito/eliminar', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');

    // Actualizar cantidad en el carrito
    Route::put('/carrito/actualizar', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');

    // Rutas del Checkout (Pantalla de Envío y Pago)
    Route::get('/checkout', [CarritoController::class, 'mostrarCheckout'])->name('checkout');
    Route::post('/checkout/procesar', [CarritoController::class, 'procesarCompra'])->name('checkout.procesar');

    // Historial de Compras (Busca en MariaDB las compras del usuario logueado)
    Route::get('/mis-compras', [CarritoController::class, 'historial'])->name('compras.historial');
    
    // Emisión de Comprobantes (Muestra la Factura B comercial dinámica usando el ID de compra)
    Route::get('/compras/factura/{id}', [CarritoController::class, 'verFactura'])->name('compras.factura');
});

Route::post('/contacto', [ContactoController::class, 'store'])->name('contacto.store');