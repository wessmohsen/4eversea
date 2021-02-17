<?php
//Class definition: Post Functions
class trendytravel_post_functions {

	function __construct() {

		add_action( 'wp_ajax_trendytravel_post_rating_like', array( $this, 'trendytravel_post_rating_like' ) );
		add_action( 'wp_ajax_nopriv_trendytravel_post_rating_like', array( $this, 'trendytravel_post_rating_like' ) );
	}

	function trendytravel_post_meta_fields( $ajax = false, $page_ID = 0 ) {

		$meta_values = array();
		$allow_excerpt = $allow_read_more = '';

		if( $page_ID > 0 ) :

			// Getting values from page meta...
			$tpl_default_settings = get_post_meta($page_ID, '_tpl_default_settings', TRUE);
			$tpl_default_settings = is_array( $tpl_default_settings ) ? $tpl_default_settings  : array();

			$allow_read_more = !empty( $tpl_default_settings['enable-blog-readmore'] ) ? $tpl_default_settings['enable-blog-readmore'] : NULL;
			$read_more = !empty( $tpl_default_settings['blog-readmore'] ) ? $tpl_default_settings['blog-readmore'] : NULL;

			$allow_excerpt = !empty( $tpl_default_settings['blog-post-excerpt'] ) ? $tpl_default_settings['blog-post-excerpt'] : NULL;
			$excerpt = !empty( $tpl_default_settings['blog-post-excerpt-length'] ) ? $tpl_default_settings['blog-post-excerpt-length'] : NULL;
			
			$show_post_format = !empty( $tpl_default_settings['show-postformat-info'] ) ? $tpl_default_settings['show-postformat-info'] : NULL;
			$show_author_meta = !empty( $tpl_default_settings['show-author-info'] ) ? $tpl_default_settings['show-author-info'] : NULL;
			
			$show_date_meta = !empty( $tpl_default_settings['show-date-info'] ) ? $tpl_default_settings['show-date-info'] : NULL;
			$show_comment_meta = !empty( $tpl_default_settings['show-comment-info'] ) ? $tpl_default_settings['show-comment-info'] : NULL;

			$show_category_meta = !empty( $tpl_default_settings['show-category-info'] ) ? $tpl_default_settings['show-category-info'] : NULL;
			$show_tag_meta = !empty( $tpl_default_settings['show-tag-info'] ) ? $tpl_default_settings['show-tag-info'] : NULL;

		elseif( is_home() || is_search() || is_archive() || $ajax ) :

			// Getting values from theme options...
			$allow_read_more = cs_get_option( 'post-archives-enable-readmore' );
			$read_more = cs_get_option( 'post-archives-readmore' );

			$allow_excerpt = cs_get_option( 'post-archives-enable-excerpt' );
			$excerpt = cs_get_option( 'post-archives-excerpt' );

			$show_post_format = cs_get_option( 'post-format-meta' );
			$show_author_meta = cs_get_option( 'post-author-meta' );

			$show_date_meta = cs_get_option( 'post-date-meta' );
			$show_comment_meta = cs_get_option( 'post-comment-meta' );

			$show_category_meta = cs_get_option( 'post-category-meta' );
			$show_tag_meta = cs_get_option( 'post-tag-meta' );

		endif;

		$read_more = !empty( $read_more ) ? $read_more : '';
		$excerpt = !empty( $excerpt ) ? $excerpt : 25;

		$show_post_format = !empty( $show_post_format )? "" : "hidden";
		$show_author_meta = !empty( $show_author_meta ) ? "" : "hidden";

		$show_date_meta = !empty( $show_date_meta ) ? "" : "hidden";
		$show_comment_meta = !empty( $show_comment_meta ) ? "" : "hidden";

		$show_category_meta = !empty( $show_category_meta ) ? "" : "hidden";
		$show_tag_meta = !empty( $show_tag_meta ) ? "" : "hidden";

		array_push( $meta_values, $allow_read_more, $read_more, $allow_excerpt, $excerpt, $show_post_format, $show_author_meta, $show_date_meta, $show_comment_meta, $show_category_meta, $show_tag_meta );

		return $meta_values;
	}
	
	function trendytravel_post_rating_like() {

		$out = '';
		$postid = $_REQUEST['post_id'];
		$nonce = $_REQUEST['nonce'];
		$action = $_REQUEST['doaction'];
		$arr_pids = array();

		if ( wp_verify_nonce( $nonce, 'rating-nonce' ) && $postid > 0 ) {
	
			$post_meta = get_post_meta ( $postid, '_dt_post_settings', TRUE );
			$post_meta = is_array ( $post_meta ) ? $post_meta : array ();
			$var_count = ($action == 'like') ? 'like_count' : 'unlike_count';

			if( isset( $_COOKIE['arr_pids'] ) ) {

				// article voted already...
				if( in_array( $postid, explode(',', $_COOKIE['arr_pids']) ) ) {

					$out = esc_html__('Already', 'trendytravel');

				} else {
					// article first vote...
					$v = array_key_exists($var_count, $post_meta) ?  $post_meta[$var_count] : 0;
					$v = $v + 1;
					$post_meta[$var_count] = $v;
					update_post_meta( $postid, '_dt_post_settings', $post_meta );

					$out = $v;

					$arr_pids = explode(',', $_COOKIE['arr_pids']);
					array_push( $arr_pids, $postid);
					setcookie( "arr_pids", implode(',', $arr_pids ), time()+1314000, "/" );
				}
			} else {

				// site first vote...
				$v = array_key_exists($var_count, $post_meta) ?  $post_meta[$var_count] : 0;
				$v = $v + 1;
				$post_meta[$var_count] = $v;
				update_post_meta( $postid, '_dt_post_settings', $post_meta );

				$out = $v;

				array_push( $arr_pids, $postid);
				setcookie( "arr_pids", implode(',', $arr_pids ), time()+1314000, "/" );
			}
		} else {
			$out = esc_html__('Security check', 'trendytravel');
		}

		echo "{$out}";
	}

	function trendytravel_post_thumb( $post_ID, $column ) {

		$post_meta = get_post_meta($post_ID, '_dt_post_settings', TRUE);
		$post_meta = is_array($post_meta) ? $post_meta  : array();

		$format = !empty( $post_meta['post-format-type'] ) ? $post_meta['post-format-type'] : 'standard';
		$img_size = array( '1' => 'full', '2' => 'trendytravel-blog-ii-column', '3' => 'trendytravel-blog-iii-column' );

		// If it's galley post
		if( $format === "gallery" && $post_meta['post-gallery-items'] != '' ) : ?>
			<ul class="entry-gallery-post-slider"><?php
				$items = explode(',', $post_meta["post-gallery-items"]);
				foreach ( $items as $item ) { ?>
					<li><?php echo wp_get_attachment_image( $item, $img_size[$column] ); ?></li><?php
				}?>
			</ul><?php
		// If it's video post
		elseif( $format === "video" && $post_meta['media-url'] != '' ) : ?>
			<div class="dt-video-wrap"><?php
				if( $post_meta['media-type'] == 'oembed' && ! isset( $_COOKIE['dtPrivacyVideoEmbedsDisabled'] ) ) :
					echo wp_oembed_get($post_meta['media-url']);
				elseif( $post_meta['media-type'] == 'self' ) :
					echo wp_video_shortcode( array('src' => $post_meta['media-url']) );
				endif;?>
			</div><?php
		// If it's audio post
		elseif( $format === "audio" ) :
			if( has_post_thumbnail($post_ID) ) : ?>
				<a href="<?php echo get_permalink($post_ID); ?>" title="<?php printf(esc_attr__('Permalink to %s','trendytravel'), get_the_title($post_ID)); ?>">
					<?php echo get_the_post_thumbnail( $post_ID, $img_size[$column] ); ?>
				</a><?php
			endif;
	
			if( $post_meta['media-url'] != '' ) :
				if( $post_meta['media-type'] == 'oembed' ) :
					echo wp_oembed_get($post_meta['media-url']);
				elseif( $post_meta['media-type'] == 'self' ) :
					echo wp_audio_shortcode( array('src' => $post_meta['media-url']) );
				endif;
			endif;
		elseif( has_post_thumbnail() ) : ?>
			<a href="<?php echo get_permalink($post_ID); ?>" title="<?php printf(esc_attr__('Permalink to %s','trendytravel'), get_the_title($post_ID)); ?>">
				<?php echo get_the_post_thumbnail( $post_ID, $img_size[$column] ); ?>
			</a><?php
		endif;
	}

