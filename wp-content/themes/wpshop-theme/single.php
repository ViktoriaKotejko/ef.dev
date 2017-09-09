<?php
 /*
 Шаблон отображения одиночной записи
 */
 ?>
 
<?php get_header(); ?>
	<div class="main-width">
	<?php if( get_post_type() != 'post' ){ include  ('shop_post.php'); 
		} else {?>
			<?php get_template_part( 'content', get_post_format() ); ?>
		<?php } ?>
	</div><!--.main-width-->	
<?php get_footer(); ?>

