<?php
$config = trendytravel_kirki_config();

TRENDYTRAVEL_Kirki::add_section( 'dt_site_layout_section', array(
	'title' => esc_html( 'Site Layout', 'trendytravel' ),
	'priority' => 20
) );

	# site-layout
	TRENDYTRAVEL_Kirki::add_field( $config, array(
		'type'     => 'radio-image',
		'settings' => 'site-layout',
		'label'    => esc_html( 'Site Layout', 'trendytravel' ),
		'section'  => 'dt_site_layout_section',
		'default'  => trendytravel_defaults('site-layout'),
		'choices' => array(
			'boxed' =>  TRENDYTRAVEL_THEME_URI.'/kirki/assets/images/site-layout/boxed.png',
			'wide' => TRENDYTRAVEL_THEME_URI.'/kirki/assets/images/site-layout/wide.png',
		)
	));

	# site-boxed-layout
	TRENDYTRAVEL_Kirki::add_field( $config, array(
		'type'     => 'switch',
		'settings' => 'site-boxed-layout',
		'label'    => esc_html( 'Customize Boxed Layout?', 'trendytravel' ),
		'section'  => 'dt_site_layout_section',
		'default'  => '1',
		'choices'  => array(
			'on'  => esc_attr__( 'Yes', 'trendytravel' ),
			'off' => esc_attr__( 'No', 'trendytravel' )
		),
		'active_callback' => array(
			array( 'setting' => 'site-layout', 'operator' => '==', 'value' => 'boxed' ),
		)			
	));

	# body-bg-type
	TRENDYTRAVEL_Kirki::add_field( $config, array(
		'type' => 'select',
		'settings' => 'body-bg-type',
		'label'    => esc_html( 'Background Type', 'trendytravel' ),
		'section'  => 'dt_site_layout_section',
		'multiple' => 1,
		'default'  => 'none',
		'choices'  => array(
			'pattern' => esc_attr__( 'Predefined Patterns', 'trendytravel' ),
			'upload' => esc_attr__( 'Set Pattern', 'trendytravel' ),
			'none' => esc_attr__( 'None', 'trendytravel' ),
		),
		'active_callback' => array(
			array( 'setting' => 'site-layout', 'operator' => '==', 'value' => 'boxed' ),
			array( 'setting' => 'site-boxed-layout', 'operator' => '==', 'value' => '1' )
		)
	));

	# body-bg-pattern
	TRENDYTRAVEL_Kirki::add_field( $config, array(
		'type'     => 'radio-image',
		'settings' => 'body-bg-pattern',
		'label'    => esc_html( 'Predefined Patterns', 'trendytravel' ),
		'description'    => esc_html( 'Add Background for body', 'trendytravel' ),
		'section'  => 'dt_site_layout_section',
		'output' => array(
			array( 'element' => 'body' , 'property' => 'background-image' )
		),
		'choices' => array(
			TRENDYTRAVEL_THEME_URI.'/kirki/assets/images/site-layout/pattern1.jpg'=> TRENDYTRAVEL_THEME_URI.'/kirki/assets/images/site-layout/pattern1.jpg',
			TRENDYTRAVEL_THEME_URI.'/kirki/assets/images/site-layout/pattern2.jpg'=> TRENDYTRAVEL_THEME_URI.'/kirki/assets/images/site-layout/pattern2.jpg',
			TRENDYTRAVEL_THEME_URI.'/kirki/assets/images/site-layout/pattern3.jpg'=> TRENDYTRAVEL_THEME_URI.'/kirki/assets/images/site-layout/pattern3.jpg',
			TRENDYTRAVEL_THEME_URI.'/kirki/assets/images/site-layout/pattern4.jpg'=> TRENDYTRAVEL_THEME_URI.'/kirki/assets/images/site-layout/pattern4.jpg',
			TRENDYTRAVEL_THEME_URI.'/kirki/assets/images/site-layout/pattern5.jpg'=> TRENDYTRAVEL_THEME_URI.'/kirki/assets/images/site-layout/pattern5.jpg',
			TRENDYTRAVEL_THEME_URI.'/kirki/assets/images/site-layout/pattern6.jpg'=> TRENDYTRAVEL_THEME_URI.'/kirki/assets/images/site-layout/pattern6.jpg',
			TRENDYTRAVEL_THEME_URI.'/kirki/assets/images/site-layout/pattern7.jpg'=> TRENDYTRAVEL_THEME_URI.'/kirki/assets/images/site-layout/pattern7.jpg',
			TRENDYTRAVEL_THEME_URI.'/kirki/assets/images/site-layout/pattern8.jpg'=> TRENDYTRAVEL_THEME_URI.'/kirki/assets/images/site-layout/pattern8.jpg',
			TRENDYTRAVEL_THEME_URI.'/kirki/assets/images/site-layout/pattern9.jpg'=> TRENDYTRAVEL_THEME_URI.'/kirki/assets/images/site-layout/pattern9.jpg',
			TRENDYTRAVEL_THEME_URI.'/kirki/assets/images/site-layout/pattern10.jpg'=> TRENDYTRAVEL_THEME_URI.'/kirki/assets/images/site-layout/pattern10.jpg',
			TRENDYTRAVEL_THEME_URI.'/kirki/assets/images/site-layout/pattern11.jpg'=> TRENDYTRAVEL_THEME_URI.'/kirki/assets/images/site-layout/pattern11.jpg',
			TRENDYTRAVEL_THEME_URI.'/kirki/assets/images/site-layout/pattern12.jpg'=> TRENDYTRAVEL_THEME_URI.'/kirki/assets/images/site-layout/pattern12.jpg',
			TRENDYTRAVEL_THEME_URI.'/kirki/assets/images/site-layout/pattern13.jpg'=> TRENDYTRAVEL_THEME_URI.'/kirki/assets/images/site-layout/pattern13.jpg',
			TRENDYTRAVEL_THEME_URI.'/kirki/assets/images/site-layout/pattern14.jpg'=> TRENDYTRAVEL_THEME_URI.'/kirki/assets/images/site-layout/pattern14.jpg',
			TRENDYTRAVEL_THEME_URI.'/kirki/assets/images/site-layout/pattern15.jpg'=> TRENDYTRAVEL_THEME_URI.'/kirki/assets/images/site-layout/pattern15.jpg',
		),
		'active_callback' => array(
			array( 'setting' => 'body-bg-type', 'operator' => '==', 'value' => 'pattern' ),
			array( 'setting' => 'site-layout', 'operator' => '==', 'value' => 'boxed' ),
			array( 'setting' => 'site-boxed-layout', 'operator' => '==', 'value' => '1' )
		)						
	));

	# body-bg-image
	TRENDYTRAVEL_Kirki::add_field( $config, array(
		'type' => 'image',
		'settings' => 'body-bg-image',
		'label'    => esc_html( 'Background Image', 'trendytravel' ),
		'description'    => esc_html( 'Add Background Image for body', 'trendytravel' ),
		'section'  => 'dt_site_layout_section',
		'output' => array(
			array( 'element' => 'body' , 'property' => 'background-image' )
		),
		'active_callback' => array(
			array( 'setting' => 'body-bg-type', 'operator' => '==', 'value' => 'upload' ),
			array( 'setting' => 'site-layout', 'operator' => '==', 'value' => 'boxed' ),
			array( 'setting' => 'site-boxed-layout', 'operator' => '==', 'value' => '1' )
		)
	));

	# body-bg-position
	TRENDYTRAVEL_Kirki::add_field( $config, array(
		'type' => 'select',
		'settings' => 'body-bg-position',
		'label'    => esc_html( 'Background Position', 'trendytravel' ),
		'section'  => 'dt_site_layout_section',
		'output' => array(
			array( 'element' => 'body' , 'property' => 'background-position' )
		),
		'default' => 'center',
		'multiple' => 1,
		'choices' => trendytravel_image_positions(),
		'active_callback' => array(
			array( 'setting' => 'body-bg-type', 'operator' => 'contains', 'value' => array( 'pattern', 'upload') ),
			array( 'setting' => 'site-layout', 'operator' => '==', 'value' => 'boxed' ),
			array( 'setting' => 'site-boxed-layout', 'operator' => '==', 'value' => '1' )
		)
	));

	# body-bg-repeat
	TRENDYTRAVEL_Kirki::add_field( $config, array(
		'type' => 'select',
		'settings' => 'body-bg-repeat',
		'label'    => esc_html( 'Background Repeat', 'trendytravel' ),
		'section'  => 'dt_site_layout_section',
		'output' => array(
			array( 'element' => 'body' , 'property' => 'background-repeat' )
		),
		'default' => 'repeat',
		'multiple' => 1,
		'choices' => trendytravel_image_repeats(),
		'active_callback' => array(
			array( 'setting' => 'body-bg-type', 'operator' => 'contains', 'value' => array( 'pattern', 'upload' ) ),
			array( 'setting' => 'site-layout', 'operator' => '==', 'value' => 'boxed' ),
			array( 'setting' => 'site-boxed-layout', 'operator' => '==', 'value' => '1' )
		)
	));	