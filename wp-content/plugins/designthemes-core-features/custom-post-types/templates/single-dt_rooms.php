<?php get_header();

    $settings = get_post_meta($post->ID,'_room_settings',TRUE);
    $settings = is_array( $settings ) ?  array_filter( $settings )  : array();
	
	$global_breadcrumb = cs_get_option( 'show-breadcrumb' );

    $header_class = '';
    if( !isset( $settings['enable-sub-title'] ) || !$settings['enable-sub-title']  ) {
        if( isset( $settings['show_slider'] ) && $settings['show_slider'] ) {
            if( isset( $settings['slider_type'] ) ) {
                $header_class =  $settings['slider_position'];
            }
        }
    }

    if( !empty( $global_breadcrumb ) ) {
        if( isset( $settings['enable-sub-title'] ) && $settings['enable-sub-title'] ) {
            $header_class = $settings['breadcrumb_position'];
		}
	}?>
<!-- ** Header Wrapper ** -->
<div id="header-wrapper" class="<?php echo esc_attr($header_class); ?>">

    <!-- **Header** -->
    <header id="header">

        <div class="container"><?php
            /**
             * trendytravel_header hook.
             * 
             * @hooked trendytravel_vc_header_template - 10
             *
             */
            do_action( 'trendytravel_header' ); ?>
        </div>
    </header><!-- **Header - End ** -->

      
    
    <!-- ** Breadcrumb ** -->
    <?php
        # Global Breadcrumb
        if( !empty( $global_breadcrumb ) ) {
            if( isset( $settings['enable-sub-title'] ) && $settings['enable-sub-title'] ) {
                $breadcrumbs = array();
                $bstyle = trendytravel_cs_get_option( 'breadcrumb-style', 'default' );

                $cat = get_the_term_list( $post->ID, 'place_entries', '', '$$$', '');
                $cats = array_filter(explode('$$$', $cat));
                if (!empty($cats))
                	$breadcrumbs[] = $cats[0];

                $breadcrumbs[] = the_title( '<span class="current">', '</span>', false );
                $style = trendytravel_breadcrumb_css( $settings['breadcrumb_background'] );

                trendytravel_breadcrumb_output ( the_title( '<h1>', '</h1>',false ), $breadcrumbs, $bstyle, $style );
            }
        }
    ?><!-- ** Breadcrumb End ** -->
    <?php
	$meta_set = get_post_meta($post->ID, '_room_settings', true);
		//RATING CALCULATION...
	  $notes = array( 0 => __('No Rating Yet', 'designthemes-core'), 1 => __('Very Poor', 'designthemes-core'), 2 => __('Not that bad', 'designthemes-core'), 3 => __('Average', 'designthemes-core'), 4 => __('Good', 'designthemes-core'), 5 => __('Perfect', 'designthemes-core'));
	  $arr_rate = trendytravel_comment_rating_count(get_the_ID());
	  $all_avg = trendytravel_comment_rating_average(get_the_ID());
	  ?>

</div><!-- ** Header Wrapper - End ** -->
<!-- **Main** -->
<div id="main">

    <!-- ** Container ** -->
    <div class="container"><?php
        $page_layout  = array_key_exists( "layout", $settings ) ? $settings['layout'] : "content-full-width";
        $layout = trendytravel_page_layout( $page_layout );
        extract( $layout );
        ?>

        <!-- Primary -->
        <section id="primary" class="<?php echo esc_attr( $page_layout );?>">
        <?php while(have_posts()): the_post(); ?>
        
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1 class="section-title hotel-title"><?php the_title(); ?></h1>
					<?php $room_meta = get_post_meta(get_the_ID(), '_room_settings', true); ?>

                    <div class="dt-sc-single-room-price">
                    	<div class="hotel-price">
                        	<span><?php echo dt_theme_currecy_symbol(); ?><?php echo wp_kses($room_meta['room_price'], $dt_allowed_html_tags); ?></span><?php _e('Per Night' ,'designthemes-core'); ?>
                        	<a class="dt-sc-button theme-btn too-small" href="<?php echo trendytravel_get_page_permalink_by_its_template('tpl-booking.php'); ?>"><?php _e('Book Now', 'designthemes-core'); ?></a>
                        </div>
                    </div>
					<div class="dt-sc-hr-invisible-small"></div><?php
					if( @array_key_exists("rooms-gallery", $meta_set) ):
						$items = explode(',',$meta_set['rooms-gallery']);
						echo '<div class="dt-sc-hr-invisible-small"></div><div class="clear"></div>';
						echo "<ul class='entry-gallery-post-slider'>";
							foreach ( $items as $item ) { 
								$image_src = wp_get_attachment_url($item);
								echo "<li><img src='".$image_src."' alt='place-img' /></li>";	
							}
						echo "</ul>";
						echo "<div id='entry-gallery-pager'>"; $i = 0;
							foreach ( $items as $item ) { 
							$image_src = wp_get_attachment_url($item);
							echo "<a data-slide-index='".$i."' href=''><img src='".$image_src."' alt='place-img' /></a>"; $i += 1;	}
						echo "</div>";
						echo '<div class="dt-sc-hr-invisible"></div><div class="dt-sc-hr-invisible-small"></div><div class="clear"></div>';
					endif;

					//Room content...
					the_content();
					wp_link_pages(array('before' => '<div class="page-link"><strong>'.__('Pages:', 'designthemes-core').'</strong> ', 'after' => '</div>', 'next_or_number' => 'number'));
					edit_post_link(__('Edit', 'designthemes-core'), '<span class="edit-link">', '</span>' ); ?>

                    <div class="dt-single-room-wrapper">
	                    <h4 class="section-title"><?php _e('Room Information', 'designthemes-core'); ?></h4>
                        <ul class="dt-single-room-meta">
                            <li><span><?php _e('Occupancy', 'designthemes-core'); ?></span> <?php echo wp_kses($room_meta['room_occupancy'], $dt_allowed_html_tags); ?></li>
                            <li><span><?php _e('Room Size', 'designthemes-core'); ?></span> <?php echo wp_kses($room_meta['room_size'], $dt_allowed_html_tags); ?></li>
                        </ul>
					</div>
                </article>
        	
        <?php endwhile; ?>
        </section><!-- Primary End --><?php

        if ( $show_sidebar ) {
            if ( $show_left_sidebar ) {
                $sticky_class = ( array_key_exists('enable-sticky-sidebar', $settings) && $settings['enable-sticky-sidebar'] == 'true' ) ? ' sidebar-as-sticky' : '';?>
                
                <!-- Secondary Left -->
                <section id="secondary-left" class="secondary-sidebar <?php esc_attr( $sidebar_class.$sticky_class );?>"><?php
                    trendytravel_show_sidebar( 'dt_rooms', $post->ID, 'left' ); ?>
                </section><!-- Secondary Left End --><?php
            }
        }

        if ( $show_sidebar ) {
            if ( $show_right_sidebar ) {
                $sticky_class = ( array_key_exists('enable-sticky-sidebar', $settings) && $settings['enable-sticky-sidebar'] == 'true' ) ? ' sidebar-as-sticky' : '';?>

                <!-- Secondary Right -->
                <section id="secondary-right" class="secondary-sidebar <?php esc_attr( $sidebar_class.$sticky_class );?>"><?php
                    trendytravel_show_sidebar( 'dt_rooms', $post->ID, 'right' ); ?>
                </section><!-- Secondary Right End --><?php
            }
        }?>
    </div>
    <!-- ** Container End ** -->
    
</div><!-- **Main - End ** -->    
<?php get_footer(); ?>