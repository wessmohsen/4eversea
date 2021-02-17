<?php 
add_action( 'vc_before_init', 'dt_login_logout_links_vc_map' );

function dt_login_logout_links_vc_map() {
	vc_map( array(
		"name" => esc_html__( 'Login / Logout Links', 'designthemes-core' ),
		"base" => "dt_login_logout_links",
		"icon" => "dt_login_logout_links",
		"category" => DT_VC_CATEGORY,
		"params" => array(

			// Show Registration Link
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Show Registration Link','designthemes-core'),
				'param_name' => 'show_registration',
				'value' => array(
					esc_html__('False', 'designthemes-core') => 'false',
					esc_html__('True', 'designthemes-core') => 'true',
				),
				'description' => esc_html__( 'If you wish you can enable regsitration link here.', 'designthemes-core' ),
				'std' => 'true'				
			),

			// Class
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Class', 'designthemes-core' ),
				'param_name' => 'class',
				'description' => esc_html__( 'If you wish you can add additional class name here.', 'designthemes-core' ),
				'admin_label' => true
			),

		)
	) );
}
?>