<?php
/**
* The template for displaying posts in the Video post format
* @since GlowLine 1.0
*/
?>
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
  <?php the_content(__('Continue Reading...','glowline' ),true); ?>
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