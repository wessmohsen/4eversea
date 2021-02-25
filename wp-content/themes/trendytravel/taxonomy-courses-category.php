<?php
get_header();
$taxonomy = get_queried_object();
$post_type = get_post_type( $post->ID );
$post_type_obj=get_post_type_object($post_type);
?>
	<header id="header">
		<div class="container">
			<?php do_action( 'trendytravel_header' ); ?>
	    </div>
		<section class="content-full-width" id="primary">
			<?php
			$cover_image = get_field('category_cover_photo',$taxonomy);
			if( isset($cover_image) ){
			$cover_size = 'wm-header-size';
		    $cover_thumb = $cover_image['sizes'][ $cover_size ];
		    echo '<img loading="lazy" class="size-full" src="' .esc_url($cover_thumb) .'" alt="Top-Banner" >' ;
			} 
			else{ ?>
            <img loading="lazy" class="size-full" src="http://new4eversea.test/wp-content/uploads/2021/01/header_001.jpg" alt="Top-Banner" >
        	<?php } ?>
		</section>
		<div class="cpt_header_title">
			<div class="container the_hd_title"><?php echo  $taxonomy->name; ?></div>
		</div>	
	</header><!-- **Header - End ** -->
	

		
	<div id="main">
        <div class="container">
	
		<?php
		$args = array(
			'post_type' => $post_type,
			'post_status' => 'publish',
			'posts_per_page' => '10',
			'tax_query' => array(
				array(
					'taxonomy' => $taxonomy->taxonomy,
					'field' => 'slug',
					'terms' => array( $taxonomy->slug )
					 )
			)
		  );

		  $trips_loop = new WP_Query( $args );

		    //If Trips is Safari
            if ( $trips_loop->have_posts() && $taxonomy->slug == 'safari') : ?>
                      <div class="div-table">
                         <div class="div-table-head">March 2021</div>
                         <div class="div-table-row head-fixed-row">
                            <div class="div-table-col" align="center">Dates</div>
                            <div  class="div-table-col">Boat</div>
                            <div  class="div-table-col">Route</div>
                            <div  class="div-table-col">Start / End</div>
                            <div  class="div-table-col">Available</div>
                            <div  class="div-table-col">Price</div>
                            <div  class="div-table-col">Status</div>
                            <div  class="div-table-col"></div>
                         </div>
                <?php
                while ( $trips_loop->have_posts() ) : $trips_loop->the_post();
                    // Set variables
                    $title = get_the_title();
                    $post_url = get_permalink( $post->ID );
                    ?>


            <div class="div-table-row">
                <div class="div-table-col" align="center">4 Mar - 14 Mar</div>
                <div  class="div-table-col">One Dive</div>
                <div  class="div-table-col"><a href="<?php echo $post_url; ?>"><?php echo $title; ?></a></div>
                <div  class="div-table-col">HRG - HRG</div>
                <div  class="div-table-col">24</div>
                <div  class="div-table-col"><?php the_field('currency', 'option'); echo' '; the_field('price');  ?></div>
                <div  class="div-table-col">Confirmed</div>
                <div  class="div-table-col booking-col"><button><a href="#pop_booking_form" rel="modal:open" ><?php  _e('Book Now', 'trendytravel'); ?></a></button></div>
            </div>



                    <!--  End Booking Form -->
                    <div id="pop_booking_form" class="modal">
                        <div class="pop_booking_head">Booking Request</div>
                        <div class="pop_booking_body">
                            <div class="wpb_column vc_column_container vc_col-sm-8">
                                <h3>Booking Trip: <strong><?php the_title(); ?></strong></h3>
                            </div>
                            <div class="wpb_column vc_column_container vc_col-sm-4 alignright">
                                <h3>Price: <strong><?php the_field('currency', 'option'); echo ' '; the_field('price'); ?></strong></h3>
                            </div>
                            <div class="wpb_column vc_column_container vc_col-sm-12 pop_short_desc">
                                <?php
                                $the_desc = get_field('short_desc');
                                echo mb_strimwidth($the_desc, 0, 190, "...");
                                ?>
                            </div>

                            <?php if($exited_incl_exc == 1){ ?>
                                <div class="pop_booking_section">
                                    <div class="wpb_column vc_column_container vc_col-sm-6">
                                        <?php
                                        $repeaters = $group['include_list'];
                                        echo '<h4>' . __( 'Price Include :', 'trendytravel' ) . '</h4>';
                                        foreach($repeaters as $repeater) {
                                            $sub_value = $repeater["include_item"];
                                            echo '<div class="include_list"><span class="list_item fas fa-check"></span><span>' .$sub_value .'</span></div>';
                                            // Do something...
                                        }
                                        ?>
                                    </div>
                                    <div class="wpb_column vc_column_container vc_col-sm-6">
                                        <?php
                                        $repeaters = $group['exclude_list'];
                                        echo '<h4>' . __( 'Price Not Include :', 'trendytravel' ) . '</h4>';
                                        foreach($repeaters as $repeater) {
                                            $sub_value = $repeater["exclude_item"];
                                            echo '<div class="exclude_list"><span class="list_item fas fa-times"></span><span>' .$sub_value .'</span></div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="popup_grv_form vc_col-sm-12">
                                <?php gravity_form( 1, false, false, true, '', true ); ?>
                            </div>
                        </div>
                    </div>



                <?php

                endwhile;
                wp_reset_postdata(); ?>
                      </div>
            <?php
            endif;



        //If Trips is Not Safari
		  if ( $trips_loop->have_posts() && $taxonomy->slug != 'safari') :
			while ( $trips_loop->have_posts() ) : $trips_loop->the_post();
			  // Set variables
			  $title = get_the_title();
			  $post_url = get_permalink( $post->ID );
			  ?>
	  



		  
                <div class="trip-block">

                    <div class="column dt-sc-one-column with-sidebar batchelor-sort business-sort all-sort">
                        <div class="hotel-item hotel-list-view">
                            <div class="hotel-thumb">
                                <div class="thumb-wrapper">
                                    <!--
                                    <p class="hotel-offer"><span>Special Offer</span></p>
                                    -->
                                    <a href="<?php echo $post_url; ?>" title="<?php echo $title; ?>"><img src="<?php echo the_post_thumbnail_url('trip-thumb')  ?>" class="attachment-hotel-thumb-sidebar size-hotel-thumb-sidebar wp-post-image" alt="" loading="lazy" title="<?php echo $title; ?>" srcset="" sizes="(max-width: 420px) 100vw, 420px" width="420" height="338">
                                    <div class="image-overlay">
                                        <span class="image-overlay-inside"></span>
                                    </div>
                                    </a>
                                </div>

                            </div>
                            <div class="hotel-details">
                                <h2><a href="<?php echo $post_url; ?>"><?php echo $title; ?></a></h2>
                                <div class="justify-content-between">

                                    <div class="wpb_column vc_column_container vc_col-sm-7">

                                        <p class="hotel-type">
                                            <a href="<?php echo home_url( '/' .$post_type ); ?>" rel="tag"><?php echo $post_type_obj->labels->singular_name; ?></a>

                                            <a href="<?php get_term_link($taxonomy->slug , $taxonomy->taxonomy); ?>" rel="tag"><?php echo  $taxonomy->name; ?></a>

                                        </p>
                                        <?php
                                        $the_desc = get_field('short_desc');
                                        echo mb_strimwidth($the_desc, 0, 225, "...");
                                        ?>

                                    </div>

                                    <?php
                                    $repeaters = get_field('trip_highlights');
                                    if($repeaters){ ?>

                                    <div class="wpb_column vc_column_container vc_col-sm-5 highlights_col">
                                        <h3>Highlights</h3>
                                        <?php
                                        $repeaters = get_field('trip_highlights');
                                        foreach(array_slice($repeaters, 0, 5) as $repeater ){
                                            $sub_value = mb_strimwidth($repeater["item"], 0, 21, "...");
                                            echo '<div class="include_list"><span class="list_item fas fa-arrow-circle-right"></span><span>' .$sub_value .'</span></div>';
                                        }
                                        ?>
                                    </div>
                                    <?php } ?>
                                    <div class="wpb_column vc_column_container vc_col-sm-12">
                                        <a href="#pop_booking_form" rel="modal:open" class="dt-sc-button theme-btn too-small"><?php  _e('Book Now', 'trendytravel'); ?></a>
                                        <a href="<?php echo $post_url; ?>" class="dt-sc-button too-small blue"><?php  _e('View Details', 'trendytravel'); ?></a>
                                    </div>

                                </div>

                                <div class="hotel-thumb-meta">
                                    <div class="hotel-price"><?php  _e('Price', 'trendytravel'); ?><span><?php the_field('currency', 'option'); echo' '; the_field('price');  ?></span></div>
                                    <span class="hotel-option-type">
                                        <a href="#pop_booking_form" rel="modal:open" ><?php  _e('Book Now', 'trendytravel'); ?></a>
                                    </span>
                                </div>
                            </div>

                        </div>


                        <!--  End Booking Form -->
                        <div id="pop_booking_form" class="modal">
                            <div class="pop_booking_head">Booking Request</div>
                            <div class="pop_booking_body">
                                <div class="wpb_column vc_column_container vc_col-sm-8">
                                    <h3>Booking Trip: <strong><?php the_title(); ?></strong></h3>
                                </div>
                                <div class="wpb_column vc_column_container vc_col-sm-4 alignright">
                                    <h3>Price: <strong><?php the_field('currency', 'option'); echo ' '; the_field('price'); ?></strong></h3>
                                </div>
                                <div class="wpb_column vc_column_container vc_col-sm-12 pop_short_desc">
                                    <?php
                                    $the_desc = get_field('short_desc');
                                    echo mb_strimwidth($the_desc, 0, 190, "...");
                                    ?>
                                </div>

                                <?php if($exited_incl_exc == 1){ ?>
                                    <div class="pop_booking_section">
                                        <div class="wpb_column vc_column_container vc_col-sm-6">
                                            <?php
                                            $repeaters = $group['include_list'];
                                            echo '<h4>' . __( 'Price Include :', 'trendytravel' ) . '</h4>';
                                            foreach($repeaters as $repeater) {
                                                $sub_value = $repeater["include_item"];
                                                echo '<div class="include_list"><span class="list_item fas fa-check"></span><span>' .$sub_value .'</span></div>';
                                                // Do something...
                                            }
                                            ?>
                                        </div>
                                        <div class="wpb_column vc_column_container vc_col-sm-6">
                                            <?php
                                            $repeaters = $group['exclude_list'];
                                            echo '<h4>' . __( 'Price Not Include :', 'trendytravel' ) . '</h4>';
                                            foreach($repeaters as $repeater) {
                                                $sub_value = $repeater["exclude_item"];
                                                echo '<div class="exclude_list"><span class="list_item fas fa-times"></span><span>' .$sub_value .'</span></div>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="popup_grv_form vc_col-sm-12">
                                    <?php gravity_form( 1, false, false, true, '', true ); ?>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
		  
		  <!--  End Booking Form -->

		  	  <?php
			  endwhile;
			  wp_reset_postdata();
			  endif;

			  ?>
		  
        </div>
    </div>

<?php get_footer(); ?>