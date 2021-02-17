<?php get_header();

    $settings = get_post_meta($post->ID,'_hotel_settings',TRUE);
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

                $cat = get_the_term_list( $post->ID, 'hotel_entries', '', '$$$', '');
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
    $meta_set = get_post_meta($post->ID, '_hotel_settings', true);
    
		//RATING CALCULATION...
	  $notes = array( 0 => __('No Rating Yet', 'designthemes-core'), 1 => __('Very Poor', 'designthemes-core'), 2 => __('Not that bad', 'designthemes-core'), 3 => __('Average', 'designthemes-core'), 4 => __('Good', 'designthemes-core'), 5 => __('Perfect', 'designthemes-core'));
	  $arr_rate = trendytravel_comment_rating_count(get_the_ID());
	  $all_avg = trendytravel_comment_rating_average(get_the_ID());
	  
	  $map_code = '';
	  $map_code = '<div class="widget">';
	  	$map_code .= '<h3 class="widgettitle">'.__('Here we are', 'designthemes-core').'</h3>';
		$map_code .= '<div id="hotel_map_'.get_the_ID().'" class="list-hotel-map" data-add="'.get_the_title().', '.esc_attr(@$meta_set['hotel_add']).'" data-lt="'.esc_attr(@$meta_set['hotel_lat']).'" data-lg="'.esc_attr(@$meta_set['hotel_long']).'"></div>';
	  $map_code .= '</div>';
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
					<?php echo get_the_term_list($post->ID, 'hotel_entries', '<p class="hotel-type">', ' ', '</p>'); ?>
					<h1 class="section-title hotel-title"><?php the_title(); ?></h1><sub><?php echo wp_kses($meta_set['hotel_add'], $dt_allowed_html_tags);?></sub><?php
					
                    echo '<div class="star-rating-wrapper"><div class="star-rating"><span style="width:'.(($all_avg/5)*100).'%"></span></div>('.__('Average ', 'designthemes-core').$all_avg.__(' of ', 'designthemes-core').count($arr_rate).__(' Ratings', 'designthemes-core').')</div><div class="dt-sc-hr-invisible"></div>';
					//Hotel Content Starts...
					the_content();
					wp_link_pages(array('before' => '<div class="page-link"><strong>'.__('Pages:', 'designthemes-core').'</strong> ', 'after' => '</div>', 'next_or_number' => 'number'));
					edit_post_link(__('Edit', 'designthemes-core'), '<span class="edit-link">', '</span>' );

					if($meta_set["show-book-now"] == 1): ?>
						<p class="aligncenter"><a href="<?php echo trendytravel_get_page_permalink_by_its_template('tpl-booking.php'); ?>" class="theme-btn dt-sc-button medium"><?php _e('Book Now', 'designthemes-core'); ?></a></p><?php
					endif;
					
                    
					if( @array_key_exists("hotel-gallery", $meta_set) ):
						$items = explode(',',$meta_set['hotel-gallery']);
						
						//$image_src = wp_get_attachment_image_src($items);
						
						echo '<div class="dt-sc-hr-invisible-small"></div><div class="clear"></div>';
						echo "<ul class='entry-gallery-post-slider'>";
							foreach ( $items as $item ) { 
							$image_src = wp_get_attachment_url($item);
							echo "<li><img src='".$image_src."' alt='hotel-img' /></li>";	
							
							}
						echo "</ul>";
						echo "<div id='entry-gallery-pager'>"; $i = 0;
							foreach ( $items as $item ) { 
							$image_src = wp_get_attachment_url($item);
							echo "<a data-slide-index='".$i."' href=''><img src='".$image_src."' alt='hotel-img' /></a>"; $i += 1;	}
						echo "</div>";
						echo '<div class="dt-sc-hr-invisible"></div><div class="dt-sc-hr-invisible-small"></div><div class="clear"></div>';
					endif;
                    //Ratings...
                    if($meta_set["show-ratings"] == 1): ?>
                        <h2 class="section-title"><?php echo count($arr_rate); _e('&nbsp;People have Rated', 'designthemes-core'); ?></h2>
                        <div class="dt-sc-four-sixth column first">
                            <div class="rating-wrapper"><?php
                                $split_rate = array_count_values($arr_rate);
                                //Performing ratings...
                                for($i = 5; $i >= 1; $i--):
                                    if(!isset($split_rate[$i])) $split_rate[$i] = 0;
                                        echo '<div class="rating-item">';
                                            echo '<ul>';
                                                echo '<li class="rate-number">'.$i.' '.__('Stars', 'designthemes-core').'</li>';
                                                echo '<li class="rate-starts"><p class="pack-rating rate-'.$i.'"><span></span></p></li>';
                                                $p = @($split_rate[$i] / count($arr_rate)) * 100;
                                                echo '<li class="rate-percent"><span style="background:#6dc82b; width:'.round($p, 1).'%; display:block; height:100%;"></span></li>';
                                                echo '<li class="rate-total">'.$split_rate[$i].'</li>';
                                            echo '</ul>';
                                        echo '</div>';
                                endfor; ?>
                            </div>
                        </div>
                        <div class="dt-sc-two-sixth column">
                            <div class="overal-rating-wrapper">
                                <div class="overal-rating">
                                    <p><?php echo $all_avg; ?></p>
                                </div>
                                <h2><?php echo $notes[round($all_avg)]; ?></h2>
                                <p><?php _e('Based on Ratings from', 'designthemes-core'); echo '&nbsp;'.count($arr_rate).'&nbsp;'; _e('People', 'designthemes-core'); ?></p>
                                <a href="#respond" class="theme-btn dt-sc-button medium"><?php _e('Write a Review', 'designthemes-core'); ?></a>
                            </div>
                        </div>
                        <div class="clear"></div><?php
					endif;
                    //Reviews...
					if($meta_set["show-ratings"] == 1) comments_template('/custom-comments.php', true); ?>
                </article>
           <?php endwhile; ?>
        </section><!-- Primary End --><?php
        
        if ( $show_sidebar ) {
            if ( $show_left_sidebar ) {
                $sticky_class = ( array_key_exists('enable-sticky-sidebar', $settings) && $settings['enable-sticky-sidebar'] == 'true' ) ? ' sidebar-as-sticky' : '';?>
                
                <!-- Secondary Left -->
                <section id="secondary-left" class="secondary-sidebar <?php esc_attr( $sidebar_class.$sticky_class );?>"><?php echo $map_code;
                    trendytravel_show_sidebar( 'dt_hotels', $post->ID, 'left' ); ?>
                </section><!-- Secondary Left End --><?php
            }
        }

        if ( $show_sidebar ) {
            if ( $show_right_sidebar ) {
                $sticky_class = ( array_key_exists('enable-sticky-sidebar', $settings) && $settings['enable-sticky-sidebar'] == 'true' ) ? ' sidebar-as-sticky' : '';?>

                <!-- Secondary Right -->
                <section id="secondary-right" class="secondary-sidebar <?php esc_attr( $sidebar_class.$sticky_class );?>"><?php echo $map_code;
                    trendytravel_show_sidebar( 'dt_hotels', $post->ID, 'right' ); ?>
                </section><!-- Secondary Right End --><?php
            }
        }?>
    </div>
    <!-- ** Container End ** -->
    
</div><!-- **Main - End ** -->    
<?php get_footer(); ?>