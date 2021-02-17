<?php
/*
	Template Name: Booking - Review
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
                              <div class="step-icon-wrapper step-finish">
                                  <div class="step-icon step-room"><span></span></div>
                                  <h5>2. <?php esc_html_e('Select Your Room', 'trendytravel'); ?></h5>
                              </div>
                          </div>
                          <div class="step-wrapper">
                              <div class="step-icon-wrapper step-icon-current">
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
					  //Check date & token...
					  if(isset($_COOKIE['checkin']) != "" && isset($_COOKIE['checkout']) != "" && $_REQUEST['token']): ?>
                      	  <div class="dt-sc-success-reserve"><i class="fa fa-user"></i><?php esc_html_e('Hi! You have successfully made a reservation. Here are your reservation details.', 'trendytravel'); ?></div>
                          <h3 class="section-title aligncenter"><?php esc_html_e('Your Order Confirmation', 'trendytravel'); ?></h3>
                          <table>
                          	<thead><tr><th><?php esc_html_e('Order No', 'trendytravel'); ?></th><th><i class="fa fa-building-o"></i> <?php esc_html_e('Hotel', 'trendytravel'); ?></th><th><i class="fa fa-coffee"></i> <?php esc_html_e('Room', 'trendytravel'); ?></th><th><i class="fa fa-calendar"></i> <?php esc_html_e('Check In', 'trendytravel'); ?></th><th><i class="fa fa-calendar"></i> <?php esc_html_e('Check Out', 'trendytravel'); ?></th></tr></thead>
                            <tbody>
                            	<tr>
                                	<td><?php echo esc_attr($_REQUEST['token']); ?></td>
                                    <td><?php echo get_the_title($_COOKIE['hotelid']); ?></td>
                                    <td><?php echo get_the_title($_COOKIE['roomid']); ?></td>
                                    <td><?php echo esc_attr($_COOKIE['checkin']); ?></td>
                                    <td><?php echo esc_attr($_COOKIE['checkout']); ?></td>
                                </tr>
                            </tbody>
                          </table><?php

						  require_once get_template_directory().'/framework/hotelbooking/paypal/review.php';

					  elseif(isset($_REQUEST['payarrival']) == 'true'): ?>
                      	  <div class="dt-sc-success-reserve"><i class="fa fa-user"></i><strong><?php esc_html_e('Hi', 'trendytravel'); ?> <?php echo esc_attr($_REQUEST['fname']); ?>!</strong> <?php esc_html_e('You have successfully made a reservation. Here are your reservation details.', 'trendytravel'); ?></div>
                      	  <h3 class="section-title aligncenter"><?php esc_html_e('Your Order Confirmation', 'trendytravel'); ?></h3>
						  <table>
                          	<thead><tr><th><i class="fa fa-building-o"></i> <?php esc_html_e('Hotel', 'trendytravel'); ?></th><th><i class="fa fa-coffee"></i> <?php esc_html_e('Room', 'trendytravel'); ?></th><th><i class="fa fa-calendar"></i> <?php esc_html_e('Check In', 'trendytravel'); ?></th><th><i class="fa fa-calendar"></i> <?php esc_html_e('Check Out', 'trendytravel'); ?></th></tr></thead>
                            <tbody>
                            	<tr>
                                    <td><?php echo get_the_title($_REQUEST['hid']); ?></td>
                                    <td><?php echo get_the_title($_REQUEST['rid']); ?></td>
                                    <td><?php echo esc_attr($_REQUEST['cin']); ?></td>
                                    <td><?php echo esc_attr($_REQUEST['cout']); ?></td>
                                </tr>
                            </tbody>
                          </table><?php
					  else:
						  ?><div class="dt-sc-notice"><?php esc_html_e('Please do not reload the page', 'trendytravel'); ?>, <a href="<?php echo trendytravel_get_page_permalink_by_its_template('tpl-booking.php'); ?>"><?php esc_html_e('begin your booking here', 'trendytravel'); ?></a></div><?php
					  endif;
                      
                      edit_post_link(__('Edit', 'trendytravel'), '<span class="edit-link">', '</span>' ); ?>
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