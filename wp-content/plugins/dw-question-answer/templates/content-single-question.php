<?php
/**
 * The template for displaying single questions
 *
 * @package DW Question & Answer
 * @since DW Question & Answer 1.4.0
 */
?>

<?php do_action( 'dwqa_before_single_question_content' ); ?>
<div class="dwqa-question-item">
	<div class="dwqa-question-vote" data-nonce="<?php echo wp_create_nonce( '_dwqa_question_vote_nonce' ) ?>" data-post="<?php the_ID(); ?>">
		<span class="dwqa-vote-count"><?php echo dwqa_vote_count() ?></span>
		<a class="dwqa-vote dwqa-vote-up" href="#"><?php _e( 'Vote Up', 'dwqa' ); ?></a>
		<a class="dwqa-vote dwqa-vote-down" href="#"><?php _e( 'Vote Down', 'dwqa' ); ?></a>
	</div>
	<div class="dwqa-question-meta">
		<?php $user_id = get_post_field( 'post_author', get_the_ID() ) ? get_post_field( 'post_author', get_the_ID() ) : false ?>
		<?php printf( __( '<span><a href="%s">%s%s</a> %s asked %s ago</span>', 'dwqa' ), dwqa_get_author_link( $user_id ), get_avatar( $user_id, 48 ), dwqa_get_author(),  dwqa_print_user_badge( $user_id ), human_time_diff( get_post_time( 'U' ) ) ) ?>
		<span class="dwqa-question-actions"><?php dwqa_question_button_action() ?></span>
	</div>
	<div class="dwqa-question-content"><?php the_content(); ?></div>
	<footer class="dwqa-question-footer">
		<div class="dwqa-question-meta">
			<?php echo get_the_term_list( get_the_ID(), 'dwqa-question_tag', '<span class="dwqa-question-tag">' . __( 'Question Tags: ', 'dwqa' ), ', ', '</span>' ); ?>
			<?php if ( dwqa_current_user_can( 'edit_question', get_the_ID() ) ) : ?>
			<span class="dwqa-question-status">
				<?php _e( 'This question is:', 'dwqa' ) ?>
				<select id="dwqa-question-status" data-nonce="<?php echo wp_create_nonce( '_dwqa_update_privacy_nonce' ) ?>" data-post="<?php the_ID(); ?>">
					<optgroup label="Status">
						<option <?php selected( dwqa_question_status(), 'open' ) ?> value="open"><?php _e( 'Open', 'dwqa' ) ?></option>
						<option <?php selected( dwqa_question_status(), 'close' ) ?> value="close"><?php _e( 'Closed', 'dwqa' ) ?></option>
						<option <?php selected( dwqa_question_status(), 'resolved' ) ?> value="resolved"><?php _e( 'Resolved', 'dwqa' ) ?></option>
					</optgroup>
				</select>
				</span>
			<?php endif; ?>
		</div>
	</footer>
	<?php comments_template(); ?>
</div>
<?php do_action( 'dwqa_after_single_question_content' ); ?>
