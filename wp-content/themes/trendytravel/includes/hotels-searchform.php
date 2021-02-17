<?php
$smodule = cs_get_option("smodule"); global $dt_allowed_html_tags;
$search_options = array();

$search_options['hotel-title'] = cs_get_option("hotel-title");
$search_options['packages-title'] = cs_get_option("packages-title");
$search_options['places-title'] = cs_get_option("places-title");
$search_options['disable-hotels-tab'] = cs_get_option("disable-hotels-tab");
$search_options['enable-title-module-for-hotels'] = cs_get_option("enable-title-module-for-hotels");
$search_options['enable-location-for-hotels'] = cs_get_option("enable-location-for-hotels");
$search_options['enable-type-module-for-hotels'] = cs_get_option("enable-type-module-for-hotels");
$search_options['enable-min-price-for-hotels'] = cs_get_option("enable-min-price-for-hotels");
$search_options['min-price-for-hotels'] = cs_get_option("min-price-for-hotels");
$search_options['enable-max-price-for-hotels'] = cs_get_option("enable-max-price-for-hotels");
$search_options['max-price-for-hotels'] = cs_get_option("max-price-for-hotels");
$search_options['enable-offer-for-hotels'] = cs_get_option("enable-offer-for-hotels");
$search_options['disable-packages-tab'] = cs_get_option("disable-packages-tab");
$search_options['enable-title-module-for-packages'] = cs_get_option("enable-title-module-for-packages");
$search_options['enable-location-for-packages'] = cs_get_option("enable-location-for-packages");
$search_options['location-for-packages'] = cs_get_option("location-for-packages");
$search_options['enable-type-module-for-packages'] = cs_get_option("enable-type-module-for-packages");
$search_options['enable-min-price-for-packages'] = cs_get_option("enable-min-price-for-packages");
$search_options['min-price-for-packages'] = cs_get_option("min-price-for-packages");
$search_options['enable-max-price-for-packages'] = cs_get_option("enable-max-price-for-packages");
$search_options['max-price-for-packages'] = cs_get_option("max-price-for-packages");
$search_options['enable-persons-for-packages'] = cs_get_option("enable-persons-for-packages");
$search_options['persons-for-packages'] = cs_get_option("persons-for-packages");
$search_options['disable-places-tab'] = cs_get_option("disable-places-tab");
$search_options['enable-title-module-for-places'] = cs_get_option("enable-title-module-for-places");
$search_options['enable-location-for-places'] = cs_get_option("enable-location-for-places");
$search_options['location-for-places'] = cs_get_option("location-for-places");
$search_options['enable-type-module-for-places'] = cs_get_option("enable-type-module-for-places");
$search_options = array_filter($search_options); ?>

