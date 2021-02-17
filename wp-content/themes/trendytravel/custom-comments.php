<?php
if ( post_password_required() ) {
	return;
}?>

<?php if(have_comments()): ?>
	
	<?php if(get_comment_pages_count() > 1 && get_option('page_comments')): ?>
    	<div class="pagination">
            <ul class="commentNav">
                <li><?php previous_comments_link(); ?></li>
                <li><?php next_comments_link(); ?></li>
            </ul>
		</div>
	<?php endif; ?>
    
    <div class="reviewentries" id="reviews">
		<h2 class="section-title"><?php comments_number(esc_html__('No Travellers Word', 'trendytravel'), esc_html__('Travellers Word (1)', 'trendytravel'), esc_html__('Travellers Word (%)', 'trendytravel')); ?></h2>
        <div class="reviewlist">
            <?php wp_list_comments('avatar_size=62&type=comment&callback=trendytravel_hotel_comments&style=div'); ?>
        </div>
	</div><?php
	else:
		if('open' == $post->comment_status): ?>
            <h2 class="section-title"><?php esc_html_e('No Travellers Word', 'trendytravel'); ?></h2><?php
		endif;
	endif;
	
	//PERFORMING COMMENT FORM...
	if('open' == $post->comment_status):

		$commenter = wp_get_current_commenter();

		$comment_form = array(
			'title_reply'          => esc_html__('Leave a Review', 'trendytravel'),
			'comment_notes_before' => '',
			'comment_notes_after'  => '',
			'fields'               => array(
				'author' => '<div class="dt-sc-one-half column"><p><input id="author" name="author" type="text" required="" placeholder="'.esc_attr__('Name (required)', 'trendytravel').'" /></p>',
				'email'  => '<p><input id="email" name="email" type="text" required="" placeholder="'.esc_attr__('Email [required]', 'trendytravel').'" /></p>',
				'url' 	 => '<p><input id="url" name="url" type="text" placeholder="'.esc_attr__('Website', 'trendytravel').'" /></p></div>'
			),
			'label_submit'  => esc_html__('Submit Review', 'trendytravel'),
			'logged_in_as'  => '',
			'comment_field' => '',
			'cancel_reply_link' => esc_html__('cancel reply', 'trendytravel')
		);

		$comment_form['comment_field'] = '<div class="dt-sc-one-column column"><p><textarea id="comment" name="comment" placeholder="'.esc_attr__('Message', 'trendytravel').'"></textarea></p></div>';
		
		

		$comment_form['comment_field'] .= '<div class="dt-sc-one-half column first"><p><input type="text" id="profession" name="profession" placeholder="'.esc_attr__('Profession', 'trendytravel').'"></p>
			<p><input type="text" id="title" name="title" required="" placeholder="'.esc_attr__('Title (required)', 'trendytravel').'"></p>
			<p><label for="dt-rating">' . esc_html__( 'Your Rating', 'trendytravel' ) .'</label><select name="rating" id="dt-rating">
			<option value="">' . esc_html__( 'Rate&hellip;', 'trendytravel' ) . '</option>
			<option value="5">' . esc_html__( 'Perfect', 'trendytravel' ) . '</option>
			<option value="4">' . esc_html__( 'Good', 'trendytravel' ) . '</option>
			<option value="3">' . esc_html__( 'Average', 'trendytravel' ) . '</option>
			<option value="2">' . esc_html__( 'Not that bad', 'trendytravel' ) . '</option>
			<option value="1">' . esc_html__( 'Very Poor', 'trendytravel' ) . '</option>
		</select></p></div>';

		comment_form( $comment_form );

	endif; ?>