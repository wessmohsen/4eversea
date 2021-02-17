<?php
function trendytravel_kirki_config() {
	return 'trendytravel_kirki_config';
}

function trendytravel_defaults( $key = '' ) {
	$defaults = array();

	# site identify
	$defaults['use-custom-logo'] = '1';
	$defaults['custom-logo'] = TRENDYTRAVEL_THEME_URI.'/images/logo.png';
	$defaults['custom-light-logo'] = TRENDYTRAVEL_THEME_URI.'/images/light-logo.png';
	$defaults['site_icon'] = TRENDYTRAVEL_THEME_URI.'/images/favicon.ico';
	$defaults['custom-title-color'] = '#ffffff';
	$defaults['body-bg-color']      = '#ffffff';
	$defaults['body-content-color'] = '#8b8b8b';
	$defaults['body-a-color']       = '#087dc2';
	$defaults['body-a-hover-color'] = '#087dc2';

	# site layout
	$defaults['site-layout'] = 'wide';

	# site skin
	$defaults['primary-color'] = '#087dc2';
	$defaults['secondary-color'] = '#fade03';
	$defaults['tertiary-color'] = '#6dc82b';
	$defaults['quaternary-color'] = '#2c3e50';
	$defaults['quinary-color'] = '#19a9e5';

	# site breadcrumb
	$defaults['customize-breadcrumb-title-typo'] = '1';
	$defaults['breadcrumb-title-typo'] = array( 'font-family' => 'Open Sans',
		'variant' => '600',
		'subsets' => array( 'latin-ext' ),
		'font-size' => '27px',
		'line-height' => '',
		'letter-spacing' => '',
		'color' => '#2c3e50',
		'text-align' => 'unset',
		'text-transform' => 'none' );
	$defaults['customize-breadcrumb-typo'] = '0';
	$defaults['breadcrumb-typo'] = array( 'font-family' => 'Open Sans',
		'variant' => 'regular',
		'subsets' => array( 'latin-ext' ),
		'font-size' => '14px',
		'line-height' => '18px',
		'letter-spacing' => '',
		'color' => '#323232',
		'text-align' => 'unset',
		'text-transform' => 'none' );

	# site footer
	$defaults['customize-footer-title-typo'] = '1';
	$defaults['footer-title-typo'] = array( 'font-family' => 'Courgette, cursive',
		'variant' => '600',
		'subsets' => array( 'latin-ext' ),
		'font-size' => '16px',
		'line-height' => '',
		'letter-spacing' => '0',
		'color' => '#1d1d1d',
		'text-align' => 'left',
		'text-transform' => 'none' );
	$defaults['customize-footer-content-typo'] = '1';
	$defaults['footer-content-typo'] = array( 'font-family' => 'Open Sans',
		'variant' => 'regular',
		'subsets' => array( 'latin-ext' ),
		'font-size' => '13px',
		'line-height' => '24px',
		'letter-spacing' => '',
		'color' => '#8b8b8b',
		'text-align' => 'left',
		'text-transform' => 'none' );
		
	$defaults['customize-footer-link-content-typo'] = '1';
	$defaults['footer-link-content-typo'] = array( 'font-family' => 'Open Sans Condensed',
		'variant' => '700',
		'subsets' => array( 'latin-ext' ),
		'font-size' => '13px',
		'line-height' => '24px',
		'letter-spacing' => '',
		'color' => '#8b8b8b',
		'text-align' => 'left',
		'text-transform' => 'none' );	

	# site typography
	$defaults['customize-body-h1-typo'] = '1';
	$defaults['h1'] = array(
		'font-family' => 'Open Sans',
		'variant' => 'regular',
		'font-size' => '36px',
		'line-height' => '',
		'letter-spacing' => '',
		'color' => '#2c3e50',
		'text-align' => 'unset',
		'text-transform' => 'none'
	);
	$defaults['customize-body-h2-typo'] = '1';
	$defaults['h2'] = array(
		'font-family' => 'Open Sans',
		'variant' => 'regular',
		'font-size' => '30px',
		'line-height' => '',
		'letter-spacing' => '',
		'color' => '#2c3e50',
		'text-align' => 'unset',
		'text-transform' => 'none'
	);
	$defaults['customize-body-h3-typo'] = '1';
	$defaults['h3'] = array(
		'font-family' => 'Open Sans',
		'variant' => 'regular',
		'font-size' => '24px',
		'line-height' => '',
		'letter-spacing' => '',
		'color' => '#2c3e50',
		'text-align' => 'unset',
		'text-transform' => 'none'
	);
	$defaults['customize-body-h4-typo'] = '1';
	$defaults['h4'] = array(
		'font-family' => 'Open Sans',
		'variant' => 'regular',
		'font-size' => '20px',
		'line-height' => '',
		'letter-spacing' => '',
		'color' => '#2c3e50',
		'text-align' => 'unset',
		'text-transform' => 'none'
	);
	$defaults['customize-body-h5-typo'] = '1';
	$defaults['h5'] = array(
		'font-family' => 'Open Sans',
		'variant' => 'regular',
		'font-size' => '18px',
		'line-height' => '',
		'letter-spacing' => '',
		'color' => '#2c3e50',
		'text-align' => 'unset',
		'text-transform' => 'none'
	);
	$defaults['customize-body-h6-typo'] = '1';
	$defaults['h6'] = array(
		'font-family' => 'Open Sans',
		'variant' => 'regular',
		'font-size' => '16px',
		'line-height' => '',
		'letter-spacing' => '',
		'color' => '#2c3e50',
		'text-align' => 'unset',
		'text-transform' => 'none'
	);
	$defaults['customize-body-content-typo'] = '1';
	$defaults['body-content-typo'] = array(
		'font-family' => 'Open Sans',
		'variant' => 'regular',
		'font-size' => '14px',
		'line-height' => '26px',
		'letter-spacing' => '',
		'color' => '#8b8b8b',
		'text-align' => 'unset',
		'text-transform' => 'none'
	);

	if( !empty( $key ) && array_key_exists( $key, $defaults) ) {
		return $defaults[$key];
	}

	return '';
}