	function trendytravel_post_thumb_date_author_left( $post_ID, $column ) {

		$post_meta = get_post_meta($post_ID, '_dt_post_settings', TRUE);
		$post_meta = is_array($post_meta) ? $post_meta  : array();
		
		$format = !empty( $post_meta['post-format-type'] ) ? $post_meta['post-format-type'] : 'standard';
		$img_size = array( '1' => 'full', '2' => 'trendytravel-blog-ii-column', '3' => 'trendytravel-blog-iii-column','4' => '' );

		// If it's galley post
		if( $format === "gallery" && $post_meta['post-gallery-items'] != '' ) : ?>
			<ul class="entry-gallery-post-slider"><?php
				$items = explode(',', $post_meta["post-gallery-items"]);
				foreach ( $items as $item ) { ?>
					<li><?php echo wp_get_attachment_image( $item, $img_size[$column] ); ?></li><?php
				}?>
			</ul><?php
		// If it's video post
		elseif( $format === "video" && $post_meta['media-url'] != '' ) : ?>
			<div class="dt-video-wrap"><?php
				if( $post_meta['media-type'] == 'oembed' && ! isset( $_COOKIE['dtPrivacyVideoEmbedsDisabled'] ) ) :
					echo wp_oembed_get($post_meta['media-url']);
				elseif( $post_meta['media-type'] == 'self' ) :
					echo wp_video_shortcode( array('src' => $post_meta['media-url']) );
				endif;?>
			</div><?php
		// If it's audio post
		elseif( $format === "audio" ) :
			if( has_post_thumbnail($post_ID) ) : ?>
				<a href="<?php echo get_permalink($post_ID); ?>" title="<?php printf(esc_attr__('Permalink to %s','trendytravel'), get_the_title($post_ID)); ?>">
					<?php echo get_the_post_thumbnail( $post_ID, $img_size[$column] ); ?>
				</a><?php
			endif;
	
			if( $post_meta['media-url'] != '' ) :
				if( $post_meta['media-type'] == 'oembed' ) :
					echo wp_oembed_get($post_meta['media-url']);
				elseif( $post_meta['media-type'] == 'self' ) :
					echo wp_audio_shortcode( array('src' => $post_meta['media-url']) );
				endif;
			endif;
		elseif( has_post_thumbnail() ) : ?>
			<a href="<?php echo get_permalink($post_ID); ?>" title="<?php printf(esc_attr__('Permalink to %s','trendytravel'), get_the_title($post_ID)); ?>">
				<?php echo get_the_post_thumbnail( $post_ID, $img_size[$column] ); ?>
				<div class="image-overlay"><span class="image-overlay-inside"></span></div>
			</a><?php
		endif;
	}

	//Default, Medium, Medium Highlight, Medium Skin Highlight
	function trendytravel_post_default_style( $post_ID, $meta ) {

		$post_meta = get_post_meta($post_ID, '_dt_post_settings', TRUE);
		$post_meta = is_array($post_meta) ? $post_meta : array();

		$format = !empty( $post_meta['post-format-type'] ) ? $post_meta['post-format-type'] : 'standard';
		$link = get_permalink( $post_ID );
		$link = rawurlencode( $link );

		if( defined( 'DOING_AJAX' ) && DOING_AJAX && class_exists('WPBMap') && method_exists('WPBMap', 'addAllMappedShortcodes') ) {
			WPBMap::addAllMappedShortcodes();
		} ?>

        <!-- Featured Image -->
        <div class="entry-thumb"><?php if( is_sticky( $post_ID ) ) echo '<div class="featured-post"><span class="sticky-post">'.esc_html__('Featured', 'trendytravel').'</span></div>'; ?><?php self::trendytravel_post_thumb_date_author_left( $post_ID, $meta[10] ); ?></div><!-- Featured Image -->

        <!-- Post Details -->
        <div class="entry-details">

            <!-- Meta -->
            <?php $tclass = ( ($meta[6] == "hidden" ) && ($meta[7] == "hidden" ) && ($meta[5] == "hidden" ) ) ? "hidden" : ""; ?>
            <div class="entry-meta <?php echo esc_attr($tclass); ?>">
            	<div class="date <?php echo esc_attr($meta[6]); ?>"><?php esc_html_e('Posted on ','trendytravel'); echo get_the_date ( get_option('date_format') ); ?></div>
                <div class="comments <?php echo esc_attr($meta[7]); ?>"> / <?php
                    comments_popup_link('<i class="pe-icon pe-chat"> </i> 0', '<i class="pe-icon pe-chat"> </i> 1', '<i class="pe-icon pe-chat"> </i> %', '', '<i class="pe-icon pe-chat"> </i>'); ?>
                </div>
                <div class="author <?php echo esc_attr( $meta[5] ); ?>">
                    / <i class="pe-icon pe-user"> </i>
                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" 
                        title="<?php esc_attr_e('View all posts by ', 'trendytravel'); echo get_the_author(); ?>"><?php echo get_the_author(); ?></a>
                </div>
            </div><!-- Meta -->

            <div class="entry-title">
                <?php if( is_sticky( $post_ID ) ) echo '<span class="sticky-post">'.esc_html__('Featured', 'trendytravel').'</span>'; ?>
                <h4><a href="<?php echo get_permalink( $post_ID ); ?>" title="<?php printf(esc_attr__('Permalink to %s','trendytravel'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a></h4>
            </div>

			<?php if( isset($meta[2]) && isset($meta[3]) ):?>
				<div class="entry-body"><?php echo trendytravel_excerpt($meta[3]); ?></div>
            <?php endif;?>

            <!-- Category & Tag -->
            <?php $tclass = ( ($meta[8] == "hidden" ) && ($meta[9] == "hidden" ) ) ? "hidden" : ""; ?>
            <div class="entry-meta-data <?php echo esc_attr($tclass); ?>">
                <?php the_tags("<p class='tags {$meta[9]}'> <i class='pe-icon pe-ticket'> </i>",', ',"</p>"); ?>
                <p class="<?php echo esc_attr( $meta[8] ); ?> category"><i class="pe-icon pe-network"> </i> <?php the_category(', '); ?></p>
            </div><!-- Category & Tag -->

            <!-- Read More Button -->
            <?php if( isset($meta[0]) ):
                    $sc = isset( $meta[1] ) ? $meta[1] : "";
					if( !empty( $sc ) && shortcode_exists( 'dt_sc_button' ) && class_exists( 'Vc_Manager' ) ):
						$sc = str_replace("]",' link="url:'.$link.'"]',$sc);
						$sc = do_shortcode($sc);
						echo !empty( $sc ) ? $sc : '';
					else:
						echo '<a href="'.get_permalink().'" title="'.get_the_title().'" class="dt-sc-button small icon-right with-icon filled type1">'.esc_html__('Read More', 'trendytravel').'<span class="fa fa-long-arrow-right"> </span></a>';
					endif;
                  endif;?><!-- Read More Button -->

        </div><!-- Post Details --><?php
	}

