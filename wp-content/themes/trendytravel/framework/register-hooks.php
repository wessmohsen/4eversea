<?php

add_action( 'vc_before_init', 'trendytravel_vc_compatible' );
function trendytravel_vc_compatible() {
	
	vc_set_as_theme();

	$posts = apply_filters( 'trendytravel_vc_default_cpt' , array ( 'page' )  );
	vc_set_default_editor_post_types( $posts );
}

/* ---------------------------------------------------------------------------
 * Theme Hooks : To Resolve < style > ... </ style > in side body tag
 * --------------------------------------------------------------------------- */
add_action( 'wp_head', 'trendytravel_wp_head',999 );
if ( ! function_exists( 'trendytravel_wp_head' ) ) {
	function trendytravel_wp_head() {
		ob_start();
	}
}

add_action( 'wp_footer', 'trendytravel_wp_footer',1000 );
if ( ! function_exists( 'trendytravel_wp_footer' ) ) {
	function trendytravel_wp_footer() {

		$content = ob_get_clean();
		$regex = "#<style id='trendytravel-custom-inline-inline-css' type='text/css'>([^<]*)</style>#";
		preg_match($regex, $content, $matches);

		$style = isset($matches[0]) ? $matches[0] : '';
		$content = str_replace($style,'',$content);
		$content = str_replace('</head>',$style.'</head>',$content);
		
		echo apply_filters( 'wp_footer_content', $content );
	}
}

/* ---------------------------------------------------------------------------
 * Hook of Top
 * --------------------------------------------------------------------------- */
function trendytravel_hook_top() {
	if( cs_get_option( 'enable-top-hook' ) ) :
		echo '<!-- trendytravel_hook_top -->';
			$hook = cs_get_option( 'top-hook' );
			$hook = do_shortcode( stripslashes($hook) );
			if (!empty($hook))
                echo apply_filters( 'trendytravel_top_hook', $hook );
		echo '<!-- trendytravel_hook_top -->';
	endif;	
}
add_action( 'trendytravel_hook_top', 'trendytravel_hook_top', 10 );

/* ---------------------------------------------------------------------------
 * Page Loader
 * --------------------------------------------------------------------------- */
add_action( 'trendytravel_hook_top', 'trendytravel_page_loader', 20 );
function trendytravel_page_loader() {
	$loader = cs_get_option( 'use-site-loader' );
	if( !empty($loader) ) {
		echo '<div class="loader"><div class="loader-inner"><span class="dot"></span><span class="dot dot1"></span><span class="dot dot2"></span><span class="dot dot3"></span><span class="dot dot4"></span></div></div>';
	}
}

/* ---------------------------------------------------------------------------
 * Hook of Content before
 * --------------------------------------------------------------------------- */
function trendytravel_hook_content_before() {
	if( cs_get_option( 'enable-content-before-hook' ) ) :
		echo '<!-- trendytravel_hook_content_before -->';
			$hook = cs_get_option( 'content-before-hook' );
			$hook = do_shortcode( stripslashes($hook) );
			if (!empty($hook))
            echo do_shortcode( stripslashes($hook) );
		echo '<!-- trendytravel_hook_content_before -->';
	endif;
}
add_action( 'trendytravel_hook_content_before', 'trendytravel_hook_content_before' );


/* ---------------------------------------------------------------------------
 * Hook of Content after
 * --------------------------------------------------------------------------- */
function trendytravel_hook_content_after() {
	if( cs_get_option( 'enable-content-after-hook' ) ) :
		echo '<!-- trendytravel_hook_content_after -->';
			$hook = cs_get_option( 'content-after-hook' );
			$hook = do_shortcode( stripslashes($hook) );
			if (!empty($hook))
            echo do_shortcode( stripslashes($hook) );
		echo '<!-- trendytravel_hook_content_after -->';
	endif;
}
add_action( 'trendytravel_hook_content_after', 'trendytravel_hook_content_after' );

/* ---------------------------------------------------------------------------
 * Main Header Hook
 * --------------------------------------------------------------------------- */
