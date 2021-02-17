    <div class="dt-sc-posts-list-wrapper"><?php
        // Getting options...
        $post_layout = cs_get_option( 'post-archives-post-layout' );
        $post_style = cs_get_option( 'post-style' );

        $post_layout_arr = array();
        $post_class = array( '1' => 'column dt-sc-one-column blog-fullwidth', '2' => 'column dt-sc-one-half', '3' => 'column dt-sc-one-third' );

        switch($post_layout):

            case 'one-column':
                $post_layout_arr[] = 1;
            break;

            case 'one-half-column':
                $post_layout_arr[] = 2;
            break;

            case 'one-third-column':
                $post_layout_arr[] = 3;
            break;

            default:
                $post_layout_arr = explode('-', $post_layout);
        endswitch;

        if( have_posts() ):

            $i = 1;
            $gs_class = ( count( $post_layout_arr ) > 1 ) ? $post_layout_arr[1] : $post_layout_arr[0];

            echo "<div class='tpl-blog-holder apply-isotope'>";
            echo "<div class='grid-sizer ".esc_attr( $post_class[$gs_class] )."'></div>";

            $obj = new trendytravel_post_functions;
            $meta = $obj->trendytravel_post_meta_fields(false);

            while( have_posts() ):
                the_post();

                $temp_class = "";
                $post_ID = get_the_ID();

                $post_layout = current($post_layout_arr);
				$meta[10]= $post_layout;

                if($i == 1) $temp_class = $post_class[$post_layout]." first"; else $temp_class = $post_class[$post_layout];
                if($i == $post_layout) $i = 1; else $i = $i + 1;
    
                $post_meta = get_post_meta($post_ID ,'_dt_post_settings',TRUE);
                $post_meta = is_array($post_meta) ? $post_meta : array();
    
                $format = !empty( $post_meta['post-format-type'] ) ? $post_meta['post-format-type'] : 'standard'; ?>
    
                <div class="<?php echo esc_attr($temp_class);?>">
                    <article id="post-<?php the_ID();?>" <?php post_class('blog-entry '.$post_style.' '.'format-'.$format);?>><?php
                        switch( $post_style ):
    
                            case 'entry-date-left':
                                $obj->trendytravel_post_date_left_style( $post_ID, $meta );
                            break;
    
                            case 'entry-date-author-left':
                                $obj->trendytravel_post_date_author_left_style( $post_ID, $meta );
                            break;
							
							case 'entry-date-left outer-frame-border':
								$obj->trendytravel_post_date_left_framed_border_style( $post_ID, $meta );
							break;

							case 'blog-modern-style':
								$obj->trendytravel_post_modern_style( $post_ID, $meta );
							break;

							case 'bordered':
								$obj->trendytravel_post_bordered_style( $post_ID, $meta );
							break;

							case 'classic':
								$obj->trendytravel_post_classic_style( $post_ID, $meta );
							break;

							case 'entry-overlay-style':
								$obj->trendytravel_post_overlay_style( $post_ID, $meta );
							break;

							case 'overlap':
								$obj->trendytravel_post_overlap_style( $post_ID, $meta );
							break;

							case 'entry-center-align':
								$obj->trendytravel_post_stripe_style( $post_ID, $meta );
							break;

							case 'entry-fashion-style':
								$obj->trendytravel_post_fashion_style( $post_ID, $meta );
							break;

							case 'entry-minimal-bordered':
								$obj->trendytravel_post_minimal_bordered_style( $post_ID, $meta );
							break;

                            case 'blog-default-style':
                            case 'blog-medium-style':
                            case 'blog-medium-style dt-blog-medium-highlight':
                            case 'blog-medium-style dt-blog-medium-highlight dt-sc-skin-highlight':
                            default:
                                $obj->trendytravel_post_default_style( $post_ID, $meta );
                            break;
    
                        endswitch;

                        $x = next($post_layout_arr);
                        if( empty($x) && (count($post_layout_arr) == 3) ){
                            unset($post_layout_arr);
                            $post_layout_arr[] = 2;
                        } elseif( empty($x) && (count($post_layout_arr) == 4) ){
                            unset($post_layout_arr);
                            $post_layout_arr[] = 3;
                        } elseif( empty($x) && (count($post_layout_arr) == 5) ){
                            reset($post_layout_arr);
                            next($post_layout_arr);
                        } elseif( empty($x) && (count($post_layout_arr) == 6) ){
                            reset($post_layout_arr);
                        } elseif( empty($x) && (count($post_layout_arr) == 1) ){
                            reset($post_layout_arr);
                        }

                    echo '</article>';
                echo '</div>';
    
            endwhile;
            echo '</div>';

        else:?>
            <h2><?php esc_html_e('Nothing Found.', 'trendytravel'); ?></h2>
            <p><?php esc_html_e('Apologies, but no results were found for the requested archive.', 'trendytravel'); ?></p><?php
        endif;?>
    </div>
    
    <!-- **Pagination** -->
    <div class="pagination blog-pagination"><?php echo trendytravel_pagination(); ?></div><!-- **Pagination** -->