<?php
/**
 * 
 * this file is designed to provide specific functions for the child theme
 *
 * @package    clea-2-ib
 * @subpackage Functions
 * @version    1.0
 * @since      0.1.0
 * @author     Anne-Laure Delpech <ald.kerity@gmail.com>  
 * @copyright  Copyright (c) 2015 Anne-Laure Delpech
 * @link       
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */


// Do theme setup on the 'after_setup_theme' hook.
add_action( 'after_setup_theme', 'clea_ib_theme_setup', 11 ); 


function clea_ib_theme_setup() {

	/* Register and load styles. */
	add_action( 'wp_enqueue_scripts', 'clea_ib_enqueue_styles', 4 ); 
	
}
 

function clea_ib_enqueue_styles() {

	// feuille de style pour l'impression
	wp_enqueue_style( 'print', get_stylesheet_directory_uri() . '/css/print.css', array(), false, 'print' );

	/*
	* enqueue font awesome 4.0 from CDN
	* @since  1.0.0
	*/
	wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' );
	
	/* enqueue bubblegum and roboto fonts stylesheet 
	* font-family: 'Bubblegum Sans', cursive;
	* font-family: 'Roboto', sans-serif;
	*/ 
	wp_enqueue_style( 'bubblegum-roboto', 'https://fonts.googleapis.com/css?family=Bubblegum+Sans|Roboto' );
	
}


?>