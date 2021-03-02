<?php
/*
 *  About me widget
 *  user about us 
 *
 */

// register widget
add_action('widgets_init', 'glowline_about_me_widget');
function glowline_about_me_widget() {
    register_widget( 'glowline_aboutme' );
}

// add admin scripts
add_action('admin_enqueue_scripts', 'glowline_aboutme_enqueue');
function glowline_aboutme_enqueue() {
    wp_enqueue_media();
    wp_enqueue_script('glowline-aboutme_script', get_template_directory_uri() . '/js/widget.js', false, '1.0', true);
}

// about me widget class
class glowline_aboutme extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'th-about-me');
        parent::__construct('th-about-me-widget', __('About Me','glowline'), $widget_ops);
    }


    function widget($args, $instance) {
        extract($args);

        // widget content
        echo $before_widget;

         $title = apply_filters('widget_title', empty($instance['title']) ? __('About Me','glowline') : $instance['title'], $instance, $this->id_base);
        $text = isset($instance['text'])?$instance['text']:'';
        $author_img_uri = isset($instance['author_img_uri'])?$instance['author_img_uri']:'';
?>
<div class="th-aboutme">
    <h4 class="widgettitle"><?php echo sanitize_text_field($title); ?></h4 class="widgettitle">
    <?php if( $author_img_uri != ''): ?>
        <img src="<?php echo esc_url($author_img_uri); ?>" />   
        <?php endif; ?> 
        <p><?php echo esc_textarea($text); ?></p>
    </div>

<?php
        echo $after_widget;

    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['text'] = sanitize_text_field($new_instance['text']);
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['author_img_uri'] = esc_url( $new_instance['author_img_uri'] );
        return $instance;
    }

    function form($instance) {
    ?>
<div class="clearfix"></div>
        <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo esc_html__('Title:','glowline'); ?></label><br />
        <input type="text" class="widefat" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php  if(isset($instance["title"])){ echo $instance['title']; } ?>" style="margin-top:5px;">
            </p>
        <p>    
        <label for="<?php echo $this->get_field_id('text'); ?>"><?php echo esc_html__('About Me Description:','glowline'); ?></label><br />
        <textarea  name="<?php echo $this->get_field_name('text'); ?>" id="<?php echo $this->get_field_id('text'); ?>"  class="widefat" ><?php if(isset($instance["text"])){ echo $instance['text']; } ?></textarea>
            </p>
        <p>
        <label for="<?php echo $this->get_field_id('author_img_uri'); ?>"><?php echo esc_html__('Upload Author Image:','glowline'); ?></label><br />
        <?php
            if ( isset($instance['author_img_uri']) && $instance['author_img_uri'] != '' ) :
                echo '<img class="custom_media_image" src="' . $instance['author_img_uri'] . '" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" /><br />';
            endif;
        ?>
        <input type="text" class="widefat custom_media_url" name="<?php echo $this->get_field_name('author_img_uri'); ?>" id="<?php echo $this->get_field_id('author_img_uri'); ?>" value="<?php if(isset($instance["author_img_uri"])){ echo $instance['author_img_uri']; } ?>" style="margin-top:5px;">
        </p>
        <input type="button" class="button button-primary custom_media_button" id="custom_media_button" name="<?php echo $this->get_field_name('author_img_uri'); ?>" value="Upload Image" style="margin-top:5px;" />

<?php
    }
}