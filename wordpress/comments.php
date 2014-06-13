<?php

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<?php _e('This post is password protected. Enter the password to view comments.','replaceme'); ?>
	<?php
		return;
	}
?>

<?php if ( have_comments() ) : ?>
	
	<h2 id="comments"><?php comments_number('No Responses', 'One Response', '% Responses' );?></h2>

	<div class="navigation">
		<div class="next-posts"><?php previous_comments_link() ?></div>
		<div class="prev-posts"><?php next_comments_link() ?></div>
	</div>

	<ol class="commentlist">
		<?php wp_list_comments(); ?>
	</ol>

	<div class="navigation">
		<div class="next-posts"><?php previous_comments_link() ?></div>
		<div class="prev-posts"><?php next_comments_link() ?></div>
	</div>
	
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<p><?php _e('Comments are closed.','replaceme'); ?></p>

	<?php endif; ?>
	
<?php endif; ?>

<?php if ( comments_open() ) : ?>

<div id="respond">

	<h4><?php comment_form_title( 'Leave a Reply', 'Leave a Reply to %s' ); ?></h4>

	<div class="cancel-comment-reply">
		<?php cancel_comment_reply_link(); ?>
	</div>

	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<p><?php _e('You must be','replaceme'); ?> <a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php _e('logged in','replaceme'); ?></a> <?php _e('to post a comment.','replaceme'); ?></p>
	<?php else : ?>

	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

		<?php if ( is_user_logged_in() ) : ?>

			<p><?php _e('Logged in as','replaceme'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account"><?php _e('Log out','replaceme'); ?> &raquo;</a></p>

		<?php else : ?>

			<div>
            	<label for="author"><?php _e('Name','replaceme'); ?> <?php if ($req) echo "(required)"; ?></label>
				<input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="56" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
				
			</div>

			<div>
            	<label for="email"><?php _e('E-mail (will not be published)','replaceme'); ?> <?php if ($req) echo "(required)"; ?></label>
				<input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="56" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
				
			</div>

			<div>
            	<label for="url"><?php _e('Website','replaceme'); ?></label>
				<input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="56" tabindex="3" />
				
			</div>

		<?php endif; ?>

		<!--<p>You can use these tags: <code><?php echo allowed_tags(); ?></code></p>-->

		<div>
        	<label for="comment"><?php _e('Your Message','replaceme'); ?></label>
			<textarea name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea>
		</div>

		<div>
			<input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" class="btn btn-teal" />
			<?php comment_id_fields(); ?>
		</div>
		
		<?php do_action('comment_form', $post->ID); ?>

	</form>

	<?php endif; // If registration required and not logged in ?>
	
</div>

<?php endif; ?>
