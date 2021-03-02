<?php
     //  =============================
     //  = Default Theme Customizer Settings  =
     //  @GlowLine Theme
     //  =============================



/*Theme customizer*/
function glowline_customize_register( $wp_customize ) {
$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';

     //  =============================
     //  = Genral Settings     =
   	 //  =============================
$wp_customize->get_section('title_tagline')->title = esc_html__('General Settings', 'glowline');
$wp_customize->remove_control( 'header_textcolor' );

     //  =============================
     //  = Header Settings       =
   	 //  =============================
    $wp_customize->get_section('header_image')->title = esc_html__('Header Image Setting', 'glowline');
    $wp_customize->get_section('header_image')->priority = 25;
    //  =header  Background Type  =
     $wp_customize->add_setting('header_background_type', array(
        'default'        => 'color',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'header_background_type', array(
        'settings' => 'header_background_type',
        'label'   => __('Header Background','glowline'),
        'section' => 'header_image',
        'priority' => 5,
        'type'    => 'radio',
        'choices'     => array(
            'color'   => 'Color',
            'image'   => 'Image',
        ),
    ));
   $wp_customize->add_setting('theme_bg_color', array(
        'default'           => '#f5f5f5',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'theme_bg_color', array(
        'label'    => __('Header Background Color', 'glowline'),
        'section'  => 'header_image',
        'settings' => 'theme_bg_color',
        'priority' => 6,

    )));

     //  =============================
    //  = Home Post Slider Settings    =
    //  =============================
     $wp_customize->add_section('slider_option', array(
        'title'    => __('Home Page Slider Options ', 'glowline'),
        'priority' => 25,
    ));

     //= Slider On Off  =
     $wp_customize->add_setting('slider_on_off', array(
        'default'        => 'slider_off',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('slider_on_off', array(
        'settings' => 'slider_on_off',
        'label'   => __('Post Slider On/Off','glowline'),
        'section' => 'slider_option',
         'type'       => 'radio',
        'choices'    => array(
        'slider_on'     => 'On',
        'slider_off'     => 'Off',
        ),
    ) );

  //= Choose All Category  =
  $cats = array();
   $cats[0] = 'All Categories';
    foreach ( get_categories() as $categories => $category ){
        $cats[$category->term_id] = $category->name;
    }
   
     $wp_customize->add_setting('slider_cate', array(
        'default'        => 1,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('slider_cate', array(
        'settings'      => 'slider_cate',
        'label'         => __('Featured Post Category','glowline'),
         'description'  => __( 'Blog post slider show', 'glowline' ),
        'section'       => 'slider_option',
        'type'          => 'select',
        'choices'       => $cats,
    ) );

    $wp_customize->add_setting('slider_count', array(
        'default'               => 1,
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'glowline_sanitize_int',
    ));
    $wp_customize->add_control('slider_count', array(
        'settings'      => 'slider_count',
        'label'         => __('Number of Slides (maximum 3 slides)','glowline'),
        'section'       => 'slider_option',
        'type'          => 'number',
        'input_attrs'    => array('min' => 1,'max' => 3)

    ) );


	//  =============================
    //  = Home Page Settings       =
    //  =============================
   $wp_customize->add_section('home_page', array(
        'title'    => __('Home Page Settings ', 'glowline'),
        'priority' => 25,
    ));

    //= Choose Grid Layout  =
     $wp_customize->add_setting('dynamic_grid', array(
        'default'           => 'two-grid-layout',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'dynamic_grid', array(
        'settings'  => 'dynamic_grid',
        'label'     => __('Choose Post Layout','glowline'),
        'section'   => 'home_page',
        'type'      => 'select',
        'choices'   => array(
            'standard-layout'       => __('Standard Layout','glowline'),
            'two-grid-layout'       => __('Two Grid','glowline'),
        ),
    ));

	   //= Choose Post Meta  =
     $wp_customize->add_setting('home_post_meta', array(
        'default'           =>array(),
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'glowline_checkbox_explode'
    ));
    $wp_customize->add_control(new Customize_Control_Checkbox_Multiple(
        $wp_customize,'home_post_meta', array(
        'settings'          => 'home_post_meta',
        'label'             => __( 'Meta Info to Hide', 'glowline' ),
        'section'           => 'home_page',
        'choices'           => array(
               'category'   => __( 'Hide Category','glowline' ),
                'date'      => __( 'Hide Date','glowline' ),
                'comment'   => __( 'Hide Comment','glowline' ),
            )
        ) 
    )
);

	//  =============================
    //  = Social Settings       =
    //  =============================

        // on/off social icon
    $wp_customize->add_section('social_option', array(
        'title'    => __('Social Icon Options ', 'glowline'),
        'priority' => 25,
    ));
    //= social Options = facebook
     $wp_customize->add_setting('f_link', array(
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage'
    ));
    $wp_customize->add_control('f_link', array(
        'settings' => 'f_link',
        'label'   => __('Facebook Link:','glowline'),
        'section' => 'social_option',
        'type'    => 'text',
    )  );
    //google icon
    $wp_customize->add_setting('g_link', array(
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage'

    ));
    $wp_customize->add_control('g_link', array(
        'settings' => 'g_link',
        'label'   => __('Google Link:','glowline'),
        'section' => 'social_option',
        'type'    => 'text',
    )  );

    //pintrest
    $wp_customize->add_setting('p_link', array(
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage'

    ));
    $wp_customize->add_control('p_link', array(
        'settings' => 'p_link',
        'label'   => __('Pinterest Link:','glowline'),
        'section' => 'social_option',
        'type'    => 'text',
    )  );


	//  =============================
    //  = Footer Settings      =
    //  =============================

    if (function_exists('glowlinepro_body_classes')) {

    $wp_customize->add_section('footer_option', array(
        'title'    => __('Footer Options ', 'glowline'),
        'priority' => 25,
    ));

    $wp_customize->add_setting('copyright_textbox', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('copyright_textbox', array(
        'settings'   => 'copyright_textbox',
        'label'      => __('Copyright Text','glowline'),
        'section'    => 'footer_option',
        'type'       => 'text',
    ) );
}

    //  =============================
    //  = Custom Css      =
    //  =============================
	
	 $wp_customize->get_section('colors')->title = esc_html__('Theme Color', 'glowline');
     $wp_customize->add_setting('theme_color', array(
        'default'           => '#bdb76b',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'theme_color', array(
        'label'    => __('Theme Color', 'glowline'),
        'section'  => 'colors',
        'settings' => 'theme_color',
        'priority' => 6,

    )));
   if( get_bloginfo( 'version' ) < '4.7'):
   $wp_customize->add_setting('custom_css_text', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    ));
    $wp_customize->add_control('custom_css_text', array(
        'settings' => 'custom_css_text',
        'label'     => __('Custom CSS','glowline'),
        'section' => 'colors',
        'type'    => 'textarea',
    ) );
    endif;
// selective-refresh option added

}
add_action('customize_register','glowline_customize_register');