<div class="search-container type2">
    <div class="dt-sc-tabs-horizontal-frame-container ">
        <ul class="dt-sc-tabs-horizontal-frame"><?php
		
        	if(!array_key_exists("disable-hotels-tab", $search_options )): ?>
	            <li><a href="#"><?php echo !empty($search_options['hotel-title']) ? wp_kses($search_options['hotel-title'], $dt_allowed_html_tags) : esc_html__('Hotels', 'trendytravel'); ?></a></li><?php
            endif;
			if(!array_key_exists("disable-packages-tab", $search_options )): ?>
				<li><a href="#"><?php echo !empty($search_options['packages-title']) ? wp_kses($search_options['packages-title'], $dt_allowed_html_tags) : esc_html__('Packages', 'trendytravel'); ?></a></li><?php
            endif;
			if(!array_key_exists("disable-places-tab", $search_options )): ?>
				<li><a href="#"><?php echo !empty($search_options['places-title']) ? wp_kses($search_options['places-title'], $dt_allowed_html_tags) : esc_html__('Places', 'trendytravel'); ?></a></li><?php
            endif; ?>
        </ul>

		<?php if(!array_key_exists("disable-hotels-tab", $search_options )): ?>
            <div class="dt-sc-tabs-horizontal-frame-content"><?php
                //Hotels Search Module...
                $action = trendytravel_get_page_permalink_by_its_template('tpl-hotels-search.php'); ?>
                <form name="frmhotelsearch" action="<?php echo esc_url($action); ?>" method="post"><?php
    
                    if(array_key_exists("enable-title-module-for-hotels", $search_options )): ?>
                        <p><input type="text" name="txthotelname" placeholder="<?php esc_attr_e('Type Hotel name here...', 'trendytravel'); ?>" /></p><?php
                    endif;
                    
                    if(array_key_exists("enable-location-for-hotels", $search_options )): ?>
                        <p><select name="cmbcity">
                            <option value=""><?php esc_html_e('Choose City', 'trendytravel'); ?></option><?php
                            $hotel_locations = get_categories("taxonomy=hotel_locations&hide_empty=1");
                            foreach ( $hotel_locations as $hotel_location ) {
                                $id = esc_attr( $hotel_location->slug );
                                $title = esc_html( $hotel_location->name );
                                $selected = "";
                                echo  "<option value='{$id}' {$selected} >{$title}</option>";
                            } ?>
                        </select></p><?php
                    endif;
                    
                    if(array_key_exists("enable-type-module-for-hotels", $search_options )): ?>
                        <p><select name="cmbcat">
                            <option value=""><?php esc_html_e('Choose Category', 'trendytravel'); ?></option><?php
                            $hotel_types = get_categories("taxonomy=hotel_entries&hide_empty=1");
                            foreach ( $hotel_types as $hotel_type ) {
                                $id = esc_attr( $hotel_type->slug );
                                $title = esc_html( $hotel_type->name );
                                $selected = "";
                                echo  "<option value='{$id}' {$selected} >{$title}</option>";
                            } ?>
                        </select></p><?php
                    endif;
                    
                    if(array_key_exists("enable-min-price-for-hotels", $search_options )): ?>
                        <p class="select-price"><select name="cmbminprice">
                            <option value=""><?php esc_html_e('Min Price', 'trendytravel'); ?></option><?php
                                $min_prices = cs_get_option("min-price-for-hotels");
								$min_price_final = array();
								foreach($min_prices as $min_prices_array)
								{
									foreach($min_prices_array as $min_prices_val)	
									{
										array_push($min_price_final, $min_prices_val);
									}    
								}
								
                                foreach ( $min_price_final as $min_price_all ) {
                                    $selected = "";
                                    echo  "<option value='{$min_price_all}' {$selected} >{$min_price_all}</option>";
                                } ?>
                        </select></p><?php
                    endif;
                    
                    if(array_key_exists("enable-max-price-for-hotels", $search_options )): ?>
                        <p class="select-price price-last"><select name="cmbmaxprice">
                            <option value=""><?php esc_html_e('Max Price', 'trendytravel'); ?></option><?php
                                $max_prices = cs_get_option("max-price-for-hotels");
								$max_price_final = array();
								foreach($max_prices as $max_prices_array)
								{
									foreach($max_prices_array as $max_prices_val)	
									{
										array_push($max_price_final, $max_prices_val);
									}    
								}
								
                                foreach ( $max_price_final as $max_price_all ) {
                                    $selected = "";
                                    echo  "<option value='{$max_price_all}' {$selected} >{$max_price_all}</option>";
                                } ?>
                        </select></p><?php
                    endif;
                    
                    if(array_key_exists("enable-offer-for-hotels", $search_options )): ?>
                        <p><select name="cmboffers">
                            <option value=""><?php esc_html_e('Choose Offer', 'trendytravel'); ?></option><?php
								$hoteloffers = cs_get_option("offer-for-hotels");
								$offers = array();
								foreach($hoteloffers as $array)
								{
									foreach($array as $val)	
									{
										array_push($offers, $val);
									}    
								}
								
                                foreach ( $offers as $offer ) {
                                    $selected = "";
                                    echo  "<option value='{$offer}' {$selected} >{$offer}</option>";
                                } ?>
                        </select></p><?php
                    endif; ?>
                    <input name="subsearch" type="submit" value="<?php echo !empty($search_options['hotel-title']) ? esc_attr($search_options['hotel-title']) : esc_attr__('Find Hotels', 'trendytravel'); ?>" />
                </form>
            </div><?php
		endif;
		if(!array_key_exists("disable-packages-tab", $search_options )): ?>
            <div class="dt-sc-tabs-horizontal-frame-content"><?php
                //Packages Search Module...
                $action = trendytravel_get_page_permalink_by_its_template('tpl-packages-search.php'); ?>
                <form name="frmpackagesearch" action="<?php echo esc_url($action); ?>" method="post"><?php
    
                    if(array_key_exists("enable-title-module-for-packages", $search_options )): ?>
                        <p><input type="text" name="txtpackagename" placeholder="<?php esc_attr_e('Type Package name here...', 'trendytravel'); ?>" /></p><?php
                    endif;
                    
                    if(array_key_exists("enable-location-for-packages", $search_options )): ?>
                        <p><select name="cmbcity">
                            <option value=""><?php esc_html_e('Choose City', 'trendytravel'); ?></option><?php
                                $package_cities = cs_get_option("location-for-packages");
								$package_cities_final = array();
								foreach($package_cities as $package_cities_array)
								{
									foreach($package_cities_array as $package_cities_val)	
									{
										array_push($package_cities_final, $package_cities_val);
									}    
								}
								
                                foreach ( $package_cities_final as $package_cities_all ) {
                                    $selected = "";
                                    echo  "<option value='{$package_cities_all}' {$selected} >{$package_cities_all}</option>";
                                } ?>
                        </select>
                        </p><?php
                    endif;
                    
                    if(array_key_exists("enable-type-module-for-packages", $search_options )): ?>
                        <p><select name="cmbcat">
                            <option value=""><?php esc_html_e('Choose Category', 'trendytravel'); ?></option><?php
                            $package_types = get_categories("taxonomy=product_cat&hide_empty=1");
                            foreach ( $package_types as $package_type ) {
                                $id = esc_attr( $package_type->slug );
                                $title = esc_html( $package_type->name );
                                $selected = "";
                                echo  "<option value='{$id}' {$selected} >{$title}</option>";
                            } ?>
                        </select></p><?php
                    endif;
                    
                    if(array_key_exists("enable-min-price-for-packages", $search_options )): ?>
                        <p class="select-price"><select name="cmbminprice">
                            <option value=""><?php esc_html_e('Min Price', 'trendytravel'); ?></option><?php
                                $min_prices = cs_get_option("min-price-for-packages");
								$min_price_final = array();
								foreach($min_prices as $min_prices_array)
								{
									foreach($min_prices_array as $min_prices_val)	
									{
										array_push($min_price_final, $min_prices_val);
									}    
								}
								
                                foreach ( $min_price_final as $min_price_all ) {
                                    $selected = "";
                                    echo  "<option value='{$min_price_all}' {$selected} >{$min_price_all}</option>";
                                } ?>
                        </select>
                        
                        </p><?php
                    endif;
                    
                    if(array_key_exists("enable-max-price-for-packages", $search_options )): ?>
                        <p class="select-price price-last"><select name="cmbmaxprice">
                            <option value=""><?php esc_html_e('Max Price', 'trendytravel'); ?></option><?php
                                $max_prices = cs_get_option("max-price-for-packages");
								$max_price_final = array();
								foreach($max_prices as $max_prices_array)
								{
									foreach($max_prices_array as $max_prices_val)	
									{
										array_push($max_price_final, $max_prices_val);
									}    
								}
								
                                foreach ( $max_price_final as $max_price_all ) {
                                    $selected = "";
                                    echo  "<option value='{$max_price_all}' {$selected} >{$max_price_all}</option>";
                                } ?>
                        </select></p><?php
                    endif;
                    
                    if(array_key_exists("enable-persons-for-packages", $search_options )): ?>
                        <p><select name="cmbmaxprice">
                            <option value=""><?php esc_html_e('Choose No.of Persons', 'trendytravel'); ?></option><?php
                                $persons = cs_get_option("persons-for-packages");
								$persons_final = array();
								foreach($persons as $persons_array)
								{
									foreach($persons_array as $persons_val)	
									{
										array_push($persons_final, $persons_val);
									}    
								}
								
                                foreach ( $persons_final as $persons_all ) {
                                    $selected = "";
                                    echo  "<option value='{$persons_all}' {$selected} >{$persons_all}</option>";
                                } ?>
                        </select></p><?php
                    endif; ?>
                    <input name="subsearch" type="submit" value="<?php echo !empty($search_options['packages-title']) ? esc_attr($search_options['packages-title']) : esc_attr__('Find Packages', 'trendytravel'); ?>" />
                </form>
            </div><?php
		endif;
		if(!array_key_exists("disable-places-tab", $search_options )): ?>			
            <div class="dt-sc-tabs-horizontal-frame-content"><?php
                //Places Search Module...
                $action = trendytravel_get_page_permalink_by_its_template('tpl-places-search.php'); ?>
                <form name="frmplacesearch" action="<?php echo esc_url($action); ?>" method="post"><?php
    
                    if(array_key_exists("enable-title-module-for-places", $search_options )): ?>
                        <p><input type="text" name="txtplacename" placeholder="<?php esc_attr_e('Type Place name here...', 'trendytravel'); ?>" /></p><?php
                    endif;
                    
                    if(array_key_exists("enable-location-for-places", $search_options )): ?>
                        <p>
                        
                        <select name="cmbcity">
                            <option value=""><?php esc_html_e('Choose City', 'trendytravel'); ?></option><?php
                                $package_cities = cs_get_option("location-for-places");
								$package_cities_final = array();
								foreach($package_cities as $package_cities_array)
								{
									foreach($package_cities_array as $package_cities_val)	
									{
										array_push($package_cities_final, $package_cities_val);
									}    
								}
								
                                foreach ( $package_cities_final as $package_cities_all ) {
                                    $selected = "";
                                    echo  "<option value='{$package_cities_all}' {$selected} >{$package_cities_all}</option>";
                                } ?>
                        </select></p><?php
                    endif;
                    
                    if(array_key_exists("enable-type-module-for-places", $search_options )): ?>
                        <p><select name="cmbcat">
                            <option value=""><?php esc_html_e('Choose Category', 'trendytravel'); ?></option><?php
                            $place_types = get_categories("taxonomy=place_entries&hide_empty=1");
                            foreach ( $place_types as $place_type ) {
                                $id = esc_attr( $place_type->slug );
                                $title = esc_html( $place_type->name );
                                $selected = "";
                                echo  "<option value='{$id}' {$selected} >{$title}</option>";
                            } ?>
                        </select></p><?php
                    endif; ?>
                    <input name="subsearch" type="submit" value="<?php echo !empty($search_options['places-title']) ? esc_attr($search_options['places-title']) : esc_attr__('Find Places', 'trendytravel'); ?>" />
                </form>
            </div><?php
		endif; ?>	
    </div>
</div>