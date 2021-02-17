<?php get_header();
    $global_breadcrumb = cs_get_option( 'show-breadcrumb' );
	$header_class	   = cs_get_option( 'breadcrumb-position' );
    $wtstyle = cs_get_option( 'wtitle-style' ); ?>
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
        if( !empty( $global_breadcrumb ) ) {

            $bstyle = trendytravel_cs_get_option( 'breadcrumb-style', 'default' );
            $style = trendytravel_breadcrumb_css();

            $title = get_the_archive_title();
            $breadcrumbs[] = __('Places','designthemes-core');
            $breadcrumbs[] = '<a href="'. get_category_link( get_query_var('place_entries') ) .'">' . single_cat_title('', false) . '</a>';

            trendytravel_breadcrumb_output ( '<h1>'.$title.'</h1>', $breadcrumbs, $bstyle, $style );
        }
    ?><!-- ** Breadcrumb End ** -->                
</div><!-- ** Header Wrapper - End ** -->

<!-- **Main** -->
<div id="main">
    <!-- ** Container ** -->
    <div class="container"><?php
        $page_layout = cs_get_option( 'places-archives-page-layout' );
        $page_layout  = !empty( $page_layout ) ? $page_layout : "content-full-width";

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
                          //Performing archive layout...
                          include(dirname(__FILE__).'/inc/place-archive-layout.php'); ?>
                      </article>
                  </section><!-- Primary End --><?php

                  
        if ( $show_sidebar ) {
            if ( $show_left_sidebar ) {?>
                <!-- Secondary Left -->
                <section id="secondary-left" class="secondary-sidebar <?php echo esc_attr( $sidebar_class );?>"><?php
                    echo !empty( $wtstyle ) ? "<div class='{$wtstyle}'>" : '';

                    if( is_active_sidebar('custom-post-place-archives-sidebar-left') ):
                        dynamic_sidebar('custom-post-place-archives-sidebar-left');
                    endif;

                    $enable = cs_get_option( 'show-standard-left-sidebar-for-places-archives' );
                    if( $enable ):
                        if( is_active_sidebar('standard-sidebar-left') ):
                            dynamic_sidebar('standard-sidebar-left');
                        endif;
                    endif;

                    echo !empty( $wtstyle ) ? '</div>' : ''; ?>
                </section><!-- Secondary Left End --><?php
            }
        }

        if ( $show_sidebar ) {
            if ( $show_right_sidebar ) {?>
                <!-- Secondary Right -->
                <section id="secondary-right" class="secondary-sidebar <?php echo esc_attr( $sidebar_class );?>"><?php
                    echo !empty( $wtstyle ) ? "<div class='{$wtstyle}'>" : '';

                    if( is_active_sidebar('custom-post-place-archives-sidebar-right') ):
                        dynamic_sidebar('custom-post-place-archives-sidebar-right');
                    endif;

                    $enable = cs_get_option( 'show-standard-right-sidebar-for-places-archives' );
                    if( $enable ):
                        if( is_active_sidebar('standard-sidebar-right') ):
                            dynamic_sidebar('standard-sidebar-right');
                        endif;
                    endif;

                    echo !empty( $wtstyle ) ? '</div>' : ''; ?>
                </section><!-- Secondary Right End --><?php
            }
        }?>
    </div>
    <!-- ** Container End ** -->
</div><!-- **Main - End ** -->    
<?php get_footer(); ?>    