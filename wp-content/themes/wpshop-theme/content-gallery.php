<?php
 /*
 Цикл одиночной записи с галереей
 */
 ?>
 <?php $category = get_the_category( $post->ID);?>
<div class="single_bread"><?php echo is_wp_error( $cat_parents = get_category_parents($category[0]->cat_ID, TRUE, '<span> >> </span>') ) ? '' : $cat_parents;?></div>		
<div class="clear"></div>
<?php get_sidebar(); ?>
<div id="main-content" class="narrow">

	<?php wp_reset_query();
	while ( have_posts() ) : the_post(); ?>
	
	<?php $posttags = get_the_tags();?>	

	
	<div id="single_wrapper">
	
		<div id="galery_wrapp">
		<?php $thumbnail = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post->ID ),full);
			$thumbnail1 = get_post_meta($post->ID, 'Thumbnail', true);
			$thumbnail2 = get_post_meta($post->ID, 'Thumbnail1', true);
			$thumbnail3 = get_post_meta($post->ID, 'Thumbnail2', true);
			$thumbnail4 = get_post_meta($post->ID, 'Thumbnail3', true);
			$thumbnail5 = get_post_meta($post->ID, 'Thumbnail4', true);
			$thumbnail6 = get_post_meta($post->ID, 'Thumbnail5', true);
			$thumbnail7 = get_post_meta($post->ID, 'Thumbnail6', true);
			$thumbnail8 = get_post_meta($post->ID, 'Thumbnail7', true);
			$new = get_post_meta($post->ID, 'new', true);
			$old_price = get_post_meta($post->ID, 'old_price', true);
			$similar_products = get_post_meta($post->ID, 'similar_products', true);
			$similar_tag_name = get_post_meta($post->ID, 'similar_tag_name', true);
			if( !empty ($thumbnail )){?>
				<div class="main_img">
					<img class="container" src="<?php echo $thumbnail[0]; ?>" width="340" title="<?php the_title(); ?>" alt="<?php the_title(); ?>"/>
				</div>
				<?php } elseif(!empty ($thumbnail1)){?>
					<div class="main_img">
						<img class="container" src="<?php echo $thumbnail1; ?>"  width="340" title="<?php the_title(); ?>" alt="<?php the_title(); ?>"/>
					</div>
				<?php } else {?>
					<div class="main_img">
						<a class="no_foto"></a>
					</div>
			<?php } ?>
			<div class="clear"></div>
			<?php if( !empty ($thumbnail )||!empty ($thumbnail1)){?>
				<?php if( !empty ($thumbnail )){?>
					<div class="thumb_img">
						<img src="<?php echo $thumbnail[0]; ?>" data-tmb-large="<?php echo $thumbnail[0];?>" width="79" />
					</div>
				<?php } elseif(!empty ($thumbnail1)){?>
						<div class="thumb_img">
							<img src="<?php echo $thumbnail1; ?>" data-tmb-large="<?php echo $thumbnail1; ?>"  width="79" />
						</div>
					<?php } ?>
				<?php/*  $args = array(
						'post_type'   => 'attachment',
						'numberposts' => -1,
						'post_status' => null,
						'post_parent' => $post->ID,
						'exclude'     => get_post_thumbnail_id()
					);

				$attachments = get_posts( $args );

				if ( $attachments ) {
					foreach ( $attachments as $attachment ) { 
						$attach_src = wp_get_attachment_image_src( $attachment->ID, full);
						$attach_src_tumb = wp_get_attachment_image_src( $attachment->ID, thumbnail);
						echo '<div class="thumb_img"><img src="'.$attach_src_tumb[0] .'" alt="" data-tmb-large="'.$attach_src[0].'" width="79" /></div>';
					}
				} */?>
				
				<?php if( !empty ($thumbnail2 )){?>
					<div class="thumb_img">
						<img src="<?php echo $thumbnail2; ?>" data-tmb-large="<?php echo $thumbnail2;?>" width="79" />
					</div>
				<?php } ?>
				
				<?php if( !empty ($thumbnail3 )){?>
					<div class="thumb_img">
						<img src="<?php echo $thumbnail3; ?>" data-tmb-large="<?php echo $thumbnail3;?>" width="79" />
					</div>
				<?php } ?>
				
				<?php if( !empty ($thumbnail4 )){?>
					<div class="thumb_img">
						<img src="<?php echo $thumbnail4; ?>" data-tmb-large="<?php echo $thumbnail4;?>" width="79" />
					</div>
				<?php } ?>
				
				<?php if( !empty ($thumbnail5 )){?>
					<div class="thumb_img">
						<img src="<?php echo $thumbnail5; ?>" data-tmb-large="<?php echo $thumbnail5;?>" width="79" />
					</div>
				<?php } ?>
				
				<?php if( !empty ($thumbnail6 )){?>
					<div class="thumb_img">
						<img src="<?php echo $thumbnail6; ?>" data-tmb-large="<?php echo $thumbnail6;?>" width="79" />
					</div>
				<?php } ?>
				
				<?php if( !empty ($thumbnail7 )){?>
					<div class="thumb_img">
						<img src="<?php echo $thumbnail7; ?>" data-tmb-large="<?php echo $thumbnail7;?>" width="79" />
					</div>
				<?php } ?>
				
				<?php if( !empty ($thumbnail8 )){?>
					<div class="thumb_img">
						<img src="<?php echo $thumbnail8; ?>" data-tmb-large="<?php echo $thumbnail8;?>" width="79" />
					</div>
				<?php } ?>
				
			<?php } ?>
		</div><!--#galery_wrapp-->
		
		<h2 class="page_title"><?php the_title(); ?></h2>
		<?php $part_url = get_post_meta($post->ID, 'part_url', true);?>
		
		<script>
			$(function(){
				var part = '<?php echo $part_url;?>';
				if(part !='') {
					$('#single_wrapper > div > .wpshop_bag .wpshop_buy td.wpshop_button').html('<a href="'+part+'" target="_blank"><span><?php _e( 'Купить', 'wp-shop' ); ?></span></a>');
				}
						
			});
		</script>	
		<div class="floatRight bottom40">
			<?php if(!empty($old_price)){ ?>
				<div class="floatRight old_price">
					<span class="through"><?php echo $old_price; ?></span> <?php _e( 'старая цена', 'wp-shop' ); ?>
				</div>
			<?php } ?>
			<?php if(is_plugin_active('wp-shop-original/wp-shop.php')) { echo $GLOBALS['wpshop_obj']->GetGoodWidget(); }?>
		</div>
		
		<div id="desc" class="just clearRight">	
			<?php the_content(); ?>
		</div>
		
		<?php edit_post_link(__('Редактировать','wp-shop')); ?>
	<?php endwhile; // end of the loop. ?>
	<?php if($similar_products == 1) {?>
		<div class="clear bottom40"></div>
		<h2 class="page_title"><?php _e( 'Похожие товары:', 'wp-shop' ); ?></h2>
		<?php 	$tag_ids = '';
			$arg ['orderby'] = 'rand';
			$arg ['order'] = 'DESC';
			$arg ['post_status'] = 'publish';
			$arg ['showposts'] = 3;
			$arg ['post__not_in'] = array($post->ID);
		if ( !empty($similar_tag_name) ) {	
			$arg ['tag'] = $similar_tag_name;
		} else {
			if ( !empty($posttags) ) { 
				$count=0;
				foreach($posttags as $tag) {
					$count++;
					if ($count !=1) {$tag_ids .= ',';}
					$tag_ids .= $tag->term_id;
				}
				$arg ['tag__in'] = array($tag_ids);
			} else { $arg ['cat'] = $category[0]->cat_ID;}
		}	
		?>	
			<div id="similar_wrap">
				<?php wp_reset_postdata();
				global $wp_query;
				$wp_query = new WP_Query($arg);?>	
					<?php if ($wp_query->have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
						<div id="item_similar">
							<?php $thumbnail = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post->ID ),full);
							$thumbnail1 = get_post_meta($post->ID, 'Thumbnail', true);
							$new = get_post_meta($post->ID, 'new', true);
							$old_price = get_post_meta($post->ID, 'old_price', true);
							if( !empty ($thumbnail )){?>
								<div class="img">
									<a href="<?php the_permalink() ?>">
										<img src="<?php echo $thumbnail[0]; ?>" width="210" title="<?php the_title(); ?>" alt="<?php the_title(); ?>"/>
										<?php if($new == 1) echo '<div class="new_label"></div>';?>
										<?php if(!empty($old_price)) echo '<div class="sale_label"></div>'; ?>
									</a>
								</div>
							<?php } elseif(!empty ($thumbnail1)){?>
								<div class="img">
									<a href="<?php the_permalink() ?>">
										<img src="<?php echo $thumbnail1; ?>" width="210" title="<?php the_title(); ?>" alt="<?php the_title(); ?>"/>
										<?php if($new == 1) echo '<div class="new_label"></div>';?>
										<?php if(!empty($old_price)) echo '<div class="sale_label"></div>'; ?>
									</a>
								</div>
							<?php } else {?>
								<div class="img">
									<a href="<?php the_permalink() ?>" class="no_foto_simm">
										<?php if($new == 1) echo '<div class="new_label"></div>';?>
										<?php if(!empty($old_price)) echo '<div class="sale_label"></div>'; ?>
									</a>
								</div>
							<?php } ?>
							
							<a id="item_title" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
																					
							<div class="clear"></div>
							
							<div class="price_box">
								<?php if(!empty($old_price)){ ?>
									<div class="floatLeft old_price">
										<span class="through"><?php echo $old_price; ?></span> <?php _e( 'старая цена', 'wp-shop' ); ?>
									</div>
									<div class="highlite_price"><?php if(is_plugin_active('wp-shop-original/wp-shop.php')) { echo $GLOBALS['wpshop_obj']->GetGoodWidget(); }?></div>
								<?php } else {?>
									<?php if(is_plugin_active('wp-shop-original/wp-shop.php')) { echo $GLOBALS['wpshop_obj']->GetGoodWidget(); }?>
								<?php } ?>	
							</div>
							
							<?php edit_post_link(__('Редактировать','wp-shop')); ?>
							
						</div><!--#item-->
					<?php endwhile; else: // end of the loop. ?>
						<h2><?php _e( 'По данным критериям товаров не найдено', 'wp-shop' ); ?></h2>
					<?php endif;  ?>
			</div>		
		<?php } ?>			
	</div><!--#single_wrapper-->				
	<div class="clear"></div>
	<?php wp_reset_query(); ?>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<div id="comments_bar"><?php comments_template( '', true ); ?></div>
	<?php endwhile; // end of the loop. ?>
	<?php endif; // end of the loop. ?>
	<div class="clear bottom40"></div>	
</div><!--#main-content-->