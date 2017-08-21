
get_header(); ?>

<div id="main-content" class="main-content">

<?php
	if ( is_front_page() && twentyfourteen_has_featured_posts() ) {
		// Include the featured content template.
		get_template_part( 'featured-content' );
	}
?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();
					<div class="blogpost">
<h3 class="entrytitle" id="post-<?php the_ID(); ?>"> <a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?> </a> </h3>
//Listado de categorías del Custom Post Type
<?php echo get_the_term_list($post->ID,'categoria', "Categorías: ", ','); ?>
<?php the_content(); ?>
</div>
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				endwhile;
			?>

		</div><!-- #content -->
	</div><!-- #primary -->
	<?php get_sidebar( 'content' ); ?>
</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();
