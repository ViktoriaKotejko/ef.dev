<?php
 /*
Базовый цикл
 */
 ?>
 
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<h1 class="page_title"><?php the_title(); ?></h1>
			<?php the_content(); ?>
			<?php edit_post_link(__('Редактировать','wp-shop')); ?>
<?php endwhile; // end of the loop. ?>
