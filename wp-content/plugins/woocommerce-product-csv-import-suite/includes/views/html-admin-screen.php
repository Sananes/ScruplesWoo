<div class="wrap woocommerce">
	<div class="icon32" id="icon-woocommerce-importer"><br></div>
    <h2 class="nav-tab-wrapper woo-nav-tab-wrapper">
        <a href="<?php echo admin_url('admin.php?page=woocommerce_csv_import_suite') ?>" class="nav-tab <?php echo ($tab == 'import') ? 'nav-tab-active' : ''; ?>"><?php _e('Import Products', 'wc_csv_import'); ?></a><a href="<?php echo admin_url('admin.php?page=woocommerce_csv_import_suite&tab=export') ?>" class="nav-tab <?php echo ($tab == 'export') ? 'nav-tab-active' : ''; ?>"><?php _e('Export Products', 'wc_csv_import'); ?></a>
    </h2>

	<?php
		switch ($tab) {
			case "export" :
				$this->admin_export_page();
			break;
			default :
				$this->admin_import_page();
			break;
		}
	?>
</div>
<script type="text/javascript">
	jQuery("select.chosen_select").chosen();
</script>