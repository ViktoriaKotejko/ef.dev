<?php
/*
 * Template Name: Custom Home Page
 * Description: A home page with featured slider and widgets.
 *
 * @package Bota
 * @since Bota 1.0
 */

get_header(); ?>

	<div class="flex-container">
              <div class="flexslider">
                <ul class="slides">
                <?php
                query_posts(array('category_name' => 'featured', 'posts_per_page' => 3));
                if(have_posts()) :
                    while(have_posts()) : the_post();
                ?>
                  <li>
                    <a href="<? the_permalink() ?>" title=" <? the_title() ?>"><?php the_post_thumbnail(); ?></a>
                  </li>
                <?php
                    endwhile;
                endif;
                wp_reset_query();
                ?>
                </ul>
              </div>
	</div>

        <div id="primary" class="content-area">
			<div id="content" class="fullwidth" role="main">

   <div class="section group">
	<div class="col span_1_of_3">
    <div class="featuretext">
        <?php if ( is_active_sidebar( 'mainbox1' ) && dynamic_sidebar('mainbox1') ) : endif ?>
	</div>
    </div>

    <div class="col span_1_of_3">
     <div class="featuretext">
         <?php if ( is_active_sidebar( 'mainbox2' ) && dynamic_sidebar('mainbox2') ) : endif ?>
	</div>
    </div>

   <div class="col span_1_of_3">
     <div class="featuretext">
         <?php if ( is_active_sidebar( 'MainBox3' ) && dynamic_sidebar('MainBox3') ) : endif ?>
	</div>
    </div>

    </div>


			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<?php get_footer(); ?>