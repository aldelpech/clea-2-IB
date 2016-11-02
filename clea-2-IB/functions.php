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


// add a new taxonomy to strong testimonials
add_action( 'init', 'clea_ib_add_taxonomy_to_strong_testimonial', 11 );	

// Do theme setup on the 'after_setup_theme' hook.
add_action( 'after_setup_theme', 'clea_ib_theme_setup', 11 ); 


function clea_ib_theme_setup() {

	/* Register and load styles and scripts. */
	add_action( 'wp_enqueue_scripts', 'clea_ib_enqueue_styles_scripts', 4 ); 

	/* Set content width. */
	hybrid_set_content_width( 700 );

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


		

function clea_ib_add_taxonomy_to_strong_testimonial() {
	
	// for 'post_types' => array( 'wpm-testimonial' ),

  $labels = array(
		'name'              => __( 'Orientations', 'clea-2-IB' ),
		'singular_name'     => __( 'Orientation', 'clea-2-IB' ),
		'search_items'      => __( 'Chercher dans les Orientations', 'clea-2-IB' ),
		'all_items'         => __( 'Toutes les orientations', 'clea-2-IB' ),
		'edit_item'         => __( 'Modifier l\'orientation', 'clea-2-IB' ),
		'update_item'       => __( 'Mettre à jour l\'orientation', 'clea-2-IB' ),
		'add_new_item'      => __( 'Ajouter une nouvelle  orientation', 'clea-2-IB' ),
		'new_item_name'     => __( 'Nom de la nouvelle orientation', 'clea-2-IB' ),
		'menu_name'         => __( 'Orientations', 'clea-2-IB' ),
	);
	
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'sort' => true,
		'args' => array( 'orderby' => 'term_order' ),
		'rewrite' => array( 'slug' => 'orientation-tag' ),
		'show_admin_column' => true
	);

    // register the taxonomy
    register_taxonomy( 'orientation', 'wpm-testimonial', $args );
	
}


		
?>