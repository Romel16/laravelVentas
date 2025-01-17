<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/* require __DIR__.'/auth.php'; */

Auth::routes();

Route::get('/home', [App\Http\Controllers\AdminController::class, 'index'])->name('home');



Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index')->middleware('auth');

Route::get('/crear-empresa', [App\Http\Controllers\EmpresaController::class, 'create'])->name('admin.empresas.create');
Route::get('/crear-empresa/pais/{id_pais}', [App\Http\Controllers\EmpresaController::class, 'buscar_estado'])->name('admin.empresas.create.buscar_estado');
Route::get('/crear-empresa/estado/{id_estados}', [App\Http\Controllers\EmpresaController::class, 'buscar_ciudad'])->name('admin.empresas.create.buscar_ciudad');
Route::post('/crear-empresa/create', [App\Http\Controllers\EmpresaController::class, 'store'])->name('admin.empresas.create.store');

//Rutas para configuracion
Route::get('/admin/configuraciones', [App\Http\Controllers\EmpresaController::class, 'edit'])->name('admin.configuraciones.edit')->middleware('auth','can:Configuracion del Sistema');
Route::get('/admin/configuraciones/pais/{id_pais}', [App\Http\Controllers\EmpresaController::class, 'buscar_estado'])->name('admin.configuracion.empresas.create.buscar_estado');
Route::get('/admin/configuraciones/estado/{id_estados}', [App\Http\Controllers\EmpresaController::class, 'buscar_ciudad'])->name('admin.configuracion.empresas.create.buscar_ciudad');
Route::put('/admin/configuraciones/{id}', [App\Http\Controllers\EmpresaController::class, 'update'])->name('admin.configuraciones.update');


