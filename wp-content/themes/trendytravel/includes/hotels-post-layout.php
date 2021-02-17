<?php
	//PERFORMING HOTELS POST LAYOUT...
	$meta_set = get_post_meta($post->ID, '_tpl_default_settings', true);
	$page_layout = !empty($meta_set['layout']) ? $meta_set['layout'] : $GLOBALS['page_layout'];
	
	$li_class = "column dt-sc-one-column";
	$feature_image = "hotel-thumb";
	
	//BETTER IMAGE SIZE...
	switch($page_layout) {
		case "with-left-sidebar":
			$li_class = $li_class." with-sidebar";
			$feature_image = $feature_image."-sidebar";
			break;
		
		case "with-right-sidebar":
			$li_class = $li_class." with-sidebar";
			$feature_image = $feature_image."-sidebar";
			break;

		case "with-both-sidebar":
			$li_class = $li_class." with-sidebar";
			$feature_image = $feature_image."-bothsidebar";
			break;
	}
	
	//POST VALUES....
	$limit = $meta_set['hotels-post-per-page'];
	$cats  = isset( $meta_set['hotel-categories'] ) ? $meta_set['hotel-categories'] : '';
	
	if(empty($cats)) {
		$cats = get_categories('taxonomy=hotel_entries&hide_empty=1');
		$cats = get_terms( array('hotel_entries'), array('fields' => 'ids'));
	} else {
		$cats = array_filter(array_unique($cats));
	}

	global $dt_allowed_html_tags;
	$search_text = !empty($_REQUEST['search_text']) ? wp_kses($_REQUEST['search_text'], $dt_allowed_html_tags) : "";
	
	//PERFORMING QUERY...
	if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
	elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
	else { $paged = 1; }
	
	//PERFORMING QUERY...
	if(isset($_REQUEST['search_text'])):
		$args = array('post_type' => 'dt_hotels', 'paged' => $paged , 'posts_per_page' => $limit, 'tax_query' => array( array( 'taxonomy' => 'hotel_entries', 'field' => 'id', 'terms' => $cats)),
																					'meta_query' => array( array( 'key' => '_hotel_settings', 'value' => $search_text, 'compare' => 'LIKE')));
		$the_query = new WP_Query($args);
		if($the_query->found_posts == 0):
			$args = array('post_type' => 'dt_hotels', 'paged' => $paged , 'posts_per_page' => $limit, 'tax_query' => array(array( 'taxonomy' => 'hotel_entries', 'field' => 'id', 'terms' => $cats)),'s' => $search_text);
		endif;
	else:
		$args = array('post_type' => 'dt_hotels', 'paged' => $paged , 'posts_per_page' => $limit, 'tax_query' => array( array( 'taxonomy' => 'hotel_entries', 'field' => 'id', 'terms' => $cats)));
	endif;
	wp_reset_postdata();

	$the_query = new WP_Query($args);
	if($the_query->have_posts()): ?>
    
      <div class="dt-sc-hr-invisible"></div>
      <div class="search-container" id="entry-search">
          <form name="frmsearch" action="<?php the_permalink(); ?>" method="get">
              <p><input type="text" name="search_text" value="<?php echo esc_attr($search_text); ?>" placeholder="<?php esc_attr_e('Search by name, address, offer etc...', 'trendytravel'); ?>" /></p>
              <input type="submit" value="<?php esc_attr_e('Find Hotels', 'trendytravel'); ?>">
          </form>
      </div>
      <div class="dt-sc-hr-invisible"></div>
      
      <h2 class="section-title entry-title"><?php esc_html_e('Hotels in : ', 'trendytravel'); echo esc_attr($search_text); ?></h2><?php
	  $maxpages = ($the_query->max_num_pages != 0) ?  $the_query->max_num_pages : 1;	  
      echo '<p class="entry-result-count">'.esc_html__('Showing Results ', 'trendytravel').$the_query->query_vars['paged'].esc_html__(' of ', 'trendytravel').$maxpages.'</p>';
	  
	  $post_class = '';

	  $post_style = isset($post_style) ? $post_style : '';
	  # Filter Option
                if( $meta_set['hotels-filter'] == 'true' ) :
                    $post_class .= " all-sort";?>
                    <div class="dt-sc-hotel-sorting <?php echo esc_attr($post_style); ?>">
                        <a href="#" class="active-sort" title="<?php esc_html_e('Hotels Sorting','trendytravel'); ?>" data-filter=".all-sort"><?php esc_html_e('All','trendytravel'); ?> (<?php echo esc_attr($the_query->post_count); ?>)</a>
                        <?php foreach($cats as $term):
                        	$myterm = get_term_by('id', $term, 'hotel_entries'); ?>
                            <a href='#' data-filter=".<?php echo strtolower($myterm->slug); ?>-sort">
                                <?php echo esc_attr($myterm->name); ?> (<?php echo esc_attr($myterm->count); ?>)
                            </a>
                        <?php endforeach;?>
                     </div><?php
                endif;?>
     
     <div class="dt-sc-hotel-container"><div class="grid-sizer <?php echo esc_attr($post_class); ?>"></div><?php
		while($the_query->have_posts()): $the_query->the_post(); 
			$terms = wp_get_post_terms($post->ID, 'hotel_entries', array("fields" => "slugs")); array_walk($terms, "arr_strfun");
			
			$new_sort_value = array();

			for($i = 0; $i < count($terms); $i++) {
				array_push($new_sort_value, $terms[$i]."-sort");
			}

			$hotel_meta = array();
			$hotel_meta = get_post_meta(get_the_id() ,'_hotel_settings', true); ?>
			<div class="<?php echo esc_attr($li_class)." ".strtolower(implode(" ", $new_sort_value))." all-sort"; ?>">
                <div class="hotel-item hotel-list-view">
                    <div class="hotel-thumb">
                    	<div class="thumb-wrapper">
							<?php if(array_key_exists("offer_value", $hotel_meta)): ?>
                                <p class="hotel-offer"><span><?php echo (($hotel_meta['offer_value'])); ?></span></p>
                            <?php endif; ?>
                             <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php
                                if( has_post_thumbnail() ):
                                    $attr = array('title' => get_the_title()); the_post_thumbnail($feature_image, $attr);
                                endif; ?>
                                <div class="image-overlay"><span class="image-overlay-inside"></span></div>
                             </a>
						</div>
                        <p>
                           <?php if(array_key_exists("show-book-now", $hotel_meta) && cs_get_option('disable-hotel-booking') == 1): ?>
                              <a data-title="<?php the_title(); ?>" href="#booknow_wrapper" class="dt-sc-button theme-btn too-small btn-book"><?php esc_html_e('Book Now', 'trendytravel'); ?></a>
                          <?php elseif(array_key_exists("show-book-now", $hotel_meta)): ?>
                              <a href="<?php echo trendytravel_get_page_permalink_by_its_template('tpl-booking.php'); ?>" class="dt-sc-button theme-btn too-small"><?php esc_html_e('Book Now', 'trendytravel'); ?></a>
                          <?php endif; ?>
                          <a href="<?php the_permalink(); ?>" class="dt-sc-button too-small yellow"><?php esc_html_e('View Details', 'trendytravel'); ?></a>
                        </p>
                    </div>
                    <div class="hotel-details">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?>, <sub><?php echo esc_attr($hotel_meta['hotel_add']); ?></sub></a></h2><?php
						echo get_the_term_list($post->ID, 'hotel_entries', '<p class="hotel-type">', ' ', '</p>');
						
						if(isset($meta_set['hotel-post-excerpt']) && $meta_set['hotel-post-excerpt']!= ""){
							echo trendytravel_excerpt($meta_set['hotel-post-excerpt-length']);
						}

						//RATING CALCULATION...
						$arr_rate = trendytravel_comment_rating_count(get_the_ID());
						$all_avg = trendytravel_comment_rating_average(get_the_ID());

						echo '<div class="star-rating-wrapper"><div class="star-rating"><span style="width:'.(($all_avg/5)*100).'%"></span></div>('.count($arr_rate).esc_html__(' Ratings', 'trendytravel').')</div>'; ?>

						<a href="<?php the_permalink(); ?>#hotel_map_<?php the_ID(); ?>" class="map-marker small"> <span class="red"></span><?php esc_html_e('View on Map', 'trendytravel'); ?></a><?php
						if(array_key_exists("starting_price", $hotel_meta)):?>
                            <div class="hotel-thumb-meta">
                                <div class="hotel-price"><?php esc_html_e('Starts From', 'trendytravel'); ?> <span><?php echo cs_get_option("smodule").$hotel_meta['starting_price'] ; ?></span></div>
                                <?php if(array_key_exists("specially_whome", $hotel_meta)): ?>
                                    <span class="hotel-option-type">
                                        <a href="<?php the_permalink(); ?>"><?php echo wp_kses($hotel_meta['specially_whome'], $dt_allowed_html_tags); ?></a>
                                    </span><?php
								endif; ?>
                            </div><?php
						endif; ?>
                    </div>
                </div>
	        </div><?php
		endwhile; ?>
     </div>
     <div style="display:none;">
         <div id="booknow_wrapper" class="booknow-container">
            <div id="ajax_message"> </div>
            <form name="frmbooknow" class="booknow-frm" action="<?php echo TRENDYTRAVEL_THEME_URI; ?>/framework/booknow.php" method="post">
                <p><input type="text" name="txtfname" required="required" placeholder="<?php esc_attr_e('Name (required)', 'trendytravel'); ?>" /></p>
                <p><input type="email" name="txtemail" required="required" placeholder="<?php esc_attr_e('Email [required]', 'trendytravel'); ?>" /></p>
                <p><input type="text" name="txtdate" required="required" placeholder="<?php esc_attr_e('Date of Arrival (required)', 'trendytravel'); ?>" /></p>
                <p><input type="text" name="txtphone" placeholder="<?php esc_attr_e('Phone', 'trendytravel'); ?>" /></p>
                <p><textarea name="txtmessage" rows="3" cols="32" placeholder="<?php esc_attr_e('Message', 'trendytravel'); ?>"></textarea></p>
                <p><input type="submit" name="subsend" value="<?php esc_attr_e('Send', 'trendytravel'); ?>" /></p>
                <input type="hidden" name="hidbookadminemail" value="<?php echo get_bloginfo('admin_email'); ?>" />
                <input type="hidden" name="hidbooksuccess" value="<?php esc_attr_e('Thanks for Booking us, We will call back to you soon.', 'trendytravel'); ?>" />
                <input type="hidden" name="hidbookerror" value="<?php esc_attr_e('Sorry your message not sent, Try again Later.', 'trendytravel'); ?>" />
                <input type="hidden" id="hidhotelname" name="hidhotelname" />
                <input type="hidden" id="booknowwpnonce" name="booknowwpnonce" value="<?php echo wp_create_nonce('booknow-nonce'); ?>" />
            </form>
         </div>
	 </div><?php
	 //Check maximum no.of pages...
	 if($the_query->max_num_pages > 1): ?>
		<div class="pagination blog-pagination">
			<?php if(function_exists("trendytravel_pagination")) echo trendytravel_pagination("", $the_query->max_num_pages, $the_query); ?>
		</div><?php
	 endif;
	 wp_reset_postdata();
	 else: ?>
		<h2><?php esc_html_e('Nothing Found.', 'trendytravel'); ?></h2>
		<p><?php esc_html_e('Apologies, but no results were found for the requested archive.', 'trendytravel'); ?></p><?php
	endif; ?>