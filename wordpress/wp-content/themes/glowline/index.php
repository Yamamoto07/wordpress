<?php
/**
* The Index template file.
*
* This is the most generic template file in a WordPress theme
* and one of the two required files for a theme (the other being style.css).
* It is used to display a page when nothing more specific matches a query.
* E.g., it puts together the home page when no home.php file exists.
*
*/
get_header();
?>
<div class="container">
	<!-- Main Heading Start -->
	<div class="main-heading">
		      <!-- Logo Start -->
            <div class="main-logo">
             <?php glowline_the_custom_logo(); ?>
          <?php
           if ( is_front_page() && is_home() ) : ?>
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
          <?php else : ?>
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
          <?php endif;

          $description = get_bloginfo( 'description', 'display' );
          if ( $description || is_customize_preview() ) : ?>
            <p class="site-description"><?php echo $description; ?></p>
          <?php endif;  ?>
            </div>
            <!-- / Logo End -->

		<?php if(get_theme_mod('slider_on_off','slider_off')=='slider_on'):?>
		<?php  get_template_part( 'template/main', 'slider' ); ?>
		<?php endif; ?>
		</div> <!-- Main Heading End -->
	</div>
	</div> <!-- Main Header End -->
	<!--class="no-sidebar" full index-->
	<div id="page" class="clearfix right" >
		<div class="content-wrapper clearfix">
			<div class="content">  <!-- right -->
			<main id="main" class="site-main" role="main">
				<?php if ( have_posts() ) :
					global $grid_layout;
			$grid_layout = get_theme_mod('dynamic_grid','two-grid-layout');
			?>
			<ul class="load_post <?php echo $grid_layout; ?>">
				<?php
				while ( have_posts() ) : the_post();
				if($grid_layout == 'standard-layout'):
						// Start the post formate loop.
				get_template_part( 'content', get_post_format() );
				else :
					// Start the post formate grid.
				get_template_part( 'content', 'grid');
				endif;
				endwhile;
				?>
			</ul>
						<div class="clearfix"></div>

			<?php
			glowline_pagination();
			else :
							// If no content, include the "No posts found" template.
			get_template_part( 'content', 'none' );
			endif;
			?>
			</main><!-- .site-main -->
			<div class="clearfix"></div>
		</div>
		<div class="sidebar-wrapper"><!-- left -->
		<?php get_sidebar(); ?>
	</div>
</div>
<!-- / content-wrapper end -->
</div>
<?php get_footer(); ?>