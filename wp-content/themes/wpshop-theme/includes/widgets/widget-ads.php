<?php class AdvWidget extends WP_Widget
{
    function AdvWidget(){
		$widget_ops = array('description' => __( 'отображает 3 баннера справа от слайдера', 'wp-shop' ));
		$control_ops = array('width' => 400, 'height' => 500);
		parent::WP_Widget(false,$name=__( 'Баннеры справа от слайдера', 'wp-shop' ),$widget_ops,$control_ops);
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
		
		$bannerPath[2] = empty($instance['bannerTwoPath']) ? '' : esc_url($instance['bannerTwoPath']);
		$bannerUrl[2] = empty($instance['bannerTwoUrl']) ? '' : esc_url($instance['bannerTwoUrl']);
		$bannerTitle[2] = empty($instance['bannerTwoTitle']) ? '' : esc_attr($instance['bannerTwoTitle']);
		$bannerAlt[2] = empty($instance['bannerTwoAlt']) ? '' : esc_attr($instance['bannerTwoAlt']);
		
		$bannerPath[3] = empty($instance['bannerThreePath']) ? '' : esc_url($instance['bannerThreePath']);
		$bannerUrl[3] = empty($instance['bannerThreeUrl']) ? '' : esc_url($instance['bannerThreeUrl']);
		$bannerTitle[3] = empty($instance['bannerThreeTitle']) ? '' : esc_attr($instance['bannerThreeTitle']);
		$bannerAlt[3] = empty($instance['bannerThreeAlt']) ? '' : esc_attr($instance['bannerThreeAlt']);
		
		
		$img_weight = isset( $instance['img_weight'] ) ? (int) $instance['img_weight'] : 240;
		$img_height = isset($instance['img_height'] ) ? (int) $instance['img_height'] : 123;
		
	?>
<div id="widget_bar_cont" class="floatRight">
	<?php if ( $title )
	echo $before_title . $title . $after_title; ?>
	<div class="adwrap"  style="width:<?php echo $img_weight; ?>px;">
	<?php $i = 1; 
	while ($i <= 6):
	if ($bannerPath[$i] <> '') { ?>
	<?php if ($bannerTitle[$i] == '') $bannerTitle[$i] = "";
		  if ($bannerAlt[$i] == '') $bannerAlt[$i] = "t"; ?>
		<?php if (!empty($bannerUrl[$i])) { ?><a href="<?php echo $bannerUrl[$i] ?>" <?php if ($new_window == 1) echo('target="_blank"') ?>><?php }?> <img src="<?php if ($use_relpath == 1) echo home_url(); else echo $bannerPath[$i]; ?><?php if ($use_relpath == 1 ) echo ("/" . $bannerPath[$i]); ?>" alt="<?php echo $bannerAlt[$i]; ?>" title="<?php echo $bannerTitle[$i]; ?>" width="<?php echo $img_weight; ?>" height="<?php echo $img_height; ?>" /><?php if (!empty($bannerUrl[$i])) { ?></a><?php } ?>
	<?php }; $i++;
	endwhile; ?>
	</div> <!-- end adwrap -->
</div><!-- #widget_bar_cont -->	
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
		
		$instance['bannerTwoPath'] = esc_url($new_instance['bannerTwoPath']);
		$instance['bannerTwoUrl'] = esc_url($new_instance['bannerTwoUrl']);
		$instance['bannerTwoTitle'] = esc_attr($new_instance['bannerTwoTitle']);
		$instance['bannerTwoAlt'] = esc_attr($new_instance['bannerTwoAlt']);
		
		$instance['bannerThreePath'] = esc_url($new_instance['bannerThreePath']);
		$instance['bannerThreeUrl'] = esc_url($new_instance['bannerThreeUrl']);
		$instance['bannerThreeTitle'] = esc_attr($new_instance['bannerThreeTitle']);
		$instance['bannerThreeAlt'] = esc_attr($new_instance['bannerThreeAlt']);
		
		$instance['img_weight'] = 240;  
		$instance['img_height'] = 123; 
		
		if ( isset($new_instance['img_weight']) ) $instance['img_weight'] = $new_instance['img_weight'];
		if ( isset($new_instance['img_height']) ) $instance['img_height'] = $new_instance['img_height'];
				
		return $instance;
	}

  /*Creates the form for the widget in the back-end. */
    function form($instance){
		//Defaults
		$instance = wp_parse_args( (array) $instance, array('title'=>'', 'use_relpath' => false, 'new_window' => false,'img_weight' => 240,'img_height' => 123, 'bannerOnePath'=>'', 'bannerOneUrl'=>'', 'bannerOneTitle'=>'', 'bannerOneAlt'=>'', 'bannerTwoPath'=>'', 'bannerTwoUrl'=>'', 'bannerTwoTitle'=>'', 'bannerTwoAlt'=>'','bannerThreePath'=>'', 'bannerThreeUrl'=>'','bannerThreeTitle'=>'', 'bannerThreeAlt'=>'') );

		$title = esc_html($instance['title']);
		$bannerPath[1] = esc_url($instance['bannerOnePath']);
		$bannerUrl[1] = esc_url($instance['bannerOneUrl']);
		$bannerTitle[1] = esc_attr($instance['bannerOneTitle']);
		$bannerAlt[1] = esc_attr($instance['bannerOneAlt']);
		
		$bannerPath[2] = esc_url($instance['bannerTwoPath']);
		$bannerUrl[2] = esc_url($instance['bannerTwoUrl']);
		$bannerTitle[2] = esc_attr($instance['bannerTwoTitle']);
		$bannerAlt[2] = esc_attr($instance['bannerTwoAlt']);
		
		$bannerPath[3] = esc_url($instance['bannerThreePath']);
		$bannerUrl[3] = esc_url($instance['bannerThreeUrl']);
		$bannerTitle[3] = esc_attr($instance['bannerThreeTitle']);
		$bannerAlt[3] = esc_attr($instance['bannerThreeAlt']);
		
			
		# Title
		echo '<p><label for="' . $this->get_field_id('title') . '">' . __( 'Заголовок:', 'wp-shop' ) . '</label><input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></p>'; ?>
		
		<input class="checkbox" type="checkbox" <?php checked($instance['use_relpath'], true) ?> id="<?php echo $this->get_field_id('use_relpath'); ?>" name="<?php echo $this->get_field_name('use_relpath'); ?>" />
		<label for="<?php echo $this->get_field_id('use_relpath'); ?>"><?php _e( 'Использовать относительные пути', 'wp-shop' ); ?></label><br />
		<input class="checkbox" type="checkbox" <?php checked($instance['new_window'], true) ?> id="<?php echo $this->get_field_id('new_window'); ?>" name="<?php echo $this->get_field_name('new_window'); ?>" />
		<label for="<?php echo $this->get_field_id('new_window'); ?>"><?php _e( 'Открывать в новом окне', 'wp-shop' ); ?></label><br />

		<label for="<?php echo $this->get_field_id('img_weight'); ?>"> <?php _e( 'Ширина картинки баннера:', 'wp-shop' ); ?> </label>
		<input type="text"  value="<?php echo $instance['img_weight']; ?>" id="<?php echo $this->get_field_id('img_weight'); ?>" name="<?php echo $this->get_field_name('img_weight'); ?>" size="3" /><br />
		
		<label for="<?php echo $this->get_field_id('img_height'); ?>"> <?php _e( 'Высота картинки баннера:', 'wp-shop' ); ?> </label>
		<input type="text"  value="<?php echo $instance['img_height']; ?>" id="<?php echo $this->get_field_id('img_height'); ?>" name="<?php echo $this->get_field_name('img_height'); ?>" size="3" /><br /><br />
		
		
		<?php	# Banner #1 Image
		echo '<p><label for="' . $this->get_field_id('bannerOnePath') . '">' . __( 'Баннер #1 Путь к изображению:', 'wp-shop' ) . '</label><input class="widefat" id="' . $this->get_field_id('bannerOnePath') . '" name="' . $this->get_field_name('bannerOnePath') . '" type="text" value="' . $bannerPath[1] . '" /></p>';
		# Banner #1 Url
		echo '<p><label for="' . $this->get_field_id('bannerOneUrl') . '">' . __( 'Баннер #1 Url:', 'wp-shop' ) . '</label><input class="widefat" id="' . $this->get_field_id('bannerOneUrl') . '" name="' . $this->get_field_name('bannerOneUrl') . '" type="text" value="' . $bannerUrl[1] . '" /></p>';
		# Banner #1 Title
		echo '<p><label for="' . $this->get_field_id('bannerOneTitle') . '">' . __( 'Баннер #1 Заголовок:', 'wp-shop' ) . '</label><input class="widefat" id="' . $this->get_field_id('bannerOneTitle') . '" name="' . $this->get_field_name('bannerOneTitle') . '" type="text" value="' . $bannerTitle[1] . '" /></p>';
		# Banner #1 Alt
		echo '<p><label for="' . $this->get_field_id('bannerOneAlt') . '">' . __( 'Баннер #1 Alt:', 'wp-shop' ) . '</label><input class="widefat" id="' . $this->get_field_id('bannerOneAlt') . '" name="' . $this->get_field_name('bannerOneAlt') . '" type="text" value="' . $bannerAlt[1] . '" /></p>';
		# Banner #2 Image
		echo '<p><label for="' . $this->get_field_id('bannerTwoPath') . '">' . __( 'Баннер #2 Путь к изображению:', 'wp-shop' ) . '</label><input class="widefat" id="' . $this->get_field_id('bannerTwoPath') . '" name="' . $this->get_field_name('bannerTwoPath') . '" type="text" value="' . $bannerPath[2] . '" /></p>';
		# Banner #2 Url
		echo '<p><label for="' . $this->get_field_id('bannerTwoUrl') . '">' . __( 'Баннер #2 Url:', 'wp-shop' ) . '</label><input class="widefat" id="' . $this->get_field_id('bannerTwoUrl') . '" name="' . $this->get_field_name('bannerTwoUrl') . '" type="text" value="' . $bannerUrl[2] . '" /></p>';
		# Banner #2 Title
		echo '<p><label for="' . $this->get_field_id('bannerTwoTitle') . '">' . __( 'Баннер #2 Заголовок:', 'wp-shop' ) . '</label><input class="widefat" id="' . $this->get_field_id('bannerTwoTitle') . '" name="' . $this->get_field_name('bannerTwoTitle') . '" type="text" value="' . $bannerTitle[2] . '" /></p>';
		# Banner #2 Alt
		echo '<p><label for="' . $this->get_field_id('bannerTwoAlt') . '">' . __( 'Баннер #2 Alt:', 'wp-shop' ) . '</label><input class="widefat" id="' . $this->get_field_id('bannerTwoAlt') . '" name="' . $this->get_field_name('bannerTwoAlt') . '" type="text" value="' . $bannerAlt[2] . '" /></p>';
		# Banner #3 Image
		echo '<p><label for="' . $this->get_field_id('bannerThreePath') . '">' . __( 'Баннер #3 Путь к изображению:', 'wp-shop' ) . '</label><input class="widefat" id="' . $this->get_field_id('bannerThreePath') . '" name="' . $this->get_field_name('bannerThreePath') . '" type="text" value="' . $bannerPath[3] . '" /></p>';
		# Banner #3 Url
		echo '<p><label for="' . $this->get_field_id('bannerThreeUrl') . '">' . __( 'Баннер #3 Url:', 'wp-shop' ) . '</label><input class="widefat" id="' . $this->get_field_id('bannerThreeUrl') . '" name="' . $this->get_field_name('bannerThreeUrl') . '" type="text" value="' . $bannerUrl[3] . '" /></p>';
		# Banner #3 Title
		echo '<p><label for="' . $this->get_field_id('bannerThreeTitle') . '">' . __( 'Баннер #3 Заголовок:', 'wp-shop' ) . '</label><input class="widefat" id="' . $this->get_field_id('bannerThreeTitle') . '" name="' . $this->get_field_name('bannerThreeTitle') . '" type="text" value="' . $bannerTitle[3] . '" /></p>';
		# Banner #3 Alt
		echo '<p><label for="' . $this->get_field_id('bannerThreeAlt') . '">' . __( 'Баннер #3 Alt:', 'wp-shop' ) . '</label><input class="widefat" id="' . $this->get_field_id('bannerThreeAlt') . '" name="' . $this->get_field_name('bannerThreeAlt') . '" type="text" value="' . $bannerAlt[3] . '" /></p>';
				
		echo __( '<p><small>Если вы не хотите отображать некоторые баннеры оставьте соответствующие поля пустыми</small></p>', 'wp-shop' );
	}

}// end AdvWidget class

function AdvWidgetInit() {
	register_widget('AdvWidget');
}

add_action('widgets_init', 'AdvWidgetInit');

?>