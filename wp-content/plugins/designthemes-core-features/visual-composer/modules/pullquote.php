<?php add_action( 'vc_before_init', 'dt_sc_pullquote_vc_map' );
function dt_sc_pullquote_vc_map() {

	global $variations;

	vc_map( array(
		"name" => esc_html__( "Pullquote", 'designthemes-core' ),
            "base" => "dt_sc_pullquote",
		"icon" => "dt_sc_pullquote",
		"category" => DT_VC_CATEGORY,
		"params" => array(

			# Types
      		array(
      			'type' => 'dropdown',
      			'heading' => esc_html__( 'Types', 'designthemes-core' ),
      			'param_name' => 'type',
                        'admin_label' => true,
      			'value' => array( esc_html__('PullQuote 1','designthemes-core') => 'pullquote1', esc_html__('PullQuote 2','designthemes-core') => 'pullquote2', esc_html__('PullQuote 3','designthemes-core') => 'pullquote3',
					esc_html__('PullQuote 4','designthemes-core') => 'pullquote4', esc_html__('PullQuote 5','designthemes-core') => 'pullquote5', esc_html__('PullQuote 6','designthemes-core') => 'pullquote6' ),
      			'description' => esc_html__( 'Select blockquote type', 'designthemes-core' ),
      		),

			# Align
      		array(
      			'type' => 'dropdown',
      			'heading' => esc_html__( 'Align', 'designthemes-core' ),
      			'param_name' => 'align',
                        'admin_label' => true,
                        'value' => array( 
      				esc_html__('None','designthemes-core') => '',
      				esc_html__('Left','designthemes-core') => 'alignleft',
      				esc_html__('Center','designthemes-core') => 'aligncenter',
      				esc_html__('Right','designthemes-core') => 'alignright',
      			),
      			'description' => esc_html__( 'Select blockquote type', 'designthemes-core' ),
      		),
			
			# Variation
            array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Select Icon', 'designthemes-core' ),
				'admin_label' => true,
				'param_name' => 'icon',
				'value' => array( esc_html__('Yes','designthemes-core') => 'yes', esc_html__('No','designthemes-core')  => 'no' ),
				'description' => esc_html__( 'Display Icon', 'designthemes-core' ),
            ),
			
			# Custom Text Color
      		array(
      			'type' => 'colorpicker',
      			'heading' => esc_html__( 'Custom text color', 'designthemes-core' ),
      			'param_name' => 'textcolor',
				'dependency' => array( 'element' => 'variation', 'value' =>'-' ),
      			'description' => esc_html__( 'Select text color', 'designthemes-core' ),
      		),
			
			# Cite
      		array( 
      			"type" => "textfield",
      			"heading" => esc_html__( "Cite", 'designthemes-core' ),
      			"param_name" => "cite"
      		),
			
			// Content
			array(
				'type' => 'textarea_html',
				'heading' => esc_html__('Content','designthemes-core'),
				'param_name' => 'content',
				'value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.'
            ),
		)
	) );	
} ?>