	//Date Left
	function trendytravel_post_date_left_style( $post_ID, $meta ) {

		$post_meta = get_post_meta($post_ID, '_dt_post_settings', TRUE);
		$post_meta = is_array($post_meta) ? $post_meta : array();

		$format = !empty( $post_meta['post-format-type'] ) ? $post_meta['post-format-type'] : 'standard';
		$link = get_permalink( $post_ID );
		$link = rawurlencode( $link );

		if( defined( 'DOING_AJAX' ) && DOING_AJAX && class_exists('WPBMap') && method_exists('WPBMap', 'addAllMappedShortcodes') ) {
			WPBMap::addAllMappedShortcodes();
		} ?>

        <!-- Featured Image -->
        <div class="entry-thumb">
        	<?php self::trendytravel_post_thumb( $post_ID, $meta[10] ); ?>

            <div class="entry-format <?php echo esc_attr($meta[4]); ?>">
                <a class="ico-format" href="<?php echo esc_url(get_post_format_link( $format )); ?>"></a>
            </div>
		</div><!-- Featured Image -->

        <!-- Post Details -->
        <div class="entry-details">

            <!-- Meta -->
            <?php $tclass = ( ($meta[6] == "hidden" ) && ($meta[7] == "hidden" ) ) ? "hidden" : ""; ?>
            <div class="entry-date <?php echo esc_attr($tclass); ?>">
                <!-- Date -->
                <div class="<?php echo esc_attr($meta[6]); ?>">
                    <?php echo get_the_date('d'); ?>
                     <span><?php echo get_the_date('M'); ?></span>
                </div><!-- Date -->

                <!-- Comment -->
                <div class="<?php echo esc_attr($meta[7]); ?>"><?php
                    comments_popup_link('<i class="pe-icon pe-chat"> </i> 0', '<i class="pe-icon pe-chat"> </i> 1', '<i class="pe-icon pe-chat"> </i> %', '', '<i class="pe-icon pe-chat"> </i>'); ?>
                </div><!-- Comment -->                                         
            </div><!-- .entry-date -->

            <div class="entry-title">
                <?php if( is_sticky( $post_ID ) ) echo '<span class="sticky-post">'.esc_html__('Featured', 'trendytravel').'</span>'; ?>
                <h4><a href="<?php echo get_permalink( $post_ID ); ?>" title="<?php printf(esc_attr__('Permalink to %s','trendytravel'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a></h4>
            </div>

			<?php if( isset($meta[2]) && isset($meta[3]) ):?>
            	<div class="entry-body"><?php echo trendytravel_excerpt($meta[3]); ?></div>
            <?php endif;?>

            <!-- Author & Category & Tag -->
            <?php $tclass = ( ($meta[5] == "hidden" ) && ($meta[9] == "hidden" ) && ($meta[8] == "hidden" ) ) ? "hidden" : ""; ?>
            <div class="entry-meta-data <?php echo esc_attr($tclass); ?>">
            	<p class="author <?php echo esc_attr( $meta[5] ); ?>">
                	<i class="pe-icon pe-user"> </i>
                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" 
                    					title="<?php esc_attr_e('View all posts by ', 'trendytravel'); echo get_the_author(); ?>"><?php echo get_the_author(); ?></a>
				</p>

                <?php the_tags("<p class='tags {$meta[9]}'> <i class='pe-icon pe-ticket'> </i>",', ',"</p>"); ?>

                <p class="<?php echo esc_attr( $meta[8] ); ?> category"><i class="pe-icon pe-network"> </i> <?php the_category(', '); ?></p>
            </div><!-- Author & Category & Tag -->

            <!-- Read More Button -->
            <?php if( isset($meta[0]) ):
                    $sc = isset( $meta[1] ) ? $meta[1] : "";
					if( !empty( $sc ) && shortcode_exists( 'dt_sc_button' ) && class_exists( 'Vc_Manager' ) ):
						$sc = str_replace("]",' link="url:'.$link.'"]',$sc);
						$sc = do_shortcode($sc);
						echo !empty( $sc ) ? $sc : '';
					else:
						echo '<a href="'.get_permalink().'" title="'.get_the_title().'" class="dt-sc-button small icon-right with-icon filled type1">'.esc_html__('Read More', 'trendytravel').'<span class="fa fa-long-arrow-right"> </span></a>';
					endif;
                  endif;?><!-- Read More Button -->

        </div><!-- Post Details --><?php
	}

	//Date Left Framed Border
	function trendytravel_post_date_left_framed_border_style( $post_ID, $meta ) {

		$post_meta = get_post_meta($post_ID, '_dt_post_settings', TRUE);
		$post_meta = is_array($post_meta) ? $post_meta : array();

		$format = !empty( $post_meta['post-format-type'] ) ? $post_meta['post-format-type'] : 'standard';
		$link = get_permalink( $post_ID );
		$link = rawurlencode( $link );

		if( defined( 'DOING_AJAX' ) && DOING_AJAX && class_exists('WPBMap') && method_exists('WPBMap', 'addAllMappedShortcodes') ) {
			WPBMap::addAllMappedShortcodes();
		} ?>

        <!-- Featured Image -->
        <div class="entry-thumb">
        	<?php self::trendytravel_post_thumb( $post_ID, $meta[10] ); ?>
		</div><!-- Featured Image -->

        <!-- Post Details -->
        <div class="entry-details">

            <!-- Date -->
            <div class="entry-date <?php echo esc_attr($meta[6]); ?>">
                <span><?php echo get_the_date('d'); ?></span><?php echo get_the_date('M'); ?>
            </div><!-- Date -->

            <!-- Author & Category & Tag -->
            <?php $tclass = ( ($meta[5] == "hidden" ) && ($meta[9] == "hidden" ) && ($meta[8] == "hidden" ) && ($meta[7] == "hidden" ) ) ? "hidden" : ""; ?>
            <div class="entry-meta-data <?php echo esc_attr($tclass); ?>">
            	<p class="author <?php echo esc_attr( $meta[5] ); ?>">
                	<?php echo esc_html__('by', 'trendytravel'); ?>
                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" 
                    					title="<?php esc_attr_e('View all posts by ', 'trendytravel'); echo get_the_author(); ?>"><?php echo get_the_author(); ?></a>
				</p>
                
                <!-- Comment -->
                <p class="comments <?php echo esc_attr($meta[7]); ?>"><?php
                    comments_popup_link('0 '.esc_html__('comments', 'trendytravel'), '1 '.esc_html__('comment', 'trendytravel'), '% '.esc_html__('comments', 'trendytravel'), '', esc_html__('comments off', 'trendytravel')); ?>
                </p><!-- Comment -->

                <?php the_tags("<p class='tags {$meta[9]}'>".esc_html__('in ', 'trendytravel'),', ',"</p>"); ?>

                <p class="<?php echo esc_attr( $meta[8] ); ?> category"><?php echo esc_html__('in ', 'trendytravel'); ?><?php the_category(', '); ?></p>
            </div><!-- Author & Category & Tag -->

            <div class="entry-title">
                <?php if( is_sticky( $post_ID ) ) echo '<span class="sticky-post">'.esc_html__('Featured', 'trendytravel').'</span>'; ?>
                <h4><a href="<?php echo get_permalink( $post_ID ); ?>" title="<?php printf(esc_attr__('Permalink to %s','trendytravel'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a></h4>
            </div>

			<?php if( isset($meta[2]) && isset($meta[3]) ):?>
            	<div class="entry-body"><?php echo trendytravel_excerpt($meta[3]); ?></div>
            <?php endif;?>

            <!-- Read More Button -->
            <?php if( isset($meta[0]) ):
                    $sc = isset( $meta[1] ) ? $meta[1] : "";
					if( !empty( $sc ) && shortcode_exists( 'dt_sc_button' ) && class_exists( 'Vc_Manager' ) ):
						$sc = str_replace("]",' link="url:'.$link.'"]',$sc);
						$sc = do_shortcode($sc);
						echo !empty( $sc ) ? $sc : '';
					else:
						echo '<a href="'.get_permalink().'" title="'.get_the_title().'" class="dt-sc-button filled small">'.esc_html__('Continue Reading...', 'trendytravel').'</a>';
					endif;
                  endif;?><!-- Read More Button -->

            <div class="entry-format <?php echo esc_attr($meta[4]); ?>">
                <a class="ico-format" href="<?php echo esc_url(get_post_format_link( $format )); ?>"></a>
            </div>

        </div><!-- Post Details --><?php
	}

