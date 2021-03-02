<?php
/**
 * all file includeed
 */
	include( get_template_directory() . '/inc/constant.php' );
	require_once( get_template_directory() . '/class-tgm-plugin-activation.php' );
	include( get_template_directory() . '/inc/plugin-install.php' );
	include( get_template_directory() . '/inc/static-function.php' );	
	//sidebar and footer widget
	include( get_template_directory() . '/inc/widget.php' );
	include( get_template_directory() . '/inc/about-me-widget.php' );
	include( get_template_directory() . '/inc/custom-customizer.php' );
	include( get_template_directory() . '/inc/customizer.php' );
	include( get_template_directory() . '/inc/dynamic-sidebar.php' );
	include( get_template_directory() . '/inc/custom-style.php' );
	include( get_template_directory() . '/inc/pro-button/class-customize.php' );
	require trailingslashit( get_template_directory() ) . '/inc/theme-setup/glowline-theme.php';

	