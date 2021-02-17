<?php
if (! class_exists ( 'DTWidgetFlickr' ) ) {
    
    class DTWidgetFlickr extends DTBaseSC {

        function __construct() {

            add_shortcode( 'dt_sc_flickr_widget', array( $this, 'dt_sc_flickr_widget' ) );
        }

        function dt_sc_flickr_widget ( $attrs, $content = null ) {

            extract ( shortcode_atts ( array (
                'el_id' => '',
                'title' => '',
                'flickr_id' => '',
                'count' => '',
                'show' => '',
                'size' => ''
            ), $attrs ) );

            if($el_id != '') {
                $el_id = 'dt-'.$el_id;
            }

            ob_start();
            echo '<div id="'.esc_attr( $el_id ).'" class="dt-flickr-widget-wrapper">';

            	global $wp_widget_factory;
            	$args = array();
            	$type = 'TrendyTravel_Flickr';
            	if ( is_object( $wp_widget_factory ) && isset( $wp_widget_factory->widgets, $wp_widget_factory->widgets[ $type ] ) ) {
            		the_widget( $type,  $attrs, $args );
            	}
            echo '</div>';
            $output = ob_get_clean();
            return $output;

        }      
    }
}

new DTWidgetFlickr();                        