	//Modern
	function trendytravel_post_modern_style( $post_ID, $meta ) {

		$post_meta = get_post_meta($post_ID, '_dt_post_settings', TRUE);
		$post_meta = is_array($post_meta) ? $post_meta : array();

		$format = !empty( $post_meta['post-format-type'] ) ? $post_meta['post-format-type'] : 'standard';
		$link = get_permalink( $post_ID );
		$link = rawurlencode( $link );

		if( defined( 'DOING_AJAX' ) && DOING_AJAX && class_exists('WPBMap') && method_exists('WPBMap', 'addAllMappedShortcodes') ) {
			WPBMap::addAllMappedShortcodes();
		} ?>

        <!-- Featured Image -->
        <div class="entry-thumb">
        	<?php self::trendytravel_post_thumb( $post_ID, $meta[10] ); ?>

            <div class="entry-format <?php echo esc_attr($meta[4]); ?>">
                <a class="ico-format" href="<?php echo esc_url(get_post_format_link( $format )); ?>"></a>
            </div>
		</div><!-- Featured Image -->

        <!-- Post Details -->
        <div class="entry-details">

            <!-- Meta -->
            <?php $tclass = ( ($meta[6] == "hidden" ) && ($meta[7] == "hidden" ) && ($meta[5] == "hidden" ) ) ? "hidden" : ""; ?>
            <div class="entry-meta <?php echo esc_attr($tclass); ?>">
            	<div class="date <?php echo esc_attr($meta[6]); ?>"><?php esc_html_e('Posted on ','trendytravel'); echo get_the_date ( get_option('date_format') ); ?></div>
                <div class="comments <?php echo esc_attr($meta[7]); ?>"> / <?php
                    comments_popup_link('<i class="pe-icon pe-chat"> </i> 0', '<i class="pe-icon pe-chat"> </i> 1', '<i class="pe-icon pe-chat"> </i> %', '', '<i class="pe-icon pe-chat"> </i>'); ?>
                </div>
                <div class="author <?php echo esc_attr( $meta[5] ); ?>">
                    / <i class="pe-icon pe-user"> </i>
                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" 
                        title="<?php esc_attr_e('View all posts by ', 'trendytravel'); echo get_the_author(); ?>"><?php echo get_the_author(); ?></a>
                </div>
            </div><!-- Meta -->

            <div class="entry-title">
                <?php if( is_sticky( $post_ID ) ) echo '<span class="sticky-post">'.esc_html__('Featured', 'trendytravel').'</span>'; ?>
                <h4><a href="<?php echo get_permalink( $post_ID ); ?>" title="<?php printf(esc_attr__('Permalink to %s','trendytravel'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a></h4>
            </div>

			<?php if( isset($meta[2]) && isset($meta[3]) ):?>
				<div class="entry-body"><?php echo trendytravel_excerpt($meta[3]); ?></div>
            <?php endif;?>

            <!-- Category & Tag -->
            <?php $tclass = ( ($meta[8] == "hidden" ) && ($meta[9] == "hidden" ) ) ? "hidden" : ""; ?>
            <div class="entry-meta-data <?php echo esc_attr($tclass); ?>">
                <?php the_tags("<p class='tags {$meta[9]}'> <i class='pe-icon pe-ticket'> </i>",', ',"</p>"); ?>
                <p class="<?php echo esc_attr( $meta[8] ); ?> category"><i class="pe-icon pe-network"> </i> <?php the_category(', '); ?></p>
            </div><!-- Category & Tag -->

            <!-- Read More Button -->
            <?php if( isset($meta[0]) ):
                    $sc = isset( $meta[1] ) ? $meta[1] : "";
					if( !empty( $sc ) && shortcode_exists( 'dt_sc_button' ) && class_exists( 'Vc_Manager' ) ):
						$sc = str_replace("]",' link="url:'.$link.'"]',$sc);
						$sc = do_shortcode($sc);
						echo !empty( $sc ) ? $sc : '';
					else:
						echo '<a href="'.get_permalink().'" title="'.get_the_title().'" class="dt-sc-button medium fully-rounded-border type1">'.esc_html__('Read More', 'trendytravel').'</a>';
					endif;
                  endif;?><!-- Read More Button -->

        </div><!-- Post Details --><?php
	}

	//Bordered
	function trendytravel_post_bordered_style( $post_ID, $meta ) {

		$post_meta = get_post_meta($post_ID, '_dt_post_settings', TRUE);
		$post_meta = is_array($post_meta) ? $post_meta : array();

		$format = !empty( $post_meta['post-format-type'] ) ? $post_meta['post-format-type'] : 'standard';
		$link = get_permalink( $post_ID );
		$link = rawurlencode( $link );

		if( defined( 'DOING_AJAX' ) && DOING_AJAX && class_exists('WPBMap') && method_exists('WPBMap', 'addAllMappedShortcodes') ) {
			WPBMap::addAllMappedShortcodes();
		} ?>

        <!-- Featured Image -->
        <div class="entry-thumb">
        	<?php self::trendytravel_post_thumb( $post_ID, $meta[10] ); ?>

            <div class="entry-format <?php echo esc_attr($meta[4]); ?>">
                <a class="ico-format" href="<?php echo esc_url(get_post_format_link( $format )); ?>"></a>
            </div>
		</div><!-- Featured Image -->

        <!-- Post Details -->
        <div class="entry-details">

            <!-- Meta -->
            <?php $tclass = ( ($meta[6] == "hidden" ) && ($meta[7] == "hidden" ) && ($meta[5] == "hidden" ) ) ? "hidden" : ""; ?>
            <div class="entry-meta <?php echo esc_attr($tclass); ?>">
            	<div class="date <?php echo esc_attr($meta[6]); ?>"><?php echo '<span>'.get_the_date('d').'</span>'.get_the_date('M'); ?></div>
                <div class="comments <?php echo esc_attr($meta[7]); ?>"> / <?php
                    comments_popup_link('<i class="pe-icon pe-chat"> </i> 0', '<i class="pe-icon pe-chat"> </i> 1', '<i class="pe-icon pe-chat"> </i> %', '', '<i class="pe-icon pe-chat"> </i>'); ?>
                </div>
                <div class="author <?php echo esc_attr( $meta[5] ); ?>">
                    / <i class="pe-icon pe-user"> </i>
                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" 
                        title="<?php esc_attr_e('View all posts by ', 'trendytravel'); echo get_the_author(); ?>"><?php echo get_the_author(); ?></a>
                </div>
            </div><!-- Meta -->

            <div class="entry-title">
                <?php if( is_sticky( $post_ID ) ) echo '<span class="sticky-post">'.esc_html__('Featured', 'trendytravel').'</span>'; ?>
                <h4><a href="<?php echo get_permalink( $post_ID ); ?>" title="<?php printf(esc_attr__('Permalink to %s','trendytravel'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a></h4>
            </div>

			<?php if( isset($meta[2]) && isset($meta[3]) ):?>
				<div class="entry-body"><?php echo trendytravel_excerpt($meta[3]); ?></div>
            <?php endif;?>

            <!-- Category & Tag -->
            <?php $tclass = ( ($meta[8] == "hidden" ) && ($meta[9] == "hidden" ) ) ? "hidden" : ""; ?>
            <div class="entry-meta-data <?php echo esc_attr($tclass); ?>">
                <?php the_tags("<p class='tags {$meta[9]}'> <i class='pe-icon pe-ticket'> </i>",', ',"</p>"); ?>
                <p class="<?php echo esc_attr( $meta[8] ); ?> category"><i class="pe-icon pe-network"> </i> <?php the_category(', '); ?></p>
            </div><!-- Category & Tag -->

            <!-- Read More Button -->
            <?php if( isset($meta[0]) ):
                    $sc = isset( $meta[1] ) ? $meta[1] : "";
					if( !empty( $sc ) && shortcode_exists( 'dt_sc_button' ) && class_exists( 'Vc_Manager' ) ):
						$sc = str_replace("]",' link="url:'.$link.'"]',$sc);
						$sc = do_shortcode($sc);
						echo !empty( $sc ) ? $sc : '';
					else:
						echo '<a href="'.get_permalink().'" title="'.get_the_title().'" class="dt-sc-button small filled type5">'.esc_html__('Read More', 'trendytravel').'</a>';
					endif;
                  endif;?><!-- Read More Button -->

        </div><!-- Post Details --><?php
	}

