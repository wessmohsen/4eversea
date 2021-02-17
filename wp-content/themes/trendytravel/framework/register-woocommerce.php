<?php 
// WooCommerce Theme Support -------------------------------------------------
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

// Change Image Sizes --------------------------------------------------------
	$pagenow = trendytravel_global_variables('pagenow');
	if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' )
		add_action( 'init', 'trendytravel_woo_image_dimensions', 1 );

	function trendytravel_woo_image_dimensions() {
		$catalog 	= 	array('width' => '500', 'height' => '500', 'crop' => 1);
		$single 	= 	array('width' => '500', 'height' => '500', 'crop' => 1);
		$thumbnail 	= 	array('width' => '200', 'height' => '200', 'crop' => 1);

		// Image sizes
		update_option( 'shop_catalog_image_size', $catalog );
		update_option( 'shop_single_image_size', $single );
		update_option( 'shop_thumbnail_image_size', $thumbnail );
	}
	
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

#WooCommerce Custom Post Label Filter
if( !function_exists('dt_packages_labels') ) {
	function dt_packages_labels( $args ){
		$args['labels'] = array(
			'name'                => 	__( 'Packages', 'trendytravel' ),
			'singular_name'       => 	__( 'Package', 'trendytravel' ),
			'menu_name'           => 	__( 'Packages', 'trendytravel' ),
			'add_new'             => 	__( 'Add Package', 'trendytravel' ),
			'add_new_item'        => 	__( 'Add New Package', 'trendytravel' ),
			'edit'                => 	__( 'Edit', 'trendytravel' ),
			'edit_item'           => 	__( 'Edit Package', 'trendytravel' ),
			'new_item'            => 	__( 'New Package', 'trendytravel' ),
			'view'             	  => 	__( 'View Package', 'trendytravel' ),
			'view_item'           => 	__( 'View Package', 'trendytravel' ),
			'search_items'        => 	__( 'Search Packages', 'trendytravel' ),
			'not_found'           => 	__( 'No Packages found', 'trendytravel' ),
			'not_found_in_trash'  => 	__( 'No Packages found in trash', 'trendytravel' ),
			'parent'              => 	__( 'Parent Package', 'trendytravel' )
		);
		$args['menu_icon'] 		  = 	'dashicons-portfolio';
		$args['rewrite'] 		  = 	array('slug' => 'package');
		return $args;
	}
}
add_filter( 'woocommerce_register_post_type_product', 'dt_packages_labels' );

#WooCommerce Enter Title Filter
if( !function_exists('dt_woocommerce_enter_title') ) {
	function dt_woocommerce_enter_title( $input ) {
		global $post_type;
	
		if ( is_admin() && 'product' == $post_type )
			return esc_html__( 'Enter Package Title', 'trendytravel' );
	
		return $input;
	}
}
add_filter( 'enter_title_here', 'dt_woocommerce_enter_title' );

#WooCommerce Taxonomy Label Filter
if( !function_exists('dt_packages_tax_cat_labels') ) {
	function dt_packages_tax_cat_labels($args){	
		$args['label']		=		__( 'Package Categories', 'trendytravel' );
		$args['labels'] = array(
			'name' 				=> 	__( 'Package Categories', 'trendytravel' ),
			'singular_name' 	=> 	__( 'Package Category', 'trendytravel' ),
			'menu_name'			=> 	__( 'Categories', 'trendytravel' ),
			'search_items' 		=> 	__( 'Search Package Categories', 'trendytravel' ),
			'all_items' 		=> 	__( 'All Package Categories', 'trendytravel' ),
			'parent_item' 		=> 	__( 'Parent Package Category', 'trendytravel' ),
			'parent_item_colon' => 	__( 'Parent Package Category:', 'trendytravel' ),
			'edit_item' 		=> 	__( 'Edit Package Category', 'trendytravel' ),
			'update_item' 		=> 	__( 'Update Package Category', 'trendytravel' ),
			'add_new_item' 		=> 	__( 'Add New Package Category', 'trendytravel' ),
			'new_item_name' 	=> 	__( 'New Package Category Name', 'trendytravel' )
		);
		$args['rewrite'] 		  = 	array('slug' => 'package-category');
		return $args;
	}
}
add_filter( 'woocommerce_taxonomy_args_product_cat', 'dt_packages_tax_cat_labels' );

