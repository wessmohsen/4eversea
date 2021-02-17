<?php
/*
	Template Name: Booking - II
*/
	get_header();

    $settings = get_post_meta($post->ID,'_tpl_default_settings',TRUE);
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

    <!-- ** Slider ** -->
    <?php
        if( !isset( $settings['enable-sub-title'] ) || !$settings['enable-sub-title'] ) {
            if( isset( $settings['show_slider'] ) && $settings['show_slider'] ) {
                if( isset( $settings['slider_type'] ) ) {
                    if( $settings['slider_type'] == 'layerslider' && !empty( $settings['layerslider_id'] ) ) {
                        echo '<div id="slider">';
                        echo '  <div id="dt-sc-layer-slider" class="dt-sc-main-slider">';
                        echo    do_shortcode('[layerslider id="'.$settings['layerslider_id'].'"/]');
                        echo '  </div>';
                        echo '</div>';
					} elseif( $settings['slider_type'] == 'revolutionslider' && !empty( $settings['revolutionslider_id'] ) ) {
                        echo '<div id="slider">';
                        echo '  <div id="dt-sc-rev-slider" class="dt-sc-main-slider">';
                        echo    do_shortcode('[rev_slider '.$settings['revolutionslider_id'].'/]');
                        echo '  </div>';
                        echo '</div>';
					} elseif( $settings['slider_type'] == 'customslider' && !empty( $settings['customslider_sc'] ) ) {
                        echo '<div id="slider">';
                        echo '  <div id="dt-sc-custom-slider" class="dt-sc-main-slider">';
                        echo    do_shortcode( $settings['customslider_sc'] );
                        echo '  </div>';
                        echo '</div>';
					}
                }
            }
        }
    ?><!-- ** Slider End ** -->

    <!-- ** Breadcrumb ** -->
    <?php 
        # Global Breadcrumb
        if( !empty( $global_breadcrumb ) ) {

			if(empty($settings)) { $settings['enable-sub-title'] = true; }

            if( isset( $settings['enable-sub-title'] ) && $settings['enable-sub-title'] ) {
                $breadcrumbs = array();
                $bstyle = trendytravel_cs_get_option( 'breadcrumb-style', 'default' );

                if( $post->post_parent ) {
                    $parent_id  = $post->post_parent;
                    $parents = array();

                    while( $parent_id ) {
                        $page = get_page( $parent_id );
                        $parents[] = '<a href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a>';
                        $parent_id  = $page->post_parent;
                    }

                    $parents = array_reverse( $parents );
                    $breadcrumbs = array_merge_recursive($breadcrumbs, $parents);
                }

                $breadcrumbs[] = the_title( '<span class="current">', '</span>', false );
				$bcsettings = isset( $settings['breadcrumb_background'] ) ? $settings['breadcrumb_background'] : array();
                $style = trendytravel_breadcrumb_css( $bcsettings );

                trendytravel_breadcrumb_output ( the_title( '<h1>', '</h1>',false ), $breadcrumbs, $bstyle, $style );
            }
        }
    ?><!-- ** Breadcrumb End ** -->
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
        <?php if($page_layout != 'content-full-width'): ?>
		            <section id="primary" class="page-with-sidebar page-<?php echo esc_attr($page_layout); ?>">
			  <?php else: ?>
		            <section id="primary" class="content-full-width">
              <?php endif; ?>
				  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>><?php
				  	  while($wp_query->have_posts()): $wp_query->the_post();
                      the_content();
                      wp_link_pages(array('before' => '<div class="page-link"><strong>'.esc_html__('Pages:', 'trendytravel').'</strong> ', 'after' => '</div>', 'next_or_number' => 'number')); ?>

                      <div class="booking-step-wrapper clearfix">
                          <div class="step-wrapper">
                              <div class="step-icon-wrapper step-finish">
                                  <div class="step-icon step-date"><span></span></div>
	                              <h5>1. <?php esc_html_e('Select Your Date', 'trendytravel'); ?></h5>
                              </div>
                          </div>
                          <div class="step-wrapper">
                              <div class="step-icon-wrapper step-icon-current">
                                  <div class="step-icon step-room"><span></span></div>
                                  <h5>2. <?php esc_html_e('Select Your Room', 'trendytravel'); ?></h5>
                              </div>
                          </div>
                          <div class="step-wrapper">
                              <div class="step-icon-wrapper">
                                  <div class="step-icon step-reserve"><span></span></div>
	                              <h5>3. <?php esc_html_e('Place Your Reservation', 'trendytravel'); ?></h5>
                              </div>
                          </div>
                          <div class="step-wrapper last-col">
                              <div class="step-icon-wrapper">
                                  <div class="step-icon step-review"><span></span></div>
	                              <h5>4. <?php esc_html_e('Confirmation', 'trendytravel'); ?></h5>
                              </div>
                          </div>
                          <div class="step-line"></div>
                      </div><?php
					  //Valid date...
					  if(isset($_REQUEST['txtcheckindate']) != "" && isset($_REQUEST['txtcheckoutdate']) != ""):
						  $checkin = esc_attr($_REQUEST['txtcheckindate']);
						  $checkout = esc_attr($_REQUEST['txtcheckoutdate']);
			  
						  //Putting values to cookies...
						  setcookie('checkin', $checkin, (time()+3600), "/");	setcookie('checkout', $checkout, (time()+3600), "/");
						  setcookie('adults', $_REQUEST['cmbadults'], (time()+3600), "/"); setcookie('childs', esc_attr($_REQUEST['cmbchilds']), (time()+3600), "/");
						  
						  //Getting action...
						  $action = trendytravel_get_page_permalink_by_its_template('tpl-booking-iii.php'); ?>
						  <div class="dt-sc-one-third column first dt-reserve-wrapper">
							  <h3 class="section-title"><?php esc_html_e('Your Reservation', 'trendytravel'); ?></h3>
							  <ul>
								  <li><i class="fa fa-calendar"></i><span><?php esc_html_e('Check In:', 'trendytravel'); ?> </span><?php echo esc_attr($checkin); ?></li>
								  <li><i class="fa fa-calendar"></i><span><?php esc_html_e('Check Out:', 'trendytravel'); ?> </span><?php echo esc_attr($checkout); ?></li>
								  <li><i class="fa fa-group"></i><span><?php esc_html_e('Guests:', 'trendytravel'); ?> </span><?php echo esc_attr($_REQUEST['cmbadults']); ?>&nbsp;<?php esc_html_e('Adult(s)', 'trendytravel'); ?>, <?php echo esc_attr($_REQUEST['cmbchilds']); ?>&nbsp;<?php esc_html_e('Child(s)', 'trendytravel'); ?></li>
                                  <li><a class="dt-sc-button green" href="<?php echo trendytravel_get_page_permalink_by_its_template('tpl-booking.php'); ?>"><?php esc_html_e('Edit Reservation', 'trendytravel'); ?></a></li>
							  </ul>
						  </div>
						  <div class="dt-sc-two-third column dt-room-wrapper">
							  <h3 class="section-title"><?php esc_html_e('Choose Your Room', 'trendytravel'); ?></h3><?php
							  //Getting dates...
							  $unroom_ids = array(); $args = "";
							  $availableoptions = get_option('hb_available_settings');
							  $select_arr = dt_theme_get_all_dates($checkin, $checkout);

							  if($availableoptions):
								  foreach($availableoptions as $key => $opts):
									  $temp = array();
									  foreach($opts as $k => $opt):
										  $c = count(array_intersect(explode(',', $opt), $select_arr));
										  //Push the roomids...
										  if($c > 0) {
											  array_push($temp, $k);
										  }
									  endforeach;
									  $unroom_ids[$key] = $temp;					
								  endforeach;
							  endif;  
							  
							  //Check Hotels Meta & Room type available...
							  if(!empty($_REQUEST['txtcityid'])) {
								  $args = array('post_type' => 'dt_hotels', 'posts_per_page' => -1, 'tax_query' => array(
																			array( 'taxonomy' => 'hotel_locations', 'field' => 'term_id', 'terms' => array($_REQUEST['txtcityid']), ), ));
							  } else {
								  $args = array('post_type' => 'dt_hotels', 'posts_per_page' => -1);
							  }

							  $the_query = new WP_Query($args);
							  if($the_query->have_posts()): ?>
								  <ul class="dt-room-list-wrapper"><?php
									  while($the_query->have_posts()): $the_query->the_post();
										  //Getting meta...
										  $hid = get_the_ID();
										  $hmeta = get_post_meta( $hid, '_hotel_settings', TRUE );

										  $selected_rooms = $hmeta['room-types'];
										  $arr = @array_diff($selected_rooms, $unroom_ids[$hid]);
                                          $arr = @array_filter($arr);

										  
										  if(!empty($arr)) {
											  $args = array('post_type' => 'dt_rooms', 'posts_per_page' => -1, 'post__in' => $arr);
										  } elseif($unroom_ids[$hid] === NULL) {
											  $args = array('post_type' => 'dt_rooms', 'posts_per_page' => -1, 'post__in' => $selected_rooms);
										  } else {
											  continue;
										  }

										  echo '<h3 class="dt-room-parent"><a href="'.get_permalink(get_the_ID()).'" title="'.get_the_title(get_the_ID()).'">'.get_the_title(get_the_ID()).'</a></h3>';
										  //Retriving with current query...
										  $room_query = new WP_Query($args);
										  
										  
										  if($room_query->have_posts()):
											  while($room_query->have_posts()): $room_query->the_post();
												  $room_meta = get_post_meta(get_the_ID(), '_room_settings', true); 
														?>
												  <li class="dt-room-item">
													  <h5><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a></h5>
													  <div class="dt-sc-room-thumb"><?php $attr = array('title' => get_the_title()); the_post_thumbnail('room-thumb', $attr); ?></div>
													  <div class="dt-sc-room-meta alignleft">
														  <ul>
															  <li><i class="fa fa-group"></i> <span><?php esc_html_e('Occupancy:', 'trendytravel'); ?></span><?php echo wp_kses($room_meta['room_occupancy'], $dt_allowed_html_tags); ?></li>
															  <li><i class="fa fa-building-o"></i> <span><?php esc_html_e('Size:', 'trendytravel'); ?></span><?php echo wp_kses($room_meta['room_size'], $dt_allowed_html_tags); ?></li>
														  </ul>
													  </div>
                                                      <div class="alignright">
                                                          <div class="hotel-thumb-meta">
                                                              <div class="hotel-price"><?php esc_html_e('Starts From', 'trendytravel'); ?> <span><?php echo dt_theme_currecy_symbol().wp_kses($room_meta['room_price'], $dt_allowed_html_tags); ?></span><?php esc_html_e('Per Night', 'trendytravel'); ?></div>
                                                              <form method="post" action="<?php echo esc_url($action); ?>" name="frmbook2">
                                                                  <input type="hidden" name="hotel_id" value="<?php echo esc_attr($hid); ?>" />
                                                                  <input type="hidden" name="room_id" value="<?php the_ID(); ?>" />
                                                                  <input type="submit" name="subselect" value="<?php esc_attr_e('Select Room', 'trendytravel'); ?>" />
                                                              </form>
                                                          </div>
                                                      </div>
                                                      <div class="dt-sc-hr-invisible-small"></div>
													  <div class="dt-sc-room-features"><?php echo get_the_excerpt(); ?></div>
												  </li><?php
											  endwhile;
										  endif;
									  endwhile; ?>
								  </ul><?php
							  else: ?>
                                  <h2><?php esc_html_e('Nothing Found.', 'trendytravel'); ?></h2>
                                  <p><?php esc_html_e('Apologies, but no results were found for the requested archive.', 'trendytravel'); ?></p><?php
							  endif;
							  wp_reset_postdata(); ?>
						  </div>
					  <?php
					  else:
						  ?><div class="dt-sc-notice"><?php esc_html_e('Please do not reload the page', 'trendytravel'); ?>, <a href="<?php echo trendytravel_get_page_permalink_by_its_template('tpl-booking.php'); ?>"><?php esc_html_e('begin your booking here', 'trendytravel'); ?></a></div><?php
					  endif;
                       edit_post_link( esc_html__( ' Edit ','trendytravel' ) ); ?> ?>
                  </article>
              </section>

              <?php
               if ( $show_sidebar ) {
                if ( $show_left_sidebar ) {
                    $sticky_class = ( array_key_exists('enable-sticky-sidebar', $settings) && $settings['enable-sticky-sidebar'] == 'true' ) ? ' sidebar-as-sticky' : '';?>
                    
                    <!-- Secondary Left -->
                    <section id="secondary-left" class="secondary-sidebar <?php echo esc_attr( $sidebar_class.$sticky_class ); ?>"><?php
                        trendytravel_show_sidebar( 'page', $post->ID, 'left' ); ?>
                    </section><!-- Secondary Left End --><?php
                }
            }
            ?>
              
              <?php if($page_layout == 'with-right-sidebar'): ?>
              	  <section class="secondary-sidebar secondary-has-right-sidebar" id="secondary-right"><?php get_sidebar('right'); ?></section>
              <?php elseif($page_layout == 'with-both-sidebar'): ?>
              	  <section class="secondary-sidebar secondary-has-both-sidebar" id="secondary-right"><?php get_sidebar('right'); ?></section>
              <?php endif;

        endwhile; ?>
          </div>
      </div>

<?php get_footer(); ?>