<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

if(!function_exists('optionsframework_option_name')) {
	function optionsframework_option_name() {
		// This gets the theme name from the stylesheet (lowercase and without spaces)
		$themename = 'theme1986';
		
		$optionsframework_settings = get_option('optionsframework');
		$optionsframework_settings['id'] = $themename;
		update_option('optionsframework', $optionsframework_settings);
		
	}
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

 
if(!function_exists('optionsframework_options')) {

	function optionsframework_options() {
	
		// Logo type
		$logo_type = array(
			"image_logo" => __('Изображение','wp-shop'),
			"text_logo" => __('Текст','wp-shop')
		);
		
		// Search box in the header
		$g_search_box = array(
			"no" => __('Нет','wp-shop'),
			"yes" => __('Да','wp-shop')
		);
		
		// Remove lightboxes and/or rollovers from galleries
		$g_gallery_lightbox = array(
			"yes" => __('Да','wp-shop'),
			"no" => __('Нет','wp-shop')
		);
		
		// Background Defaults
		$background_defaults = array(
			'color' => '', 
			'image' => '', 
			'repeat' => 'repeat',
			'position' => 'top center',
			'attachment'=>'scroll'
		);
		
		// Superfish fade-in animation
		$sf_f_animation_array = array(
			"show" => "Enable fade-in animation",
			"false" => "Disable fade-in animation"
		);
		
		// Superfish slide-down animation
		$sf_sl_animation_array = array(
			"show" => "Enable slide-down animation",
			"false" => "Disable slide-down animation"
		);
		
		// Superfish animation speed
		$sf_speed_array = array(
			"slow" => "Slow","normal" => "Normal",
			"fast" => "Fast"
		);
		
		// Superfish arrows markup
		$sf_arrows_array = array(
			"true" => "Yes",
			"false" => "No"
		);
		
		// Fonts
		$typography_mixed_fonts = array_merge( options_typography_get_os_fonts() , options_typography_get_google_fonts() );
		asort($typography_mixed_fonts);
		
		
		// Slider effects
		$sl_effect_array = array("fade" => "fade", "blindX" => "blindX", "blindY" => "blindY", "cover" => "cover", "fadeZoom" => "fadeZoom", "curtainX" => "curtainX", "curtainY" => "curtainY", "scrollUp" => "scrollUp", "scrollDown" => "scrollDown", "scrollLeft" => "scrollLeft", "scrollRight" => "scrollRight", "shuffle" => "shuffle", "slideX" => "slideX","zoom" => "zoom");
		
		// Slider slices
		$sl_slices_array = array("1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9", "10" => "10", "11" => "11", "12" => "12", "13" => "13", "14" => "14", "15" => "15", "16" => "16", "17" => "17", "18" => "18", "19" => "19", "20" => "20");
		
		// Slider box columns
		$sl_box_columns_array = array("1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9", "10" => "10", "11" => "11", "12" => "12", "13" => "13", "14" => "14", "15" => "15", "16" => "16", "17" => "17", "18" => "18", "19" => "19", "20" => "20");
		
		// Slider box rows
		$sl_box_rows_array = array("1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9", "10" => "10", "11" => "11", "12" => "12", "13" => "13", "14" => "14", "15" => "15", "16" => "16", "17" => "17", "18" => "18", "19" => "19", "20" => "20");
		
		// Slider direct navigation
		$sl_dir_nav_array = array("true" => __('Да','wp-shop'),"false" =>__('Нет','wp-shop'));
		
		// Slider direct navigation on hover
		$sl_dir_nav_hide_array = array("true" => "Yes","false" => "No");
		
		// Slider control navigation
		$sl_control_nav_array = array("true" => __('Да','wp-shop'),"false" => __('Нет','wp-shop'));
		
		// Footer menu
		$footer_menu_array = array("true" => "Yes","false" => "No");
		
		// Featured image size on the blog.
		$post_image_size_array = array("normal" => "Normal size","large" => "Large size");
		
		// Featured image size on the single page.
		$single_image_size_array = array("normal" => "Normal size","large" => "Large size");
		
		// Meta for blog
		$post_meta_array = array("true" => "Yes","false" => "No");
		
		// Meta for blog
		$post_excerpt_array = array(
			"true" => "Yes",
			"false" => "No"
		);
		
		
		
		
		
		// Pull all the categories into an array
		$options_categories = array();  
		$options_categories_obj = get_categories();
		foreach ($options_categories_obj as $category) {
				$options_categories[$category->cat_ID] = $category->cat_name;
		}
		
		// Pull all the pages into an array
		$options_pages = array();  
		$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
		$options_pages[''] = 'Select a page:';
		foreach ($options_pages_obj as $page) {
				$options_pages[$page->ID] = $page->post_title;
		}
			
		// If using image radio buttons, define a directory path
		$imagepath =  get_bloginfo('template_directory') . '/includes/images/';
			
		$options = array();
		
		$options[] = array( "name" => __('Основные','wp-shop'),
							"type" => "heading");
		
		$options['body_background'] = array( 
							"name" =>  __('Настройка фона сайта','wp-shop'),
							"desc" => __('Измените основной фон сайта','wp-shop'),
							"id" => "body_background",
							"std" => $background_defaults, 
							"type" => "background");
		
		$options['header_color'] = array( "name" => __('Настройка Хедера сайта','wp-shop'),
							"desc" => __('Измените фон Хедера','wp-shop'),
							"id" => "header_color",
							"std" => "",
							"type" => "color");
		
		$options['links_color'] = array( "name" => __('Кнопки и ссылки','wp-shop'),
							"desc" => "Измените цвет кнопок и ссылок",
							"id" => "links_color",
							"std" => "",
							"type" => "color");
							
							
		$options['google_mixed_3'] = array( 'name' => __('Основной тест','wp-shop'),
							'desc' => __('шрифт основного содержимого. <em>Примечание: шрифты отмеченые <strong>*</strong> символом загружаются библиотекой <a href="http://www.google.com/webfonts">Google Web Fonts</a>.</em>','wp-shop'),
							'id' => 'google_mixed_3',
							'std' => array( 'size' => '12px', 'lineheight' => '18px', 'face' => 'Arial', 'color' => '#333'),
							'type' => 'typography',
							'options' => array(
									'faces' => $typography_mixed_fonts )
							);
							
		$options['h1_heading'] = array( 'name' => __('Заголовок H1','wp-shop'),
							'desc' => __('шрифт заголовка H1. <em>Примечание: шрифты отмеченые <strong>*</strong> символом загружаются библиотекой <a href="http://www.google.com/webfonts">Google Web Fonts</a>.</em>','wp-shop'),
							'id' => 'h1_heading',
							'std' => array( 'size' => '32px', 'lineheight' => '32px', 'face' => 'Arial', 'color' => '#222'),
							'type' => 'typography',
							'options' => array(
									'faces' => $typography_mixed_fonts )
							);
		
		$options['h2_heading'] = array( 'name' => __('Заголовок H2','wp-shop'),
							'desc' => __('шрифт заголовка H2. <em>Примечание: шрифты отмеченые <strong>*</strong> символом загружаются библиотекой <a href="http://www.google.com/webfonts">Google Web Fonts</a>.</em>','wp-shop'),
							'id' => 'h2_heading',
							'std' => array( 'size' => '24px', 'lineheight' => '24px', 'face' => 'Arial', 'color' => '#222'),
							'type' => 'typography',
							'options' => array(
									'faces' => $typography_mixed_fonts )
							);
							
		$options['h3_heading'] = array( 'name' => __('Заголовок H3','wp-shop'),
							'desc' => __('шрифт заголовка H3. <em>Примечание: шрифты отмеченые <strong>*</strong> символом загружаются библиотекой <a href="http://www.google.com/webfonts">Google Web Fonts</a>.</em>','wp-shop'),
							'id' => 'h3_heading',
							'std' => array( 'size' => '18px', 'lineheight' => '18px', 'face' => 'Arial', 'color' => '#222'),
							'type' => 'typography',
							'options' => array(
									'faces' => $typography_mixed_fonts )
							);
		
		$options['h4_heading'] = array( 'name' => __('Заголовок H4','wp-shop'),
							'desc' => __('шрифт заголовка H4. <em>Примечание: шрифты отмеченые <strong>*</strong> символом загружаются библиотекой <a href="http://www.google.com/webfonts">Google Web Fonts</a>.</em>','wp-shop'),
							'id' => 'h4_heading',
							'std' => array( 'size' => '14px', 'lineheight' => '18px', 'face' => 'Arial', 'color' => '#222'),
							'type' => 'typography',
							'options' => array(
									'faces' => $typography_mixed_fonts )
							);
							
		$options['h5_heading'] = array( 'name' => __('Заголовок H5','wp-shop'),
							'desc' => __('шрифт заголовка H1. <em>Примечание: шрифты отмеченые <strong>*</strong> символом загружаются библиотекой <a href="http://www.google.com/webfonts">Google Web Fonts</a>.</em>','wp-shop'),
							'id' => 'h5_heading',
							'std' => array( 'size' => '12px', 'lineheight' => '18px', 'face' => 'Arial', 'color' => '#222'),
							'type' => 'typography',
							'options' => array(
									'faces' => $typography_mixed_fonts )
							);
							
		$options['h6_heading'] = array( 'name' => __('Заголовок H6','wp-shop'),
							'desc' => __('шрифт заголовка H1. <em>Примечание: шрифты отмеченые <strong>*</strong> символом загружаются библиотекой <a href="http://www.google.com/webfonts">Google Web Fonts</a>.</em>','wp-shop'),
							'id' => 'h6_heading',
							'std' => array( 'size' => '10px', 'lineheight' => '18px', 'face' => 'Arial', 'color' => '#222'),
							'type' => 'typography',
							'options' => array(
									'faces' => $typography_mixed_fonts )
							);
		
		
		$options[] = array( "name" => __('Свой CSS','wp-shop'),
							"desc" => __('Хотите добавить любой пользовательский код CSS? Положите сюда. Это отменяет любые другие стили. eg: a.button{color:green}','wp-shop'),
							"id" => "custom_css",
							"std" => "",
							"type" => "textarea");
		
		
		
		
		
		$options[] = array( "name" => __('Logo & Favicon','wp-shop'),
							"type" => "heading");
		
		$options['logo_type'] = array( "name" => __('Какой тип логотипа?','wp-shop'),
							"desc" => __('Выберите какой логотип вы хотите в виде изображения или текста. Если вы виберите изображение то введите его адрес в следующем поле, если вы выберите текст то в место лого будет показан Заголовок сайта.','wp-shop'),
							"id" => "logo_type",
							"std" => "image_logo",
							"type" => "radio",
							"options" => $logo_type);
		
		$options['logo_url'] = array( "name" => __('Лого URL','wp-shop'),
							"desc" => __('Введите адрес логотипа.','wp-shop'),
							"id" => "logo_url",
							"type" => "upload");
							
		$options['favicon'] = array( "name" => __('Favicon URL','wp-shop'),
							"desc" => __('Введите адрес Favicon.','wp-shop'),
							"id" => "favicon",
							"type" => "upload");
							
							
							
							
		$options[] = array( "name" => "Slider",
							"type" => "heading");
		
		$options['sl_effect'] = array( "name" => __('Slider эффект','wp-shop'),
							"desc" => __('Эффект переходов.','wp-shop'),
							"id" => "sl_effect",
							"std" => "fade",
							"type" => "select",
							"class" => "small", //mini, tiny, small
							"options" => $sl_effect_array);
		
		$options['sl_animation_speed'] = array( "name" => __('Скорость анимации','wp-shop'),
							"desc" => __('Скорость анимации (мс).','wp-shop'),
							"id" => "sl_animation_speed",
							"std" => "1200",
							"class" => "mini",
							"type" => "text");
		
		$options['sl_pausetime'] = array( "name" => __('Задержка','wp-shop'),
							"desc" => __('Задержка (мс).','wp-shop'),
							"id" => "sl_pausetime",
							"std" => "8000",
							"class" => "mini",
							"type" => "text");
							
		$options['sl_dir_nav'] = array( "name" => __('Навигация вперед назад','wp-shop'),
							"desc" => __('Отображать навигацию вперед назад?','wp-shop'),
							"id" => "sl_dir_nav",
							"std" => "false",
							"type" => "radio",
							"options" => $sl_dir_nav_array);
							
		$options['sl_control_nav'] = array( "name" => __('Постраничная навигация','wp-shop'),
							"desc" => __('Отображать постраничную навигацию?','wp-shop'),
							"id" => "sl_control_nav",
							"std" => "true",
							"type" => "radio",
							"options" => $sl_control_nav_array);
		
		
							
							
		
		$options[] = array( "name" => "Blog",
							"type" => "heading");
		
		
		
		$options['blog_sidebar_pos'] = array( "name" => __('Положение сайдбара','wp-shop'),
							"desc" => __('Выберите положение сайдбара','wp-shop'),
							"id" => "blog_sidebar_pos",
							"std" => "right",
							"type" => "images",
							"options" => array(
								'left' => $imagepath . '2cl.png',
								'right' => $imagepath . '2cr.png',)
							);
		
				
		
		$options[] = array( "name" => __('Footer','wp-shop'),
							"type" => "heading");
		
		$options['footer_text'] = array( "name" => __('текст в Подвале сайта','wp-shop'),
							"desc" => __('Введите текст который отобразится в Подвале сайта, разрешены теги HTML','wp-shop'),
							"id" => "footer_text",
							"std" => "",
							"type" => "textarea");
		
		$options[] = array( "name" => __('код Google Analytics','wp-shop'),
							"desc" => __('Вы можете вставить Google Analytics или другой код отслеживания в этом поле.','wp-shop'),
							"id" => "ga_code",
							"std" => "",
							"type" => "textarea");
		
			
		return $options;
	}
	
}

/* 
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');


if(!function_exists('optionsframework_custom_scripts')) {

	function optionsframework_custom_scripts() { ?>

		<script type="text/javascript">
		jQuery(document).ready(function($) {

			$('#example_showhidden').click(function() {
					$('#section-example_text_hidden').fadeToggle(400);
			});
			
			if ($('#example_showhidden:checked').val() !== undefined) {
				$('#section-example_text_hidden').show();
			}
			
		});
		</script>

		<?php
		}

}



/**
* Front End Customizer
*
* WordPress 3.4 Required
*/
add_action( 'customize_register', 'theme1986_register' );

if(!function_exists('theme1986_register')) {

	function theme1986_register($wp_customize) {
		/**
		 * This is optional, but if you want to reuse some of the defaults
		 * or values you already have built in the options panel, you
		 * can load them into $options for easy reference
		 */
		$options = optionsframework_options();
		
		
		
		/*-----------------------------------------------------------------------------------*/
		/*	General
		/*-----------------------------------------------------------------------------------*/
		$wp_customize->add_section( 'theme1986_header', array(
			'title' => __( 'General', 'theme1986' ),
			'priority' => 200
		));
		
		/* Background Image*/
		$wp_customize->add_setting( 'theme1986[body_background][image]', array(
			'default' => $options['body_background']['std']['image'],
			'type' => 'option'
		) );
		
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'body_background_image', array(
			'label'   => 'Background Image',
			'section' => 'theme1986_header',
			'settings'   => 'theme1986[body_background][image]'
		) ) );
		
		
		/* Background Color*/
		$wp_customize->add_setting( 'theme1986[body_background][color]', array(
			'default' => $options['body_background']['std']['color'],
			'type' => 'option'
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'body_background', array(
			'label'   => 'Background Color',
			'section' => 'theme1986_header',
			'settings'   => 'theme1986[body_background][color]'
		) ) );
		
		/* Header Color */
		$wp_customize->add_setting( 'theme1986[header_color]', array(
			'default' => $options['header_color']['std'],
			'type' => 'option'
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_color', array(
			'label'   => $options['header_color']['name'],
			'section' => 'theme1986_header',
			'settings'   => 'theme1986[header_color]'
		) ) );
		
		
		/* Body Font Face */
		$wp_customize->add_setting( 'theme1986[google_mixed_3][face]', array(
			'default' => $options['google_mixed_3']['std']['face'],
			'type' => 'option'
		) );
		
		$wp_customize->add_control( 'theme1986_google_mixed_3', array(
				'label' => $options['google_mixed_3']['name'],
				'section' => 'theme1986_header',
				'settings' => 'theme1986[google_mixed_3][face]',
				'type' => 'select',
				'choices' => $options['google_mixed_3']['options']['faces']
		) );
		
		
		/* Buttons and Links Color */
		$wp_customize->add_setting( 'theme1986[links_color]', array(
			'default' => $options['links_color']['std'],
			'type' => 'option'
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'links_color', array(
			'label'   => $options['links_color']['name'],
			'section' => 'theme1986_header',
			'settings'   => 'theme1986[links_color]'
		) ) );
		
		/* H1 Heading font face */
		$wp_customize->add_setting( 'theme1986[h1_heading][face]', array(
			'default' => $options['h1_heading']['std']['face'],
			'type' => 'option'
		) );
		
		$wp_customize->add_control( 'theme1986_h1_heading', array(
				'label' => $options['h1_heading']['name'],
				'section' => 'theme1986_header',
				'settings' => 'theme1986[h1_heading][face]',
				'type' => 'select',
				'choices' => $options['h1_heading']['options']['faces']
		) );
		
		/* H2 Heading font face */
		$wp_customize->add_setting( 'theme1986[h2_heading][face]', array(
			'default' => $options['h2_heading']['std']['face'],
			'type' => 'option'
		) );
		
		$wp_customize->add_control( 'theme1986_h2_heading', array(
				'label' => $options['h2_heading']['name'],
				'section' => 'theme1986_header',
				'settings' => 'theme1986[h2_heading][face]',
				'type' => 'select',
				'choices' => $options['h2_heading']['options']['faces']
		) );
		
		/* H6 Heading font face */
		$wp_customize->add_setting( 'theme1986[h6_heading][face]', array(
			'default' => $options['h6_heading']['std']['face'],
			'type' => 'option'
		) );
		
		$wp_customize->add_control( 'theme1986_h6_heading', array(
				'label' => $options['h6_heading']['name'],
				'section' => 'theme1986_header',
				'settings' => 'theme1986[h6_heading][face]',
				'type' => 'select',
				'choices' => $options['h6_heading']['options']['faces']
		) );
		
		/* H5 Heading font face */
		$wp_customize->add_setting( 'theme1986[h5_heading][face]', array(
			'default' => $options['h5_heading']['std']['face'],
			'type' => 'option'
		) );
		
		$wp_customize->add_control( 'theme1986_h5_heading', array(
				'label' => $options['h5_heading']['name'],
				'section' => 'theme1986_header',
				'settings' => 'theme1986[h5_heading][face]',
				'type' => 'select',
				'choices' => $options['h5_heading']['options']['faces']
		) );
		
		/* H4 Heading font face */
		$wp_customize->add_setting( 'theme1986[h4_heading][face]', array(
			'default' => $options['h4_heading']['std']['face'],
			'type' => 'option'
		) );
		
		$wp_customize->add_control( 'theme1986_h4_heading', array(
				'label' => $options['h4_heading']['name'],
				'section' => 'theme1986_header',
				'settings' => 'theme1986[h4_heading][face]',
				'type' => 'select',
				'choices' => $options['h4_heading']['options']['faces']
		) );
		
		/* H3 Heading font face */
		$wp_customize->add_setting( 'theme1986[h3_heading][face]', array(
			'default' => $options['h2_heading']['std']['face'],
			'type' => 'option'
		) );
		
		$wp_customize->add_control( 'theme1986_h3_heading', array(
				'label' => $options['h3_heading']['name'],
				'section' => 'theme1986_header',
				'settings' => 'theme1986[h3_heading][face]',
				'type' => 'select',
				'choices' => $options['h3_heading']['options']['faces']
		) );
		
		
		
		/* Search Box */
		$wp_customize->add_setting( 'theme1986[g_search_box_id]', array(
				'default' => $options['post_excerpt']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'theme1986_g_search_box_id', array(
				'label' => $options['g_search_box_id']['name'],
				'section' => 'theme1986_header',
				'settings' => 'theme1986[g_search_box_id]',
				'type' => $options['g_search_box_id']['type'],
				'choices' => $options['g_search_box_id']['options']
		) );
		
		
		/*-----------------------------------------------------------------------------------*/
		/*	Logo
		/*-----------------------------------------------------------------------------------*/
		
		$wp_customize->add_section( 'theme1986_logo', array(
			'title' => __( 'Logo', 'theme1986' ),
			'priority' => 201
		) );
		
		/* Logo Type */
		$wp_customize->add_setting( 'theme1986[logo_type]', array(
				'default' => $options['logo_type']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'theme1986_logo_type', array(
				'label' => $options['logo_type']['name'],
				'section' => 'theme1986_logo',
				'settings' => 'theme1986[logo_type]',
				'type' => $options['logo_type']['type'],
				'choices' => $options['logo_type']['options']
		) );
		
		/* Logo Path */
		$wp_customize->add_setting( 'theme1986[logo_url]', array(
			'type' => 'option'
		) );
		
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_url', array(
			'label' => $options['logo_url']['name'],
			'section' => 'theme1986_logo',
			'settings' => 'theme1986[logo_url]'
		) ) );
		
		
		
		/*-----------------------------------------------------------------------------------*/
		/*	Slider
		/*-----------------------------------------------------------------------------------*/
		
		$wp_customize->add_section( 'theme1986_slider', array(
			'title' => __( 'Slider', 'theme1986' ),
			'priority' => 202
		) );
		
		/* Slider Effect */
		$wp_customize->add_setting( 'theme1986[sl_effect]', array(
				'default' => $options['sl_effect']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'theme1986_sl_effect', array(
				'label' => $options['sl_effect']['name'],
				'section' => 'theme1986_slider',
				'settings' => 'theme1986[sl_effect]',
				'type' => $options['sl_effect']['type'],
				'choices' => $options['sl_effect']['options']
		) );
		
		/* Slices */
		$wp_customize->add_setting( 'theme1986[sl_slices]', array(
				'default' => $options['sl_slices']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'theme1986_sl_slices', array(
				'label' => $options['sl_slices']['name'],
				'section' => 'theme1986_slider',
				'settings' => 'theme1986[sl_slices]',
				'type' => $options['sl_slices']['type'],
				'choices' => $options['sl_slices']['options']
		) );
		
		/* Box columns */
		$wp_customize->add_setting( 'theme1986[sl_box_columns]', array(
				'default' => $options['sl_box_columns']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'theme1986_sl_box_columns', array(
				'label' => $options['sl_box_columns']['name'],
				'section' => 'theme1986_slider',
				'settings' => 'theme1986[sl_box_columns]',
				'type' => $options['sl_box_columns']['type'],
				'choices' => $options['sl_box_columns']['options']
		) );
		
		/* Box rows */
		$wp_customize->add_setting( 'theme1986[sl_box_rows]', array(
				'default' => $options['sl_box_rows']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'theme1986_sl_box_rows', array(
				'label' => $options['sl_box_rows']['name'],
				'section' => 'theme1986_slider',
				'settings' => 'theme1986[sl_box_rows]',
				'type' => $options['sl_box_rows']['type'],
				'choices' => $options['sl_box_rows']['options']
		) );
		
		
		/* Animation speed */
		$wp_customize->add_setting( 'theme1986[sl_animation_speed]', array(
				'default' => $options['sl_animation_speed']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'theme1986_sl_animation_speed', array(
				'label' => $options['sl_animation_speed']['name'],
				'section' => 'theme1986_slider',
				'settings' => 'theme1986[sl_animation_speed]',
				'type' => $options['sl_animation_speed']['type']
		) );
		
		/* Pause time */
		$wp_customize->add_setting( 'theme1986[sl_pausetime]', array(
				'default' => $options['sl_pausetime']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'theme1986_sl_pausetime', array(
				'label' => $options['sl_pausetime']['name'],
				'section' => 'theme1986_slider',
				'settings' => 'theme1986[sl_pausetime]',
				'type' => $options['sl_pausetime']['type']
		) );
		
		
		/* Display next & prev navigation? */
		$wp_customize->add_setting( 'theme1986[sl_dir_nav]', array(
				'default' => $options['sl_dir_nav']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'theme1986_sl_dir_nav', array(
				'label' => $options['sl_dir_nav']['name'],
				'section' => 'theme1986_slider',
				'settings' => 'theme1986[sl_dir_nav]',
				'type' => $options['sl_dir_nav']['type'],
				'choices' => $options['sl_dir_nav']['options']
		) );
		
		
		/* Display next & prev navigation only on hover? */
		$wp_customize->add_setting( 'theme1986[sl_dir_nav_hide]', array(
				'default' => $options['sl_dir_nav_hide']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'theme1986_sl_dir_nav_hide', array(
				'label' => $options['sl_dir_nav_hide']['name'],
				'section' => 'theme1986_slider',
				'settings' => 'theme1986[sl_dir_nav_hide]',
				'type' => $options['sl_dir_nav_hide']['type'],
				'choices' => $options['sl_dir_nav_hide']['options']
		) );
		
		
		/* Show pagination? */
		$wp_customize->add_setting( 'theme1986[sl_control_nav]', array(
				'default' => $options['sl_control_nav']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'theme1986_sl_control_nav', array(
				'label' => $options['sl_control_nav']['name'],
				'section' => 'theme1986_slider',
				'settings' => 'theme1986[sl_control_nav]',
				'type' => $options['sl_control_nav']['type'],
				'choices' => $options['sl_control_nav']['options']
		) );
		
		
		
		
		/*-----------------------------------------------------------------------------------*/
		/*	Blog
		/*-----------------------------------------------------------------------------------*/
		
		
		$wp_customize->add_section( 'theme1986_blog', array(
				'title' => __( 'Blog', 'theme1986' ),
				'priority' => 203
		) );
		
		/* Blog image size */
		$wp_customize->add_setting( 'theme1986[post_image_size]', array(
				'default' => $options['post_image_size']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'theme1986_post_image_size', array(
				'label' => $options['post_image_size']['name'],
				'section' => 'theme1986_blog',
				'settings' => 'theme1986[post_image_size]',
				'type' => $options['post_image_size']['type'],
				'choices' => $options['post_image_size']['options']
		) );
		
		/* Single post image size */
		$wp_customize->add_setting( 'theme1986[single_image_size]', array(
				'default' => $options['single_image_size']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'theme1986_single_image_size', array(
				'label' => $options['single_image_size']['name'],
				'section' => 'theme1986_blog',
				'settings' => 'theme1986[single_image_size]',
				'type' => $options['single_image_size']['type'],
				'choices' => $options['single_image_size']['options']
		) );
		
		/* Post Meta */
		$wp_customize->add_setting( 'theme1986[post_meta]', array(
				'default' => $options['post_meta']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'theme1986_post_meta', array(
				'label' => $options['post_meta']['name'],
				'section' => 'theme1986_blog',
				'settings' => 'theme1986[post_meta]',
				'type' => $options['post_meta']['type'],
				'choices' => $options['post_meta']['options']
		) );
		
		/* Post Excerpt */
		$wp_customize->add_setting( 'theme1986[post_excerpt]', array(
				'default' => $options['post_excerpt']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'theme1986_post_excerpt', array(
				'label' => $options['post_excerpt']['name'],
				'section' => 'theme1986_blog',
				'settings' => 'theme1986[post_excerpt]',
				'type' => $options['post_excerpt']['type'],
				'choices' => $options['post_excerpt']['options']
		) );
		
		
		
		/*-----------------------------------------------------------------------------------*/
		/*	Footer
		/*-----------------------------------------------------------------------------------*/
		
		$wp_customize->add_section( 'theme1986_footer', array(
			'title' => __( 'Footer', 'theme1986' ),
			'priority' => 204
		) );
			
		/* Footer Copyright Text */
		$wp_customize->add_setting( 'theme1986[footer_text]', array(
				'default' => $options['footer_text']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'theme1986_footer_text', array(
				'label' => $options['footer_text']['name'],
				'section' => 'theme1986_footer',
				'settings' => 'theme1986[footer_text]',
				'type' => 'text'
		) );
		
		
		/* Display Footer Menu */
		$wp_customize->add_setting( 'theme1986[footer_menu]', array(
				'default' => $options['footer_menu']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'theme1986_footer_menu', array(
				'label' => $options['footer_menu']['name'],
				'section' => 'theme1986_footer',
				'settings' => 'theme1986[footer_menu]',
				'type' => $options['footer_menu']['type'],
				'choices' => $options['footer_menu']['options']
		) );
		

		
	};

}