function trendytravel_image_positions() {

	$positions = array( "top left" => esc_attr__('Top Left','trendytravel'),
		"top center"    => esc_attr__('Top Center','trendytravel'),
		"top right"     => esc_attr__('Top Right','trendytravel'),
		"center left"   => esc_attr__('Center Left','trendytravel'),
		"center center" => esc_attr__('Center Center','trendytravel'),
		"center right"  => esc_attr__('Center Right','trendytravel'),
		"bottom left"   => esc_attr__('Bottom Left','trendytravel'),
		"bottom center" => esc_attr__('Bottom Center','trendytravel'),
		"bottom right"  => esc_attr__('Bottom Right','trendytravel'),
	);

	return $positions;
}

function trendytravel_image_repeats() {

	$image_repeats = array( "repeat" => esc_attr__('Repeat','trendytravel'),
		"repeat-x"  => esc_attr__('Repeat in X-axis','trendytravel'),
		"repeat-y"  => esc_attr__('Repeat in Y-axis','trendytravel'),
		"no-repeat" => esc_attr__('No Repeat','trendytravel')
	);

	return $image_repeats;
}

function trendytravel_border_styles() {

	$image_repeats = array(
		"none"	 => esc_attr__('None','trendytravel'),
		"dotted" => esc_attr__('Dotted','trendytravel'),
		"dashed" => esc_attr__('Dashed','trendytravel'),
		"solid"	 => esc_attr__('Solid','trendytravel'),
		"double" => esc_attr__('Double','trendytravel'),
		"groove" => esc_attr__('Groove','trendytravel'),
		"ridge"	 => esc_attr__('Ridge','trendytravel'),
	);

	return $image_repeats;
}

