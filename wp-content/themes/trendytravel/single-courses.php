<?php
get_header();
$page_id = $post->ID;
$settings = get_post_meta($page_id,'_tpl_default_settings',TRUE);
$post_type = get_post_type( $page_id );
?>
    <!-- ** Header Wrapper ** -->
    <div id="header-wrapper" class="<?php echo esc_attr($header_class); ?>">

        <!-- **Header** -->
        <header id="header">

            <div class="container">
                <?php do_action( 'trendytravel_header' ); ?>
            </div>

            <div class="slider_bottom_title cpt_header_title">
                <?php
                $terms = get_the_terms( $post->ID , 'courses-category' );
                if ( is_array( $terms ) && ! is_wp_error( $terms ) ) {
                    foreach ($terms as $term) {}
                }
                $term_link = home_url( '/' ) .$post_type .'/' .$term->slug;
                ?>
                <div class="container hd_title_no_slider">
                    <a href="<?php echo $term_link; ?>" ><?php echo $term->name; ?></a> / <?php the_title(); ?>
                </div>
            </div>
        </header><!-- **Header - End ** -->
    </div>

<?php if (have_posts()) : while (have_posts()) : the_post();?>
    <div id="main" style="padding-bottom:0px;">
        <div class="container">
            <!-- Place somewhere in the <body> of your page -->
    <div class="vc_row wpb_row vc_row-fluid">
    <div class="vc_col-sm-12">
        <div class="wpb_column  vc_col-sm-7">
                <div class="course_info_top vc_column_container vc_col-sm-12">

                    <?php if (get_field('course_duration')){ ?>
                    <div class="course_info_block vc_column_container wpb_column vc_col-sm-6">
                        <div class="inf_ico">
                            <img src="<?php echo $home_url; ?>/test/icons/duration_dark.png">
                        </div>
                        <div class="inf_data">
                            <span class="inf_title"><?php  _e('<strong>Duration: </strong>', 'trendytravel'); the_field('course_duration'); ?> </span>
                        </div>
                    </div>
                    <?php } ?>



                    <?php if (get_field('course_equipment')){ ?>
                    <div class="course_info_block vc_column_container wpb_column vc_col-sm-6">
                        <div class="inf_ico">
                            <img src="<?php echo $home_url; ?>/test/icons/mask.png">
                        </div>
                        <div class="inf_data">
                            <span class="inf_title"><?php  _e('<strong>Equipment: </strong>', 'trendytravel'); the_field('course_equipment'); ?></span>
                        </div>
                    </div>
                    <?php } ?>
                </div>



            <?php
            _e('<h2>Over View</h2>', 'trendytravel');
            the_content();
            ?>
            <div class="empty_spc_20"></div>
            <?php
            _e('<h2>Requirements</h2>', 'trendytravel');
            the_field('course_requirements');
            ?>
            <div class="empty_spc_20"></div>
            <h2>
            <?php
            _e('Price: ', 'trendytravel');
            the_field('currency', 'option');
            the_field('course_price');
            ?>
            </h2>

            </div>

            <div class="wpb_column vc_column_container vc_col-sm-5">

                <?php
                $images = get_field('course_slider');
                //$size = 'wm-slider-size'; // (thumbnail, medium, large, full or custom size)
                if( $images ): ?>
                    <div id="owl-demo" class="owl-carousel owl-theme wm_slider_trips">
                        <?php foreach( $images as $image ): ?>
                            <div loading="lazy" class="item">
                                <img src="<?php echo esc_url($image['sizes']['medium-slider']); ?>" alt="" />
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif;
                $repeaters = get_field('course_highlights');
                if($repeaters){ ?>

                    <div class="wpb_column vc_column_container highlights_col empty_spc_20">
                        <h3>Highlights</h3>
                        <?php
                        $repeaters = get_field('course_highlights');
                        foreach(array_slice($repeaters, 0, 5) as $repeater ){
                            $sub_value = mb_strimwidth($repeater["item"], 0, 150, "...");
                            echo '<div class="include_list"><span class="list_item fas fa-arrow-circle-right"></span><span>' .$sub_value .'</span></div>';
                        }
                        ?>
                    </div>
                <?php } ?>

            </div>
    </div>
    </div>
        </div>

        <div class="inc_exc_section">
            <div class="container">
                <div class="vc_row wpb_row vc_row-fluid">
                    <?php
                    $group = get_field('include_exclude');
                    if($group['include_list']){
                        $exited_incl_exc = 1 ;
                        ?>
                        <div class="vc_col-sm-12">
                        <div class="wpb_column vc_column_container vc_col-sm-6">
                            <?php
                            $repeaters = $group['include_list'];
                            echo '<h3>' . __( 'Price Include :', 'trendytravel' ) . '</h3>';
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
                            echo '<h3>' . __( 'Price Not Include :', 'trendytravel' ) . '</h3>';
                            foreach($repeaters as $repeater) {
                                $sub_value = $repeater["exclude_item"];
                                echo '<div class="exclude_list"><span class="list_item fas fa-times"></span><span>' .$sub_value .'</span></div>';
                            }
                            ?>
                        </div>
                        </div>

                            <?php
                    }
                    ?>

                    <div class="vc_col-sm-12 aligncenter trip_booking_btn">
                        <a href="#pop_booking_form" rel="modal:open" class="dt-sc-button medium blue ">Book Now</a>
                    </div>

                    <!-- Modal HTML embedded directly into document -->
                    <div id="pop_booking_form" class="modal">
                        <div class="pop_booking_head">Booking Request</div>
                        <div class="pop_booking_body">
                            <div class="wpb_column vc_column_container vc_col-sm-8">
                                <h3>Booking Course: <strong><?php the_title(); ?></strong></h3>
                            </div>
                            <div class="wpb_column vc_column_container vc_col-sm-4 alignright">
                                <h3>Price: <strong><?php the_field('currency', 'option'); echo ' '; the_field('course_price'); ?></strong></h3>
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

                    <!-- Link to open the modal -->




                </div>
            </div>
        </div>

        <?php endwhile; endif;?>



    </div>


<?php get_footer(); ?>