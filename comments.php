<?php
	if( ! empty( $_SERVER[ 'SCRIPT_FILENAME' ] ) && 'comments.php' == basename( $_SERVER[ 'SCRIPT_FILENAME' ] ) )
	die('please do not load this page directly kind sir');
?>

<section class="comments">
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><b class="ss-icon ss-lock"></b><?php echo( 'This post is password protected. Enter the password to view any comments.' ); ?></p>
		<?php return; ?>
	<?php endif; ?>

	<!-- begin comment count -->
	<div id="comment-count">
		<?php if ( have_comments() ) : ?>
			<h3 id="comments-title"><b class="ss-icon">comment</b> <?php printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number() ), number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' ); ?></h3>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // check if there comments to navigate through ?>
			<div class="pagination comment-pagination">
				<span class="prev-comments-link"><?php previous_comments_link( '<span>&larr; older comments</span>' ); ?></span>
				<span class="nxt-comments-link"><?php next_comments_link( '<span>newer comments &rarr;</span>' ); ?></span>
			</div>
		<?php endif; //end check for comment navigation ?>
	</div>
	<!-- end comment count -->

	<!-- comment list -->
	<ol class="commentlist">
		<?php
		//comment array
		//see developer docs http://codex.wordpress.org/Function_Reference/wp_list_comments
		$wpflex_comment_array = array(
										'walker'            => null,
										'max_depth'         => '',
										'style'             => 'ol',
										'callback'          => 'wpflex_comments',
										'end-callback'      => null,
										'type'              => 'comment',
										'reply_text'        => 'shout back <b class="ss-icon">&#x21A9;</b>',
										'page'              => '',
										'per_page'          => '',
										'reverse_top_level' => false,
										'reverse_children'  => false,
									); ?>

		<?php wp_list_comments( $wpflex_comment_array ); ?>
	</ol><!-- end comment list -->

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<div class="pagination comment-pagination">
			<span class="prev-comments-link"><?php previous_comments_link( '<span>&larr; older comments</span>' ); ?></span>
			<span class="nxt-comments-link"><?php next_comments_link( '<span>newer comments &rarr;</span>' ); ?></span>
		</div><!-- end/ div.comment-pagination -->
	<?php endif; // check for comment navigation ?>
	<?php else :
		//If there are no comments and comments are closed,
		//let's leave a little note, shall we?
		if ( ! comments_open() ) : ?>
			<p class="nocomments"><span class="ss-icon" style="display:block">&#x1F512;</span><?php echo( 'Comments are closed bro. You\'re way late.' ); ?></p>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ( comments_open() ) : ?>
		<?php comment_form(); ?>
	<?php endif; ?>
</section>
<!-- end /section.comments -->