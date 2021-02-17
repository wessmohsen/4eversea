<?php get_header();
	$settings = get_post_meta ( $post->ID, '_portfolio_settings', TRUE );
	$settings = is_array ( $settings ) ? $settings : array ();

	$global_breadcrumb = cs_get_option( 'show-breadcrumb' );
	
    $header_class = '';
    if( !$settings['enable-sub-title'] || !isset( $settings['enable-sub-title'] ) ) {
        if( isset( $settings['show_slider'] ) && $settings['show_slider'] ) {
            if( isset( $settings['slider_type'] ) ) {
                $header_class =  $settings['slider_position'];
            }
        }
    }
    
    if( !empty( $global_breadcrumb ) ) {
        if( isset( $settings['enable-sub-title'] ) && $settings['enable-sub-title'] ) {
            $header_class = $settings['breadcrumb_position'];
		}
	}?>

<!-- ** Header Wrapper ** -->
<div id="header-wrapper"  class="<?php echo esc_attr($header_class); ?>">
    <!-- **Header** -->
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
    </header><!-- **Header - End ** -->

    <!-- ** Breadcrumb ** -->
    <?php
        # Global Breadcrumb
        if( !empty( $global_breadcrumb ) ) {
            if( isset( $settings['enable-sub-title'] ) && $settings['enable-sub-title'] ) {
                $breadcrumbs = array();
                $bstyle = trendytravel_cs_get_option( 'breadcrumb-style', 'default' );

                $cat = get_the_term_list( $post->ID, 'portfolio_entries', '', '$$$', '');
                $cats = array_filter(explode('$$$', $cat));
                if (!empty($cats))
                	$breadcrumbs[] = $cats[0];

                $breadcrumbs[] = the_title( '<span class="current">', '</span>', false );
                $style = trendytravel_breadcrumb_css( $settings['breadcrumb_background'] );

                trendytravel_breadcrumb_output ( the_title( '<h1>', '</h1>',false ), $breadcrumbs, $bstyle, $style );
            }
        }
    ?><!-- ** Breadcrumb End ** -->                
</div><!-- ** Header Wrapper - End ** -->

