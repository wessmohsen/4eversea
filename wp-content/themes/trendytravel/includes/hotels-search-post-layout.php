<?php
	//PERFORMING HOTELS POST LAYOUT...
	$meta_set = get_post_meta($post->ID, '_tpl_default_settings', true);
	/*if($GLOBALS['force_enable'] == true)
	  $page_layout = $GLOBALS['page_layout'];
	else*/
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
	
	global $dt_allowed_html_tags;
	//PERFORMING QUERY...
	if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
	elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
	else { $paged = 1; }
	
	$hotels = array(
		'post_type' => 'dt_hotels',
		'paged' => $paged,
		'tax_query' => array(),
		'meta_query' => array(),
		'order_by' => 'published');
		
	if(isset($_REQUEST['txthotelname']) && ($_REQUEST['txthotelname'] !== "")):
		$hotels['s'] = wp_kses($_REQUEST['txthotelname'], $dt_allowed_html_tags);
	endif;		

	if(isset($_REQUEST['cmbcat']) && ($_REQUEST['cmbcat'] !== "")):
		$hotels_type_id = get_term_by('slug',$_REQUEST['cmbcat'],'hotel_entries',ARRAY_A);
		$hotels_type_id = is_array( $hotels_type_id ) ? $hotels_type_id['term_id'] : "";

		$hotels['tax_query'][] = array( 'taxonomy' => 'hotel_entries',
			'field' => 'id',
			'terms' => $hotels_type_id,
			'operator' => 'IN',);
	endif;
	
	if(isset($_REQUEST['cmbcity']) && ($_REQUEST['cmbcity'] !== "")):
		$hotels_city_id = get_term_by('slug',$_REQUEST['cmbcity'],'hotel_locations',ARRAY_A);
		$hotels_city_id = is_array( $hotels_city_id ) ? $hotels_city_id['term_id'] : "";

		$hotels['tax_query'][] = array( 'taxonomy' => 'hotel_locations',
			'field' => 'id',
			'terms' => $hotels_city_id,
			'operator' => 'IN',);
	endif;
	
	if(isset($_REQUEST['cmboffers']) && ($_REQUEST['cmboffers'] !== "")):
		$hotels['meta_query'][] = array(
			'key'     => '_hotel_settings',
			'value'   => $_REQUEST['cmboffers'],
			'compare' => 'LIKE',);
	endif;
	
	$minprice = $_REQUEST['cmbminprice'];
	$maxprice = $_REQUEST['cmbmaxprice'];
	
	if(!empty($minprice) && !empty($maxprice)):
		$hotels['meta_query'][] = array(
			'key'     => 'starting_price',
			'value' => array( $minprice, $maxprice ),
			'type' => 'numeric',
			'compare' => 'BETWEEN',);
			
	elseif(!empty($minprice) && empty($maxprice)):
		$hotels['meta_query'][] = array(
			'key'     => 'starting_price',
			'value' => $minprice,
			'type' => 'numeric',
			'compare' => '>=',);

	elseif(empty($minprice) && !empty($maxprice)):
		$hotels['meta_query'][] = array(
			'key'     => 'starting_price',
			'value' => $maxprice,
			'type' => 'numeric',
			'compare' => '<=',);

	endif;

	//MAKING QUERY...
	$the_query = new WP_Query($hotels);
	if($the_query->have_posts()): ?>
    
      <h2 class="section-title entry-title"><?php esc_html_e('Hotels in : ', 'trendytravel'); echo esc_attr($_REQUEST['txthotelname']); ?></h2><?php
	  $maxpages = ($the_query->max_num_pages != 0) ?  $the_query->max_num_pages : 1;	  
      echo '<p class="entry-result-count">'.esc_html__('Showing Results ', 'trendytravel').$the_query->query_vars['paged'].esc_html__(' of ', 'trendytravel').$maxpages.'</p>'; ?>
     
     <div class="dt-sc-hotels-container"><?php
		while($the_query->have_posts()): $the_query->the_post();
			$hotel_meta = array(); 
			$hotel_meta = get_post_meta(get_the_id() ,'_hotel_settings', true); ?>
			<div class="<?php echo esc_attr($li_class); ?>">
                <div class="hotel-item hotel-list-view">
                    <div class="hotel-thumb">
                    	<div class="thumb-wrapper">
							<?php if(array_key_exists("offer_value", $hotel_meta)): ?>
                                <p class="hotel-offer"><span><?php echo wp_kses($hotel_meta['offer_value'], $dt_allowed_html_tags); ?></span></p>
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
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?>, <sub><?php echo wp_kses($hotel_meta['hotel_add'], $dt_allowed_html_tags); ?></sub></a></h2><?php
                        echo get_the_term_list($post->ID, 'hotel_entries', '<p class="hotel-type">', ' ', '</p>');
						
						echo trendytravel_excerpt(30);

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