	//Classic
	function trendytravel_post_classic_style( $post_ID, $meta ) {

		$post_meta = get_post_meta($post_ID, '_dt_post_settings', TRUE);
		$post_meta = is_array($post_meta) ? $post_meta : array();

		$format = !empty( $post_meta['post-format-type'] ) ? $post_meta['post-format-type'] : 'standard';
		$link = get_permalink( $post_ID );
		$link = rawurlencode( $link );

		if( defined( 'DOING_AJAX' ) && DOING_AJAX && class_exists('WPBMap') && method_exists('WPBMap', 'addAllMappedShortcodes') ) {
			WPBMap::addAllMappedShortcodes();
		} ?>

        <!-- Featured Image -->
        <div class="entry-thumb">
        	<?php self::trendytravel_post_thumb( $post_ID, $meta[10] ); ?>

            <div class="entry-format <?php echo esc_attr($meta[4]); ?>">
                <a class="ico-format" href="<?php echo esc_url(get_post_format_link( $format )); ?>"></a>
            </div>
		</div><!-- Featured Image -->

        <!-- Post Details -->
        <div class="entry-details">

            <div class="entry-title">
                <?php if( is_sticky( $post_ID ) ) echo '<span class="sticky-post">'.esc_html__('Featured', 'trendytravel').'</span>'; ?>
                <h4><a href="<?php echo get_permalink( $post_ID ); ?>" title="<?php printf(esc_attr__('Permalink to %s','trendytravel'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a></h4>
            </div>

            <!-- Meta -->
            <?php $tclass = ( ($meta[6] == "hidden" ) && ($meta[7] == "hidden" ) && ($meta[5] == "hidden" ) ) ? "hidden" : ""; ?>
            <div class="entry-meta <?php echo esc_attr($tclass); ?>">
            	<div class="date <?php echo esc_attr($meta[6]); ?>"><?php echo get_the_date ( get_option('date_format') ); ?></div>
                <div class="comments <?php echo esc_attr($meta[7]); ?>"> / <?php
                    comments_popup_link('<i class="pe-icon pe-chat"> </i> 0', '<i class="pe-icon pe-chat"> </i> 1', '<i class="pe-icon pe-chat"> </i> %', '', '<i class="pe-icon pe-chat"> </i>'); ?>
                </div>
                <div class="author <?php echo esc_attr( $meta[5] ); ?>">
                    / <i class="pe-icon pe-user"> </i>
                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" 
                        title="<?php esc_attr_e('View all posts by ', 'trendytravel'); echo get_the_author(); ?>"><?php echo get_the_author(); ?></a>
                </div>
            </div><!-- Meta -->

			<?php if( isset($meta[2]) && isset($meta[3]) ):?>
				<div class="entry-body"><?php echo trendytravel_excerpt($meta[3]); ?></div>
            <?php endif;?>

            <!-- Category & Tag -->
            <?php $tclass = ( ($meta[8] == "hidden" ) && ($meta[9] == "hidden" ) ) ? "hidden" : ""; ?>
            <div class="entry-meta-data <?php echo esc_attr($tclass); ?>">
                <p class="<?php echo esc_attr( $meta[8] ); ?> category"><?php echo esc_html__('In : ', 'trendytravel'); the_category(', '); ?></p>
                <?php the_tags("<p class='tags {$meta[9]}'>".esc_html__('Tags : ', 'trendytravel'),', ',"</p>"); ?>
            </div><!-- Category & Tag -->

            <!-- Read More Button -->
            <?php if( isset($meta[0]) ):
                    $sc = isset( $meta[1] ) ? $meta[1] : "";
					if( !empty( $sc ) && shortcode_exists( 'dt_sc_button' ) && class_exists( 'Vc_Manager' ) ):
						$sc = str_replace("]",' link="url:'.$link.'"]',$sc);
						$sc = do_shortcode($sc);
						echo !empty( $sc ) ? $sc : '';
					else:
						echo '<a href="'.get_permalink().'" title="'.get_the_title().'" class="dt-sc-button medium icon-right with-icon simple">'.esc_html__('Read More', 'trendytravel').'<span class="lnr lnr-arrow-right"> </span></a>';
					endif;
                  endif;?><!-- Read More Button -->

        </div><!-- Post Details --><?php
	}

	//Overlay
	function trendytravel_post_overlay_style( $post_ID, $meta ) {

		$post_meta = get_post_meta($post_ID, '_dt_post_settings', TRUE);
		$post_meta = is_array($post_meta) ? $post_meta : array();

		$format = !empty( $post_meta['post-format-type'] ) ? $post_meta['post-format-type'] : 'standard';
		$link = get_permalink( $post_ID );
		$link = rawurlencode( $link );

		if( defined( 'DOING_AJAX' ) && DOING_AJAX && class_exists('WPBMap') && method_exists('WPBMap', 'addAllMappedShortcodes') ) {
			WPBMap::addAllMappedShortcodes();
		}

		$entry_bg = '';
		if( has_post_thumbnail() ) {
			$img_size = array( '1' => 'full', '2' => 'trendytravel-blog-ii-column', '3' => 'trendytravel-blog-iii-column' );
			$url = get_the_post_thumbnail_url( $post_ID, $img_size[$meta[10]] );
			$entry_bg = 'style="background-image:url('.$url.')"';
		}?>

        <div class="entry-thumb" <?php echo esc_attr($entry_bg); ?>>
            <div class="entry-format <?php echo esc_attr($meta[4]); ?>">
                <a class="ico-format" href="<?php echo esc_url(get_post_format_link( $format )); ?>"></a>
            </div>

            <!-- Post Details -->
            <div class="entry-details">

            	<!-- Meta -->
            	<?php $tclass = ( ($meta[6] == "hidden" ) && ($meta[7] == "hidden" ) && ($meta[5] == "hidden" ) ) ? "hidden" : ""; ?>
            	<div class="entry-meta <?php echo esc_attr($tclass); ?>">
            		<div class="date <?php echo esc_attr($meta[6]); ?>"><?php echo get_the_date ( get_option('date_format') ); ?></div>
            		<div class="comments <?php echo esc_attr($meta[7]); ?>"> / <?php
            			comments_popup_link('<i class="fa fa-comment-o"> </i> 0', '<i class="fa fa-comment-o"> </i> 1', '<i class="fa fa-comments-o"> </i> %', '', '<i class="fa fa-comment-o"> </i>'); ?>
            		</div>
            		<div class="author <?php echo esc_attr( $meta[5] ); ?>">
            			/ <i class="fa fa-user-o"> </i>
            			<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" 
            				title="<?php esc_attr_e('View all posts by ', 'trendytravel'); echo get_the_author(); ?>"><?php echo get_the_author(); ?></a>
            		</div>
            	</div><!-- Meta -->

            	<div class="entry-title">
            		<?php if( is_sticky( $post_ID ) )
            			echo '<span class="sticky-post">'.esc_html__('Featured', 'trendytravel').'</span>'; ?>
            		<h4><a href="<?php echo get_permalink( $post_ID ); ?>" title="<?php printf(esc_attr__('Permalink to %s','trendytravel'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a></h4>
            	</div>

            	<!-- Category & Tag -->
            	<?php $tclass = ( ($meta[8] == "hidden" ) && ($meta[9] == "hidden" ) ) ? "hidden" : ""; ?>
            	<div class="entry-meta-data <?php echo esc_attr($tclass); ?>">
            		<?php the_tags("<p class='tags {$meta[9]}'> <i class='fa fa-tag'> </i>",', ',"</p>"); ?>
            		<p class="<?php echo esc_attr( $meta[8] ); ?> category"><i class="fa fa-bookmark-o"> </i> <?php the_category(', '); ?>
            		</p>
            	</div><!-- Category & Tag -->                

            	<?php if( isset($meta[2]) && isset($meta[3]) ):?>
            		<div class="entry-body"><?php echo trendytravel_excerpt($meta[3]); ?></div>
            	<?php endif;?>

                <!-- Read More Button -->                            
            	<?php if( isset($meta[0]) && shortcode_exists( 'dt_sc_button' ) && class_exists( 'Vc_Manager' ) ):
            			$sc = isset( $meta[1] ) ? $meta[1] : "";
						$sc = str_replace("]",' link="url:'.$link.'"]',$sc);
						$sc = do_shortcode($sc);						
						echo !empty( $sc ) ? $sc : '';
					   else:
					   	echo '<a href="'.get_permalink().'" title="'.get_the_title().'" class="dt-sc-button small no-btn-bg">'.esc_html__('Read More', 'trendytravel').'</a>';	
					   endif;?>
				<!-- Read More Button -->
            </div><!-- Post Details -->
       	</div><!-- Featured Image --><?php
	}


