<?php
/**
* The Template for displaying all single posts
* @since GlowLine 1.0
*/
get_header(); ?>
</div>
<div id="page" class="clearfix right">
<!-- Content Start -->
<div class="content">
	<!-- blog-single -->
	<div class="blog-single">
		<?php if (have_posts()) : while (have_posts()) : the_post();
		get_template_part('content');
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
		comments_template();
		}
		endwhile; endif; ?>
	</div>
	<!-- /blog-single -->
</div>
<!-- / Content End -->
<div class="sidebar-wrapper">
	<?php get_sidebar(); ?>
</div>
</div>
<?php get_footer(); ?>