<?php add_action( 'vc_before_init', 'dt_sc_infographic_bar_vc_map' );
function dt_sc_infographic_bar_vc_map() {

	global $variations;

	vc_map( array(
            "name"     => esc_html__( "Infographic Bar", 'designthemes-core' ),
            "base"     => "dt_sc_infographic_bar",
            "icon"     => "dt_sc_infographic_bar",
            "category" => DT_VC_CATEGORY,
            "params"   => array(
			
			
			# Type
			array(
				'type' => 'dropdown',
				'param_name' => 'type',
				'value' => array(
					esc_html__('Standard','designthemes-core') => 'standard',
					esc_html__('Progress Striped','designthemes-core') => 'progress-striped',
					esc_html__('Progress Striped Active','designthemes-core') => 'progress-striped-active',
				),
				'heading' => esc_html__( 'Type', 'designthemes-core' ),
				'description' => esc_html__( 'Select Progress bar type', 'designthemes-core' ),
			),
			
			
			// Font Awesome
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Font Awesome', 'designthemes-core' ),
				'param_name' => 'icon',
				'settings' => array( 'emptyIcon' => false, 'iconsPerPage' => 4000 ),
				'dependency' => array( 'element' => 'icon_type', 'value' => 'fontawesome' ),
				'description' => esc_html__( 'Select icon from library', 'designthemes-core' ),
			),
			
			// Button Text
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Icon Size', 'designthemes-core' ),
				'param_name' => 'icon_size',
				'value' => esc_html__( '50', 'designthemes-core' ),
			),
			
			// BG Color			
			array(
				"type" => "colorpicker",
      			"heading" => esc_html__( "Custom Background color", 'designthemes-core' ),
      			"param_name" => "color",
      			"description" => esc_html__( "Select button background color", 'designthemes-core' ),
      		), 
			
			// Value
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Value', 'designthemes-core' ),
				'param_name' => 'value',
				'value' => esc_html__( '55', 'designthemes-core' ),
			),
			
			# Content
      		array(
      			'type' => 'textarea_html',
      			'heading' => esc_html__( 'Content', 'designthemes-core' ),
      			'param_name' => 'content',
      			'value' => '<p>Laasd pamade eleifend la sapien. Vestibulum purus quam.</p>'
      		),
		 
		)
	) );
}?>