<div class="wrap">
	<div class="greybox bintro">
		<h2>SuperCacher for WordPress by <?php echo '<img height="25" src="' . plugins_url( '../css/sglogo.jpg' , __FILE__ ) . '" > ';?></h2>		
		<p>The SuperCacher is a system that allows you to use dynamic cache powered by Varnish and Memcached to optimize the performance of your WordPress. In order to take advantage of the system you should have the SuperCacher enabled at your web host plus the required cache options turned on below. For more information on the different caching options refer to the <a href="http://www.siteground.com/tutorials/supercacher/" target="_blank">SuperCacher Tutorial</a>! </p>
	</div>
	
	<div class="clrfl"></div>

	<div class="greybox">
		<h2 class="sgheading">Dynamic Cache Settings</h2>
		<div class="greybox bvarnish">
			<div class="toggles">
				<p class="butlabel">Dynamic Cache <a href="" id="sg-cachepress-dynamic-cache-toggle" class="<?php  if ( $this->options_handler->get_option('enable_cache') ==1 ) echo 'toggleon'; else echo 'toggleoff'; ?>"></a></p>
			</div>
			<small class="howto" id="sg-cachepress-dynamic-cache-text">Enable the Varnish-powered Dynamic caching system</small>
			<small class="howto" id="sg-cachepress-dynamic-cache-error" class="error"></small>
		</div>

		<div class="greybox bautoflush">
			<div class="toggles">
				<p class="butlabel">AutoFlush Cache <a href="" id="sg-cachepress-autoflush-cache-toggle" class="<?php  if ( $this->options_handler->get_option('autoflush_cache') ==1 ) echo 'toggleon'; else echo 'toggleoff'; ?>"></a></p>
			</div>
			<small class="howto" id="sg-cachepress-autoflush-cache-text">Automatically flush the Dynamic cache when you edit your content</small>
			<small class="howto" id="sg-cachepress-autoflush-cache-error" class="error"></small>
		</div>
		
		<div class="greybox bpurge">
			<div class="pbut">
				<form class="purgebtn" method="post" action="<?php menu_page_url( 'sg-cachepress-purge' ); ?>">
					<?php submit_button( __( 'Purge the Cache', 'sg-cachepress' ), 'primary', 'sg-cachepress-purge', false );?>
				</form>
			</div>
			<small class="howto">This  button will purge all the data cached by the Static and Dynamic cache.</small>
		</div>

		<div class="clrfl"></div>	
	
		<div class="greybox blist">
			<h3 class="sgheading">Exclude URLs from Dynamic caching</h3>
			<small class="howto">Provide a list of your website's URLs you would like to exclude from the cache. For example if you'd like to exclude: <strong>http://domain.com/path/to/url</strong><br>
			You can provide only a part of the URL. If you input the "path" string part of the URL, then each URL that consists of it will be excluded. Divide each URL by a new line.</small>
			<form method="post" action="<?php menu_page_url( 'sg-cachepress-purge' ); ?>">
				<textarea id="sg-cachepress-blacklist-textarea" style="width:100%;height:150px"><?php  echo esc_textarea($this->options_handler->get_blacklist()); ?></textarea>
				<?php submit_button( __( 'Update the Exclude List', 'sg-cachepress' ), 'primary', 'sg-cachepress-blacklist', false );
				echo ' <img id="sg-cachepress-spinner-blacklist" class="ajax-feedback" src="' . esc_url( admin_url( 'images/wpspin_light.gif' ) ) . '" alt="" />';?>
			</form>
			
		</div>
	</div>

	<div class="clrfl"></div>
	
	<div class="greybox bmem">
		<h2 class="sgheading">Memcached Settings</h2>
		<div class="mtext">
			<p id="sg-cachepress-memcached-text">Enable Memcached</p>
			<p id="sg-cachepress-memcached-error" class="memerror"></p>
		</div>
		<div class="mbut">
			<div class="toggles">
				<a href="" id="sg-cachepress-memcached-toggle" class="<?php  if ( $this->options_handler->get_option('enable_memcached') ==1 ) echo 'toggleon'; else echo 'toggleoff'; ?>"></a>
			</div>
		</div>
		<div class="clrfl"></div>
		<small class="howto">Store in the server's memory frequently executed queries to the database for a faster access on a later use.</small>
	</div>
</div>