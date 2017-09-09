<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title>
	<?php
 
		global $page, $paged;
	 
		wp_title( '|', true, 'right' );
	 
		bloginfo( 'name' );
	 
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";
	 
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'starkers' ), max( $paged, $page ) );
 
    ?>
</title>

<?php if(of_get_option('favicon') != ''){ ?>
	<link rel="icon" href="<?php echo of_get_option('favicon', "" ); ?>" type="image/x-icon" />
	<?php } else { ?>
	<link rel="icon" href="<?php bloginfo( 'template_url' ); ?>/favicon.ico" type="image/x-icon" />
<?php } ?>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<script src="<?php bloginfo('template_directory'); ?>/js/jquery-1.8.3.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.cycle.all.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/superfish.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/zoomsl-3.0.min.js"></script>
<script>
	$(window).load(function(){
			var $maxHeight = 0;
			$("#similar_wrap #item_similar").each(function() {
				if (($(this).height() + $(this).find('.price_box').height()) > $maxHeight ) {
					$maxHeight = $(this).height() + $(this).find('.price_box').height();
				}
			});
			$("#similar_wrap #item_similar").height($maxHeight);
	});
	
	$(function(){
		$('#sidebar li.menu-item:has(ul.sub-menu)').addClass('parent_dir');
		$('#sidebar li.cat-item:has(ul.children)').addClass('parent_dir');
		$('#sidebar li.parent_dir > ul').before('<span class="grower"></span>');
		$('.grower').click(function() {
			$(this).toggleClass('bounce');
			$(this).parent('#sidebar li').find('> ul').slideToggle(600);
		});
		
		$('#vitrina .partnerka, #main-content > .partnerka, .table_price > .partnerka, #main-content #filter > .partnerka').each(function() {
			var part = $(this).find('.partnerka_url').text();
			$(this).find('.wpshop_bag .wpshop_buy .line_1 td.wpshop_button').html('<a href="'+part+'" target="_blank"><span><?php _e( 'Купить', 'wp-shop' ); ?></span></a>');
		}); 
		$('.table_price tbody .partnerka').each(function() {
			var part = $(this).find('.partnerka_url').text();
			$(this).find('td.wpshop_buttons .wpshop_bag .wpshop_buy .line_1 td.wpshop_button').html('<a href="'+part+'" target="_blank"><span><?php _e( 'Купить', 'wp-shop' ); ?></span></a>');
		});
		
		$('#footer_menu li:first').addClass('first');
		$('#footer_widget > li:last').addClass('last');
		$('.wpshop_button a').html('<span>Купить</span>');
		$('#banner_wrap .banner_item:last').addClass('last_banner');
		var banner_width = $('#width_meter').width();
		$('#banner_wrap').css('width',banner_width);
		
		$('.main_menu ul.primary > li:first').addClass('first_menu_item');
		$('ul.primary').superfish({delay:600,animation:{opacity:'show',height:'show'},speed:'normal',autoArrows:true,dropShadows:false});
		$('.main_menu ul.primary li:has(ul.sub-menu)').addClass('parent_dir');
		
		$('#slideshow').cycle({ 
								fx:     '<?php echo of_get_option('sl_effect'); ?>', 
								speed:  <?php echo of_get_option('sl_animation_speed'); ?>, 
								timeout: <?php echo of_get_option('sl_pausetime'); ?>, 
								<?php $sl_control_nav = of_get_option('sl_control_nav'); 
								if( $sl_control_nav == 'true') {echo 'pager:\'#nav\',';} ?>	
								<?php $sl_dir_nav = of_get_option('sl_dir_nav'); 
								if( $sl_dir_nav == 'true') {echo 'next:\'#next1\', prev:\'#prev1\',';} ?>
		});
		
		$('#vitrina #item .wpshop_buy, #similar_wrap #item_similar .wpshop_buy, #rotator #item_rotator .wpshop_buy,#rotator_sidebar #slider_rotator .wpshop_buy').each(function() {
			$("tr:first",this).each(function(){
				$(this).addClass('first_price');
			 });
		}); 
		
		$('.wpshop_button a').html('<span>в корзину</span>');
		$('.wpshop_post_block').after('<div class="clear"></div>');
		
		var $c = $('.counter');
		while($c.children('div:not(.row_rotator)').length)
        $c.children('div:not(.row_rotator):lt(4)').wrapAll('<div class="row_rotator">');
		$('.row_rotator').each(function() {
			$("> div:last",this).each(function(){
				$(this).addClass('four');
			 });
		}); 
		
		$('#main-content.narrow #vitrina > div:nth-child(3n+5)').addClass('three');
		$('#main-content.fullwidth #vitrina > div:nth-child(4n+6)').addClass('four');
		$('#main-content .three, #main-content .four').after('<div class="clear"></div>');
		
		$('.single_bread a:last').addClass('last_bread');
		$('.single_bread span:last').addClass('last_arrow');
		
		$('#similar_wrap > div:nth-child(3n)').addClass('three_sim');
		$('.three_sim').after('<div class="clear"></div>');
		
		$('form input#search').addClass('active');
			
		$.fn.clearDefault = function(){
			return this.each(function(){
				var default_value = $(this).val();
				$(this).focus(function(){
					if ($(this).val() == default_value) $(this).val("");
				});
				$(this).blur(function(){
					if ($(this).val() == "") $(this).val(default_value);
				});
			});
		};	
		
		$('form input#search').clearDefault();
		
		var $comment_form = jQuery('form#commentform');
		$comment_form.find('input, textarea').each(function(index,domEle){
			var $et_current_input = jQuery(domEle),
				$et_comment_label = $et_current_input.siblings('label'),
				et_comment_label_value = $et_current_input.siblings('label').text();
			if ( $et_comment_label.length ) {
				$et_comment_label.hide();
				if ( $et_current_input.siblings('span.required') ) { 
					et_comment_label_value += $et_current_input.siblings('span.required').text();
					$et_current_input.siblings('span.required').hide();
				}
				$et_current_input.val(et_comment_label_value);
			}
		}).live('focus',function(){
			var et_label_text = jQuery(this).siblings('label').text();
			if ( jQuery(this).siblings('span.required').length ) et_label_text += jQuery(this).siblings('span.required').text();
			if (jQuery(this).val() === et_label_text) jQuery(this).val("");
		}).live('blur',function(){
			var et_label_text = jQuery(this).siblings('label').text();
			if ( jQuery(this).siblings('span.required').length ) et_label_text += jQuery(this).siblings('span.required').text();
			if (jQuery(this).val() === "") jQuery(this).val( et_label_text );
		});

		$comment_form.find('input#submit').click(function(){
			if (jQuery("input#url").val() === jQuery("input#url").siblings('label').text()) jQuery("input#url").val("");
		});
		
		$(".back_to_top").hide();
		
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('.back_to_top').fadeIn();
			} else {
				$('.back_to_top').fadeOut();
			}
		});
		
		$('.back_to_top a').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
		
		$(".container").imagezoomsl({ 
			zoomrange: [1.68, 3],
			zoomstart: 1.68,
			cursorshadeborder: "5px solid black",
			magnifiereffectanimate: "fadeIn",	
		});
		
		$(".thumb_img img").click(function(){
			var that = this;
			$(".container").fadeOut(600, function(){
				$(this).attr("src", 	   $(that).attr("src"))
				.attr("data-large", $(that).attr("data-tmb-large"))
				.fadeIn(1000);				
			});
			return false;

		});
		
		$('#galery_wrapp > div:nth-child(4n+6)').addClass('four_img');
		
	});
