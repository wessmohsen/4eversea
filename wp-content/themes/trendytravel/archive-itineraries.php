<?php
get_header();
?>
	<header id="header">
		<div class="container"><?php

	        /**
	         * trendytravel_header hook.
	         * 
	         * @hooked trendytravel_vc_header_template - 10
	         *
	         */
	        do_action( 'trendytravel_header' ); ?>
	    </div>
		<section class="content-full-width" id="primary">
            <img loading="lazy" class="size-full" src="http://4eversea.test/wp-content/uploads/2021/01/header_001.jpg" alt="Top-Banner" >
		</section>
		<div class="cpt_header_title">
			<div class="container the_hd_title">Itineraries</div>
		</div>	
	</header><!-- **Header - End ** -->
	

		
	<div id="main">
        <div class="container">
		

		<?php
			
		$args = array(
			'post_type' => 'itineraries',
			'post_status' => 'publish',
			'posts_per_page' => '10'
		  );
		  $itineraries_loop = new WP_Query( $args );
		  if ( $itineraries_loop->have_posts() ) :
			while ( $itineraries_loop->have_posts() ) : $itineraries_loop->the_post();
			  // Set variables
			  $title = get_the_title();
			  $post_url = get_permalink( $post->ID );
			  $description = get_the_content();
			  //$download = get_field(‘download’);
			  //$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
			  //$itinerary_image1 = $featured_image[0];
			  //$itinerary_image2 = get_field(‘itinerary_image’);
			  // Output
			  ?>
	  
			<a href="<?php echo $post_url; ?>">
			<div class="itinerary-item wpb_column vc_column_container vc_col-sm-12">
				<h2><?php echo $title; ?></h2>
				<img src="<?php echo the_post_thumbnail_url('full')  ?>" alt="<?php echo $title; ?>">
			</div>
			</a>
		  <?php
		  endwhile;
		  wp_reset_postdata();
		  endif; 
		  ?>
        </div>
    </div>

<?php get_footer(); ?>