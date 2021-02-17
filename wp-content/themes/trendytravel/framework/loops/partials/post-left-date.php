<?php
	global $post;

	$show_format_meta = cs_get_option( 'post-format-meta' );
	$show_format_meta = !empty( $show_format_meta ) ? "" : "hidden";

	$show_author_meta = cs_get_option( 'post-author-meta' );
	$show_author_meta = !empty( $show_author_meta ) ? "" : "hidden";

	$show_date_meta = cs_get_option( 'post-date-meta' );
	$show_date_meta = !empty( $show_date_meta ) ? "" : "hidden";	

	$show_comment_meta = cs_get_option( 'post-comment-meta' );
	$show_comment_meta = !empty( $show_comment_meta ) ? "comments " : "comments hidden";

	$show_category_meta = cs_get_option( 'post-category-meta' );
	$show_category_meta = !empty( $show_category_meta ) ? "" : "hidden";

	$show_tag_meta = cs_get_option( 'post-tag-meta' );
	$show_tag_meta = !empty( $show_tag_meta ) ? "" : "hidden";

	$post_meta = get_post_meta($post->ID, '_dt_post_settings', TRUE);
	$post_meta = is_array($post_meta) ? $post_meta : array();
	
	$format = !empty( $post_meta['post-format-type'] ) ? $post_meta['post-format-type'] : 'standard'; ?>
    
        <div class="entry-meta">
                <!-- Entry Format -->
            <div class="entry-format <?php echo esc_attr($show_format_meta);?>">
                <a class="ico-format" href="<?php echo esc_url(get_post_format_link( $format ));?>"></a>
            </div><!-- Entry Format -->    

            <div class="date <?php echo esc_attr( $show_date_meta );?>">
            <span><?php echo get_the_date('d');?></span>
                <p><?php echo get_the_date('M');?><br><?php echo get_the_date('Y');?></p>
            </div>
            <div class="entry_format">  <a class="ico-format" href="<?php the_permalink();?>" title="<?php printf(esc_attr__('%s','trendytravel'),the_title_attribute('echo=0'));?>" class="entry_format"> </a></div>
        </div>
    <!-- Featured Image -->
    <div class="entry-thumb">
        <div class="blog-image">
            <?php get_template_part( 'framework/loops/partials/entry', 'thumb' ); ?>
            <div class="image-overlay"><span class="image-overlay-inside"></span></div>
        </div>
    </div><!-- Featured Image -->
    
    <!-- Entry Details -->
    <div class="entry-details">
         <div class="entry-title">
        	<h4><a href="<?php the_permalink();?>" title="<?php printf( esc_attr__('Permalink to %s','trendytravel'), the_title_attribute('echo=0'));?>"><?php the_title(); ?></a></h4>
    	</div>

        <div class="author <?php echo esc_attr( $show_author_meta );?>"><i class="fa fa-user"> </i> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" title="<?php esc_attr_e('View all posts by ', 'trendytravel'); echo get_the_author();?>"><?php echo get_the_author();?></a></div>
                
        <div class="comments <?php echo esc_attr($show_comment_meta);?>"><?php  if( ! post_password_required() ) {
                comments_popup_link( '<i class="fa fa-comment"> </i>'.esc_html__(' 0','trendytravel'), '<i class="fa fa-comment"> </i>'.esc_html__(' 1','trendytravel'),
          '<i class="fa fa-comment"> </i> % ', $show_comment_meta, '<i class="fa fa-comment"> </i>'.esc_html__(' 0','trendytravel'));
            } else {
                echo '<div class="password-protect"><i class="fa fa-lock"> </i>'.esc_html__(' Enter your password to view comments.', 'trendytravel')."</div>";
            } ?></div>
    
        <div class="entry-body">
           <?php the_content();?>
           <?php if(isset($show_tag_meta) && empty( $show_tag_meta ) ): ?>
           <?php the_tags("<p class='tags '> <span class='fa fa-tags'> </span> Posted In: "," "); ?>
           <?php endif; ?>
           <?php wp_link_pages( array( 'before'=>'<div class="page-link">', 'after'=>'</div>', 'link_before'=>'<span>', 'link_after'=>'</span>', 'next_or_number'=>'number',
                            'pagelink' => '%', 'echo' => 1 ) );?>
        </div>
    </div><!-- Entry Details -->

    <?php  edit_post_link( esc_html__( ' Edit ','trendytravel' ) ); ?>