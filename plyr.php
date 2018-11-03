<?php

/**
 *
 * @link              https://github.com/drrobotnik/plyr/
 * @since             1.0.0
 * @package           Plyr
 *
 * @wordpress-plugin
 * Plugin Name:       WP Plyr
 * Plugin URI:        https://github.com/drrobotnik/plyr/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.1
 * Author:            Brandon Lavigne
 * Author URI:        https://github.com/drrobotnik/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       plyr
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plyr-activator.php
 */
function activate_plyr() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-plyr-activator.php';
	Plyr_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plyr-deactivator.php
 */
function deactivate_plyr() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-plyr-deactivator.php';
	Plyr_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_plyr' );
register_deactivation_hook( __FILE__, 'deactivate_plyr' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-plyr.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_plyr() {

	$plugin = new Plyr();
	$plugin->run();

}
run_plyr();
