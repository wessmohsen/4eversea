<?php add_action( 'vc_before_init', 'dt_hotel_room_vc_map' );
function dt_hotel_room_vc_map() {

	global $variations;

	vc_map( array(
            "name"     => esc_html__( "Hotel Room", 'designthemes-core' ),
            "base"     => "dt_hotel_room",
            "icon"     => "dt_hotel_room",
            "category" => DT_VC_CATEGORY,
            "params"   => array(

			# Persons
      		array(
                        "type"       => "textfield",
                        "heading"    => esc_html__( "Room Type", 'designthemes-core' ),
                        "param_name" => "room_type"
      		),

      		# Persons
      		array(
                        "type"       => "textfield",
                        "heading"    => esc_html__( "Persons", 'designthemes-core' ),
                        "param_name" => "persons"
      		),

      		# Facilities
      		array(
                        "type"       => "textfield",
                        "heading"    => esc_html__( "Facilities", 'designthemes-core' ),
                        "param_name" => "facilities",
      		),
			
			# Price
      		array(
                        "type"       => "textfield",
                        "heading"    => esc_html__( "Price", 'designthemes-core' ),
                        "param_name" => "price"
      		),
			
			# Available
      		array(
                        "type"       => "textfield",
                        "heading"    => esc_html__( "Available", 'designthemes-core' ),
                        "param_name" => "available"
      		),
		)
	) );
}?>