<?php
/*
	Template Name: Schedule
*/
get_header();
$post_type = 'schedules';
$post_type_obj=get_post_type_object($post_type);
?>
    <header id="header">
        <div class="container">
            <?php do_action( 'trendytravel_header' ); ?>
        </div>
        <section class="content-full-width" id="primary">
            <?php
            //$cover_image = get_field('category_cover_photo',$taxonomy);
            if( isset($cover_image) ){
                $cover_size = 'wm-header-size';
                $cover_thumb = $cover_image['sizes'][ $cover_size ];
                echo '<img loading="lazy" class="size-full" src="' .esc_url($cover_thumb) .'" alt="Top-Banner" >' ;
            }
            else{ ?>
                <img class="size-full" src="/wp-content/uploads/2021/01/header_001.jpg" alt="Top-Banner" >
            <?php } ?>
        </section>
        <div class="cpt_header_title">
            <div class="container the_hd_title">Schedule</div>
        </div>


        <style>
            button{
                float:none;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            /* Zebra striping */
            tr:nth-of-type(odd) {
                background: #f7f7f7;
            }
            th {
                background: #333;
                color: white;
            }
            td, th {
                padding: 6px;
                border: 0px solid #ccc;
                text-align: center;
            }
            /*
Max width before this PARTICULAR table gets nasty
This query will take effect for any screen smaller than 760px
and also iPads specifically.
*/
            @media
            only screen and (max-width: 760px),
            (min-device-width: 768px) and (max-device-width: 1024px)  {

                /* Force table to not be like tables anymore */
                table, thead, tbody, th, td, tr {
                    display: block;
                }

                .div-table-head{
                    display: block;
                }

                /* Hide table headers (but not display: none;, for accessibility) */
                thead tr {
                    position: absolute;
                    top: -9999px;
                    left: -9999px;
                }

                tr { border: 1px solid #ccc; }

                td {
                    /* Behave  like a "row" */
                    border: none;
                    border-bottom: 1px solid #eee;
                    position: relative;
                    padding-left: 50%;
                }


                td:before {
                    /* Now like a table header */
                    position: absolute;
                    /* Top/left values mimic padding */
                    top: 6px;
                    left: 6px;
                    width: 45%;
                    padding-right: 10px;
                    white-space: nowrap;
                }

                /*
                Label the data
                */
                td:nth-of-type(1):before { content: "Dates"; }
                td:nth-of-type(2):before { content: "Boat"; }
                td:nth-of-type(3):before { content: "Route"; }
                td:nth-of-type(4):before { content: "Start / End"; }
                td:nth-of-type(5):before { content: "Available"; }
                td:nth-of-type(6):before { content: "Price"; }
                td:nth-of-type(7):before { content: "Status"; }
                td:nth-of-type(8):before { content: "Book now"; }
            }
        </style>
    </header><!-- **Header - End ** -->


<!-- **Main** -->
<div id="main">

    <!-- ** Container ** -->
    <div class="container">

        <?php
        $args2 = array(
            'post_type' => $post_type,
            'post_status' => 'publish',
            'posts_per_page' => '1',
            'meta_key'			=> 'sch_start_date',
            'orderby'			=> 'meta_value',
            'order'				=> 'ASC'
        );

        $schedules_loop2 = new WP_Query( $args2 );
        while ( $schedules_loop2->have_posts() ) : $schedules_loop2->the_post();
            $the_first_start_date = get_field('sch_start_date');
            //echo $the_first_start_date;
        endwhile;


        $args3 = array(
            'post_type' => $post_type,
            'post_status' => 'publish',
            'posts_per_page' => '1',
            'meta_key'			=> 'sch_start_date',
            'orderby'			=> 'meta_value',
            'order'				=> 'DESC'
        );

        $schedules_loop3 = new WP_Query( $args3 );

        while ( $schedules_loop3->have_posts() ) : $schedules_loop3->the_post();
            $the_last_start_date = get_field('sch_start_date');
            //echo $the_last_start_date;
        endwhile;



        $args = array(
            'post_type' => $post_type,
            'post_status' => 'publish',
            'posts_per_page' => '99',
            'meta_key'			=> 'sch_start_date',
            'orderby'			=> 'meta_value',
            'order'				=> 'ASC'
        );

        $schedules_loop = new WP_Query( $args );


        $wm_start    = (new DateTime($the_first_start_date))->modify('first day of this month');
        $wm_end      = (new DateTime($the_last_start_date))->modify('first day of next month');
        $wm_interval = DateInterval::createFromDateString('1 month');
        $wm_period   = new DatePeriod($wm_start, $wm_interval, $wm_end);
        //foreach ($wm_period as $wm_dt) {



        $prepare_last_date = new DateTime($the_last_start_date);
        $prepare_last_date->modify('last day of this month');
        $the_last_date_month =  $prepare_last_date->format('d M Y');


            //$month_first_date = $wm_dt->format("d M Y");
            //if ($month_first_date == $the_first_start_date) {

                //If Trips is Safari
                $i = 0;
                if ($schedules_loop->have_posts()) :


                    //echo "<br><br>";

                    $top_start_date= date("M Y" ,strtotime($the_first_start_date));
                    ?>



            <div class="sch_table">
                <div class="div-table-head"><?php echo  'All Schedules'; ?></div>
                <table>
                    <thead>
                    <tr>
                        <th>Dates</th>
                        <th>Boat</th>
                        <th>Route</th>
                        <th>Start / End</th>
                        <th>Available</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>

                        <?php
                        while ($schedules_loop->have_posts()) : $schedules_loop->the_post();
                            // Set variables
                            $title = get_the_title();
                            $post_url = get_permalink($post->ID);
                            $boat_obj = get_field('sch_boat');
                            if ($boat_obj) {
                                $the_boat = esc_html($boat_obj->post_title);
                                $boat_link = get_permalink($boat_obj->ID);
                            }
                            $rout_obj = get_field('sch_route');
                            if ($rout_obj) {
                                $the_route = esc_html($rout_obj->post_title);
                                $route_link = get_permalink($rout_obj->ID);
                            }
                            $the_start_date = get_field('sch_start_date');
                            $start_date = date("d M", strtotime($the_start_date));
                            $the_end_date = get_field('sch_end_date');
                            $end_date = date("d M", strtotime($the_end_date));

                            ?>

                    <tr>
                        <td><?php echo $start_date .' - ' .$end_date; ?></td>
                        <td><a href="<?php echo $boat_link; ?>"><?php echo $the_boat; ?></a></td>
                        <td><a href="<?php echo $route_link; ?>"><?php echo $the_route; ?></a></td>
                        <td><?php the_field('sch_start_port'); ?> - <?php the_field('sch_end_port'); ?></td>
                        <td><?php the_field('sch_guests_num'); ?></td>
                        <td><?php the_field('currency', 'option');
                            echo ' ';
                            the_field('sch_price'); ?></td>
                        <td><?php the_field('sch_status'); ?></td>
                        <td ><button><a href="#pop_booking_form_<?php echo $i; ?>" rel="modal:open"><?php _e('Book Now', 'trendytravel'); ?></a></button></td>


                    </tr>




                            <!--  End Booking Form -->
                            <div id="pop_booking_form_<?php echo $i; ?>" class="modal sch_pop">
                                <div class="pop_booking_head">Booking Request</div>
                                <div class="pop_booking_body">
                                    <div class="wpb_column vc_column_container vc_col-sm-8">
                                        <?php
                                        $trip_start = get_field('sch_start_date');
                                        $trip_end = get_field('sch_end_date');
                                        $trip_title = $trip_start . ' - ' . $trip_end; ?>
                                        <h3>Booking Trip: <strong><?php echo $trip_title; ?></strong></h3>
                                    </div>
                                    <div class="wpb_column vc_column_container vc_col-sm-4 alignright">
                                        <h3>Price: <strong><?php the_field('currency', 'option');
                                                echo ' ';
                                                the_field('sch_price'); ?></strong></h3>
                                    </div>
                                    <div class="wpb_column vc_column_container vc_col-sm-12 pop_short_desc">
                                        <?php

                                        //echo mb_strimwidth($the_desc, 0, 190, "...");
                                        ?>
                                    </div>

                                    <div class="popup_grv_form vc_col-sm-12">
                                        <?php gravity_form(1, false, false, true, '', true); ?>
                                    </div>
                                </div>
                            </div>


                        <?php
                        $i++;
                        endwhile;
                        wp_reset_postdata(); ?>
                    </tbody>
                </table>
                <?php
                endif;





        ?>
    </div>
    <!-- ** Container End ** -->
    
</div><!-- **Main - End ** -->    
<?php get_footer(); ?>