</script>

<style type="text/css">
		
		<?php $background = of_get_option('body_background');
			if ($background != '') {
				if ($background['image'] != '') {
					echo 'body { background-image:url('.$background['image']. '); background-repeat:'.$background['repeat'].'; background-position:'.$background['position'].';  background-attachment:'.$background['attachment'].'; }';
				}
				if($background['color'] != '') {
					echo 'body { background-color:'.$background['color']. ';}';
				}
			};
		?>
		
		<?php $header_styling = of_get_option('header_color'); 
			if($header_styling != '') {
				echo '#header {background-color:'.$header_styling.'}';
			}
		?>
		
		<?php $links_styling = of_get_option('links_color'); 
			if($links_styling) {
				echo 'a{color:'.$links_styling.'}';
				echo '.button {background:'.$links_styling.'}';
				echo 'input#submit, #commentform input#submit, #slider_desc a.button {background:'.$links_styling.'}';
			}
		?>

</style>

<?php if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) wp_enqueue_script('comment-reply'); ?>
<?php wp_head();?>

</head>
<body>
	<?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); ?>
	<div id="page-wrap">
	
		<div id="header">
      <?php $full_path=get_option("wpshop.cartpage",'{sitename}/cart');?>
			<a href="<?php echo $full_path;?>" class="cart_link">
				<div id="wpshop_minicart"></div>
			</a>
		
			<?php   wp_nav_menu( 
							array( 
									'container' => '',
									'fallback_cb' => 'false',
									'theme_location' => 'footer',
									'menu_id' => 'footer_menu',
									'menu_class' => '',
									'depth' => 2
								)	   
				);
			?>
			
			<div id="gray_line" class="relat floatLeft"></div>
			
			<div class="clear"></div>
			
			<div class="logo floatLeft relat">
				<?php if(of_get_option('logo_type') == 'text_logo'){?>
					<div id="height_metter" class="relat">
						<a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('description'); ?>"><h1 id="blog_title"><?php bloginfo('name'); ?></h1></a>
						<p class="description"><?php bloginfo('description'); ?></p>
					</div>	
				<?php } else { ?>
					<?php if(of_get_option('logo_url') != ''){ ?>
						<a href="<?php bloginfo('url'); ?>/" id="logo"><img src="<?php echo of_get_option('logo_url', "" ); ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('description'); ?>"></a>
					<?php } else { ?>
						<a href="<?php bloginfo('url'); ?>/" id="logo"><img src="<?php bloginfo('template_url'); ?>/images/logo.jpg" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('description'); ?>"></a>
					<?php } ?>
				<?php }?>
			</div>	
			
			<?php get_search_form(); ?>
			
			<div id="gray_line" class="relat floatLeft"></div>
			
						
			<div class="main_menu floatLeft">	
				<?php  	wp_nav_menu( 
									array( 
									'container'       => '',
									'fallback_cb' => 'false',
									'theme_location' => 'primary',
									'menu_id' => '',
									'menu_class' => 'primary',
									'depth' => 3
									)	   
						);
				?>
			</div>
		
		</div><!--#header-->	
		
		<div class="clear"></div>
		