<?php
/**
 * 
 * this file is designed to provide specific functions for the child theme
 *
 * @package    clea-2-IB
 * @subpackage Functions
 * @version    1.0
 * @since      0.1.0
 * @author     Anne-Laure Delpech <ald.kerity@gmail.com>  
 * @copyright  Copyright (c) 2015 Anne-Laure Delpech
 * @link       
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* !!!! Do NOT include or require other php files !!!! */
// this will break the json parse for the quiz... 


add_action( 'init', 'clea_ib_testimonial_add_support' );	

// Do theme setup on the 'after_setup_theme' hook.
add_action( 'after_setup_theme', 'clea_ib_theme_setup', 11 ); 


function clea_ib_theme_setup() {

	/* Register and load styles and scripts. */
	add_action( 'wp_enqueue_scripts', 'clea_ib_enqueue_styles_scripts', 4 ); 

	/* Set content width. */
	hybrid_set_content_width( 700 );

	add_filter( 'rwmb_meta_boxes', 'clea_ib_testimonial_register_meta_boxes' );


}
 

function clea_ib_enqueue_styles_scripts() {

	// feuille de style pour l'impression
	wp_enqueue_style( 'clea-ib-print', get_stylesheet_directory_uri() . '/css/print.css', array(), false, 'print' );

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	
	// feuille de style pour Quiz And Survey Master Plugin - https://fr.wordpress.org/plugins/quiz-master-next/
	if( is_plugin_active( 'quiz-master-next/mlw_quizmaster2.php' ) ) {
		
		wp_enqueue_style( 'clea-ib-quiz-master', get_stylesheet_directory_uri() . '/css/clea-ib-quiz-and-survey-master.css', array(), false, 'all' );
		
	} 



	// feuille de style pour Strong Testimonials - https://fr.wordpress.org/plugins/strong-testimonials/
	if( is_plugin_active( 'strong-testimonials/strong-testimonials.php' ) ) {
		
		wp_enqueue_style( 'clea-ib-strong-testimonials', get_stylesheet_directory_uri() . '/css/clea-ib-strong-testimonials.css', array(), false, 'all' );
	}

	// font awesome CDN
	wp_enqueue_script( 'clea-ib-font-awesome', 'https://use.fontawesome.com/1dcb7878fd.js', false );
	
}

function clea_ib_testimonial_register_meta_boxes() {
	
	// for other metaboxes, see https://github.com/rilwis/meta-box/blob/master/demo/demo.php
		/**
	 * prefix of meta keys (optional)
	 * Use underscore (_) at the beginning to make keys hidden
	 * Alt.: You also can make prefix empty to disable it
	 */
	// Better has an underscore as last sign
	$prefix = 'clea-ib-';

	// 1st meta box
	$meta_boxes[] = array(
		// Meta box id, UNIQUE per meta box. Optional since 4.1.5
		'id'         => 'clea-ib-t1',
		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title'      => esc_html__( 'Extraits "orientés"', 'clea-ib' ),
		// Post types, accept custom post types as well - DEFAULT is 'post'. Can be array (multiple post types) or string (1 post type). Optional.
		'post_types' => array( 'wpm-testimonial' ),
		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context'    => 'normal',
		// Order of meta box: high (default), low. Optional.
		'priority'   => 'high',
		// Auto save: true, false (default). Optional.
		'autosave'   => true,
		// List of meta fields
		'fields'     => array(
		
			// TEXTAREA
			array(
				'name' 					=> esc_html__( 'Extrait "Isabelle"', 'clea-ib' ),
				'desc' 					=> esc_html__( 'un extrait qui parle d\'Isabelle', 'clea-ib' ),
				'id'   					=> "{$prefix}textarea0",
				'type' 					=> 'textarea',
				'cols' 					=> 20,
				'rows' 					=> 3,
				// strong testimonials data for fields
				'record_type' 	=> 'custom',	// strong testimonials : 'custom', 'post' or 'optional'
				'show_label'	=> 0,
				'required'		=> 0,
				'label'			=> esc_html__( 'un extrait qui parle d\'Isabelle', 'clea-ib' ),
				'admin_table'	=> 0,
				'show_admin_table_option'	=> 1,
				'show_placeholder_option'	=> 1,
				'show_default_options'		=> 1,
				'show_shortcode_options'	=> 1,
				'admin_table'             	=> 0,
				'admin_table_option'      	=> 1,
			),
			// TEXTAREA
			array(
				'name' => esc_html__( 'Extrait "méthode"', 'clea-ib' ),
				'desc' => esc_html__( 'un extrait qui parle de la méthode', 'clea-ib' ),
				'id'   => "{$prefix}textarea1",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 3,
				// strong testimonials data for fields
				'record_type' 	=> 'custom',	// strong testimonials : 'custom', 'post' or 'optional'
				'show_label'	=> 0,
				'required'		=> 0,
				'label'			=> esc_html__( 'un extrait qui parle de la méthode', 'clea-ib' ),
				'admin_table'	=> 0,
				'show_admin_table_option'	=> 1,
				'show_placeholder_option'	=> 1,
				'show_default_options'		=> 1,
				'show_shortcode_options'	=> 1,
				'admin_table'             	=> 0,
				'admin_table_option'      	=> 1,
			),
			// TEXTAREA
			array(
				'name' => esc_html__( 'Extrait "avant-après"', 'clea-ib' ),
				'desc' => esc_html__( 'un extrait qui parle d\'avant et après', 'clea-ib' ),
				'id'   => "{$prefix}textarea2",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 3,
				// strong testimonials data for fields
				'record_type' 	=> 'custom',	// strong testimonials : 'custom', 'post' or 'optional'
				'show_label'	=> 0,
				'required'		=> 0,
				'label'			=> esc_html__( 'un extrait qui parle d\'avant et après', 'clea-ib' ),
				'admin_table'	=> 0,
				'show_admin_table_option'	=> 1,
				'show_placeholder_option'	=> 1,
				'show_default_options'		=> 1,
				'show_shortcode_options'	=> 1,
				'admin_table'             	=> 0,
				'admin_table_option'      	=> 1,
			),
			// TEXTAREA
			array(
				'name' => esc_html__( 'Extrait "comment ça se passe"', 'clea-ib' ),
				'desc' => esc_html__( 'un extrait qui parle de comment ca se passe', 'clea-ib' ),
				'id'   => "{$prefix}textarea3",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 3,
				// strong testimonials data for fields
				'record_type' 	=> 'custom',	// strong testimonials : 'custom', 'post' or 'optional'
				'show_label'	=> 0,
				'required'		=> 0,
				'label'			=> esc_html__( 'un extrait qui parle de comment ca se passe', 'clea-ib' ),
				'admin_table'	=> 0,
				'show_admin_table_option'	=> 1,
				'show_placeholder_option'	=> 1,
				'show_default_options'		=> 1,
				'show_shortcode_options'	=> 1,
				'admin_table'             	=> 0,
				'admin_table_option'      	=> 1,
			),
		),
	);
	

	return $meta_boxes;
	
	
}

function clea_ib_testimonial_add_support() {
	
 $support = array(
	'clea-ib-textarea0',
	'clea-ib-textarea1',
	'clea-ib-textarea2',
	'clea-ib-textarea3',
 ) ;
 
 add_post_type_support( 'wpm-testimonial', $support );
 
}


		
?>