<?php add_action( 'vc_before_init', 'dt_sc_menu_events_list_vc_map' );
function dt_sc_menu_events_list_vc_map() {
	vc_map( array(
		"name" => esc_html__( "Menu Events List", 'designthemes-core' ),
		"base" => "dt_sc_menu_events_list",
		"icon" => "dt_sc_menu_events_list",
		"category" => DT_VC_CATEGORY .' ( '.esc_html__('Events','designthemes-core').')',
		"params" => array(


			// Limit
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Limit', 'designthemes-core' ),
				'param_name' => 'limit',
				'description' => esc_html__( 'Enter limit', 'designthemes-core' )
			),
		)
	) );
}?>