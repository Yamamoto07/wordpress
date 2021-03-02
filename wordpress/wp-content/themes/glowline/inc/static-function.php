<?php
 /**
 * Enable support for Post Thumbnails on posts and pages.
 *
 * @param  
 * @return mixed|string
 */
function glowline_grid_thumb($grid_layout, $thumb_crop=true){
    if($thumb_crop):
switch($grid_layout){
        case 'two-grid-layout':
             the_post_thumbnail('glowline-custom-two-grid-thumb');
            break;
        case 'three-grid-layout':
             the_post_thumbnail('glowline-custom-three-grid-thumb');
            break;
        case 'four-grid-layout':
             the_post_thumbnail('glowline-custom-four-grid-thumb');
            break;
        case 'five-grid-layout':
             the_post_thumbnail('glowline-custom-five-grid-thumb');
            break;
        case 'list-layout':
             the_post_thumbnail('glowline-custom-list-thumb');
            break;
        case 'boxed-layout':
             the_post_thumbnail('glowline-custom-boxed-thumb');
            break;
}   
endif;

}

if ( ! function_exists( 'glowline_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
function glowline_the_custom_logo() {
    if ( function_exists( 'the_custom_logo' ) ) {
        the_custom_logo();
    }
}
endif;



/*
 * Custom header menu
 *
*/

add_action( 'after_setup_theme', 'glowline_register_theme_menu' );
function glowline_register_theme_menu() {
  register_nav_menu( 'primary', __( 'Primary Menu', 'glowline' ) );
}
    function glowline_nav_menu(){
    	wp_nav_menu( array('theme_location' => 'primary', 
    	'container' => false, 
    		'menu_class' => 'menu', 
    		'menu_id'         => 'menu',
    		'fallback_cb'     => 'glowline_wp_page_menu'));
    }

   function glowline_wp_page_menu()
{
    echo '<ul class="menu" id="menu">';
    wp_list_pages(array('title_li' => ''));
    echo '</ul>';
}
// full thumb get post content
function glowline_full_post_image(){

   $img_source = '';
    global $post;
  
   $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);

    if (isset($matches [1] [0])) {
        $img_source = $matches [1] [0];
    }
     if($img_source!=''){
         $permalink = esc_url(get_permalink($post->ID));
        print "<a href='$permalink'><img src='$img_source' class='postimg' alt='Post Image'/></a>";
        }

}

/**
 * Display navigation to next/previous post when applicable.
 *
 * @since ThemeHunk 1.0
 */

if ( ! function_exists( 'glowline_post_nav' ) ) :
function glowline_post_nav() {
    // Don't print empty markup if there's nowhere to navigate.
    ?>

    <nav class="navigation post-navigation" role="navigation">
        <div class="nav-links">
           <?php
              the_post_navigation( array(
                'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( '%title', 'glowline' ) . '</span> ' ,
                'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( '%title', 'glowline' )));
                //%title
            ?>
        </div><!-- .nav-links -->
    </nav><!-- .navigation -->
    <?php
}
endif;

/**
 * custom post excerpt
 */
function glowline_get_custom_excerpt(){
$excerpt = get_the_content();
$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
$excerpt = strip_shortcodes($excerpt);
$excerpt = strip_tags($excerpt);
$excerpt = substr($excerpt, 0, 200);
$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
return $excerpt;
}

// related post
  function glowline_get_related_sigle_post() {
    global $post;
     $args = array(
               'category__in' => wp_get_post_categories($post->ID),
               'post__not_in' => array($post->ID),
                'post_status' => array('publish'),                         
                'meta_key' => '_thumbnail_id',
                'posts_per_page' => 3,
            );
        $my_query = new WP_Query($args);
        if ($my_query->have_posts()) {
            while ($my_query->have_posts()) : $my_query->the_post();
                ?>
               <li class="sl-related-thumbnail">
                    <div class="sl-related-thumbnail-size">
                        <?php
                       if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) {
                            ?>
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('glowline-custom-three-grid-thumb',array('class' => "postimg listing-thumbnail")); ?></a>
                            <?php
                        } else {
                            ?><a href="<?php the_permalink(); ?>"><?php glowline_post_image(358, 204); ?></a>
                        <?php } ?>
                        </div>
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                </li>
                <?php
            endwhile;
        }
    wp_reset_query(); // to use the original query again
}

function glowline_get_my_url() {
    if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) ){
        return false;
    }
    return esc_url_raw( $matches[1] );
}

/*hexa to rgba convert*/
function glowline_hex2rgba($color, $opacity = false) {
 
 $default = 'rgb(0,0,0)';
 
 //Return default if no color provided
 if(empty($color)){
          return $default; 
 }
 //Sanitize $color if "#" is provided 
        if ($color[0] == '#' ) {
         $color = substr( $color, 1 );
        }
 
        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }
 
        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);
 
        //Check if opacity is set(rgba or rgb)
        if($opacity){
         if(abs($opacity) > 1){
         $opacity = 1.0;
     }
         $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
         $output = 'rgb('.implode(",",$rgb).')';
        }
 
        //Return rgb(a) color string
        return $output;
}

//pagination
function glowline_pagination() {

the_posts_pagination( array(
    'mid_size' => 2,
    'prev_text' => __( '&laquo;', 'glowline' ),
    'next_text' => __( '&raquo;', 'glowline' ),
) );
}

/*Number of comment*/
function glowline_comment_number(){ ?>
<span class="post-comment"><?php comments_popup_link(__('No Comment','glowline'), __('1 Comment','glowline'), __('% Comments','glowline')); ?></span>
<?php }

function glowline_userPic(){
     $address = get_the_author_meta('user_email');
     $nicname = get_the_author_meta('user_nicename');
    $pic = get_avatar( $address, 30, '', $nicname); 
    return $pic;
  }

function glowline_shareText(){ ?>
 <ul class="single-social-icon">
        <li><span class="post-author-pic"> <?php echo glowline_userPic(); ?></span></li>
        <li><span class="post-author"><?php the_author_posts_link(); ?></span></li>
        </ul> <?php }