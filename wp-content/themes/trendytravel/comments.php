<?php
if ( post_password_required() ) {
	return;
}?>

<div id="comments" class="comments-area"><?php
	if ( have_comments() ) : ?>

	    <h3><?php comments_number(esc_html__('No Comments','trendytravel'), esc_html__('Comment ( 1 )','trendytravel'), esc_html__('Comments ( % )','trendytravel') ); ?></h3>

		<?php the_comments_navigation(); ?>

        <ul class="commentlist">
     		<?php wp_list_comments( array( 'callback' => 'trendytravel_comment_style' ) ); ?>
        </ul>

        <?php the_comments_navigation();

    endif;

	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
        <p class="nocomments"><?php esc_html_e( 'Comments are closed.','trendytravel'); ?></p><?php
    endif;

    $fields =  array(
        "author" => "<div class='column dt-sc-one-half'><p><input id='author' name='author' type='text' placeholder='".esc_attr__("Name *","trendytravel")."' required /></p>",
        "email"  => "<p><input id='email' name='email' type='text' placeholder='".esc_attr__("Email *","trendytravel")."' required /></p>",
        "url"  => "<p><input id='url' name='url' type='text' placeholder='".esc_attr__("Website","trendytravel")."'></p></div>",
    );

    $comment_field = '<div class="column dt-sc-one-half first"><p><textarea id="comment" name="comment" cols="5" rows="3" placeholder="'.esc_attr__("Message","trendytravel").'" ></textarea></p></div>';

    function dt_move_comment_field_to_bottom( $fields ) {

        if( cs_get_option('privacy-commentform') == "true" ) {

            $content = do_shortcode( cs_get_option('privacy-commentform-msg') );
    
            $fields['comment-form-dt-privatepolicy'] = '<p class="comment-form-dt-privatepolicy">
                <input id="comment-form-dt-privatepolicy" name="comment-form-dt-privatepolicy" type="checkbox" value="yes">
                <label for="comment-form-dt-privatepolicy">'.$content.'</label> </p>';
        }

        return $fields;
    }
     
   add_filter( 'comment_form_fields', 'dt_move_comment_field_to_bottom' );

    
    ?>

	<!-- Comment Form -->
	<?php if ('open' == $post->comment_status) : 
            
                $comments_args = array(
                    'title_reply' => esc_html__( 'GIVE A REPLY','trendytravel' ),
                    'fields'      => $fields,
                    'comment_field'=> $comment_field,
                    'comment_notes_before'=>'','comment_notes_after'=>'','label_submit'=>esc_html__('Submit Comment','trendytravel'));     
                    

	comment_form($comments_args); ?>
    <?php endif; ?>