<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
#$routes->get('/', 'Home::index'); // Página de inicio
#$routes->get('/pagina_destino', 'Home::pagina_destino'); // Página destino
// app/Config/Routes.php

#$routes->get('/', 'UsuariosController::login');  // Página de login
##$routes->get('/login', 'UsuariosController::login');  // Página de login

// Ruta para mostrar la página de registro
#$routes->get('/register', 'UsuariosController::register');  // Página de registro

// Ruta para procesar el formulario de login
#$routes->post('/usuarios/login', 'UsuariosController::doLogin');  // Procesa el login

// Ruta para procesar el formulario de registro (crear nuevo usuario)
#$routes->post('/usuarios/create', 'UsuariosController::create');  // Procesa el registro
// app/Config/Routes.php

// Mostrar la lista de experiencias
#$routes->get('/comunidad/experiencias', 'ComunidadController::index');

#$routes->get('/comunidad/crear', 'ComunidadController::crear');
#$routes->post('/comunidad/crear', 'ComunidadController::crear');
#$routes->get('/comunidad/experiencias', 'ComunidadController::index');
#$routes->get('/comunidad/editar/(:num)', 'ComunidadController::editar/$1');
#$routes->post('/comunidad/editar/(:num)', 'ComunidadController::editar/$1');
#$routes->get('/comunidad/eliminar/(:num)', 'ComunidadController::eliminar/$1');


//$routes->setAutoRoute(true);
$routes->get('/', 'Auth::login');
$routes->get('prueba', 'Prueba::index');
$routes->get('prueba2', 'Prueba2::index');

$routes->get('registro', 'Registro::index');
$routes->post('registro/guardar', 'Registro::guardar');
$routes->get('login', 'Auth::login');
$routes->post('auth/login_process', 'Auth::login_process');
$routes->get('logout', 'Auth::logout');



$routes->get('comunidad/menu', 'Comunidad::menu');
$routes->get('comunidad/crear-experiencia', 'Comunidad::crearExperiencia');
$routes->post('comunidad/guardar-experiencia', 'Comunidad::guardarExperiencia');
$routes->get('comunidad/gestionar-experiencias', 'Comunidad::gestionarExperiencias');
$routes->post('comunidad/actualizar-experiencia', 'Comunidad::actualizarExperiencia');
$routes->post('comunidad/eliminar-experiencia', 'Comunidad::eliminarExperiencia');
$routes->get('comunidad/ver-reservas', 'Comunidad::verReservas');
$routes->post('comunidad/cambiar_estado_reserva', 'Comunidad::cambiarEstadoReserva');

$routes->get('comunidad/imagen-prueba', 'Comunidad::imagenPrueba'); // WEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE

$routes->get('turista/menu', 'Turista::menu');
$routes->get('turista/experiencia/(:num)', 'Turista::verExperiencia/$1');
$routes->post('turista/guardar-reserva', 'Turista::guardarReserva');
$routes->post('turista/confirmar-pago', 'Turista::confirmarPago');
$routes->get('turista/reservas', 'Turista::reservas');
$routes->post('turista/valorar', 'Turista::guardarValoracion');
$routes->post('turista/cancelar-reserva', 'Turista::cancelarReserva');
$routes->post('turista/reportar', 'Turista::reportar');


// Rutas para el administrador
$routes->get('admin/menu', 'AdministradorController::menu');  // Menú del Administrador
$routes->get('admin/ver_experiencias', 'AdministradorController::ver_experiencias');  // Ver experiencias pendientes
$routes->get('admin/aprobar_experiencia/(:num)', 'AdministradorController::aprobar_experiencia/$1');  // Aprobar experiencia
$routes->get('admin/rechazar_experiencia/(:num)', 'AdministradorController::rechazar_experiencia/$1');  // Rechazar experiencia

$routes->get('admin/ver_reportes', 'AdministradorController::ver_reportes');  // Ver reportes pendientes
$routes->get('admin/evaluar_reporte/(:num)/(:any)', 'AdministradorController::evaluar_reporte/$1/$2');  // Evaluar reporte

$routes->get('admin/ver_usuarios', 'AdministradorController::ver_usuarios');  // Ver usuarios
$routes->get('admin/suspender_cuenta/(:num)', 'AdministradorController::suspender_cuenta/$1');  // Suspender cuenta de usuario
$routes->post('admin/ban_experiencia', 'AdministradorController::ban_experiencia');

$routes->get('/suspendido', 'Suspendido::index');



// Rutas para la gestión de usuarios
$routes->get('admin/editar_usuario/(:num)', 'AdministradorController::editar_usuario/$1');  // Editar usuario
$routes->post('admin/actualizar_usuario', 'AdministradorController::actualizar_usuario');    // Actualizar usuario
$routes->post('admin/eliminar_usuario/(:num)', 'AdministradorController::eliminar_usuario/$1');  // Eliminar usuario

$routes->get('/admin/estadisticas', 'AdministradorController::ver_estadisticas');

