<?php add_action( 'vc_before_init', 'dt_tour_packages_list_vc_map' );
function dt_tour_packages_list_vc_map() {
	vc_map( array(
		"name" => esc_html__( "Tour Packages List", 'designthemes-core' ),
		"base" => "dt_tourpackage_list",
		"icon" => "dt_tourpackage_list",
		"category" => DT_VC_CATEGORY,
		"params" => array(


	 		// Limit
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Limit', 'designthemes-core' ),
				'param_name' => 'limit',
				'description' => esc_html__( 'Enter limit', 'designthemes-core' )
			),
			
			# Type
			array(
				'type' => 'dropdown',
				'param_name' => 'carousel',
				'value' => array(
					esc_html__(' True','designthemes-core') => 'true',
					esc_html__(' False','designthemes-core') => 'false'
				),
				'heading' => esc_html__( 'Carousel', 'designthemes-core' ),
				'description' => esc_html__( 'Enable/Disable Carousel', 'designthemes-core' ),
			),
			
			// Limit
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Excerpt Length', 'designthemes-core' ),
				'param_name' => 'excerpt_length',
				'description' => esc_html__( 'Enter Excerpt Length', 'designthemes-core' )
			),
					
		)
	) );
}?>