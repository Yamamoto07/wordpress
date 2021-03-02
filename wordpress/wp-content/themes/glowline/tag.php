<?php
/**
* The template for displaying tag pages.
*/
?>
<?php get_header(); ?>
</div>
<div class="clearfix"></div>
<div class="container">
<div class="archive-title">
	<h1><?php printf( __( '%s', 'glowline' ), single_cat_title( '', false ) ); ?>
	<span><?php _e( 'Tag Archive', 'glowline' ); ?></span>
	</h1>
</div>
</div>
<?php if (have_posts()) : ?>
<?php global $grid_layout; ?>
<div id="page" class="clearfix right" >
<!-- Content Start -->
<div class="content">
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
			// If no content, include the "No posts found" template.
			?>
		</ul>
	</div>
	<?php
	else :
	get_template_part( 'content', 'none' );
	endif;
	?>
</div>
<!-- left -->
<div class="sidebar-wrapper">
	<?php get_sidebar(); ?>
</div>
</div>
<!-- Content End -->
<?php get_footer(); ?>