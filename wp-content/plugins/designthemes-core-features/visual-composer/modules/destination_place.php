<?php add_action( 'vc_before_init', 'dt_destination_place_vc_map' );
function dt_destination_place_vc_map() {
	vc_map( array(
		"name" => esc_html__( "Destination Place", 'designthemes-core' ),
		"base" => "dt_destination_place",
		"icon" => "dt_destination_place",
		"category" => DT_VC_CATEGORY,
		"params" => array(

			// Categories
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Places id', 'designthemes-core' ),
				'param_name' => 'place_id',
				'description' => esc_html__( 'Enter Places id value', 'designthemes-core' )
			),
				
		)
	) );
}?>