<?php
 /*
 Шаблон вывода комментариев
 */
 ?>

<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (__('Пожалуйста, не загружайте этой страницы напрямую. Спасибо!','wp-shop'));

	if ( post_password_required() ) { ?>

<p class="nocomments"><?php _e('Это сообщение защищено паролем. Введите пароль для просмотра комментариев.','wp-shop') ?></p>
<?php
		return;
	}
?>
<!-- You can start editing here. -->

<div id="comment-wrap" class="clearfix">

	<?php if ( have_comments() ) : ?>
		
		<h3 id="comments" class="main-title"><?php comments_number(__('Нет комментариев','wp-shop'), __('Один комментарий','wp-shop'), '% '. __('комментариев','wp-shop') );?></h3>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation clearfix">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Старые комментарии', 'wp-shop' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Новые комментарии <span class="meta-nav">&rarr;</span>', 'wp-shop' ) ); ?></div>
			</div> <!-- .navigation -->
		<?php endif; // check for comment navigation ?>
		
		<?php if ( ! empty($comments_by_type['comment']) ) : ?>
			<ol class="commentlist clearfix">
				<?php wp_list_comments( array('type'=>'comment','callback'=>'et_custom_comments_display') ); ?>
			</ol>
		<?php endif; ?>
		
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation clearfix">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Старые комментарии', 'wp-shop' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Новые комментарии <span class="meta-nav">&rarr;</span>', 'wp-shop' ) ); ?></div>
			</div> <!-- .navigation -->
		<?php endif; // check for comment navigation ?>
			
		<?php if ( ! empty($comments_by_type['pings']) ) : ?>
		<div id="trackbacks">
			<h3 id="comments"><?php _e('Отзывы','wp-shop') ?></h3>
			<ol class="pinglist">
				<?php wp_list_comments('type=pings&callback=et_list_pings'); ?>
			</ol>
		</div>
		<?php endif; ?>	
	<?php else : // this is displayed if there are no comments so far ?>
	   <div id="comment-section" class="nocomments">
		  <?php if ('open' == $post->comment_status) : ?>
			 <!-- If comments are open, but there are no comments. -->
			 
		  <?php else : // comments are closed ?>
			 <!-- If comments are closed. -->
				<div id="respond">
				   
				</div> <!-- end respond div -->
		  <?php endif; ?>
	   </div>
	<?php endif; ?>
	
	<?php comment_form( array('label_submit' => __( 'Отправить', 'wp-shop' ), 
			'title_reply' => __( 'Оставить комментарий', 'wp-shop' ),
			'title_reply_to' => __( 'Ответить на %s' , 'wp-shop' ),
			'comment_notes_after' => '',
			'fields' => apply_filters( 'comment_form_default_fields', array(
				'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Имя', 'wp-shop' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
				'email' => '<p class="comment-form-email"><label for="email">' . __( 'E-mail', 'wp-shop' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>' 
				)
			)
	));?>
	
</div>