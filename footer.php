            </div><!-- **Container - End** -->
         </div><!-- **Main - End** -->
    </div><!-- **Inner Wrapper - End** -->
</div><!-- **Wrapper - End** -->
     
<?php $dttheme_options = get_option(IAMD_THEME_SETTINGS);
$dttheme_general = $dttheme_options['general'];?>
<!-- **Footer** -->
<footer id="footer">
<?php if(!empty($dttheme_general['show-footer'])): ?>
		<div class="container"><?php dttheme_show_footer_widgetarea($dttheme_general['footer-columns']);?></div>
<?php endif; ?>

        <div class="container">
            <div class="copyright">
				<?php if( !empty($dttheme_general['show-copyrighttext']) ): 
							echo "<div class='copyright-content'>".stripslashes(do_shortcode($dttheme_general['copyright-text']))."</div>";
					  endif;
					  
					  if( !empty( $dttheme_general['show-footer-logo']) ):
						$url = isset( $dttheme_general['footer-logo-url'] ) ?  $dttheme_general['footer-logo-url'] : "";
						$url = !empty( $url ) ? $url : IAMD_BASE_URL."images/footer-logo.png";?>
						<div class="footer-logo">
							<a href="<?php echo home_url();?>" title="<?php echo dttheme_blog_title();?>">
								<img src="<?php echo $url;?>" alt="<?php echo dttheme_blog_title(); ?>" title="<?php echo dttheme_blog_title(); ?>" />
							</a>    
						</div><?php
					  endif;?>
			</div>
		</div>
</footer><!-- **Footer - End** -->
<?php	if (is_singular() AND comments_open())
			wp_enqueue_script( 'comment-reply');

		if(dttheme_option('integration', 'enable-body-code') != '') 
			echo stripslashes(dttheme_option('integration', 'body-code'));
		wp_footer(); ?>
</body>
</html>