<?php	global $dt_allowed_html_tags; 
     $li_class = isset($li_class) ? $li_class : '';
	if(have_posts()): ?>
     <div class="dt-sc-hotels-container"><?php
		while(have_posts()): the_post();
			$hotel_meta = get_post_meta($post->ID ,'_hotel_settings', true); ?>
			<div class="<?php echo esc_attr($li_class); ?>">
                <div class="hotel-item hotel-list-view">
                    <div class="hotel-thumb">
                    	<div class="thumb-wrapper">
							<?php if(@array_key_exists("offer_value", $hotel_meta)): ?>
                                <p class="hotel-offer"><span><?php echo wp_kses(@$hotel_meta['offer_value'], $dt_allowed_html_tags); ?></span></p>
                            <?php endif; ?>
                             <a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php
                                if( has_post_thumbnail() ):
                                    $attr = array('title' => get_the_title()); the_post_thumbnail($feature_image, $attr);
                                endif; ?>
                                <div class="image-overlay"><span class="image-overlay-inside"></span></div>
                             </a>
                        </div>
                        <p>
						  <?php if(@array_key_exists("show-book-now", $hotel_meta) && cs_get_option('disable-hotel-booking') == 1): ?>
                              <a data-title="<?php the_title(); ?>" href="#booknow_wrapper" class="dt-sc-button theme-btn too-small btn-book"><?php _e('Book Now', 'designthemes-core'); ?></a>
                          <?php elseif(@array_key_exists("show-book-now", $hotel_meta)): ?>
                              <a href="<?php echo trendytravel_get_page_permalink_by_its_template('tpl-booking.php'); ?>" class="dt-sc-button theme-btn too-small"><?php _e('Book Now', 'designthemes-core'); ?></a>
                          <?php endif; ?>
                          <a href="<?php the_permalink();?>" class="dt-sc-button too-small yellow"><?php _e('View Details', 'designthemes-core'); ?></a>
						</p> 
                    </div>
                    <div class="hotel-details">
                        <h2><a href="<?php the_permalink();?>"><?php the_title(); ?>, <sub><?php echo wp_kses($hotel_meta['hotel_add'], $dt_allowed_html_tags);?></sub></a></h2><?php
                        echo get_the_term_list($post->ID, 'hotel_entries', '<p class="hotel-type">', ' ', '</p>');

						echo trendytravel_excerpt(30);

						//RATING CALCULATION...
						//RATING CALCULATION...
						$arr_rate = trendytravel_comment_rating_count(get_the_ID());
						$all_avg = trendytravel_comment_rating_average(get_the_ID());

						echo '<div class="star-rating-wrapper"><div class="star-rating"><span style="width:'.(($all_avg/5)*100).'%"></span></div>('.count($arr_rate).__(' Ratings', 'designthemes-core').')</div>'; ?>

						<a href="<?php the_permalink(); ?>#hotel_map_<?php the_ID(); ?>" class="map-marker small"> <span class="red"></span><?php _e('View on Map', 'designthemes-core'); ?></a><?php
						if(array_key_exists("starting_price", $hotel_meta)):?>
                            <div class="hotel-thumb-meta">
                                <div class="hotel-price"><?php _e('Starts From', 'designthemes-core'); ?> <span><?php echo cs_get_option("smodule").$hotel_meta['starting_price'] ; ?></span></div>
                                <?php if(@array_key_exists("specially_whome", $hotel_meta)): ?>
                                    <span class="hotel-option-type">
                                        <a href="<?php the_permalink();?>"><?php echo wp_kses($hotel_meta['specially_whome'], $dt_allowed_html_tags); ?></a>
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
                <p><input type="text" name="txtfname" required="required" placeholder="<?php _e('Name (required)', 'designthemes-core'); ?>" /></p>
                <p><input type="email" name="txtemail" required="required" placeholder="<?php _e('Email (required)', 'designthemes-core'); ?>" /></p>
                <p><input type="text" name="txtdate" required="required" placeholder="<?php _e('Date of Arrival (required)', 'designthemes-core'); ?>" /></p>
                <p><input type="text" name="txtphone" placeholder="<?php _e('Phone', 'designthemes-core'); ?>" /></p>
                <p><textarea name="txtmessage" rows="3" cols="32" placeholder="<?php _e('Message', 'designthemes-core'); ?>"></textarea></p>
                <p><input type="submit" name="subsend" value="<?php _e('Send', 'designthemes-core'); ?>" /></p>
                <input type="hidden" name="hidbookadminemail" value="<?php echo get_bloginfo('admin_email'); ?>" />
                <input type="hidden" name="hidbooksuccess" value="<?php _e('Thanks for Booking us, We will call back to you soon.', 'designthemes-core'); ?>" />
                <input type="hidden" name="hidbookerror" value="<?php _e('Sorry your message not sent, Try again Later.', 'designthemes-core'); ?>" />
				<input type="hidden" id="hidhotelname" name="hidhotelname" />
            </form>
         </div>
	 </div><?php
	 //Check maximum no.of pages...
	 if($wp_query->max_num_pages > 1): ?>
		<div class="pagination blog-pagination">
			<?php if(function_exists("trendytravel_pagination")) echo trendytravel_pagination("", $wp_query->max_num_pages, $wp_query); ?>
		</div><?php
	 endif;
	 wp_reset_query();
	 else: ?>
		<h2><?php _e('Nothing Found.', 'designthemes-core'); ?></h2>
		<p><?php _e('Apologies, but no results were found for the requested archive.', 'designthemes-core'); ?></p><?php
	endif; ?>