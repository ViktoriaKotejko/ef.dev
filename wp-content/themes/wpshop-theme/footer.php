</div><!--#page-wrap-->	
<div id="footer">
	<div id="footer_inner">
		<?php wp_reset_query(); ?>
		
		<div id="footer_widget">
			<?php if ( ! dynamic_sidebar( 'footer-widget-area' ) ) : ?>
			<?php endif; // end primary widget area ?>
		</div>
		
		<div class="back_to_top">
				<a href="#"></a>
		</div>
	
	</div><!--#footer_inner-->
	
	<div id="powered_wrapp">
		<div id="powered">
				<?php $myfooter_text = of_get_option('footer_text'); ?>
				<?php if($myfooter_text){?>
					<?php echo of_get_option('footer_text'); ?>
						<?php } else { ?>
							<p class="copyright">COPYRIGHT ©<?php the_time('Y'); ?>
							<a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('description'); ?>"><?php bloginfo('name'); ?></a>
							<?php bloginfo('description'); ?></p>		
						<?php } ?>	
		</div>	
	</div>
	
</div>	


	
<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
<?php if(of_get_option('ga_code')) { ?>
	<?php echo of_get_option('ga_code'); ?>
  
<?php } ?>
</body>
</html>