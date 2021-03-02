<?php
$loop = new WP_Query(array('posts_per_page' => get_theme_mod('slider_count',1),
'cat' => get_theme_mod('slider_cate'),
'order' => 'DESC',
'meta_query' => array(array( 'key' => '_thumbnail_id')) ));
if ($loop->have_posts()) {
$i = 0;
?>
<div class="slider">
  <div id="owl-demo" class="owl-carousel">
    <?php
    while ($loop->have_posts()) : $loop->the_post();
    ?>
    <div class="item">
      <?php
      if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) {
      ?>
      <a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail('glowline-custom-slider-thumb'); ?></a>
      <?php  } ?>
      <div class="slider-post-content-wrapper">
        <div class="slider-post-content">
          <div class="slider-post-category">
            <span><?php echo $category_list = get_the_category_list( __( ', ', 'glowline' ) ); ?></span>
          </div>
          <div class="slider-post-title">
            <a href="<?php the_permalink(); ?>">
              <h2><?php the_title(); ?></h2>
            </a>
          </div>
          <div class="slider-post-date"><span><a><?php the_time( get_option('date_format') ); ?></a></span></div>
          <p>  <?php echo glowline_get_custom_excerpt(); ?> </p>
          <div class="read-more read-more-slider"><a href="<?php the_permalink(); ?>"><?php _e('Continue Reading...','glowline'); ?></a></div>
          <div class="slider-post-meta">
            <ul class="slider-post-social social-icon">
              <li class="share-text"><?php _e('Share:','glowline' ); ?></li>
              <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="fa fa-facebook"></i></a></li>
              <li><a target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><i class="fa fa-google-plus"></i></a></li>
              <li><a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&source=LinkedIn"><i class="fa fa-linkedin"></i></a></li>
              <li><a target="_blank" href="https://twitter.com/home?status=<?php the_title(); ?>-<?php the_permalink(); ?>"><i class="fa fa-twitter"></i></a></li>
              <li><a target="_blank" data-pin-do="skipLink"  href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=&amp;description=<?php the_title(); ?>"><i class="fa fa-pinterest"></i></a></li>
              <li><span class="slider-post-comment"><?php comments_popup_link('', '<i class="fa fa-comments-o"></i>', '<i class="fa fa-comments-o"></i>'); ?></span></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
  </div>
</div>
<?php } ?>