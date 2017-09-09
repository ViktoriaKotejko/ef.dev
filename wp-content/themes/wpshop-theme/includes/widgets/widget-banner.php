<?php class BannerWidget extends WP_Widget
{
    function BannerWidget(){
		$widget_ops = array('description' => __( 'отображает баннер в сайдбаре', 'wp-shop' ));
		$control_ops = array('width' => 400, 'height' => 500);
		parent::WP_Widget(false,$name=__( 'Баннер в сайдбаре', 'wp-shop' ),$widget_ops,$control_ops);
	}

  /* Displays the Widget in the front-end */
    function widget($args, $instance){
		extract($args);
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : esc_html( $instance['title'] ) );
		$use_relpath = isset($instance['use_relpath']) ? $instance['use_relpath'] : false;
		$new_window = isset($instance['new_window']) ? $instance['new_window'] : false;
		$bannerPath[1] = empty($instance['bannerOnePath']) ? '' : esc_url($instance['bannerOnePath']);
		$bannerUrl[1] = empty($instance['bannerOneUrl']) ? '' : esc_url($instance['bannerOneUrl']);
		$bannerTitle[1] = empty($instance['bannerOneTitle']) ? '' : esc_attr($instance['bannerOneTitle']);
		$bannerAlt[1] = empty($instance['bannerOneAlt']) ? '' : esc_attr($instance['bannerOneAlt']);
	?>
<div class="clear"></div>	
<div id="banner_wrapp">
	<?php if ( $title )
	echo $before_title . $title . $after_title; ?>
	<div class="banner_img_wrapp">
	<?php $i = 1; 
	if ($bannerPath[$i] <> '') { ?>
	<?php if ($bannerTitle[$i] == '') $bannerTitle[$i] = "";
		  if ($bannerAlt[$i] == '') $bannerAlt[$i] = "t"; ?>
		<a href="<?php echo $bannerUrl[$i] ?>" <?php if ($new_window == 1) echo('target="_blank"') ?>><img src="<?php if ($use_relpath == 1) echo home_url(); else echo $bannerPath[$i]; ?><?php if ($use_relpath == 1 ) echo ("/" . $bannerPath[$i]); ?>" alt="<?php echo $bannerAlt[$i]; ?>" title="<?php echo $bannerTitle[$i]; ?>" width="300" /></a>
	<?php } ?>
</div> <!-- #banner_img_wrapp-->
</div><!-- #banner_wrapp-->	
<?php
		
	}

  /*Saves the settings. */
    function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = stripslashes($new_instance['title']);
		$instance['use_relpath'] = 0;
		$instance['new_window'] = 0;
		if ( isset($new_instance['use_relpath']) ) $instance['use_relpath'] = 1;
		if ( isset($new_instance['new_window']) ) $instance['new_window'] = 1;
		$instance['bannerOnePath'] = esc_url($new_instance['bannerOnePath']);
		$instance['bannerOneUrl'] = esc_url($new_instance['bannerOneUrl']);
		$instance['bannerOneTitle'] = esc_attr($new_instance['bannerOneTitle']);
		$instance['bannerOneAlt'] = esc_attr($new_instance['bannerOneAlt']);
						
		return $instance;
	}

  /*Creates the form for the widget in the back-end. */
    function form($instance){
		//Defaults
		$instance = wp_parse_args( (array) $instance, array('title'=>'', 'use_relpath' => false, 'new_window' => true, 'bannerOnePath'=>'', 'bannerOneUrl'=>'', 'bannerOneTitle'=>'', 'bannerOneAlt'=>'') );

		$title = esc_html($instance['title']);
		$bannerPath[1] = esc_url($instance['bannerOnePath']);
		$bannerUrl[1] = esc_url($instance['bannerOneUrl']);
		$bannerTitle[1] = esc_attr($instance['bannerOneTitle']);
		$bannerAlt[1] = esc_attr($instance['bannerOneAlt']);
		
		
		# Title
		echo '<p><label for="' . $this->get_field_id('title') . '">' . __( 'Заголовок:', 'wp-shop' ) . '</label><input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></p>'; ?>
		
		<input class="checkbox" type="checkbox" <?php checked($instance['use_relpath'], true) ?> id="<?php echo $this->get_field_id('use_relpath'); ?>" name="<?php echo $this->get_field_name('use_relpath'); ?>" />
		<label for="<?php echo $this->get_field_id('use_relpath'); ?>"><?php _e( 'Использовать относительные пути', 'wp-shop' ); ?></label><br />
		<input class="checkbox" type="checkbox" <?php checked($instance['new_window'], true) ?> id="<?php echo $this->get_field_id('new_window'); ?>" name="<?php echo $this->get_field_name('new_window'); ?>" />
		<label for="<?php echo $this->get_field_id('new_window'); ?>"><?php _e( 'Открывать в новом окне', 'wp-shop' ); ?></label><br /><br />

		<?php	# Banner #1 Image
		echo '<p><label for="' . $this->get_field_id('bannerOnePath') . '">' .  __( 'Баннер #1 Путь к изображению:', 'wp-shop' ) . '</label><input class="widefat" id="' . $this->get_field_id('bannerOnePath') . '" name="' . $this->get_field_name('bannerOnePath') . '" type="text" value="' . $bannerPath[1] . '" /></p>';
		# Banner #1 Url
		echo '<p><label for="' . $this->get_field_id('bannerOneUrl') . '">' . __( 'Баннер #1 Url:', 'wp-shop' ) . '</label><input class="widefat" id="' . $this->get_field_id('bannerOneUrl') . '" name="' . $this->get_field_name('bannerOneUrl') . '" type="text" value="' . $bannerUrl[1] . '" /></p>';
		# Banner #1 Title
		echo '<p><label for="' . $this->get_field_id('bannerOneTitle') . '">' . __( 'Баннер #1 Заголовок:', 'wp-shop' ) . '</label><input class="widefat" id="' . $this->get_field_id('bannerOneTitle') . '" name="' . $this->get_field_name('bannerOneTitle') . '" type="text" value="' . $bannerTitle[1] . '" /></p>';
		# Banner #1 Alt
		echo '<p><label for="' . $this->get_field_id('bannerOneAlt') . '">' . __( 'Баннер #1 Alt:', 'wp-shop' ) . '</label><input class="widefat" id="' . $this->get_field_id('bannerOneAlt') . '" name="' . $this->get_field_name('bannerOneAlt') . '" type="text" value="' . $bannerAlt[1] . '" /></p>';
		
	}

}// end AdvWidget class

function BannerWidgetInit() {
	register_widget('BannerWidget');
}

add_action('widgets_init', 'BannerWidgetInit');

?>