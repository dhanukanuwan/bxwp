<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://codeart.lk
 * @since      1.0.0
 *
 * @package    Bxwp
 * @subpackage Bxwp/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Bxwp
 * @subpackage Bxwp/admin
 * @author     Dhanuka Nuwan Gunarathna <dhanuka@codeart.lk>
 */
class Bxwp_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/bxwp-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/bxwp-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Adding an administration menu for the plugin
	 *
	 * @since    1.0.0
	 */

	public function bxwp_admin_menu() {
		add_menu_page( 'Bxwp Options', 'Bxwp Settings', 'manage_options', 'bxwp_admin_page', array($this, 'bxwp_admin_options') );
	}

	public function bxwp_admin_options() {
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		include_once 'partials/bxwp-admin-display.php';
	}

}
