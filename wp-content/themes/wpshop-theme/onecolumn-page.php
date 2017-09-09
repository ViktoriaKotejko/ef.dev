<?php
/*
 Template Name: На всю ширину страницы без сайдбара
 */

get_header(); ?>
 <div class="main-width">
<div id="main-content" class="fullwidth">
	<?php get_template_part( 'loop', 'page' ); ?>
</div>
</div><!--.main-width-->
<?php get_footer(); ?>