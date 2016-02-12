<?php

/**
 * Plugin Name:       Moebius Admin
 * Plugin URI:        https://github.com/1cgonza/moebius-admin/
 * Description:       Herramientas para administrar el sitio de Moebius Animación
 * Version:           1.0.0
 * Author:            Juan Camilo González
 * Author URI:        http://juancgonzalez.com/
 * License:           MIT
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

require plugin_dir_path( __FILE__ ) . 'includes/class-moebius-admin.php';

function run_moebius_admin() {
	$plugin = new Moebius_Admin();
	$plugin->run();
}
run_moebius_admin();
