<?php get_header();

	$global_breadcrumb = cs_get_option( 'show-breadcrumb' );

    $settings = get_post_meta($post->ID,'_dt_post_settings',TRUE);
    $settings = is_array( $settings ) ?  array_filter( $settings )  : array();

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
			
			if(empty($settings)) { $settings['enable-sub-title'] = true; }

            if( isset( $settings['enable-sub-title'] ) && $settings['enable-sub-title'] ) {

                $breadcrumbs = array();
                $bstyle = trendytravel_cs_get_option( 'breadcrumb-style', 'default' );
				$separator = '<span class="'.trendytravel_cs_get_option( 'breadcrumb-delimiter', 'fa default' ).'"></span>';

                $cat = get_the_category();
				$cat = $cat[0];
                $breadcrumbs[] = get_category_parents( $cat, true, $separator );
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
        <section id="primary" class="<?php echo esc_attr( $page_layout ); ?>"><?php
            if( have_posts() ) {
                while( have_posts() ) {
                    the_post();
                    get_template_part( 'framework/loops/content', 'single' );
                }
            }?>
        </section><!-- Primary End --><?php

        
        if ( $show_sidebar ) {
            if ( $show_left_sidebar ) {
                $sticky_class = ( array_key_exists('enable-sticky-sidebar', $settings) && $settings['enable-sticky-sidebar'] == 'true' ) ? ' sidebar-as-sticky' : '';?>
                
                <!-- Secondary Left -->
                <section id="secondary-left" class="secondary-sidebar <?php echo esc_attr( $sidebar_class.$sticky_class ); ?>"><?php
                    trendytravel_show_sidebar( 'post', $post->ID, 'left' ); ?>
                </section><!-- Secondary Left End --><?php
            }
        }

        if ( $show_sidebar ) {
            if ( $show_right_sidebar ) {
                $sticky_class = ( array_key_exists('enable-sticky-sidebar', $settings) && $settings['enable-sticky-sidebar'] == 'true' ) ? ' sidebar-as-sticky' : '';?>

                <!-- Secondary Right -->
                <section id="secondary-right" class="secondary-sidebar <?php echo esc_attr( $sidebar_class.$sticky_class ); ?>"><?php
                    trendytravel_show_sidebar( 'post', $post->ID, 'right' ); ?>
                </section><!-- Secondary Right End --><?php
            }
        }?>
    </div>
    <!-- ** Container End ** -->
    
</div><!-- **Main - End ** -->    
<?php get_footer(); ?>