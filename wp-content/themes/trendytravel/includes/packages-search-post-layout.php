<?php
	//PERFORMING PACKAGES POST LAYOUT...
	$meta_set = get_post_meta($post->ID, '_tpl_default_settings', true);
	/*if($GLOBALS['force_enable'] == true)
	  $page_layout = $GLOBALS['page_layout'];
	else*/
	  $page_layout = !empty($meta_set['layout']) ? $meta_set['layout'] : $GLOBALS['page_layout'];
	
	$div_class = "column dt-sc-one-fourth";
	$column = 4;
	
	global $dt_allowed_html_tags;
	//PERFORMING QUERY...
	if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
	elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
	else { $paged = 1; }
	
	$packages = array(
		'post_type' => 'product',
		'paged' => $paged,
		'tax_query' => array(),
		'meta_query' => array(),
		'order_by' => 'published');
		
	if(isset($_REQUEST['txtpackagename']) && ($_REQUEST['txtpackagename'] !== "")):
		$packages['s'] = wp_kses($_REQUEST['txtpackagename'], $dt_allowed_html_tags);
	endif;		

	if(isset($_REQUEST['cmbcat']) && ($_REQUEST['cmbcat'] !== "")):
		$packages_type_id = get_term_by('slug',$_REQUEST['cmbcat'],'product_cat',ARRAY_A);
		$packages_type_id = is_array( $packages_type_id ) ? $packages_type_id['term_id'] : "";

		$packages['tax_query'][] = array( 'taxonomy' => 'product_cat',
			'field' => 'id',
			'terms' => $packages_type_id,
			'operator' => 'IN',);
	endif;
	
	if(isset($_REQUEST['cmbcity']) && ($_REQUEST['cmbcity'] !== "")):
		$packages['meta_query'][] = array(
			'key'     => '_package_place',
			'value'   => $_REQUEST['cmbcity'],
			'compare' => 'LIKE',);
	endif;
	
	if(isset($_REQUEST['cmbpersons']) && ($_REQUEST['cmbpersons'] !== "")):
		$packages['meta_query'][] = array(
			'key'     => '_package_people',
			'value'   => $_REQUEST['cmbpersons'],
			'compare' => 'LIKE',);
	endif;
	
	$minprice = $_REQUEST['cmbminprice'];
	$maxprice = $_REQUEST['cmbmaxprice'];
	
	if(!empty($minprice) && !empty($maxprice)):
		$packages['meta_query'][] = array(
			'key'     => '_sale_price',
			'value' => array( $minprice, $maxprice ),
			'type' => 'numeric',
			'compare' => 'BETWEEN',);
			
	elseif(!empty($minprice) && empty($maxprice)):
		$packages['meta_query'][] = array(
			'key'     => '_sale_price',
			'value' => $minprice,
			'type' => 'numeric',
			'compare' => '>=',);

	elseif(empty($minprice) && !empty($maxprice)):
		$packages['meta_query'][] = array(
			'key'     => '_sale_price',
			'value' => $maxprice,
			'type' => 'numeric',
			'compare' => '<=',);

	endif;

	//MAKING QUERY...
	$the_query = new WP_Query($packages);
	if($the_query->have_posts()): $i = 1; ?>

      <h2 class="section-title entry-title"><?php esc_html_e('Packages in : ', 'trendytravel'); echo esc_attr($_REQUEST['txtpackagename']); ?></h2><?php
	  $maxpages = ($the_query->max_num_pages != 0) ?  $the_query->max_num_pages : 1;
      echo '<p class="entry-result-count">'.esc_html__('Showing Results ', 'trendytravel').$the_query->query_vars['paged'].esc_html__(' of ', 'trendytravel').$maxpages.'</p>'; ?>

     <div class="package-wrapper"><?php
		while($the_query->have_posts()): $the_query->the_post();
			$tclass = "";
			if($i == 1) $tclass = $div_class." first"; else $tclass = $div_class;
			if($i == $column) $i = 1; else $i = $i + 1; ?>            
			<div id="<?php echo get_the_ID(); ?>" class="<?php echo esc_attr($tclass); ?>">
                <div class="package-item"><?php
					if(has_post_thumbnail()): ?>
	                    <div class="package-thumb">
                           <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php $attr = array('title' => get_the_title()); the_post_thumbnail('full', $attr); ?></a>
                        </div><?php
					endif; ?>
                    <div class="package-details">
                        <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5><?php
						$city = get_post_meta(get_the_ID(), '_package_place', true);
						if(!empty($city))
							echo '<p>'.$city.'</p>'; ?>
                        <div class="package-content">
                        	<ul class="package-meta"><?php
                            	$days = get_post_meta(get_the_ID(), '_package_days_duration', true);
								if(!empty($days))
									echo '<li> <span class="fa fa-calendar"></span>'.esc_html__('No of Days:', 'trendytravel').' '.$days.' </li>';
								$people = get_post_meta(get_the_ID(), '_package_people', true);
								if(!empty($people))
									echo '<li> <span class="fa fa-user"></span>'.esc_html__('People:', 'trendytravel').' '.$people.' </li>'; ?>
							</ul><?php
							$sprice = get_post_meta(get_the_ID(), '_sale_price', true);
							if(!empty($sprice))
								echo '<span class="package-price">'.get_woocommerce_currency_symbol().$sprice.'</span>'; ?>
							<a href="<?php the_permalink(); ?>" class="dt-sc-button too-small"><?php esc_html_e('View details', 'trendytravel'); ?></a>
						</div>
                    </div>
                </div>
	        </div><?php
		endwhile; ?>
     </div><?php
	 //Check maximum no.of pages...
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