<!-- **Main** -->
<div id="main">

    <!-- ** Container ** -->
    <div class="container"><?php
        $page_layout  = array_key_exists( "layout", $settings ) ? $settings['layout'] : "content-full-width";
        $layout = trendytravel_page_layout( $page_layout );
        extract( $layout );
		?>

        <!-- Primary -->
        <section id="primary" class="<?php echo esc_attr( $page_layout );?>"><?php
            if( have_posts() ) {
                while( have_posts() ) {
                    the_post();?>
                    <article id="post-<?php the_ID();?>" <?php post_class(array('dt-portfolio-single'));?>><?php
                    	$portfolio_layout = array_key_exists("portfolio-layout", $settings) ? $settings['portfolio-layout'] : "full-width-portfolio";
                    	$container_start =  $container_middle =  $container_end = "";

                    	switch ($portfolio_layout) {

                    		case 'full-width-portfolio':
                    			$container_start = $container_middle = $container_end = "";
                    		break;

                    		case 'with-left-portfolio':
                    			$container_start	 =	'<div class="column dt-sc-two-third first">';
                    			$container_middle	 =	'</div>';
                    			$container_middle  .=	'<div class="column dt-sc-one-third last">'; 
                    			$container_end	 =	'</div>';
                    		break;

                    		case 'with-right-portfolio':
								$container_start	 =	'<div class="column dt-sc-two-third right-gallery first">';
								$container_middle	 =	'</div>';
								$container_middle  .=	'<div class="column dt-sc-one-third last">'; 
								$container_end	 =	'</div>';
							break;
						}

						echo !empty( $container_start ) ? $container_start : '';?>

						<div class="dt-portfolio-single-slider-wrapper">

							<!-- Slider -->
                            <ul class="dt-portfolio-single-slider"><?php
                            	if( has_post_thumbnail() ){ ?>
                            		<li><?php the_post_thumbnail("full");?></li><?php
                            	}

                            	if( array_key_exists("portfolio-gallery",$settings) ) {
                            		$items = explode(',', $settings["portfolio-gallery"]);
                            		foreach( $items as $item ){
                            			echo '<li>'.wp_get_attachment_image( $item, 'full' ).'</li>';
									}
								}
								
								if( array_key_exists("portfolio-video",$settings) ) {
									
									$portfolio_video_final = array();

									if(is_array($settings["portfolio-video"])){

										foreach($settings["portfolio-video"] as $portfolio_video_array)
										{
											foreach($portfolio_video_array as $portfolio_video_val)	
											{
												array_push($portfolio_video_final, $portfolio_video_val);
											}    
										}
										
										foreach ( $portfolio_video_final as $portfolio_video_url ) {
										echo '<li>';
											if (strpos($portfolio_video_url, "vimeo")) :
												$url = substr( strrchr($portfolio_video_url, "/"),1);
												echo "<iframe src='http".trendytravel_ssl()."://player.vimeo.com/video/{$url}' width='1170' height='700' frameborder='0'></iframe>";
											elseif(strpos($portfolio_video_url, "?v=")):
												$url = substr( strrchr($portfolio_video_url, "="),1);
												echo "<iframe src='http".trendytravel_ssl()."://www.youtube.com/embed/{$url}?wmode=opaque' width='1170' height='700' frameborder='0'></iframe>";
											endif;
										echo '</li>';
										}

									}
									
								}
								
								
								?>
                            </ul><!-- Slider Ends -->                           
						</div>

						<?php echo !empty( $container_middle ) ? $container_middle : '';?>

                        <div class="dt-portfolio-single-details">
                        	<div class="column dt-sc-three-fourth first">
                        		<?php the_title('<h3>','</h3>'); ?>
                        		<?php the_content(); ?>
								<p class="tags"><span class="fa fa-tag"></span><?php echo get_the_term_list($post->ID, 'portfolio_entries', ' '._e(' Posted In:','designthemes-core').'&nbsp;&nbsp;&nbsp;', ' ', ' '); ?></p>
								<p class="tags-taxo"><span class="fa fa-folder-open"></span><?php echo get_the_term_list($post->ID, 'portfolio_tags', ' '._e(' Tags:','designthemes-core').'&nbsp;&nbsp;&nbsp;', ' ', ' '); ?></p>
                            </div>

							<div class="column dt-sc-one-fourth">
								<h4><?php _e('Other Details','designthemes-core');?></h4>
								<ul class="project-details">
								<?php if( isset( $settings["organizer"] ) && $settings["organizer"]!='' ): ?>
									<li><span class="fa fa-user"></span> <strong><?php _e("Organizer","designthemes-core");?> :</strong> 
									<?php echo esc_html($settings["organizer"]);?></li>
									<?php endif;?>

									<?php if( isset( $settings["location-info"] ) && $settings["location-info"]!='' ): ?>
									<li><span class="fa fa-map-marker"></span> <strong><?php _e("Location","designthemes-core");?> : </strong>
									<?php echo esc_html($settings["location-info"]);?></li>
									<?php endif;?>

									<?php if( isset( $settings["website-link"] ) && $settings["website-link"]!='' ): ?>
											<li><span class="fa fa-link"></span> <strong><?php _e('Website','designthemes-core');?> : </strong>
												<a target="_blank" href="<?php echo $settings["website-link"];?>"><?php 
													$url = $settings["website-link"];
													$url = preg_replace("(^https?://)", "", $url );
													echo esc_html($url);?></a>
											</li>
									<?php endif;?>
									<li><span class="fa fa-calendar"></span><strong><?php _e('Date','designthemes-core');?> :</strong> <?php the_date("d M Y");?></li>
									</ul>
									<?php 
							$show_social_share = cs_get_option('show-social-share');
							if( $show_social_share ):?><div class="gallery-share"><?php trendytravel_social_bookmarks('sb-gallery'); ?></div><?php endif; ?>
							</div>

                            <div class="column dt-sc-one-column"><?php
                            	if( array_key_exists('portfolio_opt_flds', $settings) ): ?>
                            		<h3><?php esc_html_e('Project Details','designthemes-core');?></h3>
                            		<ul class="project-details"><?php
                            			for( $i = 1; $i <= sizeof($settings['portfolio_opt_flds']) / 2; $i++ ):

                            				$label = $settings['portfolio_opt_flds']["portfolio_opt_flds_title_{$i}"];
                            				$value = $settings['portfolio_opt_flds']["portfolio_opt_flds_value_{$i}"];

                            				if( filter_var($value ,FILTER_VALIDATE_URL) ){
                            					$value = "<a href='".esc_url($value)."'>".esc_html($value)."</a>";
                                			} elseif( is_email($value) ){
                                				$email = sanitize_email($value);
                                				$value = "<a href='mailto:".antispambot($email,1)."'>".antispambot($value)."</a>";
                                			}?>
                                    		<li> <span><?php echo esc_html($label);?> : </span> <?php echo ($value);?> </li><?php
                                    	endfor;?>
                                    </ul>
								<?php endif;?>
                            </div>
                        </div>

						<?php echo !empty( $container_end ) ? $container_end : '';
						edit_post_link( esc_html__( ' Edit ','designthemes-core' ) );
						
						?>
                    </article><?php
                }
            }?>

            <!-- **Post Nav** -->
        	<div class="post-nav-container">
        		<div class="prev-post"><?php previous_post_link('%link','<i class="fa fa-angle-double-left"> </i>'.esc_html__('Prev Entry','designthemes-core') ); previous_post_link('%link', '<p>%title</p>');?> </div>
        		<div class="next-post"><?php next_post_link('%link',esc_html__('Next Entry','designthemes-core').'<i class="fa fa-angle-double-right"> </i>'); next_post_link('%link', '<p>%title</p>');?></div>
        	</div><!-- **Post Nav - End** -->

        	<?php
        		# Related Portfolio
        		$related_post = cs_get_option('single-portfolio-related');
        		$terms = wp_get_object_terms( get_the_ID() ,'portfolio_entries' ,array('fields' => 'ids') );
        		if( $related_post && $terms ) :?>
        			<div class="dt-sc-hr-invisible"></div>
        			<div class="dt-sc-clear"></div>
						<div class="related-portfolios">
							<h3><span><?php esc_html_e('Related Projects','designthemes-core');?></span></h3><?php

							$post_class = "portfolio column dt-sc-one-third";
							$post_style = cs_get_option('single-portfolio-related-style');
							if( $show_sidebar ) {
								$post_class = "portfolio column dt-sc-one-third with-sidebar";
							}
							$sc = "[dt_sc_portfolio_related_post post_class='".$post_class."' post_style='".$post_style."' id='".get_the_ID()."'/]";
							echo do_shortcode($sc);?>
						</div><?php
        		endif;

        		#Portfolio Comments
	        	$post_comment = cs_get_option('single-portfolio-comments');
				if( $post_comment ):?>
	            	<div class="dt-sc-hr"></div>
    	            <div class="dt-sc-clear"></div>

        	        <!-- ** Comment Entries ** -->
            	    <section class="commententries">
                		<?php  comments_template('', true); ?>
                	</section><?php
                endif;
            ?>
        </section><!-- Primary End --><?php
		
        if ( $show_sidebar ) {
            if ( $show_left_sidebar ) {
                $sticky_class = ( array_key_exists('enable-sticky-sidebar', $settings) && $settings['enable-sticky-sidebar'] == 'true' ) ? ' sidebar-as-sticky' : '';?>
                
                <!-- Secondary Left -->
                <section id="secondary-left" class="secondary-sidebar <?php echo esc_attr( $sidebar_class.$sticky_class );?>"><?php
                	 trendytravel_show_sidebar( 'dt_portfolios', $post->ID, 'left' ); ?>
                </section><!-- Secondary Left End --><?php
            }
        }

        if ( $show_sidebar ) {
            if ( $show_right_sidebar ) {
                $sticky_class = ( array_key_exists('enable-sticky-sidebar', $settings) && $settings['enable-sticky-sidebar'] == 'true' ) ? ' sidebar-as-sticky' : '';?>

                <!-- Secondary Right -->
                <section id="secondary-right" class="secondary-sidebar <?php echo esc_attr( $sidebar_class.$sticky_class );?>"><?php
                	 trendytravel_show_sidebar( 'dt_portfolios', $post->ID, 'right' ); ?>
                </section><!-- Secondary Right End --><?php
            }
        }?>
    </div>
    <!-- ** Container End ** -->
    
</div><!-- **Main - End ** -->
<?php get_footer(); ?>