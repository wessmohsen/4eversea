<?php add_action( 'vc_before_init', 'dt_sc_simple_heading_vc_map' );
function dt_sc_simple_heading_vc_map() {

	vc_map( array(
		"name" => esc_html__( "Simple Heading", 'designthemes-core' ),
		"base" => 'dt_sc_simple_heading',
		"icon" => 'dt_sc_simple_heading',
		"category" => DT_VC_CATEGORY,
		"params" => array(

			# Types
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Type','designthemes-core'),
				'param_name' => 'type',
				'value' => array(
					esc_html__('Simple','designthemes-core') => 'simple',
					esc_html__('Two Color','designthemes-core') => 'two-color',
					esc_html__('Two Border','designthemes-core') => 'two-border',
					esc_html__('Two Border With Sub Title','designthemes-core') => 'two-border-with-subtitle',
					esc_html__('Icon With Link', 'designthemes-core') => 'with-icon-link',
					esc_html__('Ribbon','designthemes-core') => 'ribbon',
					esc_html__('Script','designthemes-core') => 'script',
					esc_html__('Stripe','designthemes-core') => 'stripe',
					esc_html__('Stripe 2','designthemes-core') => 'mz-stripe',
					esc_html__('Split','designthemes-core') => 'split',
					esc_html__('Decoration','designthemes-core') => 'decoration',
					esc_html__('Triangle','designthemes-core') => 'triangle',
					esc_html__('Type Writing','designthemes-core') => 'type-writing',
				),
				'std' => 'two-border',
				'admin_label' => true
			),

			# Heading Tag
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Heading tag','designthemes-core'),
				'param_name' => 'tag',
				'value' => array(
					'H1' => 'h1',
					'H2' => 'h2',
					'H3' => 'h3',
					'H4' => 'h4',
					'H5' => 'h5',
					'H6' => 'h6'
				),
				'std' => 'h2',
			),

			# Text
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Text', 'designthemes-core' ),
				'param_name' => 'text',
				'value' => 'Lorem ipsum dolor'
			),

			# Sub Heading Tag
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Sub Heading tag','designthemes-core'),
				'param_name' => 'subtag',
				'value' => array(
					'H1' => 'h1',
					'H2' => 'h2',
					'H3' => 'h3',
					'H4' => 'h4',
					'H5' => 'h5',
					'H6' => 'h6'
				),
				'std' => 'h3',
				'dependency' => array( 'element' => 'type', 'value' => array( 'two-border-with-subtitle', 'script', 'stripe' , 'type-writing' ) )
			),

			# Sub Heading Text
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Sub Text', 'designthemes-core' ),
				'param_name' => 'subtext',
				'value' => 'Lorem ipsum dolor',
				'dependency' => array( 'element' => 'type', 'value' => array( 'two-border-with-subtitle', 'script', 'stripe', 'type-writing' ) )
			),

			# Sub Heading Tag
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Sub Heading tag','designthemes-core'),
				'param_name' => 'extra_text_tag',
				'value' => array(
					'H1' => 'h1',
					'H2' => 'h2',
					'H3' => 'h3',
					'H4' => 'h4',
					'H5' => 'h5',
					'H6' => 'h6'
				),
				'std' => 'h5',
				'dependency' => array( 'element' => 'type', 'value' => array( 'stripe', 'type-writing' ) )
			),

			# Extra Text - type = stripe
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Extra text', 'designthemes-core' ),
				'param_name' => 'extra_text',
				'value' => 'Lorem ipsum dolor',
				'dependency' => array( 'element' => 'type', 'value' => array( 'stripe', 'type-writing' ) )
      		),

      		# Link - type = with-icon-link
      		array(
				'type' => 'vc_link',
				'heading' => esc_html__( 'URL (Link)', 'designthemes-core' ),
				'param_name' => 'link',
				'dependency' => array( 'element' => 'type', 'value' => 'with-icon-link' )
			),
			
      		# Icon Class - type = with-icon-link
      		array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Icon Class', 'designthemes-core' ),
				'param_name' => 'icon',
				'value' => 'icon icon-compactcamera',
				'description' => esc_html__( 'Eg: fa fa-home or icon icon-compactcamera', 'designthemes-core' ),
				'dependency' => array( 'element' => 'type', 'value' => 'with-icon-link' )
			),

			# Content - type = Decoration , Triangle
			array(
				'type' => 'textarea_html',
				'heading' => esc_html__( 'Content', 'designthemes-core' ),
				'param_name' => 'content',
				'value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi',
				'dependency' => array( 'element' => 'type', 'value' => array( 'decoration', 'triangle' ) )
			),

			# Extra class name
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Extra class name', 'designthemes-core' ),
				'param_name' => 'class',
				'description' => esc_html__( 'Style particular element differently - add a class name and refer to it in custom CSS', 'designthemes-core' )
      		)			
		)
	) );
}?>