if( !function_exists('dt_packages_tax_tag_labels') ) {
	function dt_packages_tax_tag_labels($args){
		$args['label']		=		__( 'Package Tags', 'trendytravel' );
		$args['labels'] = array(
			'name' 				=> esc_html__( 'Package Tags', 'trendytravel' ),
			'singular_name' 	=> esc_html__( 'Package Tag', 'trendytravel' ),
			'menu_name'			=> esc_html__( 'Tags', 'trendytravel' ),
			'search_items' 		=> esc_html__( 'Search Package Tags', 'trendytravel' ),
			'all_items' 		=> esc_html__( 'All Package Tags', 'trendytravel' ),
			'parent_item' 		=> esc_html__( 'Parent Package Tag', 'trendytravel' ),
			'parent_item_colon' => esc_html__( 'Parent Package Tag:', 'trendytravel' ),
			'edit_item' 		=> esc_html__( 'Edit Package Tag', 'trendytravel' ),
			'update_item' 		=> esc_html__( 'Update Package Tag', 'trendytravel' ),
			'add_new_item' 		=> esc_html__( 'Add New Package Tag', 'trendytravel' ),
			'new_item_name' 	=> esc_html__( 'New Package Tag Name', 'trendytravel' )
		);
		$args['rewrite'] 		  = 	array('slug' => 'package-tag');
		return $args;
	}
}
add_filter( 'woocommerce_taxonomy_args_product_tag', 'dt_packages_tax_tag_labels' );

#Woocommerce Package Custom Fields
add_action( 'woocommerce_product_options_general_product_data', 'dt_woo_add_meta_general_fields' );
if( !function_exists('dt_woo_add_meta_general_fields') ) {
	function dt_woo_add_meta_general_fields() {
	global $woocommerce, $post;
		echo '<div class="options_group">';
			woocommerce_wp_text_input(
				array(
					'id' => '_package_place',
					'label' => esc_html__( 'Place / City / Country', 'trendytravel' ),
					'placeholder' => 'LAS VEGAS, NEVADA',
					'desc_tip' => 'true',
					'description' => esc_html__( 'Enter the package place here.', 'trendytravel' )
				)
			);
		echo '</div>';
		echo '<div class="options_group">';
			woocommerce_wp_text_input(
				array(
					'id' => '_package_days_duration',
					'label' => esc_html__( 'No.of Days / Duration', 'trendytravel' ),
					'placeholder' => '4 days / 3 hours 30 mins',
					'desc_tip' => 'true',
					'description' => esc_html__( 'Enter the package duration here.', 'trendytravel' )
				)
			);
		echo '</div>';
		echo '<div class="options_group">';
			woocommerce_wp_text_input(
				array(
					'id' => '_package_people',
					'label' => esc_html__( 'People', 'trendytravel' ),
					'placeholder' => '5',
					'desc_tip' => 'true',
					'description' => esc_html__( 'Enter the no.of peoples here.', 'trendytravel' )
				)
			);
		echo '</div>';
	}
}

#Woocommerce Save Package Custom Fields
add_action( 'woocommerce_process_product_meta', 'dt_woo_add_meta_general_fields_save' );
if( !function_exists('dt_woo_add_meta_general_fields_save') ) {
	function dt_woo_add_meta_general_fields_save( $post_id ){
	
		$package_place = sanitize_text_field($_POST['_package_place']);
		update_post_meta( $post_id, '_package_place', esc_attr( $package_place ) );
	
		$package_days = sanitize_text_field($_POST['_package_days_duration']);
		update_post_meta( $post_id, '_package_days_duration', esc_attr( $package_days ) );
	
		$package_people = sanitize_text_field($_POST['_package_people']);
		update_post_meta( $post_id, '_package_people', esc_attr( $package_people ) );
	}
}

#Woocommerce Version Check
global $woocommerce;
if ( version_compare( $woocommerce->version, "2.1" ) >= 0 ) {
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );
}
else {
	define( 'WOOCOMMERCE_USE_CSS', false );
}

// Disable WooCommerce Styles & Sidebar --------------------------------------
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// To Remove Breadcrumb
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

// To Remove Page Title
	add_filter( 'woocommerce_show_page_title', '__return_false' );