	//Top Date
	function trendytravel_post_topdate_style( $post_ID, $meta ) {

		$post_meta = get_post_meta($post_ID, '_dt_post_settings', TRUE);
		$post_meta = is_array($post_meta) ? $post_meta : array();

		$format = !empty( $post_meta['post-format-type'] ) ? $post_meta['post-format-type'] : 'standard';
		$link = get_permalink( $post_ID );
		$link = rawurlencode( $link );

		if( defined( 'DOING_AJAX' ) && DOING_AJAX && class_exists('WPBMap') && method_exists('WPBMap', 'addAllMappedShortcodes') ) {
			WPBMap::addAllMappedShortcodes();
		}

		$entry_bg = '';
		if( has_post_thumbnail() ) {
			$img_size = array( '1' => 'full', '2' => 'trendytravel-blog-ii-column', '3' => 'trendytravel-blog-iii-column' );
			$url = get_the_post_thumbnail_url( $post_ID, $img_size[$meta[10]] );
			$entry_bg = 'style="background-image:url('.$url.')"';
		}?>
		<div class="date <?php echo esc_attr($meta[6]); ?>"><p><?php echo get_the_date ('d'); ?><span><?php echo get_the_date ('M'); ?> <?php echo get_the_date ('Y'); ?></span></p></div>
        
		<div class="entry-container">
			<!-- Featured Image -->
			<div class="entry-thumb">
			<?php if( is_sticky( $post_ID ) )
						echo '<div class="featured-post"><span class="sticky-post">'.esc_html__('Featured', 'trendytravel').'</span></div>'; ?>
				<?php self::trendytravel_post_thumb_date_author_left( $post_ID, $meta[10] ); ?>
			
			</div><!-- Featured Image -->
			<!-- Post Details -->
			<div class="entry-details">
				<div class="entry-title">
					<h4><a href="<?php echo get_permalink( $post_ID ); ?>" title="<?php printf(esc_attr__('Permalink to %s','trendytravel'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a></h4>
				</div>

				<!-- Meta -->
				<?php $tclass = ( ($meta[6] == "hidden" ) && ($meta[7] == "hidden" ) && ($meta[5] == "hidden" ) ) ? "hidden" : ""; ?>
				<div class="entry-meta <?php echo esc_attr($tclass); ?>">
					<div class="author <?php echo esc_attr( $meta[5] ); ?>">
						<i class="fa fa-user"></i> Posted by:
						<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" 
							title="<?php esc_attr_e('View all posts by ', 'trendytravel'); echo get_the_author(); ?>"><?php echo get_the_author(); ?></a>
					</div>
					<div class="comments <?php echo esc_attr($meta[7]); ?>"> <?php
						comments_popup_link('<i class="fa fa-comment"> </i> 0', '<i class="fa fa-comment"> </i> 1', '<i class="fa fa-comment"> </i> %', '', '<i class="fa fa-comment"> </i>'); ?>
					</div>
				</div><!-- Meta -->

				<!-- Category & Tag -->
				<?php $tclass = ( ($meta[8] == "hidden" ) && ($meta[9] == "hidden" ) ) ? "hidden" : ""; ?>
				<div class="entry-meta-data <?php echo esc_attr($tclass); ?>">
					<?php the_tags("<p class='tags {$meta[9]}'> <i class='fa fa-tag'> </i>",', ',"</p>"); ?>
					<p class="<?php echo esc_attr( $meta[8] ); ?> category"><i class="fa fa-bookmark-o"> </i> <?php the_category(', '); ?>
					</p>
				</div><!-- Category & Tag -->                

				<?php if( isset($meta[2]) && isset($meta[3]) ):?>
					<div class="entry-body"><?php echo trendytravel_excerpt($meta[3]); ?></div>
				<?php endif;?>

				<!-- Read More Button -->                            
				<?php if( isset($meta[0]) && shortcode_exists( 'dt_sc_button' ) && class_exists( 'Vc_Manager' ) ):
						$sc = isset( $meta[1] ) ? $meta[1] : "";
						$sc = str_replace("]",' link="url:'.$link.'"]',$sc);
						$sc = do_shortcode($sc);						
						echo !empty( $sc ) ? $sc : '';
						else:
						echo '<a href="'.get_permalink().'" title="'.get_the_title().'" class="dt-sc-button small no-btn-bg">'.esc_html__('Read More', 'trendytravel').'</a>';	
						endif;?>
				<!-- Read More Button -->
			</div><!-- Post Details -->
		</div>
       	<!-- Featured Image --><?php
	}

	//Overlap
	function trendytravel_post_overlap_style( $post_ID, $meta ) {

		$post_meta = get_post_meta($post_ID, '_dt_post_settings', TRUE);
		$post_meta = is_array($post_meta) ? $post_meta : array();

		$format = !empty( $post_meta['post-format-type'] ) ? $post_meta['post-format-type'] : 'standard';
		$link = get_permalink( $post_ID );
		$link = rawurlencode( $link );

		if( defined( 'DOING_AJAX' ) && DOING_AJAX && class_exists('WPBMap') && method_exists('WPBMap', 'addAllMappedShortcodes') ) {
			WPBMap::addAllMappedShortcodes();
		} ?>

        <!-- Featured Image -->
        <div class="entry-thumb">
        	<?php self::trendytravel_post_thumb( $post_ID, $meta[10] ); ?>

            <div class="entry-format <?php echo esc_attr($meta[4]); ?>">
                <a class="ico-format" href="<?php echo esc_url(get_post_format_link( $format )); ?>"></a>
            </div>
		</div><!-- Featured Image -->

        <!-- Post Details -->
        <div class="entry-details">

            <!-- Meta -->
            <?php $tclass = ( ($meta[6] == "hidden" ) && ($meta[7] == "hidden" ) && ($meta[5] == "hidden" ) ) ? "hidden" : ""; ?>
            <div class="entry-meta <?php echo esc_attr($tclass); ?>">
            	<div class="date <?php echo esc_attr($meta[6]); ?>"><?php esc_html_e('Posted on ','trendytravel'); echo get_the_date ( get_option('date_format') ); ?></div>
                <div class="comments <?php echo esc_attr($meta[7]); ?>"> / <?php
                    comments_popup_link('<i class="pe-icon pe-chat"> </i> 0', '<i class="pe-icon pe-chat"> </i> 1', '<i class="pe-icon pe-chat"> </i> %', '', '<i class="pe-icon pe-chat"> </i>'); ?>
                </div>
                <div class="author <?php echo esc_attr( $meta[5] ); ?>">
                    / <i class="pe-icon pe-user"> </i>
                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" 
                        title="<?php esc_attr_e('View all posts by ', 'trendytravel'); echo get_the_author(); ?>"><?php echo get_the_author(); ?></a>
                </div>
            </div><!-- Meta -->

            <div class="entry-title">
                <?php if( is_sticky( $post_ID ) ) echo '<span class="sticky-post">'.esc_html__('Featured', 'trendytravel').'</span>'; ?>
                <h4><a href="<?php echo get_permalink( $post_ID ); ?>" title="<?php printf(esc_attr__('Permalink to %s','trendytravel'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a></h4>
            </div>

			<?php if( isset($meta[2]) && isset($meta[3]) ):?>
				<div class="entry-body"><?php echo trendytravel_excerpt($meta[3]); ?></div>
            <?php endif;?>

            <!-- Category & Tag -->
            <?php $tclass = ( ($meta[8] == "hidden" ) && ($meta[9] == "hidden" ) ) ? "hidden" : ""; ?>
            <div class="entry-meta-data <?php echo esc_attr($tclass); ?>">
                <?php the_tags("<p class='tags {$meta[9]}'> <i class='pe-icon pe-ticket'> </i>",', ',"</p>"); ?>
                <p class="<?php echo esc_attr( $meta[8] ); ?> category"><i class="pe-icon pe-network"> </i> <?php the_category(', '); ?></p>
            </div><!-- Category & Tag -->

            <!-- Read More Button -->
            <?php if( isset($meta[0]) ):
                    $sc = isset( $meta[1] ) ? $meta[1] : "";
					if( !empty( $sc ) && shortcode_exists( 'dt_sc_button' ) && class_exists( 'Vc_Manager' ) ):
						$sc = str_replace("]",' link="url:'.$link.'"]',$sc);
						$sc = do_shortcode($sc);
						echo !empty( $sc ) ? $sc : '';
					else:
						echo '<a href="'.get_permalink().'" title="'.get_the_title().'" class="dt-sc-button medium bordered animated-btn">'.esc_html__('Read More', 'trendytravel').'</a>';
					endif;
                  endif;?><!-- Read More Button -->

        </div><!-- Post Details --><?php
	}

