<?php
	//PERFORMING PLACES POST LAYOUT...
	
	$page_layout = cs_get_option('places-archives-page-layout');
	$post_layout = cs_get_option('places-archives-post-layout');
		
	$li_class = "";
	$column = $args = "";
	
	//POST LAYOUT SWITCH...
	switch($post_layout) {
		case "one-half-column":
			$li_class = "column dt-sc-one-half"; $column = 2; break;

		case "one-third-column":
			$li_class = "column dt-sc-one-third"; $column = 3; break;

		case "one-fourth-column":
			$li_class = "column dt-sc-one-fourth"; $column = 4; break;
	}
	//BETTER IMAGE SIZE...
	switch($page_layout) {
		case "with-left-sidebar":
			$li_class = $li_class." with-sidebar";
			break;
		
		case "with-right-sidebar":
			$li_class = $li_class." with-sidebar";
			break;

		case "with-both-sidebar":
			$li_class = $li_class." with-sidebar";
			break;
	}
	
	global $dt_allowed_html_tags;
	if(have_posts()): $i = 1; ?>
      <div class="dt-sc-places-container"><?php
        while(have_posts()): the_post();
            $temp_class = "";
            if($i == 1) $temp_class = $li_class." first"; else $temp_class = $li_class;
            if($i == $column) $i = 1; else $i = $i + 1;
            $place_meta = get_post_meta(get_the_id() ,'_place_settings', true); ?>            
            <div class="<?php echo esc_attr($temp_class); ?>">
                <div id="post-<?php the_ID(); ?>" <?php post_class('place-item'); ?>>
                    <div class="place-thumb"><?php
                        if( has_post_thumbnail() ): ?>
                            <a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php
                                $attr = array('title' => get_the_title()); the_post_thumbnail('places-threecol', $attr); ?>
                                <div class="image-overlay"><span class="image-overlay-inside"></span></div>
                            </a><?php
                        endif; ?>
                    </div>
                    <div class="place-detail-wrapper">
                        <div class="place-title">
                            <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                            <p><?php echo wp_kses(@$place_meta['place_add'], $dt_allowed_html_tags);?></p>
                        </div>
                        <div class="place-content">
                            <a class="map-marker" href="<?php the_permalink(); ?>#place_map_<?php the_ID(); ?>"> <span class="red"></span><?php _e('View on Map', 'designthemes-core'); ?></a>
                            <a class="dt-sc-button too-small" href="<?php the_permalink(); ?>"><?php _e('View details', 'designthemes-core'); ?></a>
                        </div>
                    </div>
                </div>
            </div><?php
        endwhile; ?>
      </div><?php
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