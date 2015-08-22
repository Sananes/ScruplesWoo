<?php
/**
 *	Laborator 1 Click Demo Content Importer
 *
 *	Developed by: Arlind Nushi
 *	URL: www.laborator.co
 */


?>
<div class="wrap" id="lab_demo_content_container">
	<h2 id="main-title">1-Click Demo Content Installer</h2>
	<p class="description">Choose the demo content pack to install in this copy of WordPress installation. We recommend to install only one demo content pack per WordPress installation. This process is irreversible!</p>

	<ul class="demo-content-packs">
	<?php
	foreach(lab_1cl_demo_installer_get_packs() as $pack):

		extract($pack);

		?>
		<li>
			<div class="pack-entry">
				<img src="<?php echo $lab_demo_content_url . $thumb; ?>" />

				<div class="pack-details">
					<h3><?php echo $name; ?></h3>

					<?php if($desc): ?>
					<p><?php echo nl2br($desc); ?></p>
					<?php endif; ?>

					<a href="<?php echo admin_url("admin.php?page=laborator_demo_content_installer&install-pack=" . sanitize_title($name)) . '&#038;TB_iframe=true&#038;width=780&#038;height=550'; ?>" title="Demo Content Pack &raquo; <?php echo esc_attr($name); ?>" class="button button-primary thickbox">Install Content Pack</a>
				</div>
			</div>
		</li>
		<?php

	endforeach;
	?>
	</ul>

	<hr />
	<div class="footer-copyrights">
		&copy; This plugin is developed by <a href="http://laborator.co">Laborator</a>
	</div>
</div>