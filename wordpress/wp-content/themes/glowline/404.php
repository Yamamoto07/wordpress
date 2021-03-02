<?php
/**
* The template for displaying 404 pages (Not Found)
* @since GlowLine 1.0
*/
get_header(); ?>
<div class="container" class="clearfix">
	<div class="page-title breadcrumb">
		<h1><?php _e( 'Not Found', 'glowline' ); ?></h1>
	</div>
</div>
<div id="page" class="clearfix right" >
	<div class="content">
		<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'glowline' ); ?></p>
		<?php get_search_form(); ?>
	</div>
	<div class="sidebar-wrapper">
		<?php get_sidebar(); ?>
	</div>
</div>
<!-- page End -->
<?php get_footer();