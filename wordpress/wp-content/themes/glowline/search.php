<?php
/**
* The template for displaying Search Results pages
* @since GlowLine 1.0
*/
get_header(); ?>
</div>
<div class="container" class="clearfix">
<div class="page-title breadcrumb">
	<h1><?php printf( __( 'Search Results for: %s', 'glowline' ), get_search_query() ); ?></h1>
</div>
</div>
<div id="page" class="clearfix right" >
<div class="content"><!-- Content Start -->
<?php if (have_posts()) : ?>
	<?php global $grid_layout; ?>
<div id="main">
	<ul class="<?php echo $grid_layout; ?>">
		<?php
		if($grid_layout=='standard-layout'):
				// Start the post formate loop.
		while ( have_posts() ) : the_post();
		get_template_part( 'content', get_post_format() );
		endwhile;
		else :
			// Start the post formate grid.
		while ( have_posts() ) : the_post();
		get_template_part( 'content', 'grid' );
		endwhile;
		endif;
		?>
	</ul>
	<div class="pagination">
		<div class="older"><?php next_posts_link( 'Older Posts' ); ?></div>
		<div class="newer"><?php previous_posts_link( 'Newer Posts' ); ?></div>
	</div>
</div>
<?php
		else :
		// If no content, include the "No posts found" template.
		get_template_part( 'content', 'none' );
		endif;
?>
</div>
<div class="sidebar-wrapper">
<?php get_sidebar(); ?>
</div>
</div>
<!-- / Content End -->
<?php get_footer(); ?>