<?php
/**
 * The default template for displaying content
 * @since GlowLine 1.0
 */
?>
<?php if (is_single()) : ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
	<div class="single-meta"><!-- Single Meta Start -->
	<?php if(!glowline_single_post_meta('single_catgory')) : ?>
	<span class="post-category"><?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'glowline' ) ); ?></span>
	<?php endif; ?>
		<div class="post-title"><h1><span><?php the_title(); ?></span></h1></div>
	<div class="post-meta">
				<?php if(!glowline_single_post_meta('single_date')) : ?>
		<span class="post-date"><?php the_time( get_option('date_format') ); ?></span>
		<?php endif; ?>
	</div>
	</div><!-- Single Meta End -->
	<div class="post-content clearfix"><!-- Content Start -->
	<div class="post-img">
		<a href="#"></a>
	</div>
	<div class="description">
		<?php the_content(); ?>
	</div>
	<div class="clearfix"></div>
	<div class="multipage-links">
		<?php
			wp_link_pages( array(
						'before'      => '<span class="meta-nav">' . __( 'Pages:', 'glowline' ) . '</span>',
						'after'       => '',
						'link_before' => '<span class="active">',
						'link_after'  => '</span>',
					) );
		?>
	</div>
	<div class="single-bottom-meta">
		<?php if(!glowline_single_post_meta('single_tag')) : ?>
		<div class="tagcloud"><?php echo get_the_tag_list( '', __( ' ', 'glowline' ) ); ?></div>
		<?php endif; ?>
		<?php if(get_theme_mod('single_social_share','on')=='on'): ?>
		<div class="post-share">
			<?php glowline_shareText(); ?>
		</div>
		<?php endif; ?>
	</div>
	</div><!-- Content End -->

			<?php glowline_post_nav(); ?>
	<div class="clearfix"></div>
	<div class="related-post">
		<?php glowline_get_related_sigle_post(); ?>
	</div>
	<div class="clearfix"></div>
	<?php edit_post_link( __( 'Edit', 'glowline' ), '<span class="edit-link">', '</span>' );
	?>
</article>
<?php else: ?>
<li id="post-<?php the_ID(); ?>" <?php post_class('post'); ?> >
	<div class="post-header">
	<?php if(!glowline_home_post_meta('category')): ?>
		<span class="post-category">
			<?php echo $category_list = get_the_category_list( __( ', ', 'glowline' ) ); ?>
		</span>
	<?php endif; ?>
		<div class="post-title">
			<a href="<?php the_permalink(); ?>">
				<h2><?php the_title(); ?></h2>
			</a>
		</div>
		<div class="post-meta">
			 <?php  if(!glowline_home_post_meta('date')): ?>
			<span class="post-date"><?php the_time( get_option('date_format') ); ?></span>
			<?php endif; ?>
		</div>
	</div>
	<div class="post-img">
		<?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) { ?>
		<a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail('post-thumbnails'); ?></a>
		<?php  } else{ ?>
		<a href=""><?php echo glowline_full_post_image(); ?></a>
		<?php  }  ?>
	</div>
	<?php the_content('Continue Reading...',true); ?>
	<div class="clearfix"></div>
	<div class="standard-bottom-meta">
	 <?php  if(!glowline_home_post_meta('comment')): ?>
		<?php glowline_comment_number(); ?>
	<?php endif; ?>
		<div class="post-share">
			<?php glowline_shareText(); ?>
		</div>
	</div>
</li>
<?php endif; ?>