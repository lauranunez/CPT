/*
Template Name: Archives
*/
 
get_header(); ?>

//Para coger el nombre de la categoría de la que trata (como título)
<header class="page-header">
	<div class="header-taxonomia-categoria">
$termino_actual = get_queried_object();
$taxonomia = get_taxonomy($termino_actual->taxonomy);
echo "<h1 class='page-title text-center'>" . $taxonomy->label . " . $termino_actual->name ."</h1>";
?>
	</div>
</header>
 
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
 
	?>
 
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		// Page thumbnail and title.
		twentyfourteen_post_thumbnail();
		the_title( '<header class="entry-header"><h1 class="entry-title">', '</h1></header><!-- .entry-header -->' );
	?>
 
	<div class="entry-content">
		<?php the_content(); ?>
		
		<?php get_search_form(); ?>
		
		<h2>Archives by Month:</h2>
		<ul>
			<?php wp_get_archives('type=monthly'); ?>
		</ul>
		
		<h2>Archives by Subject:</h2>
		<ul>
			 <?php wp_list_categories(); ?>
		</ul>
 
	<?php 	edit_post_link( __( 'Edit', 'twentyfourteen' ), '<span class="edit-link">', '</span>' );  ?>
 
	</div><!-- .entry-content -->
</article><!-- #post-## -->
 
<?php
 
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
