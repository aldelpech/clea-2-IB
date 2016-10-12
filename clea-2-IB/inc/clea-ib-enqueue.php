<?php
/**
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
 * @version    1.0.0
 * @author     Anne-Laure Delpech <ald.kerity@gmail.com>
 * @copyright  Copyright (c) 2016 - 2019, Anne-Laure Delpech
 * @link       http://parcours-performance.com
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
 

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
