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
* display 4 metaboxes on frontpage
* source http://help4cms.com/add-wysiwyg-editor-in-wordpress-meta-box/
* http://www.wproots.com/complex-meta-boxes-in-wordpress/
* https://www.sitepoint.com/adding-custom-meta-boxes-to-wordpress/
**********************************************/

// add metaboxes to the frontpage and disables the main editor
add_action('admin_init', 'clea_ib_frontpage_wysiwyg_meta_box', 10, 1); 

add_action('save_post', 'clea_ib_custom_wysiwyg_save_postdata');

 

function clea_ib_frontpage_wysiwyg_meta_box()  {

	$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
	$template_file = get_post_meta($post_id,'_wp_page_template',TRUE);
	// check for a template type
	if ($template_file == 'page/IB-home-page-template.php') {
			
			add_meta_box( 
				   'edit_section_1',
				   __('Section 1', 'clea-2-IB'),
				   'clea_ib_custom_wysiwyg',
				   'page',
				   'normal',
				   'low',
				   array( 'editor' => 'editor_section_1',
						'template' => $template_file ) // will be in $box
			  );

			add_meta_box( 
				   'edit_section_2',
				   __('Section 2', 'clea-2-IB'),
				   'clea_ib_custom_wysiwyg',
				   'page',
				   'normal',
				   'low',
				   array( 'editor' => 'editor_section_2',
						'template' => $template_file ) // will be in $box
			  );

			add_meta_box( 
				   'edit_section_3',
				   __('Section 3', 'clea-2-IB'),
				   'clea_ib_custom_wysiwyg',
				   'page',
				   'normal',
				   'low',
				   array( 'editor' => 'editor_section_3',
						'template' => $template_file ) // will be in $box
			  );

			add_meta_box( 
				   'edit_section_4',
				   __('Section 4', 'clea-2-IB'),
				   'clea_ib_custom_wysiwyg',
				   'page',
				   'normal',
				   'low',
				   array( 'editor' => 'editor_section_4',
						'template' => $template_file ) // will be in $box
			  );

			// remove default editor 
			// http://wordpress.stackexchange.com/questions/31991/is-it-possible-to-remove-the-main-rich-text-box-editor
			remove_post_type_support( 'page', 'editor' );
	}
	
}

 
function clea_ib_custom_wysiwyg( $post, $args )  {

	$content = get_post_meta($post->ID, $args['args']['editor'] , true);
	wp_editor(
		htmlspecialchars_decode( $content ) ,
		$args['args']['editor'], 
		array(
			"media_buttons" => true
		)
	);
}
 
function clea_ib_custom_wysiwyg_save_postdata( $post_id )  {
 
	if (!empty($_POST['editor_section_1']))  {
		
		$data = htmlspecialchars($_POST['editor_section_1']);
		update_post_meta($post_id, 'editor_section_1', $data);
	}
	if (!empty($_POST['editor_section_2']))  {
		
		$data = htmlspecialchars($_POST['editor_section_2']);
		update_post_meta($post_id, 'editor_section_2', $data);
	}
	if (!empty($_POST['editor_section_3']))  {
		
		$data = htmlspecialchars($_POST['editor_section_3']);
		update_post_meta($post_id, 'editor_section_3', $data);
	}
	if (!empty($_POST['editor_section_4']))  {
		
		$data = htmlspecialchars($_POST['editor_section_4']);
		update_post_meta($post_id, 'editor_section_4', $data);
	}
}


// http://wordpress.stackexchange.com/questions/31991/is-it-possible-to-remove-the-main-rich-text-box-editor
function remove_pages_editor(){

    remove_post_type_support( 'page', 'editor' );
}   
// add_action( 'init', 'remove_pages_editor' );

		
?>