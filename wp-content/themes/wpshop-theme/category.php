<?php
 /*
 Шаблон архива категорий
 */
 ?>
 
<?php get_header(); ?>
<div class="main-width">
	<?php get_sidebar(); ?>
	<div id="main-content" class="narrow archive">
		<h1 class="page_title"><?php echo single_cat_title( '', false ); ?></h1>
		<?php $category_description = category_description();
				if ( ! empty( $category_description ) ) { ?>
				<div class="clear"></div>
				<div id="cat_desc" class=""><?php echo '' . $category_description . ''; ?></div>
		<?php } ?>
		<?php
			if (!isset($_GET['per_page']))$wp_query->set('posts_per_page',12);
			if (!isset($_GET['select']))$wp_query->set('orderby','title');
			if (!isset($_GET['order_query']))$wp_query->set('order','ASC');	
			$page = is_front_page() ? get_query_var( 'page' ) : get_query_var( 'paged' );
						
			if ($_GET['select'] == 'title') { 
				$wp_query->set('orderby','title');
				$s1 = ' selected="selected"';
				$s2 = ''; $s3 = ''; $s4 = '';}
			if ($_GET['select'] == 'date') {
				$wp_query->set('orderby','date'); 
				$s2 = ' selected="selected"';
				$s1 = ''; $s3 = ''; $s4 = ''; }
			if ($_GET['select'] == 'meta_value_num') { 
				$wp_query->set('orderby','meta_value_num'); 
				$wp_query->set('meta_key','cost_1');
				$s3 = ' selected="selected"';
				$s2 = ''; $s1 = ''; $s4 = ''; }
			if ($_GET['select'] == 'rand') { 
				$wp_query->set('orderby','rand'); 
				$s4 = ' selected="selected"';
				$s2 = ''; $s3 = ''; $s1 = ''; }
			
			if ($_GET['order_query'] == 'ASC') {
				$wp_query->set('order','ASC');
				$o1 = ' selected="selected"';
				$o2 = '';}
			if ($_GET['order_query'] == 'DESC') { 
				$wp_query->set('order','DESC');
				$o2 = ' selected="selected"';
				$o1 = '';}
			
			if ($_GET['per_page'] == '12') {
				$wp_query->set('posts_per_page',12);
				$p1 = ' selected="selected"';
				$p2 = ''; $p3 = ''; $p4 = ''; }
			if ($_GET['per_page'] == '24') {
				$wp_query->set('posts_per_page',24);
				$p2 = ' selected="selected"';
				$p1 = ''; $p3 = ''; $p4 = '';}			
			if ($_GET['per_page'] == '48') {
				$wp_query->set('posts_per_page',48);
				$p3 = ' selected="selected"';
				$p2 = ''; $p1 = ''; $p4 = '';}
			if ($_GET['per_page'] == '100'){ 
				$wp_query->set('posts_per_page',100);
				$p4 = ' selected="selected"';
				$p2 = ''; $p3 = ''; $p1 = '';}
			
			$wp_query->get_posts(); 
			$found = $wp_query->found_posts;
			$per = $wp_query->get('posts_per_page');
			$rez = $found/($per); 
			if (intval($rez)==0){
				wp_reset_query();
				$wp_query->set('paged',1);
				$wp_query->get_posts();
			}elseif($page>ceil($rez)){
			wp_reset_query();
			$wp_query->set('paged',1);
			$wp_query->get_posts();
			}else{
			$wp_query->set('paged',$page);
			}
		?>
		<div id="filter">
		<form method="get" id="order" class="floatRight">  
			<span>Сортировать по: </span>
			<select name="select" onchange='this.form.submit()'>  
				<option value="title"<?=$s1?>>по заголовку</option>  
				<option value="date"<?=$s2?>>по дате</option>  
				<option value="meta_value_num"<?=$s3?>>по цене</option>  
				<option value="rand"<?=$s4?>>случайно</option>  
			</select>  
			  
			<select name="order_query" class="right15" onchange='this.form.submit()'>  
				<option value="ASC"<?=$o1?>>возрастание</option>  
				<option value="DESC"<?=$o2?>>убывание</option>  
			</select>  
			
			<span>Показать: </span>
			<select name="per_page" onchange='this.form.submit();'>  
				<option value="12"<?=$p1?>>12</option>  
				<option value="24"<?=$p2?>>24</option>  
				<option value="48"<?=$p3?>>48</option>  
				<option value="100"<?=$p4?>>100</option>  
			</select>
			 на странице.
		</form> 
		<div class="clear"></div>
		<div class="bottom20">
			<?php if (function_exists('wp_corenavi')) wp_corenavi(); ?>
		</div>
		<?php wp_reset_query();?>
		<?php while ( have_posts() ) : the_post(); ?>	
			<?php $part_url = get_post_meta($post->ID, 'part_url', true);?>
			<div id="single_wrapper" <?php if ($part_url !=''){echo 'class="partnerka"';}?>>
				<?php if ($part_url !=''){?>
					<div class="partnerka_url" style="display:none"><?php echo $part_url;?></div>
				<?php } ?>
				<?php $thumbnail = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post->ID ),full);
						$thumbnail1 = get_post_meta($post->ID, 'Thumbnail', true);
						$new = get_post_meta($post->ID, 'new', true);
						$old_price = get_post_meta($post->ID, 'old_price', true);
						if( !empty ($thumbnail )){?>
							<div class="img">
								<a href="<?php the_permalink() ?>">
									<img src="<?php echo $thumbnail[0]; ?>" width="200" title="<?php the_title(); ?>" alt="<?php the_title(); ?>"/>
									<?php if($new == 1) echo '<div class="new_label"></div>';?>
									<?php if(!empty($old_price)) echo '<div class="sale_label"></div>'; ?>
								</a>
							</div>
						<?php } elseif(!empty ($thumbnail1)){?>
							<div class="img">
								<a href="<?php the_permalink() ?>">
									<img src="<?php echo $thumbnail1; ?>" width="200" title="<?php the_title(); ?>" alt="<?php the_title(); ?>"/>
									<?php if($new == 1) echo '<div class="new_label"></div>';?>
									<?php if(!empty($old_price)) echo '<div class="sale_label"></div>'; ?>
								</a>
							</div>
						<?php } else {?>
							<div class="img">
								<a href="<?php the_permalink() ?>" class="no_foto_archive">
									<?php if($new == 1) echo '<div class="new_label"></div>';?>
									<?php if(!empty($old_price)) echo '<div class="sale_label"></div>'; ?>
								</a>
							</div>
				<?php } ?>
				
				<h2 class="page_title"><a id="item_title" href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
				<div class="floatRight bottom40">
					<?php if(!empty($old_price)){ ?>
						<div class="floatRight old_price">
							<span class="through"><?php echo $old_price; ?></span> <?php _e( 'старая цена', 'wp-shop' ); ?>
						</div>
					<?php } ?>
					<?php if(is_plugin_active('wp-shop-original/wp-shop.php')) { echo $GLOBALS['wpshop_obj']->GetGoodWidget(); }?>
				</div>
				
				<?php $words = explode(" ",preg_replace("/<img[^>]+\>/i", '',get_formatting_content()));
						$content = implode(" ",array_splice($words,0,40));
						echo '<div class="just clearRight" id="desc">'.$content;?>
						<a href="<?php the_permalink() ?>" class="more"><?php _e( '...', 'wp-shop' ); ?></a></div>
				<div class="clear"></div>
				<?php edit_post_link(__('Редактировать','wp-shop')); ?>
			</div><!--#single_wrapper-->
			
		<?php endwhile; // end of the loop. ?>
		<div class="bottom20">
			<?php if (function_exists('wp_corenavi')) wp_corenavi(); ?>
		</div>
	</div><!--#main-content-->	
</div><!--.main-width-->	
<?php get_footer(); ?>			