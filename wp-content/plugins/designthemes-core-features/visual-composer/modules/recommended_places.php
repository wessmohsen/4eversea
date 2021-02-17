<?php add_action( 'vc_before_init', 'dt_recommend_places_vc_map' );
function dt_recommend_places_vc_map() {
	vc_map( array(
		"name" => esc_html__( "Recommended Places", 'designthemes-core' ),
		"base" => "dt_recommend_places",
		"icon" => "dt_recommend_places",
		"category" => DT_VC_CATEGORY,
		"params" => array(

			// Categories
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Limit', 'designthemes-core' ),
				'param_name' => 'limit',
				'description' => esc_html__( 'Enter Places id value', 'designthemes-core' )
			),
				
			// Post column
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Columns','designthemes-core'),
				'param_name' => 'posts_column',
				'value' => array(
					esc_html__('II Columns','designthemes-core') => 'one-half-column' ,
					esc_html__('III Columns','designthemes-core') => 'one-third-column',
					esc_html__('IV Columns','designthemes-core') => 'one-fourth-column',
				),
				'std' => 'one-fourth'
			),	
		)
	) );
}?>