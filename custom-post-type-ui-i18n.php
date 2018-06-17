<?php
/**
 * Custom Post Type UI i18n
 *
 * @since 1.0.0
 *
 * @package custom-post-type-ui-i18n
 */

/*
 * Plugin Name: Custom Post Type UI i18n
 * Plugin URI: https://github.com/tw2113/custom-post-type-ui-i18n
 * Description: Adds capabilities support for Custom Post Type UI
 * Author: tw2113
 * Version: 1.0.0
 * Author URI: https://michaelbox.net
 * Text Domain: custom-post-type-ui-i18n
 * Domain Path: /languages
 * License: GPL-2.0+
 */

namespace tw2113\cptui18n;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class customPostTypeUIi18n {

	/**
	 * Current version.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	public $version = '1.0.0';

	/**
	 * Plugin basename.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	public $basename = '';

	/**
	 * URL of plugin directory.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	public $url = '';

	/**
	 * Path of plugin directory.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	public $path = '';

	/**
	 * customPostTypeUICapabilities constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->basename    = plugin_basename( __FILE__ );
		$this->url         = plugin_dir_url( __FILE__ );
		$this->path        = plugin_dir_path( __FILE__ );
	}

	/**
	 * Run our hooks to execute the plugin.
	 *
	 * @since 1.0.0
	 */
	public function do_hooks() {

		if ( ! $this->meets_requirements() ) {
			add_action( 'admin_notices', array( $this, 'requirements_not_met_notice' ) );
			return;
		}

		add_action( 'cptui_loaded', array( $this, 'includes' ) );
		add_action( 'cptui_extra_menu_items', array( $this, 'cptui_plugin_menu' ), 10, 2 );
	}

	/**
	 * Include extra files.
	 *
	 * @since 1.0.0
	 */
	public function includes() {
		include $this->path . 'inc/post-type-hooks.php';
		include $this->path . 'inc/post-type-i18n-page.php';
		include $this->path . 'inc/taxonomy-hooks.php';
		include $this->path . 'inc/taxonomy-i18n-page.php';
		include $this->path . 'inc/helpers.php';
	}

	/**
	 * Check that all plugin requirements are met
	 *
	 * @since  1.0.0
	 *
	 * @return boolean $value True if requirements are met.
	 */
	public static function meets_requirements() {

		// Do checks for required classes / functions.
		if ( ! function_exists( 'cptui_create_custom_post_types' ) ) {
			return false;
		}
		return true;
	}

	/**
	 * Adds a notice to the dashboard if the plugin requirements are not met.
	 *
	 * @since 1.0.0
	 */
	public function requirements_not_met_notice() {
		// Output our error.
		$error_text = esc_html__( 'Custom Post Type UI i18n requires Custom Post Type UI to be active. Please make sure that requirement is met to activate Custom Post Type UI i18n.', 'custom-post-type-ui-i18n' );

		echo '<div id="message" class="error">';
		echo '<p>' . esc_attr( $error_text ) . '</p>';
		echo '</div>';
	}

	function cptui_plugin_menu( $parent_slug, $capability ) {
		add_submenu_page( $parent_slug, __( 'CPTUI Post Type i18n', 'custom-post-type-ui-i18n' ), __( 'Post Type i18n', 'custom-post-type-ui-i18n' ), $capability, 'cptui_post_type_i18n', __NAMESPACE__ . '\post_type_settings_page' );
		add_submenu_page( $parent_slug, __( 'CPTUI Taxonomy i18n', 'custom-post-type-ui-i18n' ), __( 'Taxonomy i18n', 'custom-post-type-ui-i18n' ), $capability, 'cptui_taxonomy_i18n', __NAMESPACE__ . '\taxonomy_settings_page' );
	}
}

function load() {
	$cptui18n = new customPostTypeUIi18n();
	$cptui18n->do_hooks();
}
add_action( 'plugins_loaded', __NAMESPACE__ . '\load', 8 );
