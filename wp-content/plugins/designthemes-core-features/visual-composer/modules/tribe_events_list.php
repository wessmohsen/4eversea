<?php add_action( 'vc_before_init', 'dt_sc_events_list_vc_map' );
function dt_sc_events_list_vc_map() {
	vc_map( array(
		"name" => esc_html__( "Events List", 'designthemes-core' ),
		"base" => "dt_sc_events_list",
		"icon" => "dt_sc_events_list",
		"category" => DT_VC_CATEGORY .' ( '.esc_html__('Events','designthemes-core').')',
		"params" => array(


			// Limit
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Limit', 'designthemes-core' ),
				'param_name' => 'limit',
				'description' => esc_html__( 'Enter limit', 'designthemes-core' )
			),
			
			// Excerpt Length
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Excerpt Length', 'designthemes-core' ),
				'param_name' => 'excerpt_length',
				'description' => esc_html__( 'Enter excerpt length', 'designthemes-core' )
			),
			
			// Post column
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Columns','designthemes-core'),
				'param_name' => 'post_column',
				'value' => array(
					esc_html__('II Columns','designthemes-core') => 'one-half-column' ,
					esc_html__('III Columns','designthemes-core') => 'one-third-column',
					esc_html__('IV Columns','designthemes-core') => 'one-fourth-column',
				),
				'std' => 'one-third-column'
			),
		)
	) );
}?>