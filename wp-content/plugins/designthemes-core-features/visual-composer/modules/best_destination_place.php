<?php add_action( 'vc_before_init', 'dt_best_destination_place_vc_map' );
function dt_best_destination_place_vc_map() {
	vc_map( array(
		"name" => esc_html__( "Best Destination Place", 'designthemes-core' ),
		"base" => "dt_best_destination_place",
		"icon" => "dt_best_destination_place",
		"category" => DT_VC_CATEGORY,
		"params" => array(

			// Categories
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Places id', 'designthemes-core' ),
				'param_name' => 'place_ids',
				'description' => esc_html__( 'Enter Places id value', 'designthemes-core' )
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
		)
	) );
}?>