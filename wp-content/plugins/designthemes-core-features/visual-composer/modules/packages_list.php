<?php add_action( 'vc_before_init', 'dt_packages_list_vc_map' );
function dt_packages_list_vc_map() {
	vc_map( array(
		"name" => esc_html__( "Packages List", 'designthemes-core' ),
		"base" => "dt_packages_list",
		"icon" => "dt_packages_list",
		"category" => DT_VC_CATEGORY,
		"params" => array(


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
			
			// Categories
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Product Category slug', 'designthemes-core' ),
				'param_name' => 'categories',
				'description' => esc_html__( 'Enter Product Category Slug value', 'designthemes-core' )
			),
			
			
		)
	) );
}?>