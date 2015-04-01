<div class="tool-box">

	<h3 class="title"><?php _e('Export Product Variations CSV', 'wc_csv_import'); ?></h3>
	<p><?php _e('Export your product variations using this tool. This exported CSV will be in an importable format.', 'wc_csv_import'); ?></p>
	<p class="description"><?php _e('Click export to save your products variations to your computer.', 'wc_csv_import'); ?></p>

	<form action="<?php echo admin_url('admin.php?page=woocommerce_csv_import_suite&action=export_variations'); ?>" method="post">

		<table class="form-table">
			<tr>
				<th>
					<label for="limit"><?php _e( 'Limit', 'wc_csv_import' ); ?></label>
				</th>
				<td>
					<input type="text" name="limit" id="limit" placeholder="<?php _e('Unlimited', 'wc_csv_import'); ?>" class="input-text" />
				</td>
			</tr>
			<tr>
				<th>
					<label for="offset"><?php _e( 'Offset', 'wc_csv_import' ); ?></label>
				</th>
				<td>
					<input type="text" name="offset" id="offset" placeholder="<?php _e('0', 'wc_csv_import'); ?>" class="input-text" />
				</td>
			</tr>
			<tr>
				<th>
					<label for="product"><?php _e( 'Limit to parent ID(s)', 'wc_csv_import' ); ?></label>
				</th>
				<td>
					<input type="text" name="product_limit" id="product_limit" placeholder="<?php _e( 'N/A', 'wc_csv_import' ); ?>" class="input-text" /> <span class="description"><?php _e( 'Comma separate IDs', 'wc_csv_import' ); ?></span>
				</td>
			</tr>
			<tr>
				<th>
					<label for="columns"><?php _e( 'Columns', 'wc_csv_import' ); ?></label>
				</th>
				<td>
					<select id="columns" name="columns[]" data-placeholder="<?php _e('All Columns', 'wc_csv_import'); ?>" class="chosen_select" multiple="multiple">
						<?php
							foreach ( $variation_columns as $key => $column ) {
								echo '<option value="'.$key.'">'.$column.'</option>';
							}
							echo '<option value="images">'.__('Images (featured and gallery)', 'wc_csv_import').'</option>';
							echo '<option value="taxonomies">'.__('Taxonomies (cat/tags/shipping-class)', 'wc_csv_import').'</option>';
							echo '<option value="meta">'.__('Meta (custom fields)', 'wc_csv_import').'</option>';
						?>
						</select>
				</td>
			</tr>
			<tr>
				<th>
					<label for="v_include_hidden_meta"><?php _e( 'Include hidden meta data', 'wc_csv_import' ); ?></label>
				</th>
				<td>
					<input type="checkbox" name="include_hidden_meta" id="v_include_hidden_meta" class="checkbox" />
				</td>
			</tr>
		</table>

		<p class="submit"><input type="submit" class="button" value="<?php _e('Export Variations', 'wc_csv_import'); ?>" /></p>

	</form>
</div>