<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RolController;
use App\Http\Controllers\PisoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\CheckInController;
use App\Http\Controllers\ConsumoController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\VendedorController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\HabitacionController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ConstruccionController;
use App\Http\Controllers\ConfiguracioneController;
use App\Http\Controllers\TipoHabitacionController;
use App\Http\Controllers\ProductoVendidoController;
use App\Http\Controllers\ProductoCompradoController;
use App\Http\Controllers\MinibarInventarioController;
use App\Http\Controllers\DashboardController;

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


    Route::resource('minibarinventario', MinibarInventarioController::class)->only([
    'index',     
    'show',      
    'edit',     
    'update',    
    'destroy'    
]);

    Route::resource('pisos', PisoController::class);

    Route::resource('habitaciones', HabitacionController::class)->parameters([
    'habitaciones' => 'habitacion'
]);


Route::resource('tipo_habitaciones', TipoHabitacionController::class)
    ->parameters(['tipo_habitaciones' => 'tipo']);





    Route::resource('gastos', GastoController::class);
    
    Route::resource('reservas', ReservaController::class);

    Route::get('/reservas/{id}/factura', [ReservaController::class, 'factura'])->name('reservas.factura');

    Route::resource('clientes', ClientesController::class );

    Route::resource('vendedores', VendedorController::class );

    Route::resource('empleados', EmpleadoController::class );

    Route::resource('pacientes', PacienteController::class );

    Route::resource('productos', ProductoController::class );

    Route::resource('productoscomprados', ProductoCompradoController::class);

    Route::resource('productosvendidos', ProductoVendidoController::class);
        

    // Consumops por habitación
    Route::get('/consumos', [ConsumoController::class, 'index'])
    ->name('consumos.index')
    ->middleware('permission:ver-consumos');

    Route::get('/consumos/crear', [ConsumoController::class, 'create'])
    ->name('consumos.create')
    ->middleware('permission:crear-consumos');

    Route::post('/consumos', [ConsumoController::class, 'store'])
    ->name('consumos.store')
    ->middleware('permission:crear-consumos');

    Route::resource('servicios', ServicioController::class );

    Route::resource('proveedores', ProveedorController::class );

    Route::resource('construccion', ConstruccionController::class);



    Route::resource('users', UserController::class);

    Route::resource('roles', RolController::class);
    
    Route::resource('permissions', PermissionController::class);

    Route::get('/logout', [LogoutController::class, 'logout'])->name('auth.logout');

}); 
