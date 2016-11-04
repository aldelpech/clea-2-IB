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

// ****** SHOULD BE IN A PLUGIN, together with the spécific style ***********
// functions for strong testimonials orientation taxonomy
add_filter( 'wpmtst_query_args', 'clea_ib_strong_testimonials_query_args' );
add_action( 'save_post_wpm-testimonial', 'clea_ib_default_tax_slug_strong_testimonials' );
// add a new taxonomy to strong testimonials
add_action( 'init', 'clea_ib_add_taxonomy_to_strong_testimonial', 11 );	
	

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
		'hierarchical' 		=> true,
		'sort' 				=> true,
		'args' 				=> array( 'orderby' => 'term_order' ),
		'rewrite' 			=> array( 'slug' => 'orientation-tag' ),
		'show_admin_column' => true,
		'default_term'		=> 'orientation-complet'
	);
    // register the taxonomy
    register_taxonomy( 'orientation', 'wpm-testimonial', $args );
	
}
function clea_ib_strong_testimonials_query_args( $args ) {
	/* using the term ID: */
	
	/*
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'orientation',
			'field'    => 'id',
			'terms'    => 123
		)
	);
	*/
	if ( is_page( 914 ) ) {
		
		$orientation_tag_slug = 'orientation-isabelle' ;
	} else {
		
		$orientation_tag_slug = 'orientation-complet' ;
		
	}
	/* using the term slug: */
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'orientation',
			'field'    => 'slug',
			'terms'    => $orientation_tag_slug
		)
	);	
	return $args;
}
function clea_ib_default_tax_slug_strong_testimonials( $post_id ){
		
	// http://wordpress.stackexchange.com/questions/7168/how-to-add-a-default-item-to-a-custom-taxonomy
	// will set the default orientation taxonomy term to "orientation-complet" for 
	// all Strong testimonial custom-post-types (wpm-testimonial) 
	$current_post = get_post( $post_id );
	// This makes sure the taxonomy is only set when a new post is created
	if ( $current_post->post_date == $current_post->post_modified ) {
		wp_set_object_terms( $post_id, 'orientation-complet', 'orientation', true );
	}		
}
/**********************************************
* display 4 metaboxes on frontpage
* source http://help4cms.com/add-wysiwyg-editor-in-wordpress-meta-box/
* http://www.wproots.com/complex-meta-boxes-in-wordpress/
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
	}
}

 
function clea_ib_custom_wysiwyg( $post, $args )  {

	    echo '<pre>';

	    // print_r($post);

	    print_r($args);
		/* 
		Array(
			[id] => edit_section_1
			[title] => Section 1
			[callback] => clea_ib_custom_wysiwyg
			[args] => Array
					(
						[editor] => editor_section_1
					)
		) 
		*/

	    echo '</pre>';
		
	$content = get_post_meta($post->ID, $args['args']['editor'] , true);

	wp_editor(
		htmlspecialchars_decode( $content ) ,
		$args['args']['editor'], 
		array(
			"media_buttons" => true
		)
	);
}
 
function clea_ib_custom_wysiwyg_save_postdata($post_id )  {
 
	if (!empty($_POST['editor_section_1']))  {
		
		$data = htmlspecialchars($_POST['editor_section_1']);
		update_post_meta($post_id, 'editor_section_1', $data);
	}
}


// http://wordpress.stackexchange.com/questions/31991/is-it-possible-to-remove-the-main-rich-text-box-editor
function remove_pages_editor(){
    remove_post_type_support( 'page', 'editor' );
}   
// add_action( 'init', 'remove_pages_editor' );

		
?>