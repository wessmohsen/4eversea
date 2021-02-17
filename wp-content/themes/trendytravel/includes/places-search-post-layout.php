<?php
	//PERFORMING PLACES POST LAYOUT...
	$meta_set = get_post_meta($post->ID, '_tpl_default_settings', true);
	/*if($GLOBALS['force_enable'] == true)
	  $page_layout = $GLOBALS['page_layout'];
	else*/
	  $page_layout = !empty($meta_set['layout']) ? $meta_set['layout'] : $GLOBALS['page_layout'];
	
	$li_class = "dt-sc-one-fourth column";
	$column = 4;
	
	//PERFORMING QUERY...
	if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
	elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
	else { $paged = 1; }
	
	$places = array(
		'post_type' => 'dt_places',
		'paged' => $paged,
		'tax_query' => array(),
		'meta_query' => array(),
		'order_by' => 'published');
		
	if(isset($_REQUEST['txtplacename']) && ($_REQUEST['txtplacename'] !== "")):
		$places['s'] = $_REQUEST['txtplacename'];
	endif;

	if(isset($_REQUEST['cmbcat']) && ($_REQUEST['cmbcat'] !== "")):
		$places_type_id = get_term_by('slug',$_REQUEST['cmbcat'],'place_entries',ARRAY_A);
		$places_type_id = is_array( $places_type_id ) ? $places_type_id['term_id'] : "";

		$places['tax_query'][] = array( 'taxonomy' => 'place_entries',
			'field' => 'id',
			'terms' => $places_type_id,
			'operator' => 'IN',);
	endif;
	
	if(isset($_REQUEST['cmbcity']) && ($_REQUEST['cmbcity'] !== "")):
		$places['meta_query'][] = array(
			'key'     => '_place_settings',
			'value'   => $_REQUEST['cmbcity'],
			'compare' => 'LIKE',);
	endif;
	
	$the_query = new WP_Query($places);
	if($the_query->have_posts()):  $i = 1; ?>
    
      <h2 class="section-title entry-title"><?php esc_html_e('Places in : ', 'trendytravel'); echo esc_attr($_REQUEST['txtplacename']); ?></h2><?php
	  $maxpages = ($the_query->max_num_pages != 0) ?  $the_query->max_num_pages : 1;
      echo '<p class="entry-result-count">'.esc_html__('Showing Results ', 'trendytravel').$the_query->query_vars['paged'].esc_html__(' of ', 'trendytravel').$maxpages.'</p>'; ?>
      	  
      <div class="dt-sc-places-container"><?php
		while($the_query->have_posts()): $the_query->the_post();
		
		 	$temp_class = "";
			if($i == 1) $temp_class = $li_class." first"; else $temp_class = $li_class;
			if($i == $column) $i = 1; else $i = $i + 1;
			
			$place_meta = get_post_meta(get_the_id() ,'_place_settings', true); ?>
            
	        <div class="<?php echo esc_attr($temp_class); ?>">
				<div id="post-<?php the_ID(); ?>" <?php post_class('place-item'); ?>>
                    <div class="place-thumb"><?php
						if( has_post_thumbnail() ): ?>
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php
								$attr = array('title' => get_the_title()); the_post_thumbnail('places-fourcol', $attr); ?>
                                <div class="image-overlay"><span class="image-overlay-inside"></span></div>
							</a><?php
						endif; ?>
                    </div>
                    <div class="place-detail-wrapper">
                        <div class="place-title">
                            <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                            <p><?php echo esc_attr($place_meta['place_add']); ?></p>
                        </div>
                        <div class="place-content">
                            <a class="map-marker" href="<?php the_permalink(); ?>#place_map_<?php the_ID(); ?>"> <span class="red"></span><?php esc_html_e('View on Map', 'trendytravel'); ?></a>
                            <a class="dt-sc-button too-small" href="<?php the_permalink(); ?>"><?php esc_html_e('View details', 'trendytravel'); ?></a>
                        </div>
                    </div>
                </div>
            </div><?php
		endwhile; ?>
      </div><?php
	  if($the_query->max_num_pages > 1): ?>
		<div class="pagination blog-pagination">
			<?php if(function_exists("dt_theme_pagination")) echo dt_theme_pagination("", $the_query->max_num_pages, $the_query); ?>
		</div><?php
	  endif;
	  wp_reset_postdata();
	  else: ?>
		<h2><?php esc_html_e('Nothing Found.', 'trendytravel'); ?></h2>
		<p><?php esc_html_e('Apologies, but no results were found for the requested archive.', 'trendytravel'); ?></p><?php
	 endif; ?>