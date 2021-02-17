<?php add_action( 'vc_before_init', 'dt_latest_hotel_reviews_vc_map' );
function dt_latest_hotel_reviews_vc_map() {

	global $variations;

	vc_map( array(
            "name"     => esc_html__( "Latest Hotel Reviews", 'designthemes-core' ),
            "base"     => "dt_latest_hotel_reviews",
            "icon"     => "dt_latest_hotel_reviews",
            "category" => DT_VC_CATEGORY,
            "params"   => array(

			# Limit
      		array(
                        "type"       => "textfield",
                        "heading"    => esc_html__( "Limit", 'designthemes-core' ),
                        "param_name" => "limit"
      		),
      	
		)
	) );
}?>