	//Stripe
	function trendytravel_post_stripe_style( $post_ID, $meta ) {

		$post_meta = get_post_meta($post_ID, '_dt_post_settings', TRUE);
		$post_meta = is_array($post_meta) ? $post_meta : array();

		$format = !empty( $post_meta['post-format-type'] ) ? $post_meta['post-format-type'] : 'standard';
		$link = get_permalink( $post_ID );
		$link = rawurlencode( $link );

		if( defined( 'DOING_AJAX' ) && DOING_AJAX && class_exists('WPBMap') && method_exists('WPBMap', 'addAllMappedShortcodes') ) {
			WPBMap::addAllMappedShortcodes();
		} ?>

        <!-- Featured Image -->
        <div class="entry-thumb">
        	<?php self::trendytravel_post_thumb( $post_ID, $meta[10] ); ?>

            <div class="entry-format <?php echo esc_attr($meta[4]); ?>">
                <a class="ico-format" href="<?php echo esc_url(get_post_format_link( $format )); ?>"></a>
            </div>
		</div><!-- Featured Image -->

        <!-- Post Details -->
        <div class="entry-details">

            <!-- Meta -->
            <?php $tclass = ( ($meta[6] == "hidden" ) && ($meta[7] == "hidden" ) && ($meta[5] == "hidden" ) ) ? "hidden" : ""; ?>
            <div class="entry-meta <?php echo esc_attr($tclass); ?>">
            	<div class="date <?php echo esc_attr($meta[6]); ?>"><?php esc_html_e('Posted on ','trendytravel'); echo get_the_date ( get_option('date_format') ); ?></div>
                <div class="comments <?php echo esc_attr($meta[7]); ?>"> / <?php
                    comments_popup_link('<i class="pe-icon pe-chat"> </i> 0', '<i class="pe-icon pe-chat"> </i> 1', '<i class="pe-icon pe-chat"> </i> %', '', '<i class="pe-icon pe-chat"> </i>'); ?>
                </div>
                <div class="author <?php echo esc_attr( $meta[5] ); ?>">
                    / <i class="pe-icon pe-user"> </i>
                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" 
                        title="<?php esc_attr_e('View all posts by ', 'trendytravel'); echo get_the_author(); ?>"><?php echo get_the_author(); ?></a>
                </div>
            </div><!-- Meta -->

            <div class="entry-title">
                <?php if( is_sticky( $post_ID ) ) echo '<span class="sticky-post">'.esc_html__('Featured', 'trendytravel').'</span>'; ?>
                <h4><a href="<?php echo get_permalink( $post_ID ); ?>" title="<?php printf(esc_attr__('Permalink to %s','trendytravel'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a></h4>
            </div>

			<?php if( isset($meta[2]) && isset($meta[3]) ):?>
				<div class="entry-body"><?php echo trendytravel_excerpt($meta[3]); ?></div>
            <?php endif;?>

            <!-- Category & Tag -->
            <?php $tclass = ( ($meta[8] == "hidden" ) && ($meta[9] == "hidden" ) ) ? "hidden" : ""; ?>
            <div class="entry-meta-data <?php echo esc_attr($tclass); ?>">
                <?php the_tags("<p class='tags {$meta[9]}'> <i class='pe-icon pe-ticket'> </i>",', ',"</p>"); ?>
                <p class="<?php echo esc_attr( $meta[8] ); ?> category"><i class="pe-icon pe-network"> </i> <?php the_category(', '); ?></p>
            </div><!-- Category & Tag -->

            <!-- Read More Button -->
            <?php if( isset($meta[0]) ):
                    $sc = isset( $meta[1] ) ? $meta[1] : "";
					if( !empty( $sc ) && shortcode_exists( 'dt_sc_button' ) && class_exists( 'Vc_Manager' ) ):
						$sc = str_replace("]",' link="url:'.$link.'"]',$sc);
						$sc = do_shortcode($sc);
						echo !empty( $sc ) ? $sc : '';
					else:
						echo '<a href="'.get_permalink().'" title="'.get_the_title().'" class="dt-sc-button small icon-right with-icon filled type1">'.esc_html__('Read More', 'trendytravel').'</a>';
					endif;
                  endif;?><!-- Read More Button -->

        </div><!-- Post Details --><?php
	}

	//Fashion
	function trendytravel_post_fashion_style( $post_ID, $meta ) {

		$post_meta = get_post_meta($post_ID, '_dt_post_settings', TRUE);
		$post_meta = is_array($post_meta) ? $post_meta : array();

		$format = !empty( $post_meta['post-format-type'] ) ? $post_meta['post-format-type'] : 'standard';
		$link = get_permalink( $post_ID );
		$link = rawurlencode( $link );

		if( defined( 'DOING_AJAX' ) && DOING_AJAX && class_exists('WPBMap') && method_exists('WPBMap', 'addAllMappedShortcodes') ) {
			WPBMap::addAllMappedShortcodes();
		} ?>

        <!-- Featured Image -->
        <div class="entry-thumb">
        	<?php self::trendytravel_post_thumb( $post_ID, $meta[10] ); ?>

            <div class="entry-format <?php echo esc_attr($meta[4]); ?>">
                <a class="ico-format" href="<?php echo esc_url(get_post_format_link( $format )); ?>"></a>
            </div>
		</div><!-- Featured Image -->

        <!-- Post Details -->
        <div class="entry-details">

            <!-- Meta -->
            <?php $tclass = ( ($meta[6] == "hidden" ) && ($meta[7] == "hidden" ) && ($meta[5] == "hidden" ) ) ? "hidden" : ""; ?>
            <div class="entry-meta <?php echo esc_attr($tclass); ?>">
            	<div class="date <?php echo esc_attr($meta[6]); ?>"><span><?php echo get_the_date ('d'); ?></span> / <?php echo get_the_date ('M'); ?> / <?php echo get_the_date ('Y'); ?></div>
                <div class="entry-comment-author-meta">
                    <div class="comments <?php echo esc_attr($meta[7]); ?>"><?php
                        comments_popup_link( esc_html__('No Comments', 'trendytravel'), esc_html__('1 Comment', 'trendytravel'), esc_html__('% Comments', 'trendytravel'), '', esc_html__('Comments Off', 'trendytravel')); ?>
                    </div>
                    <div class="author <?php echo esc_attr( $meta[5] ); ?>">
                        | <i class="zmdi zmdi-account"> </i>
                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" 
                            title="<?php esc_attr_e('View all posts by ', 'trendytravel'); echo get_the_author(); ?>"><?php echo get_the_author(); ?></a>
                    </div>
                </div>
            </div><!-- Meta -->

            <div class="entry-title">
                <?php if( is_sticky( $post_ID ) ) echo '<span class="sticky-post">'.esc_html__('Featured', 'trendytravel').'</span>'; ?>
                <h4><a href="<?php echo get_permalink( $post_ID ); ?>" title="<?php printf(esc_attr__('Permalink to %s','trendytravel'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a></h4>
            </div>

			<?php if( isset($meta[2]) && isset($meta[3]) ):?>
				<div class="entry-body"><?php echo trendytravel_excerpt($meta[3]); ?></div>
            <?php endif;?>

            <!-- Category & Tag -->
            <?php $tclass = ( ($meta[8] == "hidden" ) && ($meta[9] == "hidden" ) ) ? "hidden" : ""; ?>
            <div class="entry-meta-data <?php echo esc_attr($tclass); ?>">
                <?php the_tags("<p class='tags {$meta[9]}'> <i class='pe-icon pe-ticket'> </i>",', ',"</p>"); ?>
                <p class="<?php echo esc_attr( $meta[8] ); ?> category"><i class="pe-icon pe-network"> </i> <?php the_category(', '); ?></p>
            </div><!-- Category & Tag -->

            <!-- Read More Button -->
            <?php if( isset($meta[0]) ):
                    $sc = isset( $meta[1] ) ? $meta[1] : "";
					if( !empty( $sc ) && shortcode_exists( 'dt_sc_button' ) && class_exists( 'Vc_Manager' ) ):
						$sc = str_replace("]",' link="url:'.$link.'"]',$sc);
						$sc = do_shortcode($sc);
						echo !empty( $sc ) ? $sc : '';
					else:
						echo '<a href="'.get_permalink().'" title="'.get_the_title().'" class="dt-sc-button medium filled type1">'.esc_html__('Read More', 'trendytravel').'</a>';
					endif;
                  endif;?><!-- Read More Button -->

        </div><!-- Post Details --><?php
	}