add_action( 'trendytravel_header', 'trendytravel_vc_header_template', 10 );
if( ! function_exists( 'trendytravel_vc_header_template' ) ) {

    function trendytravel_vc_header_template( $page_id ) {

        $id = '';

        if( is_singular() && empty( $page_id ) ) {

            global $post;

            $settings = get_post_meta( $post->ID,'_dt_custom_settings',TRUE );
            $settings = is_array( $settings ) ? $settings  : array();

            if( array_key_exists( 'show-header', $settings ) && !$settings['show-header'] )
                return;

            
            $id = isset( $settings['header'] ) ? $settings['header'] : '';
            $id = ( $id == '' ) ? cs_get_option( 'header' ) : $id;
        } elseif( !empty( $page_id ) ) {

            $settings = get_post_meta( $page_id, '_dt_custom_settings',TRUE );
            $settings = is_array( $settings ) ? $settings  : array();

            if( array_key_exists( 'show-header', $settings ) && !$settings['show-header'] )
                return;

            $id = isset( $settings['header'] ) ? $settings['header'] : '';
            $id = ( $id == '' ) ? cs_get_option( 'header' ) : $id;

        } else {
            
            $id = cs_get_option( 'header' );
        }

        $id = apply_filters( 'trendytravel_header_id', $id );

        if( !$id || !function_exists( 'vc_lean_map' ) ) {
            get_template_part( 'template-parts/content', 'header' );
            return;
        }
        
        ob_start(); 
        wp_enqueue_style( 'trendytravel-custom-inline' );

        if ( $custom_css = get_post_meta( $id, '_wpb_post_custom_css', true ) ) {
            wp_add_inline_style( 'trendytravel-custom-inline' , $custom_css  );
        }

        if ( $shortcode_custom_css = get_post_meta( $id, '_wpb_shortcodes_custom_css', true ) ) {
            wp_add_inline_style( 'trendytravel-custom-inline' , $shortcode_custom_css  );
        }

        echo '<div id="header-'.esc_attr( $id ).'" class="dt-header-tpl header-' .esc_attr( $id ). '">';
            echo do_shortcode( get_post_field( 'post_content', $id ) );
        echo '</div>';

        $content = ob_get_clean();
        echo apply_filters( 'trendytravel_header_content', $content );
    }
}

/* ---------------------------------------------------------------------------
 * Main Footer Hook
 * --------------------------------------------------------------------------- */
add_action( 'trendytravel_footer', 'trendytravel_vc_footer_template', 10 );
if( ! function_exists( 'trendytravel_vc_footer_template' ) ) {

	function trendytravel_vc_footer_template() {

		$id = '';

		if( is_singular() ) {

			global $post;

			$settings = get_post_meta( $post->ID,'_dt_custom_settings',TRUE );
			$settings = is_array( $settings ) ? $settings  : array();

			if( array_key_exists( 'show-footer', $settings ) && !$settings['show-footer'] )
				return;

            $id = isset( $settings['footer'] ) ? $settings['footer'] : '';
			$id = ( $id == '' ) ? cs_get_option( 'footer' ) : $id;
		} else {
            $id = cs_get_option( 'footer' );
        }
		
		$id = apply_filters( 'trendytravel_footer_id', $id );
		
		if( !$id || !function_exists( 'vc_lean_map' ) ) {

			echo '<div class="dt-no-footer-builder-content footer-copyright aligncenter">
				<span>&copy; '.date( 'Y' ).' '.get_bloginfo( 'name' ).'. '. get_bloginfo( 'description', 'display' ).'</span>
			</div>';
			return;
		}

		
		ob_start();	
		wp_enqueue_style( 'trendytravel-custom-inline' );

		if ( $custom_css = get_post_meta( $id, '_wpb_post_custom_css', true ) ) {
			wp_add_inline_style( 'trendytravel-custom-inline' , $custom_css  );
		}

		if ( $shortcode_custom_css = get_post_meta( $id, '_wpb_shortcodes_custom_css', true ) ) {
			wp_add_inline_style( 'trendytravel-custom-inline' , $shortcode_custom_css  );
		}

		echo do_shortcode( get_post_field( 'post_content', $id ) );
		$content = ob_get_clean();
		echo apply_filters( 'trendytravel_footer_content', $content );
	}
}

/* ---------------------------------------------------------------------------
 * Hook of Bottom
 * --------------------------------------------------------------------------- */
function trendytravel_hook_bottom() {
	if( cs_get_option( 'enable-bottom-hook' ) ) :
		echo '<!-- trendytravel_hook_bottom -->';
			$hook = cs_get_option( 'bottom-hook' );
			$hook = do_shortcode( stripslashes($hook) );
			if (!empty($hook))
            echo do_shortcode( stripslashes($hook) );
		echo '<!-- trendytravel_hook_bottom -->';
	endif;
}
add_action( 'trendytravel_hook_bottom', 'trendytravel_hook_bottom' );

/* ---------------------------------------------------------------------------
 * Page Layout  
 * --------------------------------------------------------------------------- */
