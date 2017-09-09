<?php 

/********* Page Templates v.1.8 ************/

define( 'ET_PT_PATH', get_template_directory_uri() . '/epanel/page_templates' );

add_action( 'admin_enqueue_scripts', 'et_ptemplate_upload_categories_scripts' );
function et_ptemplate_upload_categories_scripts( $hook_suffix ) {
	if ( in_array($hook_suffix, array('post.php','post-new.php')) ) {
		wp_register_script('et-ptemplates', get_template_directory_uri().'/epanel/page_templates/js/et-ptemplates.js', array('jquery'));
		wp_enqueue_script('et-ptemplates');
	}
}

add_action("admin_init", "et_ptemplates_metabox");
function et_ptemplates_metabox(){
	global $themename;
	add_meta_box("et_ptemplate_meta", __( 'Опции шаблона', 'wp-shop' ), "et_ptemplate_meta", "page", "side");
}

if ( ! function_exists( 'et_ptemplate_meta' ) ){
	function et_ptemplate_meta($callback_args) {
		global $post, $themename;
		$temp_array = array();

		$temp_array = maybe_unserialize(get_post_meta($post->ID,'et_ptemplate_settings',true));
		$et_ptemplate_order = isset( $temp_array['et_ptemplate_order'] ) ? (int) $temp_array['et_ptemplate_order'] : 1;
		$et_ptemplate_orderby = isset( $temp_array['et_ptemplate_orderby'] ) ? (string)$temp_array['et_ptemplate_orderby'] : date;
		
		$et_ptemplate_show_slider = isset( $temp_array['et_ptemplate_show_slider'] ) ? (bool)$temp_array['et_ptemplate_show_slider'] : false;
		
		$et_ptemplate_show_banner = isset( $temp_array['et_ptemplate_show_banner'] ) ? (bool)$temp_array['et_ptemplate_show_banner'] : false;
		$et_ptemplate_showthumb = isset( $temp_array['et_ptemplate_showthumb'] ) ? (bool) $temp_array['et_ptemplate_showthumb'] : false;
		$et_ptemplate_gallerycats = isset( $temp_array['et_ptemplate_gallerycats'] ) ? (array) $temp_array['et_ptemplate_gallerycats'] : array();
		$et_ptemplate_tags = isset( $temp_array['et_ptemplate_tags'] ) ? (array) $temp_array['et_ptemplate_tags'] : array();
		$et_ptemplate_gallery_perpage = isset( $temp_array['et_ptemplate_gallery_perpage'] ) ? (int) $temp_array['et_ptemplate_gallery_perpage'] : 10;
		$et_ptemplate_words = isset( $temp_array['et_ptemplate_words'] ) ? (int) $temp_array['et_ptemplate_words'] : 30;
		$et_ptemplate_height = isset( $temp_array['et_ptemplate_height'] ) ? (int) $temp_array['et_ptemplate_height'] : 350;
		$et_ptemplate_showtitle = isset( $temp_array['et_ptemplate_showtitle'] ) ? (bool) $temp_array['et_ptemplate_showtitle'] : 1;
		$et_ptemplate_paged = isset( $temp_array['et_ptemplate_paged'] ) ? (bool) $temp_array['et_ptemplate_paged'] : false;
		$et_ptemplate_showdesc = isset( $temp_array['et_ptemplate_showdesc'] ) ? (bool) $temp_array['et_ptemplate_showdesc'] : false;
		$et_ptemplate_price = isset( $temp_array['et_ptemplate_price'] ) ? (bool) $temp_array['et_ptemplate_price'] : 1;
		$et_ptemplate_column = isset( $temp_array['et_ptemplate_column'] ) ? (int) $temp_array['et_ptemplate_column'] : 1;
		$et_ptemplate_column_price = isset( $temp_array['et_ptemplate_column_price'] ) ? (int) $temp_array['et_ptemplate_column_price'] : 1;
		$et_ptemplate_img_weight = isset( $temp_array['et_ptemplate_img_weight'] ) ? (int) $temp_array['et_ptemplate_img_weight'] : 710;
		$et_ptemplate_img_height = isset($temp_array['et_ptemplate_img_height'] ) ? (int) $temp_array['et_ptemplate_img_height'] : 388;
		$et_ptemplate_main_cont = isset( $temp_array['et_ptemplate_main_cont'] ) ? (int) $temp_array['et_ptemplate_main_cont'] : 1;
		$et_ptemplate_show_vitrina = isset( $temp_array['et_ptemplate_show_vitrina'] ) ? (bool)$temp_array['et_ptemplate_show_vitrina'] : false;
		?>
		
		<?php wp_nonce_field( 'et_ptemplates_nonce', '_wpnonce_ptemplates_save' ); ?>
		
		<div style="margin: 13px 0 11px 4px;" class="et_pt_info">
			<p><?php _e( 'Выберите шаблон страницы', 'wp-shop' ); ?></p>
		</div>
		
		<div style="margin: 13px 0 11px 4px; display: none;" class="et_pt_portfolio et_pt_main">
			<p style="font-weight: bold; padding-bottom: 7px;"><?php _e( 'Варианты разметки:', 'wp-shop' ); ?></p>
			<label title="На ширину страницы без сайдбара"><input type="radio" name="et_ptemplate_column" value="1"<?php checked( $et_ptemplate_column, 1 ); ?>> <span><?php _e( 'На ширину страницы без сайдбара', 'wp-shop' ); ?></span></label><br><br>
			<label title="Сайдбар и 2 колонки"><input type="radio" name="et_ptemplate_column" value="2"<?php checked( $et_ptemplate_column, 2 ); ?>> <span><?php _e( 'Сайдбар и 2 колонки', 'wp-shop' ); ?></span></label><br><br>
		</div>
		
		<div style="margin: 13px 0 11px 4px; display: none;" class="et_pt_price">
			<p style="font-weight: bold; padding-bottom: 7px;"><?php _e( 'Варианты разметки:', 'wp-shop' ); ?></p>
			<label title="На ширину страницы без сайдбара"><input type="radio" name="et_ptemplate_column_price" value="1"<?php checked( $et_ptemplate_column_price, 1 ); ?>> <span><?php _e( 'На ширину страницы без сайдбара', 'wp-shop' ); ?></span></label><br><br>
			<label title="Страница с сайдбаром"><input type="radio" name="et_ptemplate_column_price" value="2"<?php checked( $et_ptemplate_column_price, 2 ); ?>> <span><?php _e( 'Страница с сайдбаром', 'wp-shop' ); ?></span></label><br><br>
		</div>
		
		<div style="margin: 13px 0 11px 4px; display: none;" class="et_pt_price et_pt_main et_pt_portfolio">
			<p style="font-weight: bold; padding-bottom: 7px;"><?php _e( 'Основное содержимое:', 'wp-shop' ); ?></p>
			<label title="Перед витриной (прайсом)"><input type="radio" name="et_ptemplate_main_cont" value="1"<?php checked( $et_ptemplate_main_cont, 1 ); ?>> <span><?php _e( 'Перед витриной (прайсом)', 'wp-shop' ); ?></span></label><br><br>
			<label title="После витрины (прайса)"><input type="radio" name="et_ptemplate_main_cont" value="2"<?php checked( $et_ptemplate_main_cont, 2 ); ?>> <span><?php _e( 'После витрины (прайса)', 'wp-shop' ); ?></span></label><br><br>
		</div>
		
		<div style="margin: 13px 0 11px 4px; display: none;" class="et_pt_main">
			<label class="selectit" for="et_ptemplate_show_banner">
				<input type="checkbox" name="et_ptemplate_show_banner" id="et_ptemplate_show_banner" value=""<?php checked( $et_ptemplate_show_banner); ?> /> <?php _e( 'Скрыть баннеры', 'wp-shop' ); ?></label><br/>
		</div>
			
		<div style="margin: 13px 0 11px 4px; display: none;" class="et_pt_main">
			<label class="selectit" for="et_ptemplate_show_slider">
				<input type="checkbox" name="et_ptemplate_show_slider" id="et_ptemplate_show_slider" value=""<?php checked( $et_ptemplate_show_slider ); ?> /> <?php _e( 'Скрыть слайдер', 'wp-shop' ); ?></label><br/>
		</div>
		
		<div style="margin: 13px 0 11px 4px; display: none;" class="et_pt_main">
			<label class="selectit" for="et_ptemplate_show_vitrina">
				<input type="checkbox" name="et_ptemplate_show_vitrina" id="et_ptemplate_show_vitrina" value=""<?php checked( $et_ptemplate_show_vitrina ); ?> /> <?php _e( 'Скрыть витрину', 'wp-shop' ); ?></label><br/>
		</div>
		
		<div style="margin: 13px 0 11px 4px; display: none;" class="et_pt_main">
			<label for="et_ptemplate_img_weight" style="color: #000; font-weight: bold;"> <?php _e( 'Ширина картинки в слайдере:', 'wp-shop' ); ?> </label>
			<input type="text" class="small-text" value="<?php echo $et_ptemplate_img_weight; ?>" id="et_ptemplate_img_weight" name="et_ptemplate_img_weight" size="3" />
		</div>
		
		<div style="margin: 13px 0 11px 4px; display: none;" class="et_pt_main">
			<label for="et_ptemplate_img_height" style="color: #000; font-weight: bold;"> <?php _e( 'Высота картинки в слайдере:', 'wp-shop' ); ?> </label>
			<input type="text" class="small-text" value="<?php echo $et_ptemplate_img_height; ?>" id="et_ptemplate_img_height" name="et_ptemplate_img_height" size="3" />
		</div>
		
		<div style="margin: 13px 0 11px 4px; display: none;" class="et_pt_portfolio et_pt_price et_pt_main">
			<label class="selectit" for="et_ptemplate_showthumb">
				<input type="checkbox" name="et_ptemplate_showthumb" id="et_ptemplate_showthumb" value=""<?php checked( $et_ptemplate_showthumb ); ?> /> <?php _e( 'Скрыть миниатюры', 'wp-shop' ); ?></label><br/>
		</div>
		
		<div style="margin: 13px 0 11px 4px; display: none;" class="et_pt_portfolio et_pt_main">
			<label class="selectit" for="et_ptemplate_showtitle">
				<input type="checkbox" name="et_ptemplate_showtitle" id="et_ptemplate_showtitle" value=""<?php checked( $et_ptemplate_showtitle ); ?> /> <?php _e( 'Показать заголовки', 'wp-shop' ); ?></label><br/>
		</div>
		
		<div style="margin: 13px 0 11px 4px; display: none;" class="et_pt_portfolio et_pt_main et_pt_price">
			<label class="selectit" for="et_ptemplate_showdesc">
				<input type="checkbox" name="et_ptemplate_showdesc" id="et_ptemplate_showdesc" value=""<?php checked( $et_ptemplate_showdesc ); ?> /> <?php _e( 'Показать описание', 'wp-shop' ); ?></label><br/>
		</div>
		
		<div style="margin: 13px 0 11px 4px; display: none;" class="et_pt_portfolio et_pt_main">
			<label class="selectit" for="et_ptemplate_price">
				<input type="checkbox" name="et_ptemplate_price" id="et_ptemplate_price" value=""<?php checked( $et_ptemplate_price ); ?> /> <?php _e( 'Показать цену', 'wp-shop' ); ?></label><br/>
		</div>
		
		<div style="margin: 13px 0 11px 4px; display: none;" class="et_pt_portfolio et_pt_main et_pt_price">
			<label for="et_ptemplate_words" style="color: #000; font-weight: bold;"> <?php _e( 'Количество слов в описании:', 'wp-shop' ); ?> </label>
			<input type="text" class="small-text" value="<?php echo $et_ptemplate_words; ?>" id="et_ptemplate_words" name="et_ptemplate_words" size="3" />
		</div>
		
		<div style="margin: 13px 0 11px 4px; display: none;" class="et_pt_portfolio et_pt_main">
			<label for="et_ptemplate_height" style="color: #000; font-weight: bold;"> <?php _e( 'Высота блока:', 'wp-shop' ); ?> </label>
			<input type="text" class="small-text" value="<?php echo $et_ptemplate_height; ?>" id="et_ptemplate_height" name="et_ptemplate_height" size="3" />
		</div>
		
		<div style="margin: 13px 0 11px 4px; display: none;" class="et_pt_price et_pt_main et_pt_portfolio">
			<p style="font-weight: bold; padding-bottom: 7px;"><?php _e( 'Сортировать по:', 'wp-shop' ); ?></p>
			<select name="et_ptemplate_orderby">
				<option value="title" <?php selected( $et_ptemplate_orderby, 'title' ); ?>> <span><?php _e( 'заголовку', 'wp-shop' ); ?></span></option>
				<option value="date" <?php selected( $et_ptemplate_orderby, 'date' ); ?>> <span><?php _e( 'дате', 'wp-shop' ); ?></span></option>
				<option value="count_count" <?php selected( $et_ptemplate_orderby, 'count_count' ); ?>> <span><?php _e( 'количеству комментариев', 'wp-shop' ); ?></span></option>
				<option value="id" <?php selected( $et_ptemplate_orderby, 'id' ); ?>> <span><?php _e( 'по id', 'wp-shop' ); ?></span></option>
				<option value="meta_value_num" <?php selected( $et_ptemplate_orderby, 'meta_value_num' ); ?>> <span><?php _e( 'по цене', 'wp-shop' ); ?></span></option>
				<option value="rand" <?php selected( $et_ptemplate_orderby, 'rand' ); ?>> <span><?php _e( 'рандомно', 'wp-shop' ); ?></span></option>
			</select>	
		</div>
		
		<div style="margin: 13px 0 11px 4px; display: none;" class="et_pt_price et_pt_main et_pt_portfolio">
			<p style="font-weight: bold; padding-bottom: 7px;"><?php _e( 'Направление сортировки:', 'wp-shop' ); ?></p>
			<label title="по возрастанию"><input type="radio" name="et_ptemplate_order" value="1"<?php checked( $et_ptemplate_order, 1 ); ?>> <span><?php _e( 'по возрастанию', 'wp-shop' ); ?></span></label><br><br>
			<label title="по убыванию"><input type="radio" name="et_ptemplate_order" value="2"<?php checked( $et_ptemplate_order, 2 ); ?>> <span><?php _e( 'по убыванию', 'wp-shop' ); ?></span></label><br><br>
		</div>
		
				
		<div style="margin: 13px 0 11px 4px; display: none;" class="et_pt_main">
			<label class="selectit" for="et_ptemplate_paged">
				<input type="checkbox" name="et_ptemplate_paged" id="et_ptemplate_paged" value=""<?php checked( $et_ptemplate_paged ); ?> /> <?php _e( 'Отображать постранично', 'wp-shop' ); ?></label><br/>
		</div>	
		
		<div style="margin: 13px 0 11px 4px; display: none;" class="et_pt_portfolio et_pt_price et_pt_main">
			<label for="et_ptemplate_gallery_perpage" style="color: #000; font-weight: bold;"> <?php _e( 'Количество товаров на странице:', 'wp-shop' ); ?> </label>
			<input type="text" class="small-text" value="<?php echo $et_ptemplate_gallery_perpage; ?>" id="et_ptemplate_gallery_perpage" name="et_ptemplate_gallery_perpage" size="2" />
		</div>
		
		
		<div style="margin: 13px 0 11px 4px; display: none;" class="et_pt_portfolio et_pt_price et_pt_main">
			<h4><?php _e( 'Отображать категории:', 'wp-shop' ); ?></h4>
					
			<?php $cats_array = get_categories('hide_empty=0');
			$site_cats = array();
			foreach ($cats_array as $categs) {
				$checked = '';
				
				if (!empty($et_ptemplate_gallerycats)) {
					if (in_array($categs->cat_ID, $et_ptemplate_gallerycats)) $checked = "checked=\"checked\"";
				} ?>
				
				<label style="padding-bottom: 5px; display: block;" for="<?php echo 'et_ptemplate_gallerycats-',$categs->cat_ID; ?>">
					<input type="checkbox" name="et_ptemplate_gallerycats[]" id="<?php echo esc_attr( 'et_ptemplate_gallerycats-' . $categs->cat_ID ); ?>" value="<?php echo esc_attr( $categs->cat_ID ); ?>" <?php echo $checked; ?> />
					<?php echo esc_html( $categs->cat_name ); ?>
				</label>							
			<?php } ?>
		</div>
		
		<div style="margin: 13px 0 11px 4px; display: none;" class="et_pt_portfolio et_pt_price et_pt_main">
			<h4><?php _e( 'Отображать метки:', 'wp-shop' ); ?></h4>
					
			<?php $tags_array = get_tags('hide_empty=0');
			$site_tags = array();
			foreach ($tags_array as $tags) {
				$checked = '';
				
				if (!empty($et_ptemplate_tags)) {
					if (in_array($tags->slug, $et_ptemplate_tags)) $checked = "checked=\"checked\"";
				} ?>
				
				<label style="padding-bottom: 5px; display: block;" for="<?php echo 'et_ptemplate_tags-',$tags->slug; ?>">
					<input type="checkbox" name="et_ptemplate_tags[]" id="<?php echo esc_attr( 'et_ptemplate_tags-' . $tags->slug ); ?>" value="<?php echo esc_attr( $tags->slug ); ?>" <?php echo $checked; ?> />
					<?php echo esc_html( $tags->name ); ?>
				</label>							
			<?php } ?>
		</div>
				
		<?php
	}
}

