<?php

/**
 * Sanitization for textarea field
 */
function glowline_sanitize_textarea( $input ) {
    global $allowedposttags;
    $output = wp_kses( $input, $allowedposttags );
    return $output;
}

/**
 * Returns a sanitized filepath if it has a valid extension.
 */
function glowline_sanitize_upload( $upload ) {
    $return = '';
    $fype = wp_check_filetype( $upload );
    if ( $fype["ext"] ) {
        $return = esc_url_raw( $upload );
    }
    return $return;
}

/**
 * vaild int.
 */
function glowline_sanitize_int( $input ) {
$return = absint($input);
    return $return;
}

// Multiple Checkbox Show
    function glowline_checkbox_explode( $values ) {
    $multi_values = !is_array( $values ) ? explode( ',', $values ) : $values;
    return !empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
}


add_action('customize_register','glowline_custom_customize_register');
function glowline_custom_customize_register( $wp_customize ) {
/**
 * Multiple checkbox customize control class.
 *
 * @since  1.0.0
 * @access public
 */
class Customize_Control_Checkbox_Multiple extends WP_Customize_Control {


    /**
     * The type of customize control being rendered.
     *
     * @since  1.0.0
     * @access public
     * @var    string
     */
    public $type = 'checkbox-multiple';

    /**
     * Enqueue scripts/styles.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function enqueue() {
       
    }

    /**
     * Displays the control content.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function render_content() {

        if ( empty( $this->choices ) ){
            return;   }
            ?>
      

        <?php if ( !empty( $this->label ) ) : ?>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <?php endif; ?>
        <?php if ( !empty( $this->description ) ) : ?>
            <span class="description customize-control-description"><?php echo $this->description; ?></span>
        <?php endif; ?>
        <?php $multi_values = !is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value(); ?>
        <ul>
            <?php foreach ( $this->choices as $value => $label ) : ?>

                <li>
                    <label>
                        <input type="checkbox" value="<?php echo sanitize_text_field( $value ); ?>" <?php checked( in_array( $value, $multi_values ) ); ?> /> 
                        <?php echo esc_html( $label ); ?>
                    </label>
                </li>
            <?php endforeach; ?>
        </ul>
        <input type="hidden" <?php $this->link(); ?> value="<?php echo sanitize_text_field( implode( ',', $multi_values ) ); ?>" />
    <?php }
}

}

function glowline_customizer_styles() {

    wp_enqueue_style('glowline_customizer_styles', get_template_directory_uri() . '/css/customizer-styles.css');

}
add_action('customize_controls_print_styles', 'glowline_customizer_styles');