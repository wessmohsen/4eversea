<?php
get_header();
?>

	<header id="header">
		<div class="container">
			<?php do_action( 'trendytravel_header' ); ?>
	    </div>
		<section class="content-full-width" id="primary">

            <img loading="lazy" class="size-full" src="<?php the_post_thumbnail_url('full');?>" alt="Top-Banner" >

		</section>
		<div class="cpt_header_title">
			<div class="container the_hd_title"><a href="<?php echo home_url( '/itineraries' ); ?>" >Itineraries</a> / <?php the_title(); ?></div>
		</div>	
	</header><!-- **Header - End ** -->




    <?php if (have_posts()) : while (have_posts()) : the_post();?>
			
		<div id="main" style="padding-bottom:0px;">
          <div class="container">

        <?php the_content();?>

    <?php endwhile; endif;?>



          </div>
      </div>

<?php get_footer(); ?>