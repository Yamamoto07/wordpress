<?php
function glowline_admin_assets(){
wp_enqueue_script( 'glowline_customizer_admin', get_template_directory_uri() . '/inc/theme-setup/customizer-popup.js', array("jquery"), '', true  );
  wp_enqueue_style('glowline_customizer_admin', get_template_directory_uri() . '/inc/theme-setup/customizer-popup-styles.css');

}
     add_action('admin_enqueue_scripts', 'glowline_admin_assets');


// home page setup 

function active_plugin(){
       $plugin_slug = 'blogwings-companion';
            $active_file_name =  $plugin_slug.'/'.$plugin_slug.'.php';
            $button_class = 'install-now button button-primary button-large';
      $install_url = add_query_arg(array(
                            'action' => 'activate',
                            'plugin' => rawurlencode( $active_file_name ),
                            'plugin_status' => 'all',
                            'paged' => '1',
                            '_wpnonce' => wp_create_nonce('activate-plugin_' . $active_file_name ),
                        ), network_admin_url('plugins.php'));
                        $button_class = 'activate-now button-primary button-large';
                        $button_txt = esc_html__( 'Setup Homepage', 'glowline' );
    if ( is_plugin_active( $active_file_name ) ) {
      echo false;
    }else{
      echo $install_url;

} 
        
}

add_action( 'wp_ajax_glowline_default_home', 'glowline_default_home' );
function glowline_default_home() {

    wp_die(); // this is required to terminate immediately and return a proper response
}

function glowline_customizer_disable_popup(){
      $value = intval(@$_POST['value']);
      update_option( "glowline_disable_popup", $value );
      die();
  }
add_action('wp_ajax_customizer_disable_popup', 'glowline_customizer_disable_popup');


/**
 * Add admin notice when active theme, just show one time
 *
 * @return bool|null
 */
add_action( 'admin_notices', 'glowline_admin_notice' );

