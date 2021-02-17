<?php
if(!function_exists('dt_theme_hb_order_page')) {
	function dt_theme_hb_order_page() {
		
		if(isset($_REQUEST['delete']) == 'Delete') {
			
			$oids = $_REQUEST['order'];
			if($oids != ""):
				$orders = get_option('hb_order_settings');
				foreach($oids as $oid):
					unset($orders[$oid]);
				endforeach;
				update_option('hb_order_settings', $orders);
				
				$text = esc_html__('Orders deleted.', 'trendytravel');
			endif;			
		} ?>
		
		<div id="wrapper" class="wrap">
			<h2><?php esc_html_e('Hotels Order Details', 'trendytravel'); ?></h2>
			<?php if(!empty($text)) echo '<div class="updated settings-error" id="setting-error-settings_updated"><p><strong>'.$text.'</strong></p></div>'; ?>
			
			<form method="post" action="" class="dt-sort-table" style="margin-top:20px;">
				<label for="quicksearch"><?php esc_html_e('Submitted Orders', 'trendytravel'); ?>: </label><input type="text" id="quicksearch" name="quicksearch" placeholder="<?php esc_html_e('Type to search', 'trendytravel'); ?>..." />
				<table class="wp-list-table widefat fixed tablesorter dt-sc-tbl-orders" style="width:100%" cellspacing="1">
					<thead>
						<tr>
							<th class="manage-column column-cb check-column" id="cb" scope="col">
								<label for="cb-select-all-1" class="screen-reader-text"><?php esc_html_e('Select All', 'trendytravel'); ?></label>
								<input type="checkbox" id="cb-select-all-1">
							</th>
							<th scope="col"><span><?php esc_html_e('Payer ID', 'trendytravel'); ?></span></th>
							<th scope="col"><span><?php esc_html_e('First Name', 'trendytravel'); ?></span></th>
							<th scope="col"><span><?php esc_html_e('Last Name', 'trendytravel'); ?></span></th>
							<th scope="col"><span><?php esc_html_e('Email', 'trendytravel'); ?></span></th>
							<th scope="col" style="width:6%;"><span><?php esc_html_e('Country', 'trendytravel'); ?></span></th>
							<th scope="col" style="width:6%;"><span><?php esc_html_e('Amount', 'trendytravel'); ?></span></th>
							<th scope="col"><span><?php esc_html_e('Hotel', 'trendytravel'); ?></span></th>
							<th scope="col"><span><?php esc_html_e('Room', 'trendytravel'); ?></span></th>
							<th scope="col"><span><?php esc_html_e('Service IDs', 'trendytravel'); ?></span></th>
							<th scope="col"><span><?php esc_html_e('Check In', 'trendytravel'); ?></span></th>
							<th scope="col"><span><?php esc_html_e('Check Out', 'trendytravel'); ?></span></th>
							<th scope="col" style="width:6%;"><span><?php esc_html_e('Adults', 'trendytravel'); ?></span></th>
							<th scope="col" style="width:6%;"><span><?php esc_html_e('Childs', 'trendytravel'); ?></span></th>
							<th scope="col" style="width:6%;"><span><?php esc_html_e('Deposit (%)', 'trendytravel'); ?></span></th>
							<th scope="col" style="width:6%;"><span><?php esc_html_e('Net Amount', 'trendytravel'); ?></span></th>
						</tr>
					</thead>
					<tbody data-wp-lists="list:service" id="the-list">
					<?php
						$order_details = get_option('hb_order_settings');
						if($order_details != NULL):
							foreach($order_details as $key => $order): ?>
								<tr class="alternate">
									<th class="check-column" scope="row">
										<label for="cb-select-<?php echo esc_attr($key); ?>" class="screen-reader-text"><?php esc_html_e('Select Order', 'trendytravel'); ?></label>
										<input type="checkbox" value="<?php echo esc_attr($key); ?>" class="administrator" id="order_<?php echo esc_attr($key); ?>" name="order[]">
									</th>
									<td><?php echo esc_attr($order['Payer_ID']); ?></td>
									<td><?php echo esc_attr($order['First_Name']); ?></td>
									<td><?php echo esc_attr($order['Last_Name']); ?></td>
									<td><?php echo esc_attr($order['Email']); ?></td>
									<td><?php echo esc_attr($order['Country']); ?></td>
									<td><?php echo esc_attr($order['Amount']); ?></td>
									<td><?php echo get_the_title($order['Hotel_ID']); ?></td>
									<td><?php echo get_the_title($order['Room_ID']); ?></td>
									<td><?php echo esc_attr($order['Service_IDs']); ?></td>
									<td><?php echo esc_attr($order['Check_In']); ?></td>
									<td><?php echo esc_attr($order['Check_Out']); ?></td>
									<td><?php echo esc_attr($order['Adults']); ?></td>
									<td><?php echo esc_attr($order['Childs']); ?></td>
									<td><?php echo esc_attr($order['Deposit_Due']); ?></td>
									<td><?php echo esc_attr($order['Net_Amount']); ?></td>
								</tr><?php
							endforeach;
						else:
							?><tr class="no-items"><td colspan="16" class="colspanchange"><?php esc_html_e('No Orders found.', 'trendytravel'); ?></td></tr><?php
						endif; ?>
					</tbody>
				</table>
				<p class="submit"><input type="submit" value="<?php esc_attr_e('Delete', 'trendytravel'); ?>" class="button button-primary" id="delete" name="delete"></p>
				<div id="pager" class="dt-theme-pager">
					<a href="#" class="first"></a>
					<a href="#" class="prev"></a>
					<input type="text" class="pagedisplay"/>
					<a href="#" class="next"></a>
					<a href="#" class="last"></a>
					<select class="pagesize">
						<option selected="selected"  value="5">5</option>
						<option value="10">10</option>
						<option value="20">20</option>
						<option value="30">30</option>
						<option  value="40">40</option>
					</select>
				</div>
			</form>
		</div>
		<?php
	}
}?>