<?php
/**
 * Template Name: IB test 1
 */
?>

<?php get_header('test1'); // Loads the header.php template. ?>



<main <?php hybrid_attr( 'content' ); ?>>


	<?php if ( have_posts() ) : // Checks if any posts were found. ?>



		<?php while ( have_posts() ) : // Begins the loop through found posts. ?>



			<?php the_post(); // Loads the post data. ?>



			<?php hybrid_get_content_template(); // Loads the content/*.php template. ?>



			<?php if ( is_singular() ) : // If viewing a single post/page/CPT. ?>



				<?php comments_template( '', true ); // Loads the comments.php template. ?>



			<?php endif; // End check for single post. ?>



		<?php endwhile; // End found posts loop. ?>



		<?php locate_template( array( 'misc/loop-nav.php' ), true ); // Loads the misc/loop-nav.php template. ?>

	<div id="choix-couleur">	
	<?php
		$colors = array(
			"A" => array(
				'Clementine #F5B053 (245,176,83)',
				'245',
				'176',
				'83'
			), 
			"B" => array(
				'Nepal #6891AF (104,145,175)',
				'104',
				'145',
				'175'
			), 
			"C" => array(
				'Bahamasblue #25597F(37,89,127)',
				'37',
				'89',
				'127'
			), 	
			"D" => array(
				'Sun #F49631 (244, 150, 49)',
				'244',
				'150',
				'49'
			), 	
			"E" => array(
				'Pancho #E3C092 (227, 192, 146)',
				'227',
				'192',
				'146'
			)
		);
		
		$nuances = array( 1, 0.75, 0.5, 0.25 ) ;
	
	foreach ($colors as $color ) {
		foreach ($nuances as $nuance ) {
			?>	
				<div class="ib-test">
					<a href="https://isabellebyloos.bzh/wp-content/uploads/2016/11/header-044-1800x600.jpg" class="img-hyperlink"><img class="alignnone size-full wp-image-1180" src="https://isabellebyloos.bzh/wp-content/uploads/2016/11/header-044-1800x600.jpg" alt="header-044-1800x600" width="1800" height="600"></a>
					<div class="bandeau" style="background-color:rgba(<?php echo $color[1]; ?>,<?php echo $color[2]; ?>,<?php echo $color[3]; ?>,<?php echo $nuance; ?>);color:#fff"><?php echo $color[0]; ?>. Nuance <?php echo $nuance; ?></div>
				</div>	
			<?php
		}
	} // end foreach
	?>
	</div> <!-- #choix-couleur -->

	<?php else : // If no posts were found. ?>



		<?php locate_template( array( 'content/error.php' ), true ); // Loads the content/error.php template. ?>



	<?php endif; // End check for posts. ?>



</main><!-- #content -->



<?php get_footer(); // Loads the footer.php template. ?>