function glowline_admin_notice() {
  global $current_user;
  $user_id   = $current_user->ID;
  $theme_data  = wp_get_theme();
  if ( !get_user_meta( $user_id, esc_html( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore' ) ) {
    ?>
    <div class="notice thunk-notice">

      <h1>
        <?php
        /* translators: %1$s: theme name, %2$s theme version */
        printf( esc_html__( 'Welcome to %1$s - Version %2$s', 'glowline' ), esc_html( $theme_data->Name ), esc_html( $theme_data->Version ) );
        ?>
      </h1>
      <p>
        <?php
        /* translators: %1$s: theme name, %2$s link */
        printf( __( 'Welcome! Thank you for choosing %1$s! To fully take advantage of the best our theme can offer please make sure you visit our <a href="%2$s">Welcome page</a>', 'glowline' ), esc_html( $theme_data->Name ), esc_url( admin_url( 'themes.php?page=th_glowline' ) ) );
        printf( '<a href="%1$s" class="notice-dismiss dashicons dashicons-dismiss dashicons-dismiss-icon"></a>', '?' . esc_html( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore=0' );
        ?>
      </p>
      <p>
        <a href="<?php echo esc_url( admin_url( 'themes.php?page=th_glowline' ) ) ?>" style="text-decoration: none;">
          <?php
          /* translators: %s theme name */
          printf( esc_html__( 'Get started with %s', 'glowline' ), esc_html( $theme_data->Name ) )
          ?>
        </a>
      </p>
    </div>
    <?php
  }
}

add_action( 'admin_init', 'glowline_notice_ignore' );

function glowline_notice_ignore() {
  global $current_user;
  $theme_data  = wp_get_theme();
  $user_id   = $current_user->ID;
  /* If user clicks to ignore the notice, add that to their user meta */
  if ( isset( $_GET[ esc_html( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore' ] ) && '0' == $_GET[ esc_html( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore' ] ) {
    add_user_meta( $user_id, esc_html( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore', 'true', true );
  }
}


function glowline_tab_config($theme_data){
    $config = array(
        'theme_brand' => sprintf(esc_html__('%1s','glowline'),$theme_data->get( 'Name' )),
        'theme_brand_url' => esc_url('//themehunk.com','glowline' ),
        'welcome'=>sprintf(esc_html__('Welcome to %1s - Version %1s', 'glowline'), $theme_data->get( 'Name' ), $theme_data->get( 'Version' ) ),
        'welcome_desc' => esc_html__( 'Glowline is a powerful theme made with love for Magazine, Newspaper and Personal blog.', 'glowline' ),
        'tab_one' =>sprintf(esc_html__('Get Started with %1s', 'glowline' ), $theme_data->get( 'Name' )),
        'tab_two' =>esc_html__( 'Recommended Actions', 'glowline' ),
        'tab_three' =>esc_html__( 'Free VS Pro', 'glowline' ),
        'tab_four' =>esc_html__( 'Demo Import', 'glowline' ),
        'tab_five' =>esc_html__( 'FREE VS PRO', 'glowline' ),


        'plugin_title' => esc_html__( 'Step 1 - Read Full Documentation', 'glowline' ),
        'plugin_link' => esc_url('//themehunk.com/docs/glowline-lite-theme/','glowline' ),
        'plugin_text' => esc_html__('', 'glowline'),
        'plugin_button' => esc_html__('Documentation', 'glowline'),
		
		    'customizer_title' => esc_html__( 'Step 2 - Import Demo Content', 'glowline' ),
        'customizer_text' =>  sprintf(esc_html__('Do you want to import demo file? This action will make your site look like theme demo (Showcased at our site).', 'glowline'), $theme_data->get( 'Name' )),
        'customizer_button' => sprintf( esc_html__('Import Demo', 'glowline')),

        'support_title' => esc_html__( 'Step 4 - Having trouble? Need support?', 'glowline' ),
        'support_link' => esc_url('//themehunk.com/support/'),
        'support_forum' => sprintf(esc_html__('Contact Us', 'glowline'), $theme_data->get( 'Name' )),
        'doc_link' => esc_url('//blogwings.com/docs/magazina-theme/'),
        'doc_link_text' => sprintf(esc_html__('Contact Us', 'glowline'), $theme_data->get( 'Name' )),

        'support_text' => sprintf(esc_html__('If you need any help you can contact to our support team, our team is always ready to help you.', 'glowline'), $theme_data->get( 'Name' )),
        'support_button' => sprintf( esc_html__('Create a support ticket', 'glowline'), $theme_data->get( 'Name' )),
        );
    return $config;
}


if ( ! function_exists( 'glowline_admin_scripts' ) ) :
    /**
     * Enqueue scripts for admin page only: Theme info page
     */
    function glowline_admin_scripts( $hook ) {
        wp_enqueue_style( 'magazina-admin-css', get_template_directory_uri() . '/inc/theme-setup/admin.css' );

        if ($hook === 'appearance_page_th_glowline'  ) {
            // Add recommend plugin css
            wp_enqueue_style( 'plugin-install' );
            wp_enqueue_script( 'plugin-install' );
            wp_enqueue_script( 'updates' );
            add_thickbox();
        }
    }
endif;
add_action( 'admin_enqueue_scripts', 'glowline_admin_scripts' );

function magazina_count_active_plugins() {
   $i = 3;

  $recommend_plugins = get_theme_support( 'recommend-plugins' );
    if ( is_array( $recommend_plugins ) && isset( $recommend_plugins[0] ) ){

        foreach($recommend_plugins[0] as $slug=>$plugin){
                  $active_file_name = $slug . '/' . $slug . '.php';

      if (is_plugin_active( $active_file_name ) ):
           $i--;
       endif;
            
        }
    }
       return $i;
}
function magazina_tab_count(){
       $count = '';
       $number_count = magazina_count_active_plugins();
           if( $number_count >0):
           $count = "<span class='update-plugins count-".esc_attr( $number_count )."' title='".esc_attr( $number_count )."'><span class='update-count'>" . number_format_i18n($number_count) . "</span></span>";
           endif;
           return $count;
}

/**
    * Menu tab
    */
function magazina_tab() {
               $number_count = magazina_count_active_plugins();
               $menu_title = esc_html__('Get Started with glowline', 'glowline');
           if( $number_count >0):
           $count = "<span class='update-plugins count-".esc_attr( $number_count )."' title='".esc_attr( $number_count )."'><span class='update-count'>" . number_format_i18n($number_count) . "</span></span>";
               $menu_title = sprintf( esc_html__('Get Started with glowline %s', 'glowline'), $count );
           endif;


   add_theme_page( esc_html__( 'glowline', 'glowline' ), $menu_title, 'edit_theme_options', 'th_glowline', 'magazina_tab_page');
}
add_action('admin_menu', 'magazina_tab');


function magazina_theme(){ ?>
  <div class="freeevspro-img">
    <img src="<?php echo esc_url(get_template_directory_uri().'/inc/theme-setup/images/free-pro.png');?>" alt="free vs pro" />
    <p>
     <a class="button button-secondary" target="_blank" href="<?php echo esc_url('//themehunk.com/product/glowline-gracefull-wordpress-theme/'); ?>"><?php esc_html_e('Check Pro version for more features','glowline'); ?></a>
    </p>
  </div>
<?php }


// demo import
function magazina_demo_import(){ ?>
<div class="theme_demo">
   <div class="inner-wrp">
  <h3><?php esc_html_e( 'Step', 'glowline' ); ?></h3>
    <p class="about"><?php esc_html_e( 'Click "One Click Install" button, Install the plugin and then go to the Appearance > Import Demo Data and click "Import Demo Data" button.', 'glowline' ); ?>
    </p>
    <p>
<?php if ( !class_exists('OCDI_Plugin') ) : ?>
<?php $odi_url = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=one-click-demo-import'), 'install-plugin_one-click-demo-import'); ?>
            <p>
              <a target="_blank" class="install-now button importer-install" href="<?php echo esc_url( $odi_url ); ?>"><?php esc_html_e( 'One Click Install', 'glowline' ); ?></a>
              <a style="display:none;" class="button button-primary button-large importer-button" href="<?php echo admin_url( 'themes.php?page=pt-one-click-demo-import.php' ); ?>"><?php esc_html_e( 'Go to the importer', 'glowline' ); ?></a>            
            </p>
            <?php else : ?>
              <p style="color:#e45f12;font-style:italic;font-size:14px;"><?php esc_html_e( 'Plugin installed and active!', 'glowline' ); ?></p>
              <a class="button button-primary button-large" href="<?php echo admin_url( 'themes.php?page=pt-one-click-demo-import.php' ); ?>"><?php esc_html_e( 'Go to the automatic importer', 'glowline' ); ?></a>
            <?php endif;  ?>
   <img src="<?php echo esc_url(get_template_directory_uri().'/inc/theme-setup/images/demo-import.png');?>" alt="free vs pro" />
  </p>
</div>
</div>
<?php }


function magazina_tab_page() {
    $theme_data = wp_get_theme();
    $theme_config = glowline_tab_config($theme_data);


    // Check for current viewing tab
    $tab = null;
    if ( isset( $_GET['tab'] ) ) {
        $tab = $_GET['tab'];
    } else {
        $tab = null;
    }

    $actions_r = glowline_get_actions_required();
    $actions = $actions_r['actions'];

    $current_action_link =  admin_url( 'themes.php?page=th_glowline&tab=actions_required' );

    $recommend_plugins = get_theme_support( 'recommend-plugins' );
    if ( is_array( $recommend_plugins ) && isset( $recommend_plugins[0] ) ){
        $recommend_plugins = $recommend_plugins[0];
    } else {
        $recommend_plugins[] = array();
    }
    ?>
    <div class="wrap about-wrap theme_info_wrapper">
        <h1><?php  echo $theme_config['welcome']; ?></h1>
        <div class="about-text"><?php echo $theme_config['welcome_desc']; ?></div>
        <a target="_blank" href="<?php echo $theme_config['theme_brand_url']; ?>" class="blogwingshemes-badge wp-badge"><span><?php echo $theme_config['theme_brand']; ?></span></a>
        <h2 class="nav-tab-wrapper">
            <a href="?page=th_glowline" class="nav-tab<?php echo is_null($tab) ? ' nav-tab-active' : null; ?>"><?php  echo $theme_config['tab_one']; ?></a>
            <a href="?page=th_glowline&tab=actions_required" class="nav-tab<?php echo $tab == 'actions_required' ? ' nav-tab-active' : null; ?>"><?php echo $theme_config['tab_two'];  echo magazina_tab_count();?></a>
            <!-- <a href="?page=th_glowline&tab=theme-pro" class="nav-tab<?php echo $tab == 'theme-pro' ? ' nav-tab-active' : null; ?>"><?php echo $theme_config['tab_three']; ?></span></a> -->
            <a href="?page=th_glowline&tab=demo-import" class="nav-tab<?php echo $tab == 'demo-import' ? ' nav-tab-active' : null; ?>"><?php echo $theme_config['tab_four']; ?></span></a>
            <a href="?page=th_glowline&tab=free-pro" class="nav-tab<?php echo $tab == 'free-pro' ? ' nav-tab-active' : null; ?>"><?php echo $theme_config['tab_five']; ?></span></a>
        </h2>
        <?php if ( is_null( $tab ) ) { 
          ?>
            <div class="theme_info info-tab-content">
                <div class="theme_info_column clearfix">
                    <div class="theme_info_left">
                    <div class="theme_link one"><div class="inner-wrp">
                            <h3><?php echo $theme_config['plugin_title']; ?></h3>
                            <p class="about"><ul>
                                <li><p>
                                <?php echo $theme_config['plugin_text'];?></p></li></ul></p>
                            <p>
                                <a target="_blank" href="<?php echo esc_url($theme_config['plugin_link'] ); ?>" class="button button-secondary"><?php echo $theme_config['plugin_button']; ?></a>
                            </p>
                          </div>
                        </div>
                          
                 </div>

						      <div class="theme_link two"><div class="inner-wrp">
                            <h3><?php echo $theme_config['customizer_title']; ?></h3>
                            <p class="about"><?php  echo $theme_config['customizer_text']; ?>
                            </p>
                            <a href="<?php echo admin_url( 'themes.php?page=th_glowline&tab=demo-import' )?>" class="button button-secondary"><?php echo $theme_config['customizer_button']; ?></a>
                        </div>
                      </div>
                        <div class="theme_link three"><div class="inner-wrp">
                            <h3><?php esc_html_e('Step 3 - Go to Customizer','glowline');?></h3>
                            <p><?php esc_html_e('Using the WordPress Customizer you can easily customize every aspect of the theme.','glowline'); ?>
                           </p>
                             <p>
                              <a target="_blank" class="button button-secondary" href="<?php echo admin_url('customize.php'); ?>"><?php echo esc_html_e('Go to the Customizer','glowline'); ?></a>
                            </p>
                        </div></div>
                        <div class="theme_link four"><div class="inner-wrp">
                            <h3><?php echo $theme_config['support_title']; ?></h3>
            <p><a target="_blank" class="button button-secondary" href="<?php echo $theme_config['support_link']; ?>"><?php echo $theme_config['support_forum']; ?></a></p></div>
                        </div>
                        <div class="theme_link five"><div class="inner-wrp">
                            <h3><?php esc_html_e('Step 5 - Need more features?','glowline');?></h3>
                            <p><?php esc_html_e('Upgrade to Pro version for more exciting features.','glowline'); ?>
                           </p>
                             <p>
                              <a target="_blank" class="button button-secondary" href="//themehunk.com/product/glowline-gracefull-wordpress-theme/"><?php echo esc_html_e('View Pro Version','glowline'); ?></a>
                            </p>
                        </div></div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if ( $tab == 'actions_required' ) { ?>
            <div class="action-required-tab info-tab-content">
                <div id="plugin-filter" class="recommend-plugins action-required">

                    <?php if ( isset($actions['recommend_plugins']) && $actions['recommend_plugins'] == 'active' ) {  ?>
                        <h3><?php esc_html_e( 'Recommended Plugins', 'glowline' ); ?></h3>
                            <?php magazina_plugin_api(); ?>
                    <?php } else {  
                            echo '<p style="color:#e45f12;font-style:italic;font-size:14px;">'.esc_html_e( 'Plugin installed and active!', 'glowline' ).'</p>';
                    } ?> 
                                        </div>                          
            </div>
        <?php } ?>

        <?php if ( $tab == 'free-pro' ) { ?>

            <?php magazina_theme(); ?>

        <?php  } elseif ( $tab == 'demo-import' ) {

                     magazina_demo_import();

        } ?>


    </div> <!-- END .theme_info -->
    <?php

}

 function magazina_plugin_api() {
 if ( ! function_exists( 'plugins_api' ) ) {
      require ABSPATH . 'wp-admin/includes/plugin-install.php';
}

        $recommend_plugins = get_theme_support( 'recommend-plugins' );
    if ( is_array( $recommend_plugins ) && isset( $recommend_plugins[0] ) ){

        foreach($recommend_plugins[0] as $slug=>$plugin){
              $plugin_info = plugins_api( 'plugin_information', array(
                  'slug' => $slug,
                  'fields' => array(
                      'sections'          => true,
                      'homepage'          => true,
                      'added'             => false,
                      'last_updated'      => false,
                      'compatibility'     => false,
                      'tested'            => false,
                      'requires'          => false,
                      'downloadlink'      => false,
                      'icons'             => true,
                  )
              ) );
              //foreach($plugin_info as $plugin_info){
                  $plugin_name = $plugin_info->name;
                  $plugin_slug = $plugin_info->slug;
                  $version = $plugin_info->version;
                  $author = $plugin_info->author;
                  $download_link = $plugin_info->download_link;
                  $icons = (isset($plugin_info->icons['1x']))?$plugin_info->icons['1x']:$plugin_info->icons['default'];
              $status = is_dir( WP_PLUGIN_DIR . '/' . $plugin_slug );
              $active_file_name = $plugin_slug . '/' . $plugin_slug . '.php';
              $button_class = 'install-now button';

            if ( ! is_plugin_active( $active_file_name ) ) {
                $button_txt = esc_html__( 'Install Now', 'glowline' );
                  if ( ! $status ) {
                    $install_url = wp_nonce_url(
                    add_query_arg(
                    array(
                    'action' => 'install-plugin',
                    'plugin' => $plugin_slug
                    ),
                    network_admin_url( 'update.php' )
                    ),
                    'install-plugin_'.$plugin_slug
                    );
                  } else {
                    $install_url = add_query_arg(array(
                    'action' => 'activate',
                    'plugin' => rawurlencode( $active_file_name ),
                    'plugin_status' => 'all',
                    'paged' => '1',
                    '_wpnonce' => wp_create_nonce('activate-plugin_' . $active_file_name ),
                    ), network_admin_url('plugins.php'));
                    $button_class = 'activate-now button-primary';
                    $button_txt = esc_html__( 'Active Now', 'glowline' );
                  }


                $detail_link = add_query_arg(
                array(
                'tab' => 'plugin-information',
                'plugin' => $plugin_slug,
                'TB_iframe' => 'true',
                'width' => '772',
                'height' => '349',

                ),
                network_admin_url( 'plugin-install.php' )
                );
                $detail = '';
                echo '<div class="rcp">';
                echo '<h4 class="rcp-name">';
                echo esc_html( $plugin_name );
                echo '</h4>';
                echo '<img src="'.$icons.'" />';
                if($plugin_slug=='one-click-demo-import'){
                		$detail = esc_html__('Please install the One Click Demo Import plugin to import the demo content. After activation go to Appearance >> Import Demo Data and import it.','glowline');
                } elseif($plugin_slug=='lead-form-builder'){
                    $detail= esc_html__('Lead Form Builder Plugin is a contact form builder as well as lead generator. Plugin comes with nearly all field options required to create Contact form, Registration form, News letter and contain Ajax based drag & drop field ordering.','glowline');

                } elseif($plugin_slug=='mailchimp-for-wp'){
                		$detail= esc_html__('This plugin helps you grow your MailChimp lists and write better newsletters through various methods. You can create good looking opt-in forms or integrate with any existing form on your site, like your comment, contact or checkout form.','glowline');

                } elseif($plugin_slug=='business-popup'){
                    $detail= esc_html__('Business Popup plugin comes with easy to use layouts, You can simply select and add your original content using live editor. Plugin contain layouts for sale, Discount offers, Deals, shop ad etc. You can popup at your desired page, post, Between post and in the widget areas as a banner ad.','glowline');

}

                echo '<p class="rcp-detail">'.$detail.' </p>';

                echo '<p class="action-btn plugin-card-'.esc_attr( $plugin_slug ).'"><span>Version:'.$version.'</span>
                      '.$author.'<a href="'.esc_url( $install_url ).'" data-slug="'.esc_attr( $plugin_slug ).'" class="'.esc_attr( $button_class ).'">'.$button_txt.'</a>
                </p>';
                echo '<a class="plugin-detail thickbox open-plugin-details-modal" href="'.esc_url( $detail_link ).'">'.esc_html__( 'Details', 'glowline' ).'</a>';
                echo '</div>';

            }
        }

    }

}


function glowline_get_actions_required( ) {

    $actions = array();

    $recommend_plugins = get_theme_support( 'recommend-plugins' );
    if ( is_array( $recommend_plugins ) && isset( $recommend_plugins[0] ) ){
        $recommend_plugins = $recommend_plugins[0];
    } else {
        $recommend_plugins[] = array();
    }

    if ( ! empty( $recommend_plugins ) ) {

        foreach ( $recommend_plugins as $plugin_slug => $plugin_info ) {
            $plugin_info = wp_parse_args( $plugin_info, array(
                'name' => '',
                'active_filename' => '',
            ) );
            if ( $plugin_info['active_filename'] ) {
                $active_file_name = $plugin_info['active_filename'] ;
            } 
            else {
                $active_file_name = $plugin_slug . '/' . $plugin_slug . '.php';
            }
            if ( ! is_plugin_active( $active_file_name ) ) {
                $actions['recommend_plugins'] = 'active';
            }
        }

    }

    $actions = apply_filters( 'glowline_get_actions_required', $actions );

    $return = array(
        'actions' => $actions,
        'number_actions' => count( $actions ),
    );

    return $return;
}