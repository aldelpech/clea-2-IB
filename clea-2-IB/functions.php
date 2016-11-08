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
* http://www.wproots.com/complex-meta-boxes-in-wordpress/
* https://premium.wpmudev.org/blog/creating-meta-boxes/
**********************************************/

function food_add_meta_boxes( $post ){
	add_meta_box( 
		'food_meta_box', 
		__( 'Nutrition facts', 'food_example_plugin' ), 
		'food_build_meta_box', 
		'page', 'normal', 
		'low' 
	);
}
add_action( 'add_meta_boxes', 'food_add_meta_boxes' );

function food_build_meta_box( $post ){
	// make sure the form request comes from WordPress
	wp_nonce_field( basename( __FILE__ ), 'food_meta_box_nonce' );
	// retrieve the _food_cholesterol current value
	$current_cholesterol = get_post_meta( $post->ID, '_food_cholesterol', true );
	// retrieve the _food_carbohydrates current value
	$current_carbohydrates = get_post_meta( $post->ID, '_food_carbohydrates', true );
	$vitamins = array( 'Vitamin A', 'Thiamin (B1)', 'Riboflavin (B2)', 'Niacin (B3)', 'Pantothenic Acid (B5)', 'Vitamin B6', 'Vitamin B12', 'Vitamin C', 'Vitamin D', 'Vitamin E', 'Vitamin K' );
	
	// stores _food_vitamins array 
	$current_vitamins = ( get_post_meta( $post->ID, '_food_vitamins', true ) ) ? get_post_meta( $post->ID, '_food_vitamins', true ) : array();
	?>
	<div class='inside'>

		<h3><?php _e( 'Cholesterol', 'food_example_plugin' ); ?></h3>
		<p>
			<input type="radio" name="cholesterol" value="0" <?php checked( $current_cholesterol, '0' ); ?> /> Yes<br />
			<input type="radio" name="cholesterol" value="1" <?php checked( $current_cholesterol, '1' ); ?> /> No
		</p>

		<h3><?php _e( 'Carbohydrates', 'food_example_plugin' ); ?></h3>
		<p>
			<input type="text" name="carbohydrates" value="<?php echo $current_carbohydrates; ?>" /> 
		</p>

		<h3><?php _e( 'Vitamins', 'food_example_plugin' ); ?></h3>
		<p>
		<?php
			foreach ( $vitamins as $vitamin ) {
				?>
				<input type="checkbox" name="vitamins[]" value="<?php echo $vitamin; ?>" <?php checked( ( in_array( $vitamin, $current_vitamins ) ) ? $vitamin : '', $vitamin ); ?> /><?php echo $vitamin; ?> <br />
				<?php
			}
		?>
		</p>
	</div>
	<?php
}

function food_save_meta_box_data( $post_id ){
	// verify taxonomies meta box nonce
	if ( !isset( $_POST['food_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['food_meta_box_nonce'], basename( __FILE__ ) ) ){
		echo "------------------------------------------------------------------------1";
		return;
	}
	// return if autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
		echo "------------------------------------------------------------------------2";
		return;
	}
	// Check the user's permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ){
		echo "------------------------------------------------------------------------3";
		return;
	}

	// store custom fields values
	// cholesterol string
	if ( isset( $_REQUEST['cholesterol'] ) ) {
		update_post_meta( $post_id, '_food_cholesterol', sanitize_text_field( $_POST['cholesterol'] ) );
	}
	// store custom fields values
	// carbohydrates string
	if ( isset( $_REQUEST['carbohydrates'] ) ) {
		update_post_meta( $post_id, '_food_carbohydrates', sanitize_text_field( $_POST['carbohydrates'] ) );
	}
	// store custom fields values
	// vitamins array
	if( isset( $_POST['vitamins'] ) ){
		$vitamins = (array) $_POST['vitamins'];
		// sinitize array
		$vitamins = array_map( 'sanitize_text_field', $vitamins );
		// save data
		update_post_meta( $post_id, '_food_vitamins', $vitamins );
	}else{
		// delete data
		delete_post_meta( $post_id, '_food_vitamins' );
	}
}
add_action( 'save_post', 'food_save_meta_box_data' );

?>