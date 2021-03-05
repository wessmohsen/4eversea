<?php
get_header();
$taxonomy = get_queried_object();
$post_type = get_post_type( $post->ID );
$post_type_obj=get_post_type_object($post_type);
$post_type_name = $post_type_obj->labels->singular_name;

?>
	<header id="header">
		<div class="container">
			<?php do_action( 'trendytravel_header' ); ?>
	    </div>
		<section class="content-full-width" id="primary">
			<?php
			$cover_image = get_field('category_cover_photo',$taxonomy);
			if( isset($cover_image) && $cover_image != NULL ){
			$cover_size = 'wm-header-size';
		    $cover_thumb = $cover_image['sizes'][ $cover_size ];
		    echo '<img loading="lazy" class="size-full" src="' .esc_url($cover_thumb) .'" alt="Top-Banner" >' ;
			} 
			else{ ?>
            <img class="size-full" src="/wp-content/uploads/2021/01/header_001.jpg" alt="Top-Banner" >
        	<?php } ?>
		</section>
		<div class="cpt_header_title">
			<div class="container the_hd_title"><a href="/<?php echo $post_type ; ?>"><?php echo $post_type_name; ?></a> / <?php echo  $taxonomy->name; ?></div>
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


		  if ( $trips_loop->have_posts() ) :
			while ( $trips_loop->have_posts() ) : $trips_loop->the_post();
			  // Set variables
			  $title = get_the_title();
			  $post_url = get_permalink( $post->ID );
			  ?>
	  



		  
                <div class="trip-block">

                    <div class="column dt-sc-one-column with-sidebar batchelor-sort business-sort all-sort wpb_column vc_col-sm-6">
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
                                        <a href="<?php echo $post_url; ?>" class="dt-sc-button too-small blue"><?php  _e('View Details', 'trendytravel'); ?></a>
                                    </div>

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