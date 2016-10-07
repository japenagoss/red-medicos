<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'talento1_rm');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'talento1_general');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', '27XQGuAXAzYUq3dTfLAZ');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8mb4');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '}XV 5uSdCPj8P?Pv{5<=tM0;D+qW)+edE7ro`$Ca03-E~R~mo>w(vm4qgRx}uR6.');
define('SECURE_AUTH_KEY', 'v)lR#zf%,&ILHX3pHQYZ_ah7|a%MngPE?)Sx(oxeazoiH:b=2J(8>j}meIG$0}5J');
define('LOGGED_IN_KEY', 'qW0uMy!F_0DU-SQ)M7-3X}q_0ii:S4ga#0bRv7;XO++n6h(+<7MkiIO(y1<9Kd{O');
define('NONCE_KEY', 'd6|YdQvN!|0+t-5G?!Tpaj1H< .f21i-hAm`cbd5BTAq+eY2]2|]s,<RHCs p:d_');
define('AUTH_SALT', 'w5+yCaz*dw$~Q|+h!G0o)1N(y3F+!^t>u^Wd+_)V~ID8vA|=-V3c_FknnXV-i/( ');
define('SECURE_AUTH_SALT', '0=-9u%Gj{yPokW| qeE=[HJz/BhJ9:r-/|Ae>>~-&gUo-1QtrHh]C1|rwk%GKeO]');
define('LOGGED_IN_SALT', '0OufE)Re2NQ@1T_?o|S|}`}#~aQ|CXBmKcjGDEM<Mw_7WlQ1c%7$zwpd-i|Yy(zS');
define('NONCE_SALT', '{Ja9Wh= B9(I}3bHIdp!l1%&b4SCuIK>]dm/(PIDhzwi*r.T1o!u%o[-4F>]M*xi');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

