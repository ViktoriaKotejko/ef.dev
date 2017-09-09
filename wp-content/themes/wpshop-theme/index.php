<?php
 /*
Основной шаблон
 */
 ?>

<?php get_header(); ?>
 <div class="main-width">
<?php get_sidebar(); ?>
<div id="main-content" class="narrow">
	<?php get_template_part( 'loop', 'page' ); ?>
</div>
</div><!--.main-width-->
<?php get_footer(); ?>