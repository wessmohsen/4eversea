<?php
get_header();
$home_url = home_url( '/' );
?>
	<header id="header">
		<div class="container">
			<?php do_action( 'trendytravel_header' ); ?>
	    </div>
		<section class="content-full-width" id="primary">

                <?php
                $images = get_field('boat_slider');
                //$size = 'wm-slider-size'; // (thumbnail, medium, large, full or custom size)
                if( $images ): ?>
                    <div id="owl-demo" class="owl-carousel owl-theme wm_slider_trips">
                        <?php foreach( $images as $image ): ?>
                            <div loading="lazy" class="item">
                                <img src="<?php echo esc_url($image['sizes']['wm-slider-size']); ?>" alt="" />
                            </div>
                        <?php endforeach; ?>
                    </div>

				
				<div class="boat_info_top">
					<div class="boot_info_block">
						<div class="inf_ico"><img src="<?php echo $home_url; ?>/test/icons/boat_cabin.png" ></div>
						<div class="inf_data">
							<span class="inf_title">Cabins</span>
							<small class="inf_desc">11 cabin</small>
						</div>
					</div>
					<div class="boot_info_block">
						<div class="inf_ico"><img src="<?php echo $home_url; ?>/test/icons/boat_beam.png"></div>
						<div class="inf_data">
							<span class="inf_title">Length</span>
							<small class="inf_desc">30 M</small>
						</div>
					</div>
					<div class="boot_info_block">
						<div class="inf_ico"><img src="<?php echo $home_url; ?>/test/icons/boat_length.png"></div>
						<div class="inf_data">
							<span class="inf_title">Beam</span>
							<small class="inf_desc">7.4 M</small>
						</div>
					</div>
				</div>

           <?php endif; ?>
				

		</section>
		<div class="slider_bottom_title cpt_header_title">
			<div class="container the_hd_title"><a href="<?php echo home_url( '/boats' ); ?>" >Boats</a> / <?php the_title(); ?></div>
		</div>	
	</header><!-- **Header - End ** -->








    <?php if (have_posts()) : while (have_posts()) : the_post();?>
			
		<div id="main" style="padding-bottom:0px;">
          <div class="container">
          		<!-- Place somewhere in the <body> of your page -->

        <?php the_content();?>


    <?php endwhile; endif;?>



          </div>
      </div>

<?php get_footer(); ?>