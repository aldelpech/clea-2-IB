<?php
/**
 *
 * enqueue styles and scripts 
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License as published by the Free Software Foundation; either version 2 of the License,
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package    clea-2-ib
 * @subpackage Functions
 * @version    0.2.0
 * @author     Anne-Laure Delpech <ald.kerity@gmail.com>
 * @copyright  Copyright (c) 2016 - 2019, Anne-Laure Delpech
 * @link       http://parcours-performance.com
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
 


function clea_ib_enqueue_scripts_styles() {

	// feuille de style pour l'impression
	// wp_enqueue_style( 'print', get_stylesheet_directory_uri() . '/css/print.css', array(), false, 'print' );


	/* enqueue bubblegum and roboto fonts stylesheet 
	* font-family: 'Bubblegum Sans', cursive;
	* font-family: 'Roboto', sans-serif;
	*/ 
	// wp_enqueue_style( 'bubblegum-roboto', 'https://fonts.googleapis.com/css?family=Bubblegum+Sans|Roboto' );	

/*
	// feuille de style pour les quiz de Quiz And Survey Master https://fr.wordpress.org/plugins/quiz-master-next/
	wp_enqueue_style( 'clea_2_ib_quiz_master', get_stylesheet_directory_uri() . '/css/clea-ib-quiz-and-survey-master.css', array(), false, 'all' );
	// feuille de style pour les témoignages de Strong Testimonials https://fr.wordpress.org/plugins/strong-testimonials/
	wp_enqueue_style( 'clea_2_ib_testimonials', get_stylesheet_directory_uri() . '/css/clea-ib-strong-testimonials.css', array(), false, 'all' );	
*/
	
	/*
	* enqueue font awesome from CDN
	* @since  0.2.0
	*/
	// wp_enqueue_script( 'font-awesome', 'https://use.fontawesome.com/1dcb7878fd.js', false );
	
}
