<?php
$atts = array();
parse_str( $data, $atts );
extract( shortcode_atts( array(
	'link' => '',
	'category_style' => '',
	'category_color' => '',
	'category_size' => '',
	'css' => '',
	'el_class' => ''
), $atts ) );

$categories = get_the_category( $post->ID );

$separator = '';
$css_class = array( 'vc_gitem-post-data' );
$css_class[] = vc_shortcode_custom_css_class( $atts['css'] );
$css_class[] = $atts['el_class'];
$css_class[] = 'vc_gitem-post-data-source-post_categories';
$style = str_replace( ',', 'comma', $atts['category_style'] );

$output = '<div class="' . esc_attr( implode( ' ', array_filter( $css_class ) ) ) . ' vc_grid-filter vc_clearfix vc_grid-filter-' . esc_attr( $style ) . ' vc_grid-filter-size-' . esc_attr( $atts['category_size'] ) . ' vc_grid-filter-center vc_grid-filter-color-' . esc_attr( $atts['category_color'] ) . '">';
$data = array();
if ( ! empty( $categories ) ) {
	foreach ( $categories as $category ) {
		$category_link = '';
		if ( ! empty( $atts['link'] ) ) {
			$category_link = 'href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( esc_html__( 'View all posts in %s', 'designthemes-core' ), $category->name ) ) . '"';
		}

		$wrapper = '<div class="vc_grid-filter-item vc_gitem-post-category-name vc_gitem-post-category-'.$category->term_id.'">';
		$content = esc_html( $category->name );
		if ( ! empty( $category_link ) ) {
			$content = '<span class="vc_gitem-post-category-name"><a ' . $category_link . ' class="vc_gitem-link">' . $content . '</a>' . '</span>';
		} else {
			$content = '<span class="vc_gitem-post-category-name">' . $content . '</span>';
		}
		$wrapper_end = '</div>';
		$data[] = $wrapper . $content . $wrapper_end;
	}
}
if ( empty( $atts['category_style'] ) || ' ' === $atts['category_style'] || ', ' === $atts['category_style'] ) {
	$separator = $atts['category_style'];
}
$output .= implode( $separator, $data );
$output .= '</div>';

return $output;