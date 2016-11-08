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
	// style pour le site IB
	wp_enqueue_style( 'clea-ib', get_stylesheet_directory_uri() . '/css/clea-ib-style.css', array(), false, 'all' );
	
	
	// feuille de style pour Quiz And Survey Master Plugin - https://fr.wordpress.org/plugins/quiz-master-next/
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	
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

/**********************************************
* display 1 metaboxe with 4 editors on frontpage
* source http://help4cms.com/add-wysiwyg-editor-in-wordpress-meta-box/
* https://premium.wpmudev.org/blog/creating-meta-boxes/
**********************************************/

function clea_ib_frontpage_meta_box( $post ){

	$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
	$template_file = get_post_meta($post_id,'_wp_page_template',TRUE);
	// check for a template type
	if ($template_file == 'page/IB-home-page-template.php') {

		add_meta_box( 
			'edit_sections', 					
			__( "Editer les sections de la page d'accueil", 'clea-2-IB' ), 
			'clea_ib_custom_meta_box', 
			'page', 'normal', 
			'low' 
		);
		
		// remove default editor 
		// http://wordpress.stackexchange.com/questions/31991/is-it-possible-to-remove-the-main-rich-text-box-editor
		remove_post_type_support( 'page', 'editor' );

	}
}
add_action( 'add_meta_boxes', 'clea_ib_frontpage_meta_box' );

function clea_ib_custom_meta_box( $post ){

	// make sure the form request comes from WordPress
	wp_nonce_field( basename( __FILE__ ), 'edit_sections_nonce' );

	$section_1 = get_post_meta( $post->ID, '_section_1', true );
	?>
	<div class='inside'>

		<h3><?php _e( 'Section 1', 'clea-2-IB' ); ?></h3>
		<?php

		wp_editor(
			htmlspecialchars_decode( $section_1 ) ,
			section_1, 
			array(
				"media_buttons" => true
			)
		);	
		?>
	</div>
	<?php
}

function clea_ib_save_meta_box_data( $post_id ){
	// verify taxonomies meta box nonce
	if ( !isset( $_POST['edit_sections_nonce'] ) || !wp_verify_nonce( $_POST['edit_sections_nonce'], basename( __FILE__ ) ) ){
		return;
	}
	// return if autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
		return;
	}
	// Check the user's permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ){
		return;
	}

	
	$section_1 = get_post_meta( $post->ID, 'section_1', true );	
	
	// store section_1
	if ( isset( $_REQUEST['section_1'] ) ) {
		update_post_meta( $post_id, '_section_1', sanitize_text_field( $_POST['section_1'] ) );
	}	
}
add_action( 'save_post', 'clea_ib_save_meta_box_data' );

?>