<?php
 /*
 Шаблон отображения корзины и вариантов оплаты
 */
 ?>
 <?php get_sidebar(); ?>
 <?php while ( have_posts() ) : the_post(); ?>
	<div id="main-content" class="narrow">
		<div class="load">
			<h1 class="page_title"><?php the_title(); ?></h1>
			<div class="clear"></div>
			<?php the_content(); ?>
		</div>
	</div><!--#main-content-->	

<?php endwhile; // end of the loop. ?>