	//Minimal Bordered
	function trendytravel_post_minimal_bordered_style( $post_ID, $meta ) {

		$post_meta = get_post_meta($post_ID, '_dt_post_settings', TRUE);
		$post_meta = is_array($post_meta) ? $post_meta : array();

		$format = !empty( $post_meta['post-format-type'] ) ? $post_meta['post-format-type'] : 'standard';
		$link = get_permalink( $post_ID );
		$link = rawurlencode( $link );

		if( defined( 'DOING_AJAX' ) && DOING_AJAX && class_exists('WPBMap') && method_exists('WPBMap', 'addAllMappedShortcodes') ) {
			WPBMap::addAllMappedShortcodes();
		} ?>

        <!-- Featured Image -->
        <div class="entry-thumb">
        	<?php self::trendytravel_post_thumb( $post_ID, $meta[10] ); ?>

            <div class="entry-format <?php echo esc_attr($meta[4]); ?>">
                <a class="ico-format" href="<?php echo esc_url(get_post_format_link( $format )); ?>"></a>
            </div>
		</div><!-- Featured Image -->

        <!-- Post Details -->
        <div class="entry-details">
        	<?php if(is_sticky($post_ID)) echo '<div class="sticky-post"><span class="fa fa-trophy"> </span><span class="text">'.esc_html__('Featured', 'trendytravel').'</span></div>'; ?>

			<div class="entry-title">
            	<h4><a href="<?php echo get_permalink( $post_ID ); ?>" title="<?php printf(esc_attr__('Permalink to %s','trendytravel'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a></h4>
                <?php $tclass = ( ($meta[8] == "hidden" ) && ($meta[9] == "hidden" ) && ($meta[6] == "hidden" ) ) ? "hidden" : ""; ?>
                <div class="entry-meta <?php echo esc_attr($tclass); ?>">
                	<p class="<?php echo esc_attr( $meta[8] ); ?> category"><?php the_category(', '); ?></p>
                	<?php the_tags("<p class='tags {$meta[9]}'>",', ',"</p>"); ?>
                    <div class="date <?php echo esc_attr($meta[6]); ?>"><?php echo get_the_date ('M'); ?><?php echo get_the_date (' d, '); ?><?php echo get_the_date ('Y'); ?></div>
                </div>
            </div>

			<?php if( isset($meta[2]) && isset($meta[3]) ):?>
				<div class="entry-body"><?php echo trendytravel_excerpt($meta[3]); ?></div>
            <?php endif;?>

            <!-- Meta -->
            <?php $tclass = ( ($meta[5] == "hidden" ) && ($meta[7] == "hidden" ) && ($meta[0] == "hidden" ) ) ? "hidden" : ""; ?>
            <div class="entry-meta-data <?php echo esc_attr($tclass); ?>">
                <div class="author <?php echo esc_attr( $meta[5] ); ?>"><?php echo esc_html__('By ', 'trendytravel'); ?><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title="<?php esc_attr_e('View all posts by ', 'trendytravel'); echo get_the_author(); ?>"><?php echo get_the_author(); ?></a>
                </div>
                <div class="comments <?php echo esc_attr($meta[7]); ?>"><?php
                    comments_popup_link( esc_html__('Comments', 'trendytravel').'<span>0</span>', esc_html__('Comment', 'trendytravel').'<span>0</span>', esc_html__('Comments', 'trendytravel').'<span>%</span>', '', esc_html__('Comments Off', 'trendytravel')); ?>
                </div>
                <!-- Read More Button -->
                <?php if( isset($meta[0]) ):
                        $sc = isset( $meta[1] ) ? $meta[1] : "";
                        if( !empty( $sc ) && shortcode_exists( 'dt_sc_button' ) && class_exists( 'Vc_Manager' ) ):
                            $sc = str_replace("]",' link="url:'.$link.'"]',$sc);
                            $sc = do_shortcode($sc);
                            echo !empty( $sc ) ? $sc : '';
                        else:
                            echo '<a href="'.get_permalink().'" title="'.get_the_title().'" class="dt-sc-button small overline">'.esc_html__('Read More', 'trendytravel').'</a>';
                        endif;
                      endif;?><!-- Read More Button -->
            </div><!-- Meta -->

        </div><!-- Post Details --><?php
	}

	//Date Author Left
	function trendytravel_post_date_author_left_style( $post_ID, $meta ) {

		$post_meta = get_post_meta($post_ID, '_dt_post_settings', TRUE);
		$post_meta = is_array($post_meta) ? $post_meta : array();

		$format = !empty( $post_meta['post-format-type'] ) ? $post_meta['post-format-type'] : 'standard';
		$link = get_permalink( $post_ID );
		$link = rawurlencode( $link );
		$show_comment_meta = isset($show_comment_meta) ? $show_comment_meta : '';

		if( defined( 'DOING_AJAX' ) && DOING_AJAX && class_exists('WPBMap') && method_exists('WPBMap', 'addAllMappedShortcodes') ) {
			WPBMap::addAllMappedShortcodes();
		} ?>
        
        <!-- Featured Image -->
        <div class="entry-thumb"><?php if( is_sticky( $post_ID ) ) echo '<div class="featured-post"><span class="sticky-post">'.esc_html__('Featured', 'trendytravel').'</span></div>'; ?><?php self::trendytravel_post_thumb_date_author_left( $post_ID, $meta[10] ); ?></div><!-- Featured Image -->


        <!-- Entry date author -->
		<?php $tclass = ( ($meta[6] == "hidden" ) && ($meta[7] == "hidden" ) && ($meta[5] == "hidden" ) ) ? "hidden" : ""; ?>
        <div class="entry-date-author <?php echo esc_attr($tclass); ?>">
        
        	<div class="entry-format <?php echo esc_attr($meta[4]); ?>">
                <a class="ico-format" href="<?php echo esc_url(get_post_format_link( $format )); ?>"></a>
            </div>

            <div class="entry-date <?php echo esc_attr($meta[6]); ?>">
				<span><?php echo get_the_date('d'); ?></span>
                <?php echo get_the_date('M'); ?>
                <span><?php echo get_the_date('Y'); ?></span>
            </div>
            
        </div><!-- Entry date author -->

        <!-- Post Details -->
        <div class="entry-details">

            <div class="entry-title">
                
                <h4><a href="<?php echo get_permalink( $post_ID ); ?>" title="<?php printf(esc_attr__('Permalink to %s','trendytravel'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a></h4>
            </div>
           <!-- Category & Tag -->
           <?php $tclass = ( ($meta[8] == "hidden" ) && ($meta[9] == "hidden" ) ) ? "hidden" : ""; ?>
           <div class="entry-meta-data <?php echo esc_attr($tclass); ?>">
           		<p class="entry-author <?php echo esc_attr( $meta[5] ); ?>"><i class='fa fa-user'> </i>
                <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" 
                    title="<?php esc_attr_e('View all posts by ', 'trendytravel'); echo get_the_author(); ?>"><span><?php echo get_the_author(); ?></span></a>
            	</p>
                
                <p class="<?php echo esc_attr( $meta[8] ); ?> category"><i class="fa fa-folder-open"> </i> <?php the_category(', '); ?></p>
           
				<p class="comments <?php echo esc_attr($meta[7]); ?>"><?php  if( ! post_password_required() ) {
						comments_popup_link( '<i class="fa fa-comment"> </i>'.esc_html__(' 0','trendytravel'), '<i class="fa fa-comment"> </i>'.esc_html__(' 1','trendytravel'),
				'<i class="fa fa-comment"> </i> % ', $show_comment_meta, '<i class="fa fa-comment"> </i>'.esc_html__(' 0','trendytravel'));
					} else {
						echo '<p class="password-protect"><i class="fa fa-lock"> </i>'.esc_html__(' Enter your password to view comments.', 'trendytravel')."</p>";
					} ?>
					</p>
			</div><!-- Category & Tag -->
		<?php if( isset($meta[2]) && isset($meta[3]) ):?>
			<div class="entry-body"><?php echo trendytravel_excerpt($meta[3]); ?></div>
		<?php endif;?>
		<div class="tags"><?php the_tags("<p class='tags {$meta[9]}'> <i class='fa fa-tags'> </i> ".esc_html__('Posted In:  ', 'trendytravel').'&nbsp;&nbsp;&nbsp;&nbsp;',' ',"</p>"); ?></div>
        </div><!-- Post Details -->
		 <!-- Read More Button -->
		<?php if( isset($meta[0]) ):
            $sc = isset( $meta[1] ) ? $meta[1] : "";
            if( !empty( $sc ) && shortcode_exists( 'dt_sc_button' ) && class_exists( 'Vc_Manager' ) ):
                $sc = str_replace("]",' link="url:'.$link.'"]',$sc);
                $sc = do_shortcode($sc);
                echo !empty( $sc ) ? $sc : '';
            else:
                echo '<a href="'.get_permalink().'" title="'.get_the_title().'" class="dt-sc-button small filled rounded-corner">'.esc_html__('Read More', 'trendytravel').'</a>';
            endif;
          endif;?><!-- Read More Button --><?php
	} 
}