add_action( 'save_post', 'et_ptemplate_save_details', 10, 2 );
function et_ptemplate_save_details( $post_id, $post ){
	global $pagenow;
	
	if ( 'post.php' != $pagenow ) return $post_id;

	if ( 'page' != $post->post_type )
		return $post_id;
			
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
		return $post_id;
		
	$post_type = get_post_type_object( $post->post_type );
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;
	
	if ( ! isset( $_POST['_wpnonce_ptemplates_save'] ) || ! wp_verify_nonce( $_POST['_wpnonce_ptemplates_save'], 'et_ptemplates_nonce' ) )
        return $post_id;

	if ( !isset( $_POST["page_template"] ) )
		return $post_id;
		
	if ( !in_array( $_POST["page_template"], array('page-template-portfolio.php','page-price.php','main-page.php') ) )
		return $post_id;
		
	$temp_array = array();
	
			
	if ( 'page-template-portfolio.php' == $_POST["page_template"] ) {
		if (isset($_POST["et_ptemplate_orderby"])) $temp_array['et_ptemplate_orderby'] = (string) $_POST["et_ptemplate_orderby"];
		if (isset($_POST["et_ptemplate_gallerycats"])) $temp_array['et_ptemplate_gallerycats'] = (array) $_POST["et_ptemplate_gallerycats"];
		if (isset($_POST["et_ptemplate_tags"])) $temp_array['et_ptemplate_tags'] = (array) $_POST["et_ptemplate_tags"];
		if (isset($_POST["et_ptemplate_gallery_perpage"])) $temp_array['et_ptemplate_gallery_perpage'] = (int) $_POST["et_ptemplate_gallery_perpage"];
		if (isset($_POST["et_ptemplate_words"])) $temp_array['et_ptemplate_words'] = (int) $_POST["et_ptemplate_words"];
		if (isset($_POST["et_ptemplate_height"])) $temp_array['et_ptemplate_height'] = (int) $_POST["et_ptemplate_height"];
		$temp_array['et_ptemplate_showthumb'] = isset( $_POST["et_ptemplate_showthumb"] ) ? 1 : 0;
		$temp_array['et_ptemplate_showtitle'] = isset( $_POST["et_ptemplate_showtitle"] ) ? 1 : 0;
		$temp_array['et_ptemplate_showdesc'] = isset( $_POST["et_ptemplate_showdesc"] ) ? 1 : 0;
		$temp_array['et_ptemplate_price'] = isset( $_POST["et_ptemplate_price"] ) ? 1 : 0;
		$temp_array['et_ptemplate_column'] = isset( $_POST["et_ptemplate_column"] ) ? (int) $_POST["et_ptemplate_column"] : 1;
		$temp_array['et_ptemplate_order'] = isset( $_POST["et_ptemplate_order"] ) ? (int) $_POST["et_ptemplate_order"] : 1;
		$temp_array['et_ptemplate_main_cont'] = isset( $_POST["et_ptemplate_main_cont"] ) ? (int) $_POST["et_ptemplate_main_cont"] : 1;
	}
	
	if ( 'page-price.php' == $_POST["page_template"] ) {
		if (isset($_POST["et_ptemplate_orderby"])) $temp_array['et_ptemplate_orderby'] = (string) $_POST["et_ptemplate_orderby"];
		if (isset($_POST["et_ptemplate_gallerycats"])) $temp_array['et_ptemplate_gallerycats'] = (array) $_POST["et_ptemplate_gallerycats"];
		if (isset($_POST["et_ptemplate_tags"])) $temp_array['et_ptemplate_tags'] = (array) $_POST["et_ptemplate_tags"];
		if (isset($_POST["et_ptemplate_gallery_perpage"])) $temp_array['et_ptemplate_gallery_perpage'] = (int) $_POST["et_ptemplate_gallery_perpage"];
		if (isset($_POST["et_ptemplate_words"])) $temp_array['et_ptemplate_words'] = (int) $_POST["et_ptemplate_words"];
	
		$temp_array['et_ptemplate_showthumb'] = isset( $_POST["et_ptemplate_showthumb"] ) ? 1 : 0;
		$temp_array['et_ptemplate_price'] = isset( $_POST["et_ptemplate_price"] ) ? 1 : 0;
		$temp_array['et_ptemplate_column_price'] = isset( $_POST["et_ptemplate_column_price"] ) ? (int) $_POST["et_ptemplate_column_price"] : 1;
		$temp_array['et_ptemplate_showdesc'] = isset( $_POST["et_ptemplate_showdesc"] ) ? 1 : 0;
		$temp_array['et_ptemplate_order'] = isset( $_POST["et_ptemplate_order"] ) ? (int) $_POST["et_ptemplate_order"] : 1;
		$temp_array['et_ptemplate_main_cont'] = isset( $_POST["et_ptemplate_main_cont"] ) ? (int) $_POST["et_ptemplate_main_cont"] : 1;
	}

	if ( 'main-page.php' == $_POST["page_template"] ) {
		
		if (isset($_POST["et_ptemplate_orderby"])) $temp_array['et_ptemplate_orderby'] = (string) $_POST["et_ptemplate_orderby"];
				
		if (isset($_POST["et_ptemplate_gallerycats"])) $temp_array['et_ptemplate_gallerycats'] = (array) $_POST["et_ptemplate_gallerycats"];
		if (isset($_POST["et_ptemplate_tags"])) $temp_array['et_ptemplate_tags'] = (array) $_POST["et_ptemplate_tags"];
		if (isset($_POST["et_ptemplate_gallery_perpage"])) $temp_array['et_ptemplate_gallery_perpage'] = (int) $_POST["et_ptemplate_gallery_perpage"];
		if (isset($_POST["et_ptemplate_words"])) $temp_array['et_ptemplate_words'] = (int) $_POST["et_ptemplate_words"];
		if (isset($_POST["et_ptemplate_height"])) $temp_array['et_ptemplate_height'] = (int) $_POST["et_ptemplate_height"];
		if (isset($_POST["et_ptemplate_img_weight"])) $temp_array['et_ptemplate_img_weight'] = (int) $_POST["et_ptemplate_img_weight"];
		if (isset($_POST["et_ptemplate_img_height"])) $temp_array['et_ptemplate_img_height'] = (int) $_POST["et_ptemplate_img_height"];
		$temp_array['et_ptemplate_column'] = isset( $_POST["et_ptemplate_column"] ) ? (int) $_POST["et_ptemplate_column"] : 1;
		$temp_array['et_ptemplate_order'] = isset( $_POST["et_ptemplate_order"] ) ? (int) $_POST["et_ptemplate_order"] : 1;
		$temp_array['et_ptemplate_main_cont'] = isset( $_POST["et_ptemplate_main_cont"] ) ? (int) $_POST["et_ptemplate_main_cont"] : 1;
		$temp_array['et_ptemplate_show_slider'] = isset( $_POST["et_ptemplate_show_slider"] ) ? 1 : 0;
		$temp_array['et_ptemplate_show_banner'] = isset( $_POST["et_ptemplate_show_banner"] ) ? 1 : 0;
		
		$temp_array['et_ptemplate_showthumb'] = isset( $_POST["et_ptemplate_showthumb"] ) ? 1 : 0;
		$temp_array['et_ptemplate_showtitle'] = isset( $_POST["et_ptemplate_showtitle"] ) ? 1 : 0;
		$temp_array['et_ptemplate_showdesc'] = isset( $_POST["et_ptemplate_showdesc"] ) ? 1 : 0;
		$temp_array['et_ptemplate_price'] = isset( $_POST["et_ptemplate_price"] ) ? 1 : 0;
		$temp_array['et_ptemplate_paged'] = isset( $_POST["et_ptemplate_paged"] ) ? 1 : 0;
		$temp_array['et_ptemplate_show_vitrina'] = isset( $_POST["et_ptemplate_show_vitrina"] ) ? 1 : 0;
	}
				
	update_post_meta( $post_id, "et_ptemplate_settings", $temp_array );
} ?>