<?php add_action( 'vc_before_init', 'dt_sc_callout_box_vc_map' );
function dt_sc_callout_box_vc_map() {

	global $variations;

	vc_map( array(
            "name"     => esc_html__( "Call Out Box", 'designthemes-core' ),
            "base"     => "dt_sc_callout_box",
            "icon"     => "dt_sc_callout_box",
            "category" => DT_VC_CATEGORY,
            "params"   => array(
			
			
			# Type
			array(
				'type' => 'dropdown',
				'param_name' => 'type',
				'value' => array(
					esc_html__(' Type 1','designthemes-core') => 'type1',
					esc_html__(' Type 2','designthemes-core') => 'type2',
					esc_html__(' Type 3','designthemes-core') => 'type3',
					esc_html__(' Type 4','designthemes-core') => 'type4',
					esc_html__(' Type 5','designthemes-core') => 'type5',
				),
				'heading' => esc_html__( 'Type', 'designthemes-core' ),
				'description' => esc_html__( 'Select Callout type', 'designthemes-core' ),
			),
			
			# Title
      		array(
                        "type"       => "textfield",
                        "heading"    => esc_html__( "Title", 'designthemes-core' ),
                        "param_name" => "title"
      		),

      		# Sub Title
      		array(
                        "type"       => "textfield",
                        "heading"    => esc_html__( "Sub Title", 'designthemes-core' ),
                        "param_name" => "description",
      		),
			
			// Button Link
			array(
				'type' => 'vc_link',
				'heading' => esc_html__( 'URL (Link)', 'designthemes-core' ),
				'param_name' => 'link',
				'description' => esc_html__( 'Add link to button', 'designthemes-core' ),
				'dependency' => array( 'element' => 'type', 'value_not_equal_to' => 'type1' )
			),
			
			// Button Text
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Button Text', 'designthemes-core' ),
				'param_name' => 'button_text',
				'value' => esc_html__( 'Text on the button', 'designthemes-core' ),
				'dependency' => array( 'element' => 'type', 'value_not_equal_to' => 'type1')
			),
		  
		  # Font Awesome
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Font Awesome', 'designthemes-core' ),
				'param_name' => 'icon',
				'value' => 'fa fa-info-circle',
				'settings' => array( 'emptyIcon' => false, 'iconsPerPage' => 4000 ),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'fontawesome',
				),
				'description' => esc_html__( 'Select icon from library', 'designthemes-core' ),
			),
		  
		)
	) );
}?>