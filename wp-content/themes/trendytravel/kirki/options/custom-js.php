<?php
$config = trendytravel_kirki_config();

TRENDYTRAVEL_Kirki::add_section( 'dt_custom_js_section', array(
	'title' => esc_html( 'Additional JS', 'trendytravel' ),
	'priority' => 210
) );

	# custom-js
	TRENDYTRAVEL_Kirki::add_field( $config, array(
		'type'     => 'switch',
		'settings' => 'enable-custom-js',
		'section'  => 'dt_custom_js_section',
		'label'    => esc_html( 'Enable Custom JS?', 'trendytravel' ),
		'default'  => trendytravel_defaults('enable-custom-js'),
		'choices'  => array(
			'on'  => esc_attr__( 'Yes', 'trendytravel' ),
			'off' => esc_attr__( 'No', 'trendytravel' )
		)		
	));

	# custom-js
	TRENDYTRAVEL_Kirki::add_field( $config, array(
		'type'     => 'code',
		'settings' => 'custom-js',
		'section'  => 'dt_custom_js_section',
		'transport' => 'postMessage',
		'label'    => esc_html( 'Add Custom JS', 'trendytravel' ),
		'choices'     => array(
			'language' => 'javascript',
			'theme'    => 'dark',
		),
		'active_callback' => array(
			array( 'setting' => 'enable-custom-js' , 'operator' => '==', 'value' =>'1')
		)
	));