<?php
get_header();

$page_id = $post->ID;
$settings = get_post_meta($page_id,'_tpl_default_settings',TRUE);
$post_type = get_post_type( $page_id );
$obj = get_post_type_object( $post_type );
$post_type_name = $obj->labels->singular_name;

?>
    <!-- ** Header Wrapper ** -->
    <div id="header-wrapper" class="<?php echo esc_attr($header_class); ?>">

        <!-- **Header** -->
        <header id="header">

            <div class="container">
                <?php do_action( 'trendytravel_header' ); ?>
            </div>

            <div class="slider_bottom_title cpt_header_title rmv_bottom_spc">
                <?php
                $terms = get_the_terms( $post->ID , 'dive-sites-category' );
                if ( is_array( $terms ) && ! is_wp_error( $terms ) ) {
                    foreach ($terms as $term) {}
                }
                $term_link = home_url( '/' ) .$post_type .'/' .$term->slug;
                $post_type_link = home_url( '/' ) .$post_type;
                ?>
                <div class="container hd_title_no_slider">
                    <a href="<?php echo $post_type_link ?>" ><?php echo $post_type_name; ?></a> / <a href="<?php echo $term_link; ?>" ><?php echo $term->name; ?></a> / <?php the_title(); ?>
                </div>
            </div>
        </header><!-- **Header - End ** -->
    </div>

<?php if (have_posts()) : while (have_posts()) : the_post();?>
    <div id="main" >
    <div class="container">
        <!-- Place somewhere in the <body> of your page -->
        <div class="vc_row wpb_row vc_row-fluid">
            <div class="vc_col-sm-12">
                <div class="ds_top_content">
                    <div class="wpb_column vc_column_container vc_col-sm-8">

                        <?php
                        $images = get_field('ds_slider_gallery');
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
                        ?>

                    </div>


                    <div class="wpb_column  vc_col-sm-4 ds_data">
                        <div class="vc_column_container vc_col-sm-12 ds_information">
                            <div class="empty_spc_10"></div>
                            <div class="ds_inf_block">
                                <p class="ds_inf_txt"><strong>Dive Site: </strong><span><?php the_title(); ?></span></p>
                                <p> </p>
                            </div>

                            <?php if(get_field('ds_access')){ ?>
                                <div class="ds_inf_block">
                                    <p class="ds_inf_txt"><strong>Access: </strong><span><?php the_field('ds_access'); ?></span></p>
                                    <p> </p>
                                </div>
                            <?php }

                            if(get_field('ds_min_divers')){ ?>
                                <div class="ds_inf_block">
                                    <p class="ds_inf_txt"><strong>Minimum Divers: </strong><span><?php the_field('ds_min_divers'); ?></span></p>
                                    <p> </p>
                                </div>
                            <?php }
                            if(get_field('ds_min_qualification')){ ?>
                                <div class="ds_inf_block">
                                    <p class="ds_inf_txt"><strong>Minimum Qualification: </strong><span><?php the_field('ds_min_qualification'); ?></span></p>
                                    <p> </p>
                                </div>
                            <?php }
                            if(get_field('ds_depth_range')){ ?>

                                <div class="ds_inf_block">
                                    <p class="ds_inf_txt"><strong>Depth Range: </strong><span><?php the_field('ds_depth_range'); ?></span></p>
                                    <p> </p>
                                </div>
                            <?php } ?>






                        </div>


                        <?php
                        //_e('<h2>Requirements</h2>', 'trendytravel');
                        //the_field('course_requirements');
                        ?>

                    </div>
                </div>


                <div class="vc_column_container vc_col-sm-12">
                    <div class="empty_spc_20"></div>
                    <?php
                    the_content();
                    ?>
                </div>


            </div>
        </div>
    </div>



<?php endwhile; endif;?>



    </div>
    <div class="vc_row-full-width vc_clearfix border_btm_end"></div>


<?php get_footer(); ?>