//Rutas para roles
Route::get('/admin/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('admin.roles.index')->middleware('auth','can:Listado de roles');
Route::get('/admin/roles/reporte', [App\Http\Controllers\RoleController::class, 'reporte'])->name('admin.roles.reportes')->middleware('auth');
Route::get('/admin/roles/create', [App\Http\Controllers\RoleController::class, 'create'])->name('admin.roles.create')->middleware('auth','can:Crear role');
Route::post('/admin/roles/create', [App\Http\Controllers\RoleController::class, 'store'])->name('admin.roles.store')->middleware('auth');
Route::get('/admin/roles/{id}', [App\Http\Controllers\RoleController::class, 'show'])->name('admin.roles.show')->middleware('auth','can:Ver datos de rol');
Route::get('/admin/roles/{id}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('admin.roles.edit')->middleware('auth','can:Editar rol');
Route::get('/admin/roles/{id}/asignar', [App\Http\Controllers\RoleController::class, 'asignar'])->name('admin.roles.asignar')->middleware('auth');
Route::put('/admin/roles/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('admin.roles.update')->middleware('auth');
Route::put('/admin/roles/asignar/{id}', [App\Http\Controllers\RoleController::class, 'update_asignar'])->name('admin.roles.update_asignar')->middleware('auth');
Route::delete('/admin/roles/{id}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('admin.roles.destroy')->middleware('auth','can:Eliminar rol');


//Rutas para usuarios
Route::get('/admin/usuarios', [App\Http\Controllers\UsuarioController::class, 'index'])->name('admin.usuarios.index')->middleware('auth','can:Listado de usuario');
Route::get('/admin/usuarios/reporte', [App\Http\Controllers\UsuarioController::class, 'reporte'])->name('admin.usuarios.reportes')->middleware('auth','can:Ver reporte de usuario');
Route::get('/admin/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'create'])->name('admin.usuarios.create')->middleware('auth','can:Crear usuario');
Route::post('/admin/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'store'])->name('admin.usuarios.store')->middleware('auth');
Route::get('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'show'])->name('admin.usuarios.show')->middleware('auth','can:Ver datos del usuario');
Route::get('/admin/usuarios/{id}/edit', [App\Http\Controllers\UsuarioController::class, 'edit'])->name('admin.usuarios.edit')->middleware('auth','can:Editar usuario');
Route::put('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'update'])->name('admin.usuarios.update')->middleware('auth');
Route::delete('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'destroy'])->name('admin.usuarios.destroy')->middleware('auth','can:Eliminar usuario');


//Rutas para categorias
Route::get('/admin/categorias', [App\Http\Controllers\CategoriaController::class, 'index'])->name('admin.categorias.index')->middleware('auth','can:Listado de categoria');

Route::get('/admin/categorias/reporte', [App\Http\Controllers\CategoriaController::class, 'reporte'])->name('admin.categorias.reportes')->middleware('auth','can:Ver reporte de categoria');

Route::get('/admin/categorias/create', [App\Http\Controllers\CategoriaController::class, 'create'])->name('admin.categorias.create')->middleware('auth','can:Crear categoria');
Route::post('/admin/categorias/create', [App\Http\Controllers\CategoriaController::class, 'store'])->name('admin.categorias.store')->middleware('auth');
Route::get('/admin/categorias/{id}', [App\Http\Controllers\CategoriaController::class, 'show'])->name('admin.categorias.show')->middleware('auth','can:Ver datos de categoria');
Route::get('/admin/categorias/{id}/edit', [App\Http\Controllers\CategoriaController::class, 'edit'])->name('admin.categorias.edit')->middleware('auth','can:Editar categoria');
Route::put('/admin/categorias/{id}', [App\Http\Controllers\CategoriaController::class, 'update'])->name('admin.categorias.update')->middleware('auth');
Route::delete('/admin/categorias/{id}', [App\Http\Controllers\CategoriaController::class, 'destroy'])->name('admin.categorias.destroy')->middleware('auth','can:Eliminar categoria');


//Rutas para productos
Route::get('/admin/productos', [App\Http\Controllers\ProductoController::class, 'index'])->name('admin.productos.index')->middleware('auth','can:Listado de producto');

Route::get('/admin/productos/reporte', [App\Http\Controllers\ProductoController::class, 'reporte'])->name('admin.productos.reportes')->middleware('auth','can:Ver reporte de producto');

Route::get('/admin/productos/create', [App\Http\Controllers\ProductoController::class, 'create'])->name('admin.productos.create')->middleware('auth','can:Crear producto');
Route::post('/admin/productos/create', [App\Http\Controllers\ProductoController::class, 'store'])->name('admin.productos.store')->middleware('auth');
Route::get('/admin/productos/{id}', [App\Http\Controllers\ProductoController::class, 'show'])->name('admin.productos.show')->middleware('auth','can:Ver datos del producto');
Route::get('/admin/productos/{id}/edit', [App\Http\Controllers\ProductoController::class, 'edit'])->name('admin.productos.edit')->middleware('auth','can:Editar producto');
Route::put('/admin/productos/{id}', [App\Http\Controllers\ProductoController::class, 'update'])->name('admin.productos.update')->middleware('auth');
Route::delete('/admin/productos/{id}', [App\Http\Controllers\ProductoController::class, 'destroy'])->name('admin.productos.destroy')->middleware('auth','can:Eliminar producto');

//Rutas para proveedores
Route::get('/admin/proveedor', [App\Http\Controllers\ProveedorController::class, 'index'])->name('admin.proveedor.index')->middleware('auth','can:Listado de proveedor');

Route::get('/admin/proveedor/reporte', [App\Http\Controllers\ProveedorController::class, 'reporte'])->name('admin.proveedor.reportes')->middleware('auth','can:Ver reporte de proveedor');

Route::get('/admin/proveedor/create', [App\Http\Controllers\ProveedorController::class, 'create'])->name('admin.proveedor.create')->middleware('auth','can:Crear proveedor');
Route::post('/admin/proveedor/create', [App\Http\Controllers\ProveedorController::class, 'store'])->name('admin.proveedor.store')->middleware('auth');
Route::get('/admin/proveedor/{id}', [App\Http\Controllers\ProveedorController::class, 'show'])->name('admin.proveedor.show')->middleware('auth','can:Ver datos del proveedor');
Route::get('/admin/proveedor/{id}/edit', [App\Http\Controllers\ProveedorController::class, 'edit'])->name('admin.proveedor.edit')->middleware('auth','can:Editar proveedor');
Route::put('/admin/proveedor/{id}', [App\Http\Controllers\ProveedorController::class, 'update'])->name('admin.proveedor.update')->middleware('auth');
Route::delete('/admin/proveedor/{id}', [App\Http\Controllers\ProveedorController::class, 'destroy'])->name('admin.proveedor.destroy')->middleware('auth','can:Eliminar proveedor');


//Rutas para compras
Route::get('/admin/compras', [App\Http\Controllers\CompraController::class, 'index'])->name('admin.compras.index')->middleware('auth','can:Listado de compras');

Route::get('/admin/compras/reporte', [App\Http\Controllers\CompraController::class, 'reporte'])->name('admin.compras.reportes')->middleware('auth','can:Ver reporte de compras');

Route::get('/admin/compras/create', [App\Http\Controllers\CompraController::class, 'create'])->name('admin.compras.create')->middleware('auth','can:Crear compras');
Route::post('/admin/compras/create', [App\Http\Controllers\CompraController::class, 'store'])->name('admin.compras.store')->middleware('auth');
Route::get('/admin/compras/{id}', [App\Http\Controllers\CompraController::class, 'show'])->name('admin.compras.show')->middleware('auth','can:Ver datos de compras');
Route::get('/admin/compras/{id}/edit', [App\Http\Controllers\CompraController::class, 'edit'])->name('admin.compras.edit')->middleware('auth','can:Editar compras');
Route::put('/admin/compras/{id}', [App\Http\Controllers\CompraController::class, 'update'])->name('admin.compras.update')->middleware('auth');
Route::delete('/admin/compras/{id}', [App\Http\Controllers\CompraController::class, 'destroy'])->name('admin.compras.destroy')->middleware('auth','can:Eliminar compras');


//rutas para tmp_compras
Route::post('/admin/compras/create/tmp', [App\Http\Controllers\TmpCompraController::class, 'tmp_compra'])->name('admin.compras.tmp_compras')->middleware('auth');
Route::delete('/admin/compras/create/tmp/{id}', [App\Http\Controllers\TmpCompraController::class, 'destroy'])->name('admin.compras.tmp_compras.destroy')->middleware('auth');

//rutas para Detallecompras
Route::post('/admin/compras/detalle/create', [App\Http\Controllers\DetalleCompraController::class, 'store'])->name('admin.detalle.compras.store')->middleware('auth');
Route::delete('/admin/compras/detalle/{id}', [App\Http\Controllers\DetalleCompraController::class, 'destroy'])->name('admin.detalle.compras.destroy')->middleware('auth');

//Rutas para Clientes
Route::get('/admin/clientes', [App\Http\Controllers\ClienteController::class, 'index'])->name('admin.clientes.index')->middleware('auth','can:Listado de cliente');

Route::get('/admin/clientes/reporte', [App\Http\Controllers\ClienteController::class, 'reporte'])->name('admin.clientes.reportes')->middleware('auth','can:Ver reporte de cliente');


Route::get('/admin/clientes/create', [App\Http\Controllers\ClienteController::class, 'create'])->name('admin.clientes.create')->middleware('auth','can:Crear cliente');
Route::post('/admin/clientes/create', [App\Http\Controllers\ClienteController::class, 'store'])->name('admin.clientes.store')->middleware('auth');
Route::get('/admin/clientes/{id}', [App\Http\Controllers\ClienteController::class, 'show'])->name('admin.clientes.show')->middleware('auth','can:Ver datos del cliente');
Route::get('/admin/clientes/{id}/edit', [App\Http\Controllers\ClienteController::class, 'edit'])->name('admin.clientes.edit')->middleware('auth','can:Editar cliente');
Route::put('/admin/clientes/{id}', [App\Http\Controllers\ClienteController::class, 'update'])->name('admin.clientes.update')->middleware('auth');
Route::delete('/admin/clientes/{id}', [App\Http\Controllers\ClienteController::class, 'destroy'])->name('admin.clientes.destroy')->middleware('auth','can:Eliminar cliente');


//Rutas para ventas
Route::get('/admin/ventas', [App\Http\Controllers\VentaController::class, 'index'])->name('admin.ventas.index')->middleware('auth','can:Listado de ventas');

Route::get('/admin/ventas/reporte', [App\Http\Controllers\VentaController::class, 'reporte'])->name('admin.ventas.reportes')->middleware('auth','can:Ver reporte de ventas');

Route::get('/admin/ventas/create', [App\Http\Controllers\VentaController::class, 'create'])->name('admin.ventas.create')->middleware('auth','can:Crear ventas');
Route::post('/admin/ventas/create', [App\Http\Controllers\VentaController::class, 'store'])->name('admin.ventas.store')->middleware('auth');
Route::get('/admin/ventas/pdf/{id}', [App\Http\Controllers\VentaController::class, 'pdf'])->name('admin.ventas.pdf')->middleware('auth','can:Imprimir factura de venta');
Route::get('/admin/ventas/{id}', [App\Http\Controllers\VentaController::class, 'show'])->name('admin.ventas.show')->middleware('auth');
Route::get('/admin/ventas/{id}/edit', [App\Http\Controllers\VentaController::class, 'edit'])->name('admin.ventas.edit')->middleware('auth','can:Editar venta');
Route::put('/admin/ventas/{id}', [App\Http\Controllers\VentaController::class, 'update'])->name('admin.ventas.update')->middleware('auth');
Route::delete('/admin/ventas/{id}', [App\Http\Controllers\VentaController::class, 'destroy'])->name('admin.ventas.destroy')->middleware('auth','can:Eliminar venta');
Route::post('/admin/ventas/cliente/create', [App\Http\Controllers\VentaController::class, 'cliente_stores'])->name('admin.ventas.cliente.store')->middleware('auth');

//rutas para tmp_ventas
Route::post('/admin/ventas/create/tmp', [App\Http\Controllers\TmpVentaController::class, 'tmp_venta'])->name('admin.ventas.tmp_ventas')->middleware('auth');
Route::delete('/admin/ventas/create/tmp/{id}', [App\Http\Controllers\TmpVentaController::class, 'destroy'])->name('admin.ventas.tmp_ventas.destroy')->middleware('auth');

//rutas para Detalleventas
Route::post('/admin/ventas/detalle/create', [App\Http\Controllers\DetalleVentaController::class, 'store'])->name('admin.detalle.ventas.store')->middleware('auth');
Route::delete('/admin/ventas/detalle/{id}', [App\Http\Controllers\DetalleVentaController::class, 'destroy'])->name('admin.detalle.ventas.destroy')->middleware('auth');


//Rutas para Arqueo de Caja
Route::get('/admin/arqueos', [App\Http\Controllers\ArqueoController::class, 'index'])->name('admin.arqueos.index')->middleware('auth','can:Listado de arqueo');

Route::get('/admin/arqueos/reporte', [App\Http\Controllers\ArqueoController::class, 'reporte'])->name('admin.arqueos.reportes')->middleware('auth','can:Ver reporte de arqueo');


Route::get('/admin/arqueos/create', [App\Http\Controllers\ArqueoController::class, 'create'])->name('admin.arqueos.create')->middleware('auth','can:Crear arqueo');
Route::post('/admin/arqueos/create', [App\Http\Controllers\ArqueoController::class, 'store'])->name('admin.arqueos.store')->middleware('auth');
Route::get('/admin/arqueos/{id}', [App\Http\Controllers\ArqueoController::class, 'show'])->name('admin.arqueos.show')->middleware('auth','can:Ver datos del arqueo');
Route::get('/admin/arqueos/{id}/edit', [App\Http\Controllers\ArqueoController::class, 'edit'])->name('admin.arqueos.edit')->middleware('auth','can:Editar arqueo');
Route::get('/admin/arqueos/{id}/ingreso-egreso', [App\Http\Controllers\ArqueoController::class, 'ingresoegreso'])->name('admin.arqueos.ingresoegreso')->middleware('auth');

Route::post('/admin/arqueos/create_ingresos_egresos', [App\Http\Controllers\ArqueoController::class, 'store_ingreso_egreso'])->name('admin.arqueos.storeingresoegreso')->middleware('auth','can:Crear ingreso-egreso de arqueo');

Route::put('/admin/arqueos/{id}', [App\Http\Controllers\ArqueoController::class, 'update'])->name('admin.arqueos.update')->middleware('auth');
Route::delete('/admin/arqueos/{id}', [App\Http\Controllers\ArqueoController::class, 'destroy'])->name('admin.arqueos.destroy')->middleware('auth','can:Eliminar arqueo');

Route::get('/admin/arqueos/{id}/cierre', [App\Http\Controllers\ArqueoController::class, 'cierre'])->name('admin.arqueos.cierre')->middleware('auth','can:Cierre de arqueo');

Route::post('/admin/arqueos/create_cierre', [App\Http\Controllers\ArqueoController::class, 'store_cierre'])->name('admin.arqueos.storecierre')->middleware('auth');


//Rutas para permisos
Route::get('/admin/permisos', [App\Http\Controllers\PermisoController::class, 'index'])->name('admin.permisos.index')->middleware('auth','can:Listado de permisos');
//Route::get('/admin/permisos/reporte', [App\Http\Controllers\PermisoController::class, 'reporte'])->name('admin.permisos.reportes')->middleware('auth');
Route::get('/admin/permisos/create', [App\Http\Controllers\PermisoController::class, 'create'])->name('admin.permisos.create')->middleware('auth','can:Crear permiso');
Route::post('/admin/permisos/create', [App\Http\Controllers\PermisoController::class, 'store'])->name('admin.permisos.store')->middleware('auth');
Route::get('/admin/permisos/{id}', [App\Http\Controllers\PermisoController::class, 'show'])->name('admin.permisos.show')->middleware('auth','can:Ver datos del permiso');
Route::get('/admin/permisos/{id}/edit', [App\Http\Controllers\PermisoController::class, 'edit'])->name('admin.permisos.edit')->middleware('auth','can:Editar permiso');
Route::put('/admin/permisos/{id}', [App\Http\Controllers\PermisoController::class, 'update'])->name('admin.permisos.update')->middleware('auth');
Route::delete('/admin/permisos/{id}', [App\Http\Controllers\PermisoController::class, 'destroy'])->name('admin.permisos.destroy')->middleware('auth','can:Eliminar permiso');
