<?php
/**
* The template for displaying archive pages
* If you'd like to further customize these archive views, you may create a
*
* @since GlowLine 1.0
*/
?>
<?php get_header(); ?>
</div>
<?php if (have_posts()) : ?>
<div class="container" class="clearfix">
<div class="archive-title">
	<?php
		if ( is_day() ) :
			printf( __( '<h1>Daily Archives:%s</h1>', 'glowline' ), get_the_date() );
		elseif ( is_month() ) :
			printf( __( '<h1>Monthly Archives:%s</h1>', 'glowline' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'glowline' ) ) );
		elseif ( is_year() ) :
			printf( __( '<h1>Yearly Archives:%s</h1>', 'glowline' ), get_the_date( _x( 'Y', 'yearly archives date format', 'glowline' ) ) );
		else :
			_e( '<h1>Archives</h1>', 'glowline' );
		endif;
	?>
</div>
</div>

<div id="page" class="clearfix right">
<!-- Content Start -->
<div class="content">
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
<div class="sidebar-wrapper"><!-- left -->
<?php get_sidebar(); ?>
</div>
</div><!-- Content End -->
<?php get_footer();