function trendytravel_animations() {

	$animations = array(
		'' 					 => esc_html__('Default','trendytravel'),	
		"bigEntrance"        =>  esc_attr__("bigEntrance",'trendytravel'),
        "bounce"             =>  esc_attr__("bounce",'trendytravel'),
        "bounceIn"           =>  esc_attr__("bounceIn",'trendytravel'),
        "bounceInDown"       =>  esc_attr__("bounceInDown",'trendytravel'),
        "bounceInLeft"       =>  esc_attr__("bounceInLeft",'trendytravel'),
        "bounceInRight"      =>  esc_attr__("bounceInRight",'trendytravel'),
        "bounceInUp"         =>  esc_attr__("bounceInUp",'trendytravel'),
        "bounceOut"          =>  esc_attr__("bounceOut",'trendytravel'),
        "bounceOutDown"      =>  esc_attr__("bounceOutDown",'trendytravel'),
        "bounceOutLeft"      =>  esc_attr__("bounceOutLeft",'trendytravel'),
        "bounceOutRight"     =>  esc_attr__("bounceOutRight",'trendytravel'),
        "bounceOutUp"        =>  esc_attr__("bounceOutUp",'trendytravel'),
        "expandOpen"         =>  esc_attr__("expandOpen",'trendytravel'),
        "expandUp"           =>  esc_attr__("expandUp",'trendytravel'),
        "fadeIn"             =>  esc_attr__("fadeIn",'trendytravel'),
        "fadeInDown"         =>  esc_attr__("fadeInDown",'trendytravel'),
        "fadeInDownBig"      =>  esc_attr__("fadeInDownBig",'trendytravel'),
        "fadeInLeft"         =>  esc_attr__("fadeInLeft",'trendytravel'),
        "fadeInLeftBig"      =>  esc_attr__("fadeInLeftBig",'trendytravel'),
        "fadeInRight"        =>  esc_attr__("fadeInRight",'trendytravel'),
        "fadeInRightBig"     =>  esc_attr__("fadeInRightBig",'trendytravel'),
        "fadeInUp"           =>  esc_attr__("fadeInUp",'trendytravel'),
        "fadeInUpBig"        =>  esc_attr__("fadeInUpBig",'trendytravel'),
        "fadeOut"            =>  esc_attr__("fadeOut",'trendytravel'),
        "fadeOutDownBig"     =>  esc_attr__("fadeOutDownBig",'trendytravel'),
        "fadeOutLeft"        =>  esc_attr__("fadeOutLeft",'trendytravel'),
        "fadeOutLeftBig"     =>  esc_attr__("fadeOutLeftBig",'trendytravel'),
        "fadeOutRight"       =>  esc_attr__("fadeOutRight",'trendytravel'),
        "fadeOutUp"          =>  esc_attr__("fadeOutUp",'trendytravel'),
        "fadeOutUpBig"       =>  esc_attr__("fadeOutUpBig",'trendytravel'),
        "flash"              =>  esc_attr__("flash",'trendytravel'),
        "flip"               =>  esc_attr__("flip",'trendytravel'),
        "flipInX"            =>  esc_attr__("flipInX",'trendytravel'),
        "flipInY"            =>  esc_attr__("flipInY",'trendytravel'),
        "flipOutX"           =>  esc_attr__("flipOutX",'trendytravel'),
        "flipOutY"           =>  esc_attr__("flipOutY",'trendytravel'),
        "floating"           =>  esc_attr__("floating",'trendytravel'),
        "hatch"              =>  esc_attr__("hatch",'trendytravel'),
        "hinge"              =>  esc_attr__("hinge",'trendytravel'),
        "lightSpeedIn"       =>  esc_attr__("lightSpeedIn",'trendytravel'),
        "lightSpeedOut"      =>  esc_attr__("lightSpeedOut",'trendytravel'),
        "pullDown"           =>  esc_attr__("pullDown",'trendytravel'),
        "pullUp"             =>  esc_attr__("pullUp",'trendytravel'),
        "pulse"              =>  esc_attr__("pulse",'trendytravel'),
        "rollIn"             =>  esc_attr__("rollIn",'trendytravel'),
        "rollOut"            =>  esc_attr__("rollOut",'trendytravel'),
        "rotateIn"           =>  esc_attr__("rotateIn",'trendytravel'),
        "rotateInDownLeft"   =>  esc_attr__("rotateInDownLeft",'trendytravel'),
        "rotateInDownRight"  =>  esc_attr__("rotateInDownRight",'trendytravel'),
        "rotateInUpLeft"     =>  esc_attr__("rotateInUpLeft",'trendytravel'),
        "rotateInUpRight"    =>  esc_attr__("rotateInUpRight",'trendytravel'),
        "rotateOut"          =>  esc_attr__("rotateOut",'trendytravel'),
        "rotateOutDownRight" =>  esc_attr__("rotateOutDownRight",'trendytravel'),
        "rotateOutUpLeft"    =>  esc_attr__("rotateOutUpLeft",'trendytravel'),
        "rotateOutUpRight"   =>  esc_attr__("rotateOutUpRight",'trendytravel'),
        "shake"              =>  esc_attr__("shake",'trendytravel'),
        "slideDown"          =>  esc_attr__("slideDown",'trendytravel'),
        "slideExpandUp"      =>  esc_attr__("slideExpandUp",'trendytravel'),
        "slideLeft"          =>  esc_attr__("slideLeft",'trendytravel'),
        "slideRight"         =>  esc_attr__("slideRight",'trendytravel'),
        "slideUp"            =>  esc_attr__("slideUp",'trendytravel'),
        "stretchLeft"        =>  esc_attr__("stretchLeft",'trendytravel'),
        "stretchRight"       =>  esc_attr__("stretchRight",'trendytravel'),
        "swing"              =>  esc_attr__("swing",'trendytravel'),
        "tada"               =>  esc_attr__("tada",'trendytravel'),
        "tossing"            =>  esc_attr__("tossing",'trendytravel'),
        "wobble"             =>  esc_attr__("wobble",'trendytravel'),
        "fadeOutDown"        =>  esc_attr__("fadeOutDown",'trendytravel'),
        "fadeOutRightBig"    =>  esc_attr__("fadeOutRightBig",'trendytravel'),
        "rotateOutDownLeft"  =>  esc_attr__("rotateOutDownLeft",'trendytravel')
    );

	return $animations;
}

function trendytravel_custom_fonts( $standard_fonts ){

	$custom_fonts = array();

	$fonts = cs_get_option('custom_font_fields');
	if( count( $fonts ) > 0 ):
		foreach( $fonts as $font ):
			$custom_fonts[$font['custom_font_name']] = array(
				'label' => $font['custom_font_name'],
				'variants' => array( '100', '100italic', '200', '200italic', '300', '300italic', 'regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic' ),
				'stack' => $font['custom_font_name'] . ', sans-serif'
			);
		endforeach;
	endif;

	return array_merge_recursive( $custom_fonts, $standard_fonts );
}
add_filter( 'kirki/fonts/standard_fonts', 'trendytravel_custom_fonts', 20 );