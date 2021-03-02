<?php
/**
* The template for displaying the footer
* @since GlowLine 1.0
*/
?>
<div class="footer-wrapper">
	<div class="container">
		<?php get_sidebar('footer'); ?>
		<div class="clearfix"></div>
	</div>
	<div class="footer-copyright">
		<div class="container">
			<ul>
				<li class="copyright">
					<?php 
					if (function_exists('glowlinepro_body_classes')) {
						$copyright_textbox = get_theme_mod( 'copyright_textbox');
						echo esc_html($copyright_textbox);
						} else { 
                 $allowed_html = array(
                                  'a' => array(
                                  'href' => array(),
                                  'title' => array(),
                                  'target' => array()
                              ),
                              'br' => array(),
                              'em' => array(),
                              'strong' => array(),
                          );
                $url = "https://themehunk.com";
              echo  sprintf( 
              	wp_kses( __( 'GlowLine developed by <a href="%s" target="_blank">ThemeHunk</a>', 'glowline' ), $allowed_html), esc_url( $url ) );
               } ?>
				</li>
				<li class="social-icon">
					<?php glowline_social_links(); ?>
				</li>
			</ul>
		</div>
	</div>
</div>
<?php wp_footer();
?>
</body>
</html>