function trendytravel_page_layout( $layout = '' ) {

    $page_layout       = $sidebar_class = '';
    $show_sidebar      = $show_left_sidebar = $show_right_sidebar = false;
    $container_class   = "container";
    $image_size_class = '';

	switch ( $layout ) {

		case 'with-left-sidebar':
            $page_layout      = "page-with-sidebar with-left-sidebar";
            $show_sidebar     = $show_left_sidebar = true;
            $sidebar_class    = "secondary-has-left-sidebar";
            $image_size_class = 'default';
    	break;

    	case 'with-right-sidebar':
            $page_layout      = "page-with-sidebar with-right-sidebar";
            $show_sidebar     = $show_right_sidebar	= true;
            $sidebar_class    = "secondary-has-right-sidebar";
            $image_size_class = 'default';
    	break;

    	case 'with-both-sidebar':
            $page_layout      = "page-with-sidebar with-both-sidebar";
            $show_sidebar     = $show_left_sidebar = $show_right_sidebar = true;
            $sidebar_class    = "secondary-has-both-sidebar";
            $image_size_class = 'default';
    	break;

        case 'fullwidth':
            $container_class  = "portfolio-fullwidth-container";
            $page_layout      = "content-full-width";
            $image_size_class = 'fullwidth';
        break;

    	case 'content-full-width':
    	default:
            $page_layout      = "content-full-width";
            $image_size_class = 'default';
    	break;
    }

    return array(
        'page_layout'        => $page_layout,
        'sidebar_class'      => $sidebar_class,
        'show_sidebar'       => $show_sidebar,
        'show_left_sidebar'  => $show_left_sidebar,
        'show_right_sidebar' => $show_right_sidebar,
        'container_class'    => $container_class,
        'image_size_class'   => $image_size_class,
    );
}

/* ---------------------------------------------------------------------------
 * Return Breadcrumb Style
 * --------------------------------------------------------------------------- */
function trendytravel_breadcrumb_css( $settings = array() ) {

    $bg = $co = $repeat = $pos = $attach = $size = $style = '';

    $bg = !empty( $settings['image'] ) ? $settings['image'] : '';
    $co = !empty( $settings['color'] ) ? $settings['color'] : '';
	
    if(!empty($bg) || !empty($co)) :
        $repeat = !empty( $settings['repeat'] ) ? $settings['repeat'] :'repeat';
        $pos    = !empty( $settings['position'] ) ? $settings['position'] :'left top';
        $attach = !empty( $settings['attachment'] ) ? $settings['attachment'] :'scroll';
        $size   = !empty( $settings['size'] ) ? $settings['size'] :'auto';
    else:
        $bgoptions = cs_get_option( 'breadcrumb_background' );
        $bg         = !empty( $bgoptions['image'] ) ? $bgoptions['image'] : '';
        $attach     = !empty( $bgoptions['attachment'] ) ? $bgoptions['attachment'] :'scroll';
        $pos        = !empty( $bgoptions['position'] ) ? $bgoptions['position'] :'left top';
        $size       = !empty( $bgoptions['size'] ) ? $bgoptions['size'] :'auto';
        $repeat     = !empty( $bgoptions['repeat'] ) ? $bgoptions['repeat'] :'repeat';
        $co         = !empty( $bgoptions['color'] ) ? $bgoptions['color'] : '';
    endif;

	$style = !empty($bg) ? "background-image: url($bg); " : "";
	$style .= !empty($pos) ? "background-position: $pos; " : "";
	$style .= !empty($size) ? "background-size: $size; " : "";
	$style .= !empty($repeat) ? "background-repeat: $repeat; " : "";
	$style .= !empty($attach) ? "background-attachment: $attach; " : "";
    $style .= !empty($co) ? "background-color:$co;" : "";

    return $style;
}

/* ---------------------------------------------------------------------------
 * Breadcrumb
 * --------------------------------------------------------------------------- */
function trendytravel_new_breadcrumbs( $args ) {

    $breadcrumbs = array();
    $output = '';

    $homeLink = esc_url( home_url('/') );
    $separator = '<span class="'.cs_get_option( 'breadcrumb-delimiter', 'fa default' ).'"></span>';
    $breadcrumbs[] =  '<a href="'. $homeLink .'">'. esc_html__('Home','trendytravel') .'</a>';
    $breadcrumbs = array_merge( $breadcrumbs, $args );

    $output .=  '<div class="breadcrumb">';
        $count = count( $breadcrumbs );
        $i = 1;

        foreach( $breadcrumbs as $bk => $bc ){
            if( !is_object( $bc ) ) {
                if( strpos( $bc , $separator ) ) {
                    // category parents fix
                    $output .=  ($bc);
                } else {
                    if( $i == $count ) $separator = '';
                    $output .=  ($bc . $separator);
                }
            }
            $i++;
        }
    $output .=  '</div>';

    return $output;
}

function trendytravel_breadcrumb_output( $title, $breadcrumbs, $class, $inline_css ) {

    $inline_css = !empty( $inline_css ) ? "style='".esc_attr($inline_css)."'" : "";

    echo '<section class="main-title-section-wrapper '.esc_attr($class).'">';
    echo '  <div class="main-title-section-bg" '. $inline_css.'></div>';
    echo '  <div class="container">';
    echo '  	<div class="main-title-section">'. $title .'</div>';
    echo        trendytravel_new_breadcrumbs( $breadcrumbs );
    echo '  </div>';
    echo '</section>';
}