// To Remove Page wrapper Start
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	add_action( 'woocommerce_before_main_content', 'trendytravel_woo_output_content_wrapper', 11 );
	function trendytravel_woo_output_content_wrapper() {

		$shop_page_id = $header_class = '';
		$settings = array();

		$global_breadcrumb = cs_get_option( 'show-breadcrumb' );
		$bstyle = trendytravel_cs_get_option( 'breadcrumb-style', 'default' );

		if( is_shop() ) {
			$shop_page_id = get_option('woocommerce_shop_page_id');

			$settings = get_post_meta( $shop_page_id, '_tpl_default_settings', TRUE);
    		$settings = is_array( $settings ) ?  array_filter( $settings )  : array();

			# Header Class
				if( !isset( $settings['enable-sub-title'] ) || !$settings['enable-sub-title']  ) {
					if( isset( $settings['show_slider'] ) && $settings['show_slider'] ) {
						if( isset( $settings['slider_type'] ) ) {
							$header_class =  $settings['slider_position'];
						}
					}
				}

				if( !empty( $global_breadcrumb ) ) {

					if(empty($settings)) { $settings['enable-sub-title'] = true; }

					if( isset( $settings['enable-sub-title'] ) && $settings['enable-sub-title'] ) {
						$header_class = isset($settings['breadcrumb_position']) ? $settings['breadcrumb_position'] : '';
					}
				}    		
		} else {
			$header_class = cs_get_option( 'breadcrumb-position' );
		}

		echo '<!-- ** Header Wrapper ** -->';
		echo '<div id="header-wrapper">';

		echo '	<header id="header" class="'.$header_class.'">';
		echo '		<div class="container">';
             			do_action( 'trendytravel_header', $shop_page_id );
		echo '		</div>';
		echo '	</header>';

		# Slider Section
		if( is_shop() ) {

			if( !$settings['enable-sub-title'] || !isset( $settings['enable-sub-title'] ) ) {
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
		}
		
		# Breadcrumb
		if( !empty( $global_breadcrumb ) ) {

			if(empty($settings)) { $settings['enable-sub-title'] = true; }

			# Shop
			if( is_shop() ) {

				if( isset( $settings['enable-sub-title'] ) && $settings['enable-sub-title'] ) {

					$title = get_the_title( $shop_page_id );
					$breadcrumbs[] = '<span class="current">'. $title .'</span>';
					$bcsettings = isset( $settings['breadcrumb_background'] ) ? $settings['breadcrumb_background'] : array();
					$style = trendytravel_breadcrumb_css( $bcsettings );

					trendytravel_breadcrumb_output ( '<h1>'.$title.'</h1>', $breadcrumbs, $bstyle, $style );
                }
			}

			# Product
			if( is_product() ) {

				global $post;

				$terms = get_the_terms( $post->ID, 'product_cat' );
				foreach ($terms as $term) {
					$term_link = get_term_link( $term );
					$breadcrumbs[] = '<a href="' . esc_url( $term_link ) . '">' . $term->name . '</a>';
				}

				//$breadcrumbs[] = '<a href="'.get_the_permalink( get_option('woocommerce_shop_page_id') ).'">' . get_the_title( get_option('woocommerce_shop_page_id') ). '</a>';
				$breadcrumbs[] = the_title( '<span class="current">', '</span>', false );
                $style = trendytravel_breadcrumb_css();

                trendytravel_breadcrumb_output ( the_title( '<h1>', '</h1>', false ), $breadcrumbs, $bstyle, $style );
			}

			# Product Category
			if( is_product_category() || is_product_tag() ) {
				$breadcrumbs[] = '<a href="'.get_the_permalink( get_option('woocommerce_shop_page_id') ).'">' . get_the_title( get_option('woocommerce_shop_page_id') ). '</a>';
				$breadcrumbs[] = '<span class="current">'.single_term_title( '', false ).'</span>';
                $style = trendytravel_breadcrumb_css();

                trendytravel_breadcrumb_output ( '<h1>'.single_term_title( '', false ).'</h1>', $breadcrumbs, $bstyle, $style );
			}			
		}

		echo '</div><!-- ** Header Wrapper - End ** -->';

		echo '<div id="main">';
		echo '	<div class="container">';

		# Sidebar
		if( is_shop() ) {

			$page_layout  = array_key_exists( "layout", $settings ) ? $settings['layout'] : "content-full-width";
			$layout = trendytravel_page_layout( $page_layout );
			extract( $layout );

			if ( $show_sidebar ) {
				if ( $show_left_sidebar ) {
					$sticky_class = ( array_key_exists('enable-sticky-sidebar', $settings) && $settings['enable-sticky-sidebar'] == 'true' ) ? ' sidebar-as-sticky' : '';
					echo '<section id="secondary-left" class="secondary-sidebar '.$sidebar_class.$sticky_class.'">';
						trendytravel_show_sidebar( 'page', $shop_page_id, 'left' );
					echo '</section>';
				}
			}
		}

		if( is_product() ) {

			$page_layout = cs_get_option( 'product-layout' );
			$page_layout = !empty($page_layout) ? $page_layout : "content-full-width";
			$layout = trendytravel_page_layout( $page_layout );
			extract( $layout );

			if ( $show_sidebar ) {
				if ( $show_left_sidebar ) {

					$wtstyle = cs_get_option( 'wtitle-style' );	

					echo '<section id="secondary-left" class="secondary-sidebar '.$sidebar_class.'">';
					echo 	!empty( $wtstyle ) ? "<div class='{$wtstyle}'>" : '';

								if( is_active_sidebar('product-detail-sidebar-left') ):
									dynamic_sidebar('product-detail-sidebar-left');
								endif;

								$enable = cs_get_option( 'show-shop-standard-left-sidebar-for-product-layout' );
								if( $enable ):
									if( is_active_sidebar('shop-everywhere-sidebar-left') ):
										dynamic_sidebar('shop-everywhere-sidebar-left');
									endif;
								endif;

					echo 	!empty( $wtstyle ) ? '</div>' : '';
					echo '</section>';
				}
			}
		}

		if( is_product_category() ) {

			$page_layout = cs_get_option( 'product-category-layout' );
			$page_layout = !empty($page_layout) ? $page_layout : "content-full-width";

			$layout = trendytravel_page_layout( $page_layout );
			extract( $layout );

			if ( $show_sidebar ) {
				if ( $show_left_sidebar ) {

					$wtstyle = cs_get_option( 'wtitle-style' );	

					echo '<section id="secondary-left" class="secondary-sidebar '.$sidebar_class.'">';
					echo 	!empty( $wtstyle ) ? "<div class='{$wtstyle}'>" : '';

								if( is_active_sidebar('product-category-sidebar-left') ):
									dynamic_sidebar('product-category-sidebar-left');
								endif;

								$enable = cs_get_option( 'show-shop-standard-left-sidebar-for-product-category-layout' );
								if( $enable ):
									if( is_active_sidebar('shop-everywhere-sidebar-left') ):
										dynamic_sidebar('shop-everywhere-sidebar-left');
									endif;
								endif;

					echo 	!empty( $wtstyle ) ? '</div>' : '';
					echo '</section>';
				}
			}
		}

		if( is_product_tag() ) {

			$page_layout = cs_get_option( 'product-tag-layout' );
			$page_layout = !empty($page_layout) ? $page_layout : "content-full-width";

			$layout = trendytravel_page_layout( $page_layout );
			extract( $layout );

			if ( $show_sidebar ) {
				if ( $show_left_sidebar ) {

					$wtstyle = cs_get_option( 'wtitle-style' );	

					echo '<section id="secondary-left" class="secondary-sidebar '.$sidebar_class.'">';
					echo 	!empty( $wtstyle ) ? "<div class='{$wtstyle}'>" : '';

								if( is_active_sidebar('product-tag-sidebar-left') ):
									dynamic_sidebar('product-tag-sidebar-left');
								endif;

								$enable = cs_get_option( 'show-shop-standard-left-sidebar-for-product-tag-layout' );
								if( $enable ):
									if( is_active_sidebar('shop-everywhere-sidebar-left') ):
										dynamic_sidebar('shop-everywhere-sidebar-left');
									endif;
								endif;

					echo 	!empty( $wtstyle ) ? '</div>' : '';
					echo '</section>';
				}
			}
		}

		echo '<section id="primary" class="'.$page_layout.'">';
	}

// To Remove Page wrapper End
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
	add_action( 'woocommerce_after_main_content', 'trendytravel_woo_output_content_wrapper_end', 11 );
	function trendytravel_woo_output_content_wrapper_end() {

		echo '</section>';

		if( is_shop() ) {

			$shop_page_id = get_option('woocommerce_shop_page_id');
			$settings = get_post_meta( $shop_page_id, '_tpl_default_settings', TRUE);
    		$settings = is_array( $settings ) ?  array_filter( $settings )  : array();

			$page_layout  = array_key_exists( "layout", $settings ) ? $settings['layout'] : "content-full-width";
			$layout = trendytravel_page_layout( $page_layout );
			extract( $layout );

			if ( $show_sidebar ) {
				if ( $show_right_sidebar ) {
					$sticky_class = ( array_key_exists('enable-sticky-sidebar', $settings) && $settings['enable-sticky-sidebar'] == 'true' ) ? ' sidebar-as-sticky' : '';

					echo '<section id="secondary-right" class="secondary-sidebar'.$sidebar_class.$sticky_class.'">';
						trendytravel_show_sidebar( 'page', $shop_page_id, 'right' );
					echo '</section>';					
				}
			}
		}

		if( is_product() ) {

			$page_layout = cs_get_option( 'product-layout' );
			$page_layout = !empty($page_layout) ? $page_layout : "content-full-width";
			$layout = trendytravel_page_layout( $page_layout );
			extract( $layout );

			if ( $show_sidebar ) {
				if ( $show_right_sidebar ) {

					$wtstyle = cs_get_option( 'wtitle-style' );	

					echo '<section id="secondary-right" class="secondary-sidebar '.$sidebar_class.'">';
					echo 	!empty( $wtstyle ) ? "<div class='{$wtstyle}'>" : '';

								if( is_active_sidebar('product-detail-sidebar-right') ):
									dynamic_sidebar('product-detail-sidebar-right');
								endif;

								$enable = cs_get_option( 'show-shop-standard-right-sidebar-for-product-layout' );
								if( $enable ):
									if( is_active_sidebar('shop-everywhere-sidebar-right') ):
										dynamic_sidebar('shop-everywhere-sidebar-right');
									endif;
								endif;

					echo 	!empty( $wtstyle ) ? '</div>' : '';
					echo '</section>';
				}
			}
		}

		if( is_product_category() ) {

			$page_layout = cs_get_option( 'product-category-layout' );
			$page_layout = !empty($page_layout) ? $page_layout : "content-full-width";

			$layout = trendytravel_page_layout( $page_layout );
			extract( $layout );

			if ( $show_sidebar ) {
				if ( $show_right_sidebar ) {

					$wtstyle = cs_get_option( 'wtitle-style' );	

					echo '<section id="secondary-right" class="secondary-sidebar '.$sidebar_class.'">';
					echo 	!empty( $wtstyle ) ? "<div class='{$wtstyle}'>" : '';

								if( is_active_sidebar('product-category-sidebar-right') ):
									dynamic_sidebar('product-category-sidebar-right');
								endif;

								$enable = cs_get_option( 'show-shop-standard-right-sidebar-for-product-category-layout' );
								if( $enable ):
									if( is_active_sidebar('shop-everywhere-sidebar-right') ):
										dynamic_sidebar('shop-everywhere-sidebar-right');
									endif;
								endif;

					echo 	!empty( $wtstyle ) ? '</div>' : '';
					echo '</section>';
				}
			}
		}

		if( is_product_tag() ) {

			$page_layout = cs_get_option( 'product-tag-layout' );
			$page_layout = !empty($page_layout) ? $page_layout : "content-full-width";

			$layout = trendytravel_page_layout( $page_layout );
			extract( $layout );

			if ( $show_sidebar ) {
				if ( $show_right_sidebar ) {

					$wtstyle = cs_get_option( 'wtitle-style' );	

					echo '<section id="secondary-right" class="secondary-sidebar '.$sidebar_class.'">';
					echo 	!empty( $wtstyle ) ? "<div class='{$wtstyle}'>" : '';

								if( is_active_sidebar('product-tag-sidebar-right') ):
									dynamic_sidebar('product-tag-sidebar-right');
								endif;

								$enable = cs_get_option( 'show-shop-standard-right-sidebar-for-product-tag-layout' );
								if( $enable ):
									if( is_active_sidebar('shop-everywhere-sidebar-right') ):
										dynamic_sidebar('shop-everywhere-sidebar-right');
									endif;
								endif;

					echo 	!empty( $wtstyle ) ? '</div>' : '';
					echo '</section>';
				}
			}
		}

		echo '	</div> <!-- ** Container End ** -->';
		echo '</div><!-- **Main - End ** -->';
	}

// Shop Column
	add_filter( 'loop_shop_per_page', 'trendytravel_woo_posts_per_page' );
	add_filter( 'loop_shop_columns', 'trendytravel_woo_loop_columns' );

	// No.of products per page --------------------------------------------------
	function trendytravel_woo_posts_per_page( $count ) {
		$count = cs_get_option( 'shop-product-per-page' );
		$count = !empty( $count )  ? $count : 12;
		return $count;
	}

	// Columns in products loop -------------------------------------------------
	function trendytravel_woo_loop_columns( $columns ) {
		$columns = cs_get_option( 'shop-page-product-layout' );
		$columns = !empty( $columns )  ? $columns : 4;
		return $columns;
	}

// Remove Yith Buttons
trendytravel_woo_remove_anonymous_object_action('woocommerce_after_shop_loop_item', 'YITH_WCQV_Frontend', 'yith_add_quick_view_button' , 15 );
trendytravel_woo_remove_anonymous_object_action('woocommerce_after_shop_loop_item', 'YITH_Woocompare_Frontend', 'add_compare_link' , 20 );

// Product Category
	add_action( 'woocommerce_before_subcategory', 'trendytravel_woo_product_style_start', 5 );
	add_action( 'woocommerce_after_subcategory', 'trendytravel_woo_product_style_end', 10 );

	add_action( 'woocommerce_before_subcategory_title', 'trendytravel_woo_before_subcategory_title', 5 );
	remove_action('woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10 );
	add_action( 'woocommerce_after_subcategory_title', 'trendytravel_woo_after_subcategory_title', 10 );

// Product Wrapper
	add_action( 'woocommerce_before_shop_loop_item', 'trendytravel_woo_product_style_start', 1 );
	add_action( 'woocommerce_after_shop_loop_item', 'trendytravel_woo_product_style_end', 100 );

	remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
	remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

	add_action( 'woocommerce_after_shop_loop_item', 'trendytravel_woo_shop_overview_show_price', 10 );

// To Remove Pagination
	remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
	add_action( 'woocommerce_after_shop_loop', 'trendytravel_woo_after_shop_loop', 10 );

// Before shop loop item -----------------------------------------------------
function trendytravel_woo_product_style_start() {

	global $woocommerce_loop;

	$style = 'woo-type22';
	$class = '';

	if( is_shop() || is_product_category() || is_product_tag() ) {
		$pstyle = cs_get_option( 'product-style' );
		$style  = !is_null( $pstyle ) ? $pstyle : $style;
		$column = cs_get_option( 'shop-page-product-layout' );
	} else {
		$style = isset( $woocommerce_loop['product-style'] ) ? $woocommerce_loop['product-style'] : $style;
		$column = $woocommerce_loop['columns'];
	}

	if( is_null( $column ) ) {
		$column = '4';
	}

	switch($column) {

		case 1:
		case '1':
			$class = 'no-column';
		break;

		case 2:
		case '2':
			$class = 'column dt-sc-one-half';
		break;

		case 3:
		case '3':
			$class = 'column dt-sc-one-third';
		break;

		case 4:
		case '4':
			$class = 'column dt-sc-one-fourth';
		break;

		case 5:
		case '5':
			$class = 'column dt-sc-one-fifth';
		break;
	}

	echo '<div class="'.$style.'">';
	echo '	<div class="'.$class.'">';
	echo '		<div class="product-wrapper">';
}

// After shop loop item -----------------------------------------------------
function trendytravel_woo_product_style_end() {
	echo '		</div> <!-- .product-wrapper -->';
	echo '	</div> <!-- .column -->';
	echo '</div> <!-- .style -->';
}

// After shop loop item -----------------------------------------------------
function trendytravel_woo_shop_overview_show_price() {
	global $product;
	$style = 'woo-type22';
	$class = $output = '';
	global $product;

	ob_start();
	woocommerce_template_loop_price();
	$price = ob_get_clean();

	if( is_shop() || is_product_category() || is_product_tag() ) {
		$pstyle = cs_get_option( 'product-style' );
		$style  = !is_null( $pstyle ) ? $pstyle : $style;
		$column = cs_get_option( 'shop-page-product-layout' );
	} else {
		$style = isset( $woocommerce_loop['product-style'] ) ? $woocommerce_loop['product-style'] : $style;
		$column = isset( $woocommerce_loop['columns'] ) ? $woocommerce_loop['columns'] : '';
	}

	if($style == 'woo-type22'){
		$output .= "<div class='package-thumb'>";
		if( $product->is_on_sale() and $product->is_in_stock() )
				$output .= '<span class="onsale"><span>'.esc_html__('Sale','trendytravel').'</span></span>';

			elseif(!$product->is_in_stock())
				$output .= '<span class="out-of-stock"><span>'.esc_html__('Out of Stock','trendytravel').'</span></span>';

			if( $product->is_featured())
				$output .= '<div class="featured-tag"><div><i class="fa fa-thumb-tack"></i><span>'.esc_html__('Featured','trendytravel').'</span></div></div>';
	
		$id = $product->get_id();
		$image = get_the_post_thumbnail( $id, 'shop_catalog' );
		$image = !empty( $image ) ? $image : "<img src='http".trendytravel_ssl()."://placehold.it/575x395' alt='product-thumb' />";
		$attachment_ids = $product->get_gallery_image_ids();
		$secondary_image_id = !empty( $attachment_ids ) ? $attachment_ids['0'] : '';
	
		$image1 = wp_get_attachment_image( $secondary_image_id, 'full', '', $attr = array( 'class' => 'secondary-image attachment-shop-catalog' ) );
		$output .= $image.$image1;
		
		$output .= "</div>";

		$output .= "<div class='package-details'>";
			$output .= '<h5><a href="'.get_permalink($product->get_id()).'">'.$product->get_name().'</a></h5>';
			if(get_post_meta($product->get_id(), '_package_place', true) != NULL) {
				$place = get_post_meta($product->get_id(), '_package_place', true);
				$output .= '<p>'.$place.'</p>';
			}
			$output .= '<div class="package-content">';
				$output .= '<ul class="package-meta">';
					if(get_post_meta($product->get_id(), '_package_days_duration', true) != NULL) {
						$duration = get_post_meta($product->get_id(), '_package_days_duration', true);
						$output .= '<li> <span class="fa fa-calendar"></span>'.esc_html__('No of Days: ', 'trendytravel').$duration.' </li>';
					}
					if(get_post_meta($product->get_id(), '_package_people', true) != NULL) {
						$people = get_post_meta($product->get_id(), '_package_people', true);
						$output .= '<li> <span class="fa fa-user"></span>'.esc_html__('People: ','trendytravel').$people.' </li>';
					}
				$output .= '</ul>';
				$output .= '<span class="package-price">'.$price.'</span>';
				
				ob_start();
				woocommerce_template_loop_add_to_cart();
				$add_to_cart = ob_get_clean();
			
				if( !empty($add_to_cart) ) {
					$add_to_cart = str_replace(' class="',' class="dt-sc-button too-small ',$add_to_cart);
				}
				$output .= $add_to_cart;
				
				if ( shortcode_exists( 'yith_wcwl_add_to_wishlist' ) )
					$output.= do_shortcode('[yith_wcwl_add_to_wishlist]');
			$output .= '</div>';
		$output .= '</div>';

	} else {

		$output .= "<div class='product-thumb'>";
		
			if( $product->is_on_sale() and $product->is_in_stock() )
				$output .= '<span class="onsale"><span>'.esc_html__('Sale','trendytravel').'</span></span>';

			elseif(!$product->is_in_stock())
				$output .= '<span class="out-of-stock"><span>'.esc_html__('Out of Stock','trendytravel').'</span></span>';

			if( $product->is_featured())
				$output .= '<div class="featured-tag"><div><i class="fa fa-thumb-tack"></i><span>'.esc_html__('Featured','trendytravel').'</span></div></div>';

			$output .= '<a class="image" href="'.get_permalink().'" title="'.get_the_title().'">';
			$id = $product->get_id();
				$image =  get_the_post_thumbnail( $id, 'shop_catalog' );
				$image = !empty( $image ) ? $image : "<img src='http://placehold.it/500' alt='product-thumb' />";
				$attachment_ids = $product->get_gallery_image_ids();
				$secondary_image_id = !empty( $attachment_ids ) ? $attachment_ids['0'] : '';
				$image1 = wp_get_attachment_image( $secondary_image_id, 'full', '', $attr = array( 'class' => 'secondary-image attachment-shop-catalog' ) );
				$output .= $image.$image1;
			$output .= '</a>';

			$output .= '<div class="product-buttons-wrapper">';

					$output .= '<div class="wc_inline_buttons">';

							ob_start();
							woocommerce_template_loop_add_to_cart();
							$add_to_cart = ob_get_clean();

							// Add to Cart
							if( !empty($add_to_cart) ) {
								$add_to_cart = str_replace(' class="',' class="dt-sc-button too-small ',$add_to_cart);
								$output .= '<div class="wc_cart_btn_wrapper wc_btn_inline">'.$add_to_cart.'</div>';
							}

							// YITH Wishlist 
							if ( shortcode_exists( 'yith_wcwl_add_to_wishlist' ) ) {
								$output .= '<div class="wcwl_btn_wrapper wc_btn_inline">'.do_shortcode('[yith_wcwl_add_to_wishlist]').'</div>';
							}

					$output .= '</div>';

			$output .= '</div>';

		$output .= "</div>";
	

		$output .= "<div class='product-details'>";
			$output .= '<h5><a href="'.get_permalink($product->get_id()).'">'.$product->get_name().'</a></h5>';
			$output .= '<span class="product-price">'.trim($price).'</span>';
			$output .= '<div class="product-rating-wrapper">'.wc_get_rating_html( $product->get_average_rating() ).'</div>';
		$output .= '</div>';
	}
	echo do_shortcode($output);
}

// After shop loop ----------------------------------------------------------
function trendytravel_woo_after_shop_loop() {
	echo '<div class="pagination">';
		if( function_exists( 'trendytravel_pagination' ) )
			echo trendytravel_pagination();
		else
			wc_get_template( 'loop/pagination.php' );
	echo '</div>';
}

// Before Category Title ---------------------------------------------------
function trendytravel_woo_before_subcategory_title() {
	echo '<div class="product-thumb"><span class="image">';
}

// After Category Title ----------------------------------------------------
function trendytravel_woo_after_subcategory_title( $category ) {
	echo '</span></div>';
	echo '<div class="product-details"><h5>'.$category->name;
		if ( $category->count > 0 ) {
			echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . $category->count . ')</mark>', $category );
		}
	echo '</h5></div>';
}


// Single Product 
	// Upsell Products
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
	add_action( 'woocommerce_after_single_product_summary', 'trendytravel_woo_show_upsell', 16 );

	// Related Products
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
	add_action( 'woocommerce_after_single_product_summary', 'trendytravel_woo_show_related', 21 );

	// Sale Flash
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
	add_action( 'woocommerce_before_single_product_summary','trendytravel_woo_show_product_wrapper',10 );
	add_action( 'woocommerce_after_single_product_summary','trendytravel_woo_close_product_wrapper',10 );
	add_action('woocommerce_product_thumbnails','trendytravel_woo_show_product_sale_flash',10);

	/* --------------------------------------------------------------------------
	 * Single Product
	 * Showing Upsell Products
	 * -------------------------------------------------------------------------- */
	function trendytravel_woo_show_upsell() {
		global $woocommerce_loop;

		$output = '';

		$page_layout = cs_get_option( 'product-layout' );
		$page_layout = !empty($page_layout) ? $page_layout : "content-full-width";

		$upsell_products = ( $page_layout === "content-full-width" ) ? 4 : 3;
		$woocommerce_loop['product-style'] = cs_get_option( 'product-style' );

		ob_start();
		woocommerce_upsell_display($upsell_products, $upsell_products); // X products, X columns
		$content = ob_get_clean();
		if($content):
			$content =  str_replace('<h2>','<h2 class="border-title"><span>', $content);
			$output .= "<div class='upsell-products-container'>{$content}</div>";
		endif;

		echo do_shortcode($output);
	}

	/* --------------------------------------------------------------------------
	 * Single Product
	 * Showing Releated Products
	 * -------------------------------------------------------------------------- */
	function trendytravel_woo_show_related() {
		global $woocommerce_loop;

		$show_related = cs_get_option( 'enable-related' );
		$output = '';

		if($show_related):

			$page_layout = cs_get_option( 'product-layout' );
			$page_layout = !empty($page_layout) ? $page_layout : "content-full-width";

			$related_products = ( $page_layout === "content-full-width" ) ? 4 : 3;
			$woocommerce_loop['product-style'] = cs_get_option( 'product-style' );

			ob_start();
			woocommerce_related_products(array('posts_per_page' => $related_products, 'columns' => $related_products, 'orderby' => 'rand')); // X products, X columns
			$content = ob_get_clean();
			if($content):
				$content =  str_replace('<h2>','<h2 class="border-title"><span>', $content);
				$output .= "<div class='related-products-container'>{$content}</div>";
			endif;

		endif;

		echo do_shortcode($output);
	}

	/* --------------------------------------------------------------------------
	 * Single Product
	 * Showing Product Thumb Wrapper
	 * -------------------------------------------------------------------------- */
	function trendytravel_woo_show_product_wrapper() {
		$out = '<div class="product-thumb-wrapper">';
		echo "{$out}";
	}

	/* --------------------------------------------------------------------------
	 * Single Product
	 * Closing Product Thumb Wrapper
	 * -------------------------------------------------------------------------- */
	function trendytravel_woo_close_product_wrapper() {
		$out = '</div>';
		echo "{$out}";
	}

	/* --------------------------------------------------------------------------
	 * Single Product
	 * Product Sale Flash
	 * -------------------------------------------------------------------------- */
	function trendytravel_woo_show_product_sale_flash() {
		global $product;

		$out = '<div class="package-thumb-wrapper">';
		if( $product->is_on_sale() and $product->is_in_stock() )
			$out .= '<span class="onsale"><span>'.esc_html__('Sale!','trendytravel').'</span></span>';

		elseif(!$product->is_in_stock())
			$out .= '<span class="out-of-stock">'.esc_html__('Out of Stock','trendytravel').'</span>';

		if($product->is_featured())
			$out .= '<div class="featured-tag"><div><i class="fa fa-thumb-tack"></i><span>'.esc_html__('Featured','trendytravel').'</span></div></div>';

		$out .= '</div>';

		echo "{$out}";
	}

// Remove Anonymous action ------------------------------------------
function trendytravel_woo_remove_anonymous_object_action( $tag, $class, $method, $priority = null ){

	if( empty($GLOBALS['wp_filter'][ $tag ]) ){
		return;
	}

	foreach ( $GLOBALS['wp_filter'][ $tag ] as $filterPriority => $filter ){
		if( !($priority===null || $priority==$filterPriority) )
			continue;

		foreach ( $filter as $identifier => $function ){
			if( is_array( $function)
				and is_a( $function['function'][0], $class )
				and $method === $function['function'][1]
			){
				remove_action(
					$tag,
					array ( $function['function'][0], $method ),
					$filterPriority
				);
			}
		}
	}
}