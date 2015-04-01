<form action="<?php echo admin_url( 'admin.php?import=' . $this->import_page . '&step=2&merge=' . $merge ); ?>" method="post">
	<?php wp_nonce_field( 'import-woocommerce' ); ?>
	<input type="hidden" name="import_id" value="<?php echo $this->id; ?>" />
	<?php if ( $this->file_url_import_enabled ) : ?>
	<input type="hidden" name="import_url" value="<?php echo $this->file_url; ?>" />
	<?php endif; ?>

	<h3><?php _e( 'Map Fields', 'wc_csv_import' ); ?></h3>
	<p><?php _e( 'Here you can map your imported columns to product data fields.', 'wc_csv_import' ); ?></p>

	<table class="widefat widefat_importer">
		<thead>
			<tr>
				<th><?php _e( 'Map to', 'wc_csv_import' ); ?></th>
				<th><?php _e( 'Column Header', 'wc_csv_import' ); ?></th>
				<th><?php _e( 'Example Column Value', 'wc_csv_import' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ( $row as $key => $value ) : ?>
			<tr>
				<td width="25%">
					<?php
						if ( strstr( $key, 'tax:' ) ) {

							$column = trim( str_replace( 'tax:', '', $key ) );
							printf(__('Taxonomy: <strong>%s</strong>', 'wc_csv_import'), $column);

						} elseif ( strstr( $key, 'meta:' ) ) {

							$column = trim( str_replace( 'meta:', '', $key ) );
							printf(__('Custom Field: <strong>%s</strong>', 'wc_csv_import'), $column);

						} elseif ( strstr( $key, 'attribute:' ) ) {

							$column = trim( str_replace( 'attribute:', '', $key ) );
							printf(__('Product Attribute: <strong>%s</strong>', 'wc_csv_import'), sanitize_title( $column ) );

						} elseif ( strstr( $key, 'attribute_data:' ) ) {

							$column = trim( str_replace( 'attribute_data:', '', $key ) );
							printf(__('Product Attribute Data: <strong>%s</strong>', 'wc_csv_import'), sanitize_title( $column ) );

						} elseif ( strstr( $key, 'attribute_default:' ) ) {

							$column = trim( str_replace( 'attribute_default:', '', $key ) );
							printf(__('Product Attribute default value: <strong>%s</strong>', 'wc_csv_import'), sanitize_title( $column ) );

						} else {
							?>
							<select name="map_to[<?php echo $key; ?>]">
								<option value=""><?php _e( 'Do not import', 'wc_csv_import' ); ?></option>
								<option value="import_as_images" <?php selected( $key, 'images' ); ?>><?php _e( 'Images/Gallery', 'wc_csv_import' ); ?></option>
								<option value="import_as_meta"><?php _e( 'Custom Field with column name', 'wc_csv_import' ); ?></option>
								<optgroup label="<?php _e( 'Taxonomies', 'wc_csv_import' ); ?>">
									<?php
										foreach ($taxonomies as $taxonomy ) {
											if ( substr( $taxonomy, 0, 3 ) == 'pa_' ) continue;
											echo '<option value="tax:' . $taxonomy . '" ' . selected( $key, 'tax:' . $taxonomy, true ) . '>' . $taxonomy . '</option>';
										}
									?>
								</optgroup>
								<optgroup label="<?php _e( 'Attributes', 'wc_csv_import' ); ?>">
									<?php
										foreach ($taxonomies as $taxonomy ) {
											if ( substr( $taxonomy, 0, 3 ) == 'pa_' )
												echo '<option value="attribute:' . $taxonomy . '" ' . selected( $key, 'attribute:' . $taxonomy, true ) . '>' . $taxonomy . '</option>';
										}
									?>
								</optgroup>
								<optgroup label="<?php _e( 'Map to parent (variations and grouped products)', 'wc_csv_import' ); ?>">
									<option value="post_parent" <?php selected( $key, 'post_parent' ); ?>><?php _e( 'By ID', 'wc_csv_import' ); ?>: post_parent</option>
									<option value="parent_sku" <?php selected( $key, 'parent_sku' ); ?>><?php _e( 'By SKU', 'wc_csv_import' ); ?>: parent_sku</option>
								</optgroup>
								<optgroup label="<?php _e( 'Post data', 'wc_csv_import' ); ?>">
									<option <?php selected( $key, 'post_id' ); selected( $key, 'id' ); ?>>post_id</option>
									<option <?php selected( $key, 'post_type' ); ?>>post_type</option>
									<option <?php selected( $key, 'menu_order' ); ?>>menu_order</option>
									<option <?php selected( $key, 'post_status' ); ?>>post_status</option>
									<option <?php selected( $key, 'post_title' ); ?>>post_title</option>
									<option <?php selected( $key, 'post_name' ); ?>>post_name</option>
									<option <?php selected( $key, 'post_date' ); ?>>post_date</option>
									<option <?php selected( $key, 'post_date_gmt' ); ?>>post_date_gmt</option>
									<option <?php selected( $key, 'post_content' ); ?>>post_content</option>
									<option <?php selected( $key, 'post_excerpt' ); ?>>post_excerpt</option>
									<option <?php selected( $key, 'post_author' ); ?>>post_author</option>
									<option <?php selected( $key, 'post_password' ); ?>>post_password</option>
									<option <?php selected( $key, 'comment_status' ); ?>>comment_status</option>
								</optgroup>
								<optgroup label="<?php _e( 'Product data', 'wc_csv_import' ); ?>">
									<option value="tax:product_type" <?php selected( $key, 'tax:product_type' ); ?>><?php _e( 'Type', 'wc_csv_import' ); ?>: product_type</option>
									<option value="downloadable" <?php selected( $key, 'downloadable' ); ?>><?php _e( 'Type', 'wc_csv_import' ); ?>: downloadable</option>
									<option value="virtual" <?php selected( $key, 'virtual' ); ?>><?php _e( 'Type', 'wc_csv_import' ); ?>: virtual</option>
									<option value="sku" <?php selected( $key, 'sku' ); ?>><?php _e( 'SKU', 'wc_csv_import' ); ?>: sku</option>
									<option value="visibility" <?php selected( $key, 'visibility' ); ?>><?php _e( 'Visibility', 'wc_csv_import' ); ?>: visibility</option>
									<option value="featured" <?php selected( $key, 'featured' ); ?>><?php _e( 'Visibility', 'wc_csv_import' ); ?>: featured</option>
									<option value="stock" <?php selected( $key, 'stock' ); ?>><?php _e( 'Inventory', 'wc_csv_import' ); ?>: stock</option>
									<option value="stock_status" <?php selected( $key, 'stock_status' ); ?>><?php _e( 'Inventory', 'wc_csv_import' ); ?>: stock_status</option>
									<option value="backorders" <?php selected( $key, 'backorders' ); ?>><?php _e( 'Inventory', 'wc_csv_import' ); ?>: backorders</option>
									<option value="manage_stock" <?php selected( $key, 'manage_stock' ); ?>><?php _e( 'Inventory', 'wc_csv_import' ); ?>: manage_stock</option>
									<option value="regular_price" <?php selected( $key, 'regular_price' ); ?>><?php _e( 'Price', 'wc_csv_import' ); ?>: regular_price</option>
									<option value="sale_price" <?php selected( $key, 'sale_price' ); ?>><?php _e( 'Price', 'wc_csv_import' ); ?>: sale_price</option>
									<option value="sale_price_dates_from" <?php selected( $key, 'sale_price_dates_from' ); ?>><?php _e( 'Price', 'wc_csv_import' ); ?>: sale_price_dates_from</option>
									<option value="sale_price_dates_to" <?php selected( $key, 'sale_price_dates_to' ); ?>><?php _e( 'Price', 'wc_csv_import' ); ?>: sale_price_dates_to</option>
									<option value="weight" <?php selected( $key, 'weight' ); ?>><?php _e( 'Dimensions', 'wc_csv_import' ); ?>: weight</option>
									<option value="length" <?php selected( $key, 'length' ); ?>><?php _e( 'Dimensions', 'wc_csv_import' ); ?>: length</option>
									<option value="width" <?php selected( $key, 'width' ); ?>><?php _e( 'Dimensions', 'wc_csv_import' ); ?>: width</option>
									<option value="height" <?php selected( $key, 'height' ); ?>><?php _e( 'Dimensions', 'wc_csv_import' ); ?>: height</option>
									<option value="tax_status" <?php selected( $key, 'tax_status' ); ?>><?php _e( 'Tax', 'wc_csv_import' ); ?>: tax_status</option>
									<option value="tax_class" <?php selected( $key, 'tax_class' ); ?>><?php _e( 'Tax', 'wc_csv_import' ); ?>: tax_class</option>
									<option value="upsell_ids" <?php selected( $key, 'upsell_ids' ); ?>><?php _e( 'Related Products', 'wc_csv_import' ); ?>: upsell_ids</option>
									<option value="crosssell_ids" <?php selected( $key, 'crosssell_ids' ); ?>><?php _e( 'Related Products', 'wc_csv_import' ); ?>: crosssell_ids</option>
									<option value="upsell_skus" <?php selected( $key, 'upsell_skus' ); ?>><?php _e( 'Related Products', 'wc_csv_import' ); ?>: upsell_skus</option>
									<option value="crosssell_skus" <?php selected( $key, 'crosssell_skus' ); ?>><?php _e( 'Related Products', 'wc_csv_import' ); ?>: crosssell_skus</option>
									<option value="file_paths" <?php selected( $key, 'file_paths' ); ?>><?php _e( 'Downloads', 'wc_csv_import' ); ?>: file_paths <?php _e( '(WC 2.0.x)', 'wc_csv_import' ); ?></option>
									<option value="downloadable_files" <?php selected( $key, 'downloadable_files' ); ?>><?php _e( 'Downloads', 'wc_csv_import' ); ?>: downloadable_files <?php _e( '(WC 2.1.x)', 'wc_csv_import' ); ?></option>
									<option value="download_limit" <?php selected( $key, 'download_limit' ); ?>><?php _e( 'Downloads', 'wc_csv_import' ); ?>: download_limit</option>
									<option value="download_expiry" <?php selected( $key, 'download_expiry' ); ?>><?php _e( 'Downloads', 'wc_csv_import' ); ?>: download_expiry</option>
									<option value="product_url" <?php selected( $key, 'product_url' ); ?>><?php _e( 'External', 'wc_csv_import' ); ?>: product_url</option>
									<option value="button_text" <?php selected( $key, 'button_text' ); ?>><?php _e( 'External', 'wc_csv_import' ); ?>: button_text</option>
									<?php do_action( 'woocommerce_csv_product_data_mapping', $key ); ?>
								</optgroup>
								<?php if( function_exists( 'woocommerce_gpf_install' ) ) : ?>
								<optgroup label="<?php _e( 'Google Product Feed', 'wc_csv_import' ); ?>">
									<option value="gpf:availability" <?php selected( $key, 'gpf:availability' ); ?>><?php _e('Availability', 'wc_csv_import' ); ?></option>
									<option value="gpf:condition" <?php selected( $key, 'gpf:condition' ); ?>><?php _e('Condition', 'wc_csv_import' ); ?></option>
									<option value="gpf:brand" <?php selected( $key, 'gpf:brand' ); ?>><?php _e('Brand', 'wc_csv_import' ); ?></option>
									<option value="gpf:product_type" <?php selected( $key, 'gpf:product_type' ); ?>><?php _e('Product Type', 'wc_csv_import' ); ?></option>
									<option value="gpf:google_product_category" <?php selected( $key, 'gpf:google_product_category' ); ?>><?php _e('Google Product Category', 'wc_csv_import' ); ?></option>
									<option value="gpf:gtin" <?php selected( $key, 'gpf:gtin' ); ?>><?php _e('Global Trade Item Number (GTIN)', 'wc_csv_import' ); ?></option>
									<option value="gpf:mpn" <?php selected( $key, 'gpf:mpn' ); ?>><?php _e('Manufacturer Part Number (MPN)', 'wc_csv_import' ); ?></option>
									<option value="gpf:gender" <?php selected( $key, 'gpf:gender' ); ?>><?php _e('Gender', 'wc_csv_import' ); ?></option>
									<option value="gpf:age_group" <?php selected( $key, 'gpf:age_group' ); ?>><?php _e('Age Group', 'wc_csv_import' ); ?></option>
									<option value="gpf:color" <?php selected( $key, 'gpf:color' ); ?>><?php _e('Color', 'wc_csv_import' ); ?></option>
									<option value="gpf:size" <?php selected( $key, 'gpf:size' ); ?>><?php _e('Size', 'wc_csv_import' ); ?></option>
									<option value="gpf:adwords_grouping" <?php selected( $key, 'gpf:adwords_grouping' ); ?>><?php _e('adwords_grouping', 'wc_csv_import' ); ?></option>
									<option value="gpf:adwords_labels" <?php selected( $key, 'gpf:adwords_labels' ); ?>><?php _e('adwords_labels', 'wc_csv_import' ); ?></option>
								</optgroup>
								<?php endif; ?>
							</select>
							<?php
						}
					?>
				</td>
				<td width="25%"><?php echo $raw_headers[$key]; ?></td>
				<td><code><?php if ( $value != '' ) echo esc_html( $value ); else echo '-'; ?></code></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

	<p class="submit">
		<input type="submit" class="button" value="<?php esc_attr_e( 'Submit', 'wc_csv_import' ); ?>" />
		<input type="hidden" name="delimiter" value="<?php echo $this->delimiter ?>" />
		<input type="hidden" name="merge_empty_cells" value="<?php echo $this->merge_empty_cells ?>" />
	</p>
</form>