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
		wp_localize_script( $this->plugin_name, 'bx_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

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

	public function bxwp_post_types(){
		$args = array(
			'hierarchical'      => true,
			'show_ui'           => false,
			'show_admin_column' => false,
			'query_var'         => false
		);

		register_taxonomy( 'bxslide_cats', array( 'bxslides' ), $args ); 

		$args = array(
			'label'               => __( 'bxslides' ),
			'taxonomies'          => array('bxslide_cats'),
			'hierarchical'        => false,
			'public'              => false,
			'show_ui'             => false,
			'show_in_menu'        => false,
			'show_in_nav_menus'   => false,
			'show_in_admin_bar'   => false,
			'can_export'          => true,
			'publicly_queryable'  => false,
			'capability_type'     => 'post'
	 		
		);
		register_post_type( 'bxslides', $args );
	}

	public function bxwp_newslide_callback() {
		$newpost_args = array(
			'post_title' 	=> ' ',
			'post_content' 	=> ' ',
			'post_status'	=> 'publish',
			'post_type'		=> 'bxslides'
		);

		$newslide = wp_insert_post($newpost_args);
		echo $newslide;
		wp_die();
	}

	public function bxwp_delete_slide_callback(){
		$slideid = wp_kses($_POST['slideid'],'','');
		wp_delete_post( $slideid, true );
		wp_die();

	}

	public function bxwp_update_slide_callback(){
		$slideid = wp_kses($_POST['slideid'],'','');
		$slide_name = wp_kses($_POST['slide_name'],'','');
		if(!empty($slide_name)){
			$response = wp_update_post(array('ID' => $slideid, 'post_title' => $slide_name));
			if($response != 0){
				$updated_slide = get_post($slideid);
				echo $updated_slide->post_title;
			}
		}
		wp_die();
	}

}
