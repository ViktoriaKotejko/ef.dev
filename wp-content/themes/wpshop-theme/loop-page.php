<?php
 /*
Цикл для отображения содержимого страицы
 */
 ?>
 


<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<h1 class="page_title"><?php the_title(); ?></h1>
	<div id="desc">
		<?php the_content(); ?>
	<?php edit_post_link(__('Редактировать','wp-shop')); ?>
	</div>	
	<div class="clear bottom20"></div>
	<div id="comments_bar"><?php comments_template('', true); ?></div>
<?php endwhile; // end of the loop. ?>
