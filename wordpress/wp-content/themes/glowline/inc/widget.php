<?php
function glowline_widgets_init() {
// Area , located below the Primary Widget Area in the sidebar. Empty by default.
register_sidebar(array(
'name' => __('Primary Sidebar', 'glowline'),
'id' => 'primary-sidebar',
'description' => __('Main sidebar that appears on the left.', 'glowline'),
'before_widget' => '<div class="sidebar-inner-widget">',
'after_widget' => '</div><div class="clearfix"></div>',
'before_title' => '<h4 class="widgettitle">',
'after_title' => '</h4>',
));
// Area , located below the Secondry Widget Area in the sidebar. Empty by default.
register_sidebar(array(
'name' => __('Secondry Sidebar', 'glowline'),
'id' => 'secondary-sidebar',
'description' => __('Secondry sidebar that appears on the left.', 'glowline'),
'before_widget' => '<div class="sidebar-inner-widget">',
'after_widget' => '</div><div class="clearfix"></div>',
'before_title' => '<h4 class="widgettitle">',
'after_title' => '</h4>',
));
// Area 1, located in the footer. Empty by default.
register_sidebar(array(
'name' => __('First Footer Widget Area', 'glowline'),
'id' => 'first-footer-widget-area',
'description' => __('Appears in the first footer section of the site.', 'glowline'),
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h4 class="widgettitle" >',
'after_title' => '</h4>',
));
// Area 2, located in the footer. Empty by default.
register_sidebar(array(
'name' => __('Second Footer Widget Area', 'glowline'),
'id' => 'second-footer-widget-area',
'description' => __('Appears in the Second footer section of the site.', 'glowline'),
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h4 class="widgettitle" >',
'after_title' => '</h4>',
));

// Area 3, located in the footer. Empty by default.
register_sidebar(array(
'name' => __('Third Footer Widget Area', 'glowline'),
'id' => 'third-footer-widget-area',
'description' => __('Appears in the Third footer section of the site.', 'glowline'),
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h4 class="widgettitle">',
'after_title' => '</h4>',
));

}
/** Register sidebars by running glowline_widgets_init() on the widgets_init hook. */
add_action('widgets_init', 'glowline_widgets_init');
