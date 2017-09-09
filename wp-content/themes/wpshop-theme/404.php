<?php
 /*
 Шаблон страницы 404
 */
 ?>
 
<?php get_header(); ?>

	<?php get_sidebar(); ?>
	<div id="main-content" class="narrow archive">
		<h1 class="page_title"><?php _e( 'Страница не найдена', 'wp-shop' ); ?></h1>
		<p><?php _e( 'Извините, но страница, которую вы запросили, не найдена. Возможно, поиск поможет.', 'wp-shop' ); ?></p>
	</div><!--#main-content-->	
	
<?php get_footer(); ?>