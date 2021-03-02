<?php

 // custom header background
function glowline_custom_style(){ 
$theme_color = esc_html(get_theme_mod('theme_color','#bdb76b'));
$header_upload = esc_url_raw(get_header_image());
$header_color = esc_html(get_theme_mod('theme_bg_color','#f5f5f5'));
$header_bg_type = esc_html(get_theme_mod('header_background_type','color'));
$header_textcolor = esc_html(get_theme_mod('header_textcolor'));
if(!empty($header_upload) && $header_bg_type=='image'):
    ?>
.home .header-wrapper{
          background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.4)), url("<?php echo $header_upload; ?>");
    background-image: -moz-linear-gradient(top, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.4)), url("<?php echo $header_upload; ?>");
    background-image: -o-linear-gradient(top, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.4)), url("<?php echo $header_upload; ?>");
    background-image: -ms-linear-gradient(top, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.4)), url("<?php echo $header_upload; ?>");
    background-image: -webkit-gradient(linear, left top, left bottom, from(rgba(0, 0, 0, 0.2)), to(rgba(0, 0, 0, 0.4))), url("<?php echo $header_upload; ?>");
    background-image: -webkit-linear-gradient(top, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.4)), url("<?php echo $header_upload; ?>");
}
<?php
elseif (!empty($header_color) && $header_bg_type=='color'):
?>
.home .header-wrapper{
    background-color:<?php echo $header_color; ?>;
}
 <?php
 endif;
  ?>
  .main-heading .main-logo h1 a, .main-heading .main-logo p{ color:#<?php echo $header_textcolor; ?>}
.navigation .menu > li > a:hover, .navigation ul li a:hover, header #main-menu-wrapper .menu-item-has-children > a:hover:after, .navigation ul ul.sub-menu a:hover, .navigation ul ul.sub-menu a:link:hover{
  color:<?php echo $theme_color; ?>;
}
.slider-post-category span a, .post-category a,
.social-icon i.fa:hover, .post-share i.fa:hover, .footer-copyright .social-icon ul li a:hover, .header-bottom .social-icon ul li a:hover, .content .post-content .read-more a, .slider-post-content .read-more-slider a, .owl-controls .owl-prev:before, .owl-controls .owl-next:before, a.more-link, ul li a:hover, #commentform #commentSubmit, ol.commentlist li .reply a, .th-widget-recent-post .th-recent-post h5 a:hover, .widget .twitter-user a, .standard-layout .format-link h2, .format-quote blockquote p:before, .widget .tagcloud a:hover, .content .post-content .description p a, .page-description p a, .multipage-links span, .content .navigation.post-navigation .nav-links a:hover, .content, #searchform .icon-search:before, .content .post .post-meta .post-author a:hover, header.smaller .header .logo h1 a, .main-heading .main-logo h1 a, .pagination .nav-links .prev, .pagination .nav-links .page-numbers {
color:<?php echo $theme_color; ?>;
}

.pagination .nav-links .prev, .pagination .nav-links .page-numbers{
      border-color: <?php echo $theme_color; ?>;
}

.post .post-content .post-category, .post .post-category, .single-meta .post-category, .slider-post-category span, .archive-title, .page-title, li.sl-related-thumbnail h3, .multipage-links span, #searchform #s, #searchform #s:focus, #searchform #s:hover, #searchform .icon-search:hover + #s {
   border-bottom: 1px solid <?php echo $theme_color; ?>;
}
.format-quote blockquote, .single .format-quote blockquote, .single blockquote{
   border-left: 5px solid <?php echo $theme_color; ?>;
}
.home-category .cat-img-wrap:hover {
  background:<?php echo glowline_hex2rgba($theme_color, 0.7); ?>;
 border: 1px solid <?php echo $theme_color; ?>;
}
#move-to-top, .slider-post-content .read-more-slider a:hover, .widget .search-submit:hover, .search .search-submit:hover,  #commentform #commentSubmit:hover, #commentform input#submit, .tagcloud a, .mc4wp-form input[type=submit], input[type=submit]:hover, .pagination .nav-links a:hover, .pagination .nav-links .current, .pagination .nav-links span:hover {
background:<?php echo $theme_color; ?>;
 border: 1px solid <?php echo $theme_color; ?>;
}
@media screen and (max-width: 1024px){
.navigation ul .current-menu-item > a, .navigation ul li a:hover {
    background:<?php echo $theme_color; ?>;
   }}
::selection{
background:<?php echo $theme_color; ?>;
}
::-moz-selection{
background:<?php echo $theme_color; ?>;
}

.widget .search-submit, .slider-post-content .read-more-slider a, .widget .search-submit, .search .search-submit, #commentform #commentSubmit, ul.paging li a, {
border: 1px solid <?php echo $theme_color; ?>;
}
<?php
  // Has the text been hidden?
    if ( ! display_header_text() ) :
  ?>
    .site-title,
    .site-description {
      clip: rect(1px, 1px, 1px, 1px);
      position: absolute;
    }
  <?php endif; 
  
 echo wp_strip_all_tags(get_theme_mod('custom_css_text'));
    }

// custom header code
function glowline_header(){
  /*theme favicon*/
   
    ?>
    <style type="text/css">
    <?php  glowline_custom_style(); ?>
    </style>
    <?php 
    }
add_action('wp_head','glowline_header');