<?php add_action( 'vc_before_init', 'dt_sc_icon_box_colored_vc_map' );
function dt_sc_icon_box_colored_vc_map() {

	global $variations;

	vc_map( array(
            "name"     => esc_html__( "Colored Box", 'designthemes-core' ),
            "base"     => "dt_sc_icon_box_colored",
            "icon"     => "dt_sc_icon_box_colored",
            "category" => DT_VC_CATEGORY,
            "params"   => array(
			
			
			# Type
			array(
				'type' => 'dropdown',
				'param_name' => 'type',
				'value' => array(
					esc_html__(' Type 1','designthemes-core') => 'type1',
					esc_html__(' Type 2','designthemes-core') => 'type2',
				),
				'heading' => esc_html__( 'Type', 'designthemes-core' ),
				'description' => esc_html__( 'Select Callout type', 'designthemes-core' ),
			),
			
			# Type
			array(
				'type' => 'dropdown',
				'param_name' => 'icon_type',
				'value' => array(
					esc_html__('Font Awesome','designthemes-core') => 'fontawesome',
					esc_html__('Custom Icon','designthemes-core') => 'custom_icon',
				),
				'heading' => esc_html__( 'Type', 'designthemes-core' ),
				'description' => esc_html__( 'Select Callout type', 'designthemes-core' ),
			),
			
			// Font Awesome
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Font Awesome', 'designthemes-core' ),
				'param_name' => 'fontawesome_icon',
				'settings' => array( 'emptyIcon' => false, 'iconsPerPage' => 4000 ),
				'dependency' => array( 'element' => 'icon_type', 'value' => 'fontawesome' ),
				'description' => esc_html__( 'Select icon from library', 'designthemes-core' ),
			),
			
			# Custom Icon
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Image', 'designthemes-core' ),
				'param_name' => 'custom_icon',
				'dependency' => array( 'element' => 'icon_type', 'value' => 'custom_icon' ),
				'description' => esc_html__( 'Select image from media library', 'designthemes-core' ),
			),
			
			// BG Color			
			array(
				"type" => "colorpicker",
      			"heading" => esc_html__( "Custom Background color", 'designthemes-core' ),
      			"param_name" => "bgcolor",
      			"description" => esc_html__( "Select button background color", 'designthemes-core' ),
      		), 
			
			// Title
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title', 'designthemes-core' ),
				'param_name' => 'title',
			),
			
			// Button Link
			array(
				'type' => 'vc_link',
				'heading' => esc_html__( 'URL (Link)', 'designthemes-core' ),
				'param_name' => 'link',
				'description' => esc_html__( 'Add link to button', 'designthemes-core' ),
			),
			
			// Button Text
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Button Text', 'designthemes-core' ),
				'param_name' => 'button_text',
				'value' => esc_html__( 'Text on the button', 'designthemes-core' ),
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