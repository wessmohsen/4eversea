<?php 

/*
Template Name: Booking - I
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
                              <div class="step-icon-wrapper step-icon-current">
                                  <div class="step-icon step-date"><span></span></div>
	                              <h5>1. <?php esc_html_e('Select Your Date', 'trendytravel'); ?></h5>
                              </div>
                          </div>
                          <div class="step-wrapper">
                              <div class="step-icon-wrapper">
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
                      </div>
					  <?php $action = trendytravel_get_page_permalink_by_its_template('tpl-booking-ii.php'); ?>
                      <form id="frmbooking" name="frmbooking" action="<?php echo esc_url($action); ?>" method="post">
                          <label for="txtcheckindate"><?php esc_html_e('Checkin Date', 'trendytravel'); ?><span>*</span></label>
                          <input type="text" class="datepicker" name="txtcheckindate" id="txtcheckindate" readonly="readonly" value="<?php echo !empty($_REQUEST['txtckindate']) ? esc_attr($_REQUEST['txtckindate']) : '';?>" />
                          
                          <label for="txtcheckoutdate"><?php esc_html_e('Checkout Date', 'trendytravel'); ?><span>*</span></label>
                          <input type="text" class="datepicker" name="txtcheckoutdate" id="txtcheckoutdate" readonly="readonly" value="<?php echo !empty($_REQUEST['txtckoutdate']) ? esc_attr($_REQUEST['txtckoutdate']) : ''; ?>" />
                          
                          <label for="txtlocation"><?php esc_html_e('City / Location', 'trendytravel'); ?></label>
                          <input type="text" name="txtlocation" id="txtlocation" /><input type="hidden" name="txtcityid" id="txtcityid" />
                          
                          <label for="cmbadults"><?php esc_html_e('Adults', 'trendytravel'); ?><span>*</span></label>
                          <select name="cmbadults" id="cmbadults"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select>
                          
                          <label for="cmbchilds"><?php esc_html_e('Children', 'trendytravel'); ?></label>
                          <select name="cmbchilds" id="cmbchilds">
                              <option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
                          </select>
                          
                          <input type="submit" name="subfind" id="subfind" value="<?php esc_attr_e('Check Availability', 'trendytravel'); ?>" />
                      </form>
                      <div class="dt-calendar-container">
                          <div class="dt-sc-warning-box calendar-notice"><?php esc_html_e('Please select your dates from the calendar', 'trendytravel'); ?></div>
                          <div id="open_datepicker"></div>
                          <div class="datepicker-key clearfix">
                              <div class="key-unavailable-wrapper clearfix">
                                  <div class="key-unavailable-icon"></div>
                                  <div class="key-unavailable-text"><?php esc_html_e('Unavailable', 'trendytravel'); ?></div>
                              </div>
                              <div class="key-available-wrapper clearfix">
                                  <div class="key-available-icon"></div>
                                  <div class="key-available-text"><?php esc_html_e('Available', 'trendytravel'); ?></div>
                              </div>
                              <div class="key-selected-wrapper clearfix">
                                  <div class="key-selected-icon"></div>
                                  <div class="key-selected-text"><?php esc_html_e('Selected Dates', 'trendytravel'); ?></div>
                              </div>
						  </div>
                      </div>                      
                      <?php  edit_post_link( esc_html__( ' Edit ','trendytravel' ) );
                      endwhile; ?>
                  </article>
              </section><!-- Primary End --><?php
              
        if ( $show_sidebar ) {
            if ( $show_left_sidebar ) {
                $sticky_class = ( array_key_exists('enable-sticky-sidebar', $settings) && $settings['enable-sticky-sidebar'] == 'true' ) ? ' sidebar-as-sticky' : '';?>
                
                <!-- Secondary Left -->
                <section id="secondary-left" class="secondary-sidebar <?php echo esc_attr( $sidebar_class.$sticky_class ); ?>"><?php
                    trendytravel_show_sidebar( 'page', $post->ID, 'left' ); ?>
                </section><!-- Secondary Left End --><?php
            }
        }

        if ( $show_sidebar ) {
            if ( $show_right_sidebar ) {
                $sticky_class = ( array_key_exists('enable-sticky-sidebar', $settings) && $settings['enable-sticky-sidebar'] == 'true' ) ? ' sidebar-as-sticky' : '';?>

                <!-- Secondary Right -->
                <section id="secondary-right" class="secondary-sidebar <?php echo esc_attr( $sidebar_class.$sticky_class ); ?>"><?php
                    trendytravel_show_sidebar( 'page', $post->ID, 'right' ); ?>
                </section><!-- Secondary Right End --><?php
            }
        }?>
    </div>
    <!-- ** Container End ** -->
    
</div><!-- **Main - End ** -->    
<?php get_footer(); ?>