<?php
/**
* The template for displaying the sidebar footer
* @since GlowLine 1.0
*/
?>
<div class="footer">
  <div class="footer-widget-column footer-widget-3column-active">
    <?php
    if ( ! is_active_sidebar( 'first-footer-widget-area'  )
    && ! is_active_sidebar( 'second-footer-widget-area' )
    && ! is_active_sidebar( 'third-footer-widget-area'  )
    && ! is_active_sidebar( 'fourth-footer-widget-area' )
    ){
    return;
    }
    ?>
    <div class="widget">
      <?php
      if ( is_active_sidebar( 'first-footer-widget-area' ) ){
      dynamic_sidebar( 'first-footer-widget-area' );
    }
      ?>
    </div>
    <div class="widget">
      <?php
      if ( is_active_sidebar( 'second-footer-widget-area' ) ){
      dynamic_sidebar( 'second-footer-widget-area' );
    }
      ?>
    </div>
    <div class="widget">
      <?php
      if ( is_active_sidebar( 'third-footer-widget-area' ) ){
      dynamic_sidebar( 'third-footer-widget-area' );
    }
      ?>
    </div>
  </div>
</div>