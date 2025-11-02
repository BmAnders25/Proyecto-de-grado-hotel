<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RolController;
use App\Http\Controllers\PisoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\CheckInController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VendedorController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\HabitacionController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ConstruccionController;
use App\Http\Controllers\ConfiguracioneController;
use App\Http\Controllers\TipoHabitacionController;
use App\Http\Controllers\ProductoVendidoController;
use App\Http\Controllers\ProductoCompradoController;
use App\Http\Controllers\MinibarHabitacionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\DetalleFacturaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí es donde puede registrar rutas web para su aplicación. Estas
| rutas son cargadas por RouteServiceProvider y todas ellas
| ser asignado al grupo de middleware "web". ¡Haz algo genial!
|
*/

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    Route::resource('configuracion', ConfiguracioneController::class)->only([
        'index', 'edit', 'update'
    ]);

    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

    
    Route::resource('checkins', CheckInController::class);
    Route::resource('checkouts', CheckOutController::class);

    Route::get('minibar/create/{habitacion}', [MinibarHabitacionController::class, 'create'])->name('minibar.create');
    Route::delete('minibar/{habitacion}/{producto}', [MinibarHabitacionController::class, 'destroy'])
    ->name('minibar.habitacion.destroy');

    Route::resource('minibar', MinibarHabitacionController::class)->except(['create']);
    


    Route::resource('pisos', PisoController::class);

    Route::resource('habitaciones', HabitacionController::class)->parameters([
    'habitaciones' => 'habitacion'
]);



Route::resource('tipo_habitaciones', TipoHabitacionController::class)
    ->parameters(['tipo_habitaciones' => 'tipo']);




Route::middleware(['auth'])->group(function () {


// Registro RESTful estándar (incluye destroy -> DELETE facturas/{factura})
Route::resource('facturas', FacturaController::class);

// Ruta para descargar PDF (GET) usando Route Model Binding
Route::get('facturas/{factura}/pdf', [FacturaController::class, 'descargarPDF'])
    ->name('facturas.pdf');

    

});


    
    Route::resource('reservas', ReservaController::class);

    Route::get('/reservas/{id}/factura', [ReservaController::class, 'factura'])->name('reservas.factura');

    Route::resource('clientes', ClientesController::class );

    Route::resource('vendedores', VendedorController::class );

    Route::resource('empleados', EmpleadoController::class );

    Route::resource('productos', ProductoController::class );

    Route::resource('productoscomprados', ProductoCompradoController::class);

    Route::resource('productosvendidos', ProductoVendidoController::class);
        



    Route::resource('proveedores', ProveedorController::class );

    Route::resource('construccion', ConstruccionController::class);



    Route::resource('users', UserController::class);

    Route::resource('roles', RolController::class);
    
    Route::resource('permissions', PermissionController::class);

    Route::get('/logout', [LogoutController::class, 'logout'])->name('auth.logout');

}); 
