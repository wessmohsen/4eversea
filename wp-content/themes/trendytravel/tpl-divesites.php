<?php
/*
	Template Name: Dive Sites
*/
get_header();
$terms = get_terms('dive-sites-category');
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
                <img class="size-full" src="/wp-content/uploads/2021/01/header_001.jpg" alt="Top-Banner" >
            <?php } ?>
        </section>
        <div class="cpt_header_title">
            <div class="container the_hd_title">Dive Sites</div>
        </div>
    </header><!-- **Header - End ** -->


<!-- **Main** -->
<div id="main">

    <!-- ** Container ** -->
    <div class="container">

        <?php

        if ( !empty( $terms ) && !is_wp_error( $terms ) ){
            foreach ( $terms as $term ) {
                echo '<div class="wpb_column vc_col-sm-12 ds_container vc_align_center">';
                echo '<div class="welcome-text aligncenter"><h2>' . $term->name . '</h2></div>'; ?>

                <div class="wpb_single_image wpb_content_element vc_align_center">

                    <figure class="wpb_wrapper vc_figure">
                        <div class="vc_single_image-wrapper   vc_box_border_grey"><img src="/wp-content/uploads/2021/01/hr-white-boat-1.png" class="vc_single_image-img attachment-full" alt="" loading="lazy" srcset="https://hurghadashop.com/wp-content/uploads/2021/01/hr-white-boat-1.png 699w, https://hurghadashop.com/wp-content/uploads/2021/01/hr-white-boat-1-300x12.png 300w, https://hurghadashop.com/wp-content/uploads/2021/01/hr-white-boat-1-540x22.png 540w, https://hurghadashop.com/wp-content/uploads/2021/01/hr-white-boat-1-500x21.png 500w" sizes="(max-width: 699px) 100vw, 699px" width="699" height="29"></div>
                    </figure>
                </div>




                    <?php

            $args = array(
			'post_type' => $post_type,
			'post_status' => 'publish',
			'posts_per_page' => '999',
			'tax_query' => array(
				array(
					'taxonomy' => $term->taxonomy,
					'field' => 'slug',
					'terms' => array( $term->slug )
					 )
			)
		  );

		  $divesite_loop = new WP_Query( $args );

		    //If Trips is Safari
            if ( $divesite_loop->have_posts() ) :
                echo '<div class="woocommerce columns-3 ds_3col" > <ul class="products columns-3" >';
                $i = 0;
                while ( $divesite_loop->have_posts() ) : $divesite_loop->the_post();
                    echo "<li><div class='dt-sc-one-third column  "; if($i % 3 == 0 || $i ==0){echo 'first';} echo "'>";

                    $title = get_the_title();
                    $post_url = get_permalink( $post->ID ); ?>

                    <div class="hotel-thumb">
                    <div class="thumb-wrapper">

                    <a href="<?php echo $post_url; ?>" ><?php echo get_the_post_thumbnail( $post_id, 'dive-site-thumb' ); ?>
                    <div class="image-overlay">
                        <span class="image-overlay-inside"></span>
                    </div>
                    </a>
                    </div>
                    </div>
                    <a href="<?php echo $post_url; ?>" >
                    <h3><?php echo $title ; ?></h3>
                    </a>


                    <?php
                    echo '</div></li>';
                    $i++;

                endwhile;

                wp_reset_postdata();
                echo '</ul></div>';
            endif;
            echo '</div>';
            }
        }

        ?>
    </div>
    <!-- ** Container End ** -->
    
</div><!-- **Main - End ** -->    
<?php get_footer(); ?>