<?php get_header();

    $settings = get_post_meta($post->ID,'_place_settings',TRUE);
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
	$meta_set = get_post_meta($post->ID, '_place_settings', true);
		//RATING CALCULATION...
	  $notes = array( 0 => __('No Rating Yet', 'designthemes-core'), 1 => __('Very Poor', 'designthemes-core'), 2 => __('Not that bad', 'designthemes-core'), 3 => __('Average', 'designthemes-core'), 4 => __('Good', 'designthemes-core'), 5 => __('Perfect', 'designthemes-core'));
	  $arr_rate = trendytravel_comment_rating_count(get_the_ID());
	  $all_avg = trendytravel_comment_rating_average(get_the_ID());
	  
	  $map_code = '';
	  $map_code = '<div class="widget">';
	  	$map_code .= '<h3 class="widgettitle">'.__('Here we are', 'designthemes-core').'</h3>';
		$map_code .= '<div id="place_map'.get_the_ID().'" class="list-hotel-map" data-add="'.get_the_title().', '.esc_attr(@$meta_set['place_add']).'" data-lt="'.esc_attr(@$meta_set['place_lat']).'" data-lg="'.esc_attr(@$meta_set['place_long']).'"></div>';
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
					<?php echo get_the_term_list($post->ID, 'place_entries', '<p class="hotel-type">', ' ', '</p>'); ?>
					<h1 class="section-title place-heading"><?php the_title(); ?></h1><sub><?php echo wp_kses($meta_set['place_add'], $dt_allowed_html_tags);?></sub><?php
					
                    echo '<div class="star-rating-wrapper"><div class="star-rating"><span style="width:'.(($all_avg/5)*100).'%"></span></div>('.__('Average ', 'designthemes-core').$all_avg.__(' of ', 'designthemes-core').count($arr_rate).__(' Ratings', 'designthemes-core').')</div><div class="dt-sc-hr-invisible"></div>';
					
					if( @array_key_exists("places-gallery", $meta_set) ):
						$items = explode(',',$meta_set['places-gallery']);
						
						//$image_src = wp_get_attachment_image_src($items);
						
						echo '<div class="clear"></div>';
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
					the_excerpt();
					//Show hotels & destination list...
					if($meta_set['show-hotels-list'] == 1): ?>
                        <div class="dt-sc-hr-invisible"></div>
                        
                        <div class="dt-sc-one-half column first"><?php
							//Check Hotels...
							$hotel_array = @array_filter($meta_set['place-hotels-list']);
							if($hotel_array != NULL): ?>
								<div class="widget hotels-list-widget">
									<h3 class="widgettitle"><?php _e('Hotels to Stay', 'designthemes-core'); ?></h3>
									<div class="recent-hotels-widget">
										<ul><?php
											foreach($hotel_array as $hid):
												$tpost = get_post($hid);
												$attr = array('title' => $tpost->post_title);
												$hmeta = get_post_meta($hid, '_hotel_settings', true);
											    $arr_rate = trendytravel_comment_rating_count($hid);
												$all_avg = trendytravel_comment_rating_average($hid); ?>
                                                <li>
                                                    <a class="thumb" href="<?php echo get_permalink($hid); ?>"><?php echo get_the_post_thumbnail($hid, array(100, 80), $attr); ?></a>
                                                    <h6><a href="<?php echo get_permalink($hid); ?>"><?php echo $tpost->post_title; ?></a>, <sub><?php echo wp_kses(@$hmeta['hotel_add'], $dt_allowed_html_tags); ?></sub></h6>
                                                    <?php echo '<div class="star-rating-wrapper"><div class="star-rating"><span style="width:'.(($all_avg/5)*100).'%"></span></div>('.count($arr_rate).__(' Ratings', 'designthemes-core').')</div>'; ?>
                                                    <a href="<?php echo get_permalink($hid);?>#hotel_map_<?php echo $hid;?>" class="map-marker"><span class="red"></span><?php _e('View on Map', 'designthemes-core'); ?></a>
                                                </li><?php
											endforeach; ?>
										</ul>
									</div>
								</div><?php
							else:
								echo '<h4>'.__('No Hotels Found.', 'designthemes-core').'</h4>';
								echo '<p>'.__('Choose hotels from back-end to show in this section.', 'designthemes-core').'</h2>';
							endif; ?>
                        </div>
                        
                        <div class="dt-sc-one-half column"><?php
							//Check Destinations...
							$dests_array = @array_filter($meta_set['place-destinations-list']);
							if($dests_array != NULL): ?>
                                <div class="widget places-list-widget">
                                    <h3 class="widgettitle"><?php _e('Popular Destinations', 'designthemes-core'); ?></h3>
                                    <div class="recent-places-widget">
                                        <ul><?php
											foreach($dests_array as $did):
												$tpost = get_post($did);
												$attr = array('title' => $tpost->post_title);
												$pmeta = get_post_meta($did, '_place_settings', true);
											    $arr_rate = trendytravel_comment_rating_count($hid);
												$all_avg = trendytravel_comment_rating_average($hid); ?>
                                                <li>
                                                    <a class="thumb" href="<?php echo get_permalink($did); ?>"><?php echo get_the_post_thumbnail($did, array(100, 80), $attr); ?></a>
                                                    <h6><a href="<?php echo get_permalink($did); ?>"><?php echo $tpost->post_title; ?></a>, <sub><?php echo wp_kses(@$pmeta['place_add'], $dt_allowed_html_tags); ?></sub></h6>
                                                    <?php echo '<div class="star-rating-wrapper"><div class="star-rating"><span style="width:'.(($all_avg/5)*100).'%"></span></div>('.count($arr_rate).__(' Ratings', 'designthemes-core').')</div>'; ?>
                                                    <a href="<?php echo get_permalink($did);?>#place_map_<?php echo $did;?>" class="map-marker"><span class="red"></span><?php _e('View on Map', 'designthemes-core'); ?></a>
                                                </li><?php
											endforeach; ?>
                                        </ul>
                                    </div>
                                </div><?php
							else:
								echo '<h4>'.__('No Destinations Found.', 'designthemes-core').'</h4>';
								echo '<p>'.__('Choose destinations from back-end to show in this section.', 'designthemes-core').'</h2>';
							endif; ?>
                        </div><?php
					endif;
					echo '<div class="clear"></div>';
					the_content();
                    wp_link_pages(array('before' => '<div class="page-link"><strong>'.__('Pages:', 'designthemes-core').'</strong> ', 'after' => '</div>', 'next_or_number' => 'number'));
                    edit_post_link(__('Edit', 'designthemes-core'), '<span class="edit-link">', '</span>' );
					
                    if($meta_set['show-reviews'] == 1):
						echo '<div class="dt-sc-hr-invisible"></div>';
						comments_template('/custom-comments.php', true); ?>
						<a href="#respond" class="dt-sc-button medium green aligncenter btn-place-review"><?php _e('Write a Review about ', 'designthemes-core'); the_title(); ?></a><?php
                    endif;
                    
					if($meta_set['show-recommends'] == 1): ?>
						<div class="dt-sc-hr-invisible"></div>
                        <h2 class="section-title"><?php _e('Our Recommendations', 'designthemes-core'); ?></h2><?php
						
						$args = array('orderby' => 'rand', 'post_type' => 'dt_places', 'post__not_in' => array(get_the_ID()), 'posts_per_page' => 8);
						$the_query = new WP_Query($args);
						if($the_query->have_posts()):
						  $maxitems = ($the_query->post_count <= 4) ? $the_query->post_count : 4; ?>
                          <div class="carousel_items">
                            <div class="dt-sc-places-wrapper dt_carousel" data-items="<?php echo esc_attr($maxitems); ?>"><?php
								while($the_query->have_posts()): $the_query->the_post();
									$place_meta = get_post_meta(get_the_id() ,'_place_settings', true); ?>
									<div class="dt-sc-one-fourth column">
										<div class="place-item">
											<div class="place-thumb"><?php
												if( has_post_thumbnail() ): ?>
													<a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php
														$attr = array('title' => get_the_title()); the_post_thumbnail('place-thumb', $attr); ?>
                                                        <div class="image-overlay"><span class="image-overlay-inside"></span></div>
													</a><?php
												endif; ?>
											</div>
											<div class="place-detail-wrapper">
												<div class="place-title">
													<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
													<p><?php echo wp_kses(@$place_meta['place_add'], $dt_allowed_html_tags);?></p>
												</div>
												<div class="place-content">
													<a class="map-marker" href="<?php the_permalink(); ?>#place_map_<?php the_ID(); ?>"> <span class="red"></span><?php _e('View on Map', 'designthemes-core'); ?></a>
													<a class="dt-sc-button too-small" href="<?php the_permalink(); ?>"><?php _e('View details', 'designthemes-core'); ?></a>
												</div>
											</div>
										</div>
									</div><?php
								endwhile; 
								wp_reset_postdata();?>	
                            </div>
							<div class="carousel-arrows">
                                <a class="prev-arrow" href="#"><span class="fa fa-angle-left"> </span></a>
                                <a class="next-arrow" href="#"><span class="fa fa-angle-right"> </span></a>
                            </div>
						  </div><?php
						endif;
					endif; ?>
                </article>
           <?php endwhile; ?>
        </section><!-- Primary End --><?php
		
        if ( $show_sidebar ) {
            if ( $show_left_sidebar ) {
                $sticky_class = ( array_key_exists('enable-sticky-sidebar', $settings) && $settings['enable-sticky-sidebar'] == 'true' ) ? ' sidebar-as-sticky' : '';?>
                
                <!-- Secondary Left -->
                <section id="secondary-left" class="secondary-sidebar <?php esc_attr( $sidebar_class.$sticky_class );?>"><?php echo $map_code;
                    trendytravel_show_sidebar( 'dt_places', $post->ID, 'left' ); ?>
                </section><!-- Secondary Left End --><?php
            }
        }

        if ( $show_sidebar ) {
            if ( $show_right_sidebar ) {
                $sticky_class = ( array_key_exists('enable-sticky-sidebar', $settings) && $settings['enable-sticky-sidebar'] == 'true' ) ? ' sidebar-as-sticky' : '';?>

                <!-- Secondary Right -->
                <section id="secondary-right" class="secondary-sidebar <?php esc_attr( $sidebar_class.$sticky_class );?>"><?php echo $map_code;
                    trendytravel_show_sidebar( 'dt_places', $post->ID, 'right' ); ?>
                </section><!-- Secondary Right End --><?php
            }
        }?>
    </div>
    <!-- ** Container End ** -->
    
</div><!-- **Main - End ** -->    
<?php get_footer(); ?>