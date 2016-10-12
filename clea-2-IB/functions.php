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

	// feuille de style pour Quiz And Survey Master Plugin - https://fr.wordpress.org/plugins/quiz-master-next/
	wp_enqueue_style( 'clea-ib-quiz-master', get_stylesheet_directory_uri() . '/css/clea-ib-quiz-and-survey-master.css', array(), false, 'all' );

	// feuille de style pour Strong Testimonials - https://fr.wordpress.org/plugins/strong-testimonials/
	wp_enqueue_style( 'clea-ib-strong-testimonials', get_stylesheet_directory_uri() . '/css/clea-ib-strong-testimonials.css', array(), false, 'all' );

	// font awesome CDN
	wp_enqueue_script( 'clea-ib-font-awesome', 'https://use.fontawesome.com/1dcb7878fd.js', false );
	
}


?>