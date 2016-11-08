<article <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_page() && !is_front_page() ) : // If viewing a single page. ?>

		<header class="entry-header">
			<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php single_post_title(); ?></h1>
		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php edit_post_link(); ?>
		</footer><!-- .entry-footer -->

	<?php elseif ( is_front_page() ) : // If viewing the front page. ?>

		<header class="entry-header">
			<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php single_post_title(); ?></h1>
		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-content' ); ?>>

			<?php 
			// get post meta data
			global $post;
			$meta = get_post_meta( $post->ID ); 
			?>
			
			<section class="section-1">
				<?php echo wpautop( stripslashes( $meta[_section_1][0] ) ) ; ?>
			</section>
			<section class="section-2">
				<?php echo $meta[_section_2][0] ; ?>
			</section>		
			<section class="section-3">
				<?php echo $meta[_section_3][0] ; ?>
			</section>
			<section class="section-4">
				<?php echo $meta[_section_4][0] ; ?>
			</section>
		</div><!-- .entry-content -->


		<footer class="entry-footer">
			<?php edit_post_link(); ?>
		</footer><!-- .entry-footer -->
	
	<?php else : // If not viewing a single page. ?>

		<?php get_the_image( array( 'size' => 'stargazer-full' ) ); ?>

		<header class="entry-header">
			<?php the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '><a href="' . get_permalink() . '" rel="bookmark" itemprop="url">', '</a></h2>' ); ?>
		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-summary' ); ?>>
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

	<?php endif; // End single page check. ?>

</article><!-- .entry -->