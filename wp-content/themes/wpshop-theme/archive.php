<?php
 /*
 Шаблон архива
 */
 ?>
 
<?php get_header(); ?>
<div class="main-width">
	<?php get_sidebar(); ?>
	<div id="main-content" class="narrow archive">
				
		<h1 class="page_title">
			<?php if ( is_day() ) : ?>
							<?php printf( __( 'Архив по дате: %s', 'wp-shop' ), get_the_date() ); ?>
			<?php elseif ( is_month() ) : ?>
							<?php printf( __( 'Архив по месяцу: %s', 'wp-shop' ), get_the_date('F Y') ); ?>
			<?php elseif ( is_year() ) : ?>
							<?php printf( __( 'Архив по году: %s', 'wp-shop' ), get_the_date('Y') ); ?>
			<?php else : ?>
							<?php _e( 'Архив', 'wp-shop' ); ?>
			<?php endif; ?>
		</h1>
		<div class="clear"></div>
		<div class="bottom20">
			<?php if (function_exists('wp_corenavi')) wp_corenavi(); ?>
		</div>
		<?php wp_reset_query();?>
		<?php while ( have_posts() ) : the_post(); ?>	
			<div id="single_wrapper">
								
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