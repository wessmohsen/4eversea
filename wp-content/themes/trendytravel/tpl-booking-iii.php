<?php
/*
	Template Name: Booking - III
*/
	get_header();

    $settings = get_post_meta($post->ID,'_tpl_default_settings',TRUE);
    $settings = is_array( $settings ) ?  array_filter( $settings )  : array();

    $global_breadcrumb = cs_get_option( 'show-breadcrumb' );

    $privacy = $attrs = '';

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
    }
    
    ?>
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
					  //Valid date...
                      if(isset($_COOKIE['checkin']) != "" && isset($_COOKIE['checkout']) != "" && isset($_REQUEST['room_id']) != ""): ?>
                          <form id="frmhotelcheckout" name="frmhotelcheckout" action="<?php the_permalink(); ?>" method="post">
                              <div class="dt-sc-one-third column first dt-reserve-wrapper">
                                  <h3 class="section-title"><?php esc_html_e('Your Reservation', 'trendytravel'); ?></h3>
                                  <ul>
                                      <li><i class="fa fa-building-o"></i><span><?php esc_html_e('Hotel:', 'trendytravel'); ?> </span><?php echo get_the_title($_REQUEST['hotel_id']); ?></li>
                                      <li><i class="fa fa-home"></i><span><?php esc_html_e('Room:', 'trendytravel'); ?> </span><?php echo get_the_title($_REQUEST['room_id']); ?></li>
                                      <li><i class="fa fa-calendar"></i><span><?php esc_html_e('Check In:', 'trendytravel'); ?> </span><?php echo esc_attr($_COOKIE['checkin']); ?></li>
                                      <li><i class="fa fa-calendar"></i><span><?php esc_html_e('Check Out:', 'trendytravel'); ?> </span><?php echo esc_attr($_COOKIE['checkout']); ?></li>
                                      <li><i class="fa fa-group"></i><span><?php esc_html_e('Guests:', 'trendytravel'); ?> </span><?php echo esc_attr($_COOKIE['adults']); ?>&nbsp;<?php esc_html_e('Adult(s)', 'trendytravel'); ?>, <?php echo esc_attr($_COOKIE['childs']); ?>&nbsp;<?php esc_html_e('Child(s)', 'trendytravel'); ?></li><?php
                                      $total_days = count(dt_theme_get_all_dates($_COOKIE['checkin'], $_COOKIE['checkout'])) - 1; $room_meta = get_post_meta(wp_kses($_REQUEST['room_id'], $dt_allowed_html_tags), '_room_settings', true); $rcost = wp_kses($room_meta['room_price'], $dt_allowed_html_tags); ?>
                                      <li><span><?php esc_html_e('Total Days:', 'trendytravel'); ?> </span><?php echo esc_attr($total_days); ?></li>
                                      <li><span><?php esc_html_e('Price / Night:', 'trendytravel'); ?> </span><?php echo dt_theme_currecy_symbol().$rcost; ?></li>
                                  </ul>
                                  <?php
                                      $service_opts = get_option('hb_service_settings');
                                      if($service_opts != NULL): 
                                            $i = 0;
                                          foreach($service_opts as $key => $service):
                                              if($service['hb-hotel-id'] == $_REQUEST['hotel_id']):
                                                if($i == 0){ ?>
                                                <h3 class="section-title"><?php esc_html_e('Additional Services', 'trendytravel'); ?></h3>
                                                <ul> <?php } ?>
                                                  <li><input type="checkbox" value="<?php echo esc_attr($key); ?>" name="chkservice[]" /><?php echo wp_kses($service['hb-service-name'], $dt_allowed_html_tags).' ('.dt_theme_currecy_symbol().wp_kses($service['hb-service-price'], $dt_allowed_html_tags).')'; ?></li><?php
                                                  $i++;
                                              endif;
                                          endforeach;
                                      endif;	
                                  ?>
                                  </ul>
                                  <h3 class="section-title"><?php esc_html_e('Total Amount', 'trendytravel'); ?></h3>
                                  <ul class="dt-net-wrapper"><?php
								  	  $netAmount = dt_theme_hb_net_amount($_REQUEST['room_id']); ?>
									  <li><span><?php esc_html_e('Net Amount ( TD * Price * Adult(s) )', 'trendytravel'); ?></span><br /><i><?php echo dt_theme_currecy_symbol(); ?></i><div id="dt-netamount"><?php echo esc_attr($netAmount); ?></div></li><?php
									  #DepositDue Enabled...
									  $hb_general_settings = get_option('hb_general_settings');
									  if($hb_general_settings['hb-general-enabledepositdue'] && $hb_general_settings['hb-general-depositpercent'] != ""):
									     $depPercent = wp_kses($hb_general_settings['hb-general-depositpercent'], $dt_allowed_html_tags); ?>
									     <li><span><?php esc_html_e('Deposit Due', 'trendytravel'); ?> (<?php echo esc_attr($depPercent); ?>%)</span><br /><i><?php echo dt_theme_currecy_symbol(); ?></i><div id="dt-depositamount"><?php echo esc_attr($netAmount) * ($depPercent / 100); ?></div></li><?php
									  endif; ?>
                                  </ul>
                              </div>

                              <div class="dt-sc-two-third column dt-room-wrapper">
                              	  <h3 class="section-title"><?php esc_html_e('Choose Payment Option', 'trendytravel'); ?></h3>
                              	  <ul>
                                  	<li><input type="radio" class="rdopayment" name="rdopayoption[]" value="Pay with PayPal" /><?php esc_html_e('Pay with PayPal', 'trendytravel'); ?>
									  <div class="dt-sc-warning-box"><?php esc_html_e("Pay via PayPal; you can pay with your credit card if you don't have a PayPal account.", "trendytravel"); ?></div>
                                    </li>
                                    <li><input type="radio" class="rdopayment" name="rdopayoption[]" value="Pay on Arrival" checked="checked" /><?php esc_html_e('Pay on Arrival', 'trendytravel'); ?>
	                                  <div class="dt-sc-warning-box"><?php esc_html_e('Please fill out following details, and get confirmation email.', 'trendytravel'); ?></div>
                                    </li>
                                  </ul>
                                  
                              	  <div class="dt-sc-payarrival-wrapper">
                                      <h3 class="section-title"><?php esc_html_e('Guest Details', 'trendytravel'); ?></h3>
                                      <div class="dt-sc-one-half column first">
                                          <label for="txtfirstname"><?php esc_html_e('First Name', 'trendytravel'); ?><span>*</span></label>
                                          <input name="txtfirstname" id="txtfirstname" type="text" />
                                          <label for="txtlastname"><?php esc_html_e('Last Name', 'trendytravel'); ?><span>*</span></label>
                                          <input name="txtlastname" id="txtlastname" type="text" />
                                          <label for="txtemailaddress"><?php esc_html_e('Email Address', 'trendytravel'); ?><span>*</span></label>
                                          <input name="txtemailaddress" id="txtemailaddress" type="email" />
                                          <label for="txtphone"><?php esc_html_e('Telephone Number', 'trendytravel'); ?><span>*</span></label>
                                          <input name="txtphone" id="txtphone" type="tel" />
                                          <label for="txtaddress1"><?php esc_html_e('Address Line 1', 'trendytravel'); ?><span>*</span></label>
                                          <input name="txtaddress1" id="txtaddress1" type="text" />
                                      </div>
                                      <div class="dt-sc-one-half column">
                                          <label for="txtaddress2"><?php esc_html_e('Address Line 2', 'trendytravel'); ?></label>
                                          <input name="txtaddress2" id="txtaddress2" type="text" />
                                          <label for="txtcity"><?php esc_html_e('City', 'trendytravel'); ?><span>*</span></label>
                                          <input name="txtcity" id="txtcity" type="text" />
                                          <label for="txtstate"><?php esc_html_e('State / County', 'trendytravel'); ?><span>*</span></label>
                                          <input name="txtstate" id="txtstate" type="text" />
                                          <label for="txtzipcode"><?php esc_html_e('Zip / Postcode', 'trendytravel'); ?><span>*</span></label>
                                          <input name="txtzipcode" id="txtzipcode" type="text" />
                                          <label for="txtcountry"><?php esc_html_e('Country', 'trendytravel'); ?><span>*</span></label>
                                          <input name="txtcountry" id="txtcountry" type="text" />
                                      </div>
                                      <label for="txtspecialreq"><?php esc_html_e('Special Request', 'trendytravel'); ?></label>
                                      <textarea name="txtspecialreq" id="txtspecialreq"></textarea>
			                      </div>
                                  <input type="hidden" name="hotel_id" value="<?php echo esc_attr($_REQUEST['hotel_id']); ?>" />
                                  <input type="hidden" name="room_id" value="<?php echo esc_attr($_REQUEST['room_id']); ?>" />

                                  <?php 
                                  $check = dt_reservation_field_form();
                                  ?>
                                  <p><?php echo "{$check}"; ?></p>

                                  <input id="book_submit" type="submit" name="paynow" value="Submit" />
                              </div>
                          </form><?php
                      else:
                          ?><div class="dt-sc-notice"><?php esc_html_e('Please do not reload the page', 'trendytravel'); ?>, <a href="<?php echo trendytravel_get_page_permalink_by_its_template('tpl-booking.php'); ?>"><?php esc_html_e('begin your booking here', 'trendytravel'); ?></a></div><?php
                      endif;
                      #After Form Submission...
					  $poption = !empty($_REQUEST['rdopayoption'][0]) ? $_REQUEST['rdopayoption'][0] : '';
                      if($poption == 'Pay on Arrival' && isset($_REQUEST['paynow']) != NULL):
                          require_once get_template_directory().'/framework/hotelbooking/paypal/payment-arrival.php';
                      elseif($poption == 'Pay with PayPal' && isset($_REQUEST['paynow']) != NULL):
                          require_once get_template_directory().'/framework/hotelbooking/paypal/expresscheckout.php';
                      endif;
                      edit_post_link( esc_html__( ' Edit ','trendytravel' ) ); ?>
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