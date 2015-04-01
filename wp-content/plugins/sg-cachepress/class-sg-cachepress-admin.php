<?php
/**
 * SG CachePress
 *
 * @package   SG_CachePress
 * @author    SiteGround 
 * @author    George Penkov
 * @author    Gary Jones <gamajo@gamajo.com>
 * @link      http://www.siteground.com/
 * @copyright 2014 SiteGround
 */

/** SG CachePress purge cache admin class */

class SG_CachePress_Admin {

	/**
	 * Slug of the plugin screen.
	 *
	 * @since 1.1.0
	 *
	 * @var string
	 */
	protected $page_hook = null;

	/**
	 * Holds the options object
	 *
	 * @since 1.1.0
	 *
	 * @type SG_CachePress_Options
	 */
	protected $options_handler;

	/**
	 * Assign dependencies.
	 *
	 * @since 1.1.0
	 *
	 * @param SG_CachePress_Options $options_handler
	 */
	public function __construct( $options_handler ) {
		$this->options_handler = $options_handler;
	}

	/**
	 * Initialize the administration functions.
	 *
	 * @since 1.1.0
	 */
	public function run() {
		// Add the admin page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );

		// Load admin assets.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		// Ajax callback
		add_action( 'wp_ajax_sg-cachepress-purge', array( 'SG_CachePress_Supercacher', 'purge_cache' ) );
		add_action( 'wp_ajax_sg-cachepress-blacklist-update', array( $this, 'update_blacklist' ) );
		add_action( 'wp_ajax_sg-cachepress-parameter-update', array( $this, 'update_parameter' ) );
	}
	/**
	 * Updates a param from ajax request
	 *
	 * @since 1.1.0
	 */
	public function update_parameter() {
		$paramTranslator = array(
			'dynamic-cache' 	=> 'enable_cache',
			'memcached'			=> 'enable_memcached',
			'autoflush-cache'	=> 'autoflush_cache',
		);

		$paramName = $paramTranslator[$_POST['parameterName']];
		$currentValue = (int)$this->options_handler->get_option($paramName);
		$toggledValue = (int)!$currentValue;

		//if cache is turned on or off it's a good idea to flush it on right away
		if ($paramName == 'enable_cache') {
			global $sg_cachepress_supercacher;
			$sg_cachepress_supercacher->purge_cache();
		}

		if ($paramName == 'enable_memcached') {
			global $sg_cachepress_memcache;
			//check if we can actually enable memcached and display error if not
			if ($toggledValue == 1) {
				if (!$sg_cachepress_memcache->check_and_create_memcached_dropin())
					die( "Please, first enable Memcached from your cPanel!" );
			}
			else {
				if (!$sg_cachepress_memcache->remove_memcached_dropin())
					die( "Could not disable memcache!" );
			}
		}

		if ($this->options_handler->update_option($paramName,$toggledValue))
			die((string)$toggledValue);
		else
			die((string)$currentValue);
	}
	/**
	 * Updates the blacklist from ajax request
	 *
	 * @since 1.1.0
	 */
	public function update_blacklist() {
		die((int)$this->options_handler->update_option('blacklist',$_POST['blacklist']));
	}

	/**
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @since 1.1.0
	 */
	public function enqueue_admin_styles() {
		if ( ! isset( $this->page_hook ) )
			return;

		$screen = get_current_screen();
		if ( $screen->id == $this->page_hook )
			wp_enqueue_style( SG_CachePress::PLUGIN_SLUG . '-admin', plugins_url( 'css/admin.css', __FILE__ ), array(), SG_CachePress::VERSION );
	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since 1.1.0
	 *
	 * @return null Return early if no settings page is registered.
	 */
	public function enqueue_admin_scripts() {
		if ( ! isset( $this->page_hook ) )
			return;

		$screen = get_current_screen();
		if ( $screen->id == $this->page_hook ) {
			wp_enqueue_script( SG_CachePress::PLUGIN_SLUG . '-admin', plugins_url( 'js/admin.js', __FILE__ ), array( 'jquery' ), SG_CachePress::VERSION, true );
			$strings = array(
				'purge'   => __( 'Purge the Cache', 'sg-cachepress' ),
				'purging' => __( 'Purging, please wait...', 'sg-cachepress' ),
				'updating' => __( 'Updating, please wait...', 'sg-cachepress' ),
				'updated'  => __( 'Update the Exclude List' ),
				'purged'  => __( 'Successfully Purged', 'sg-cachepress' )
			);
			wp_localize_script( SG_CachePress::PLUGIN_SLUG . '-admin', 'sgCachePressL10n', $strings );
		}
	}

	/**
	 * Register the top level page into the WordPress admin menu.
	 *
	 * @since 1.1.0
	 */
	public function add_plugin_admin_menu() {
		$this->page_hook = add_menu_page(
			__( 'SuperCacher', 'sg-cachepress' ), // Page title
			__( 'SuperCacher', 'sg-cachepress' ),    // Menu item title
			'manage_options',
			SG_CachePress::PLUGIN_SLUG,   // Page slug
			array( $this, 'display_plugin_admin_page' ),
			plugins_url('sg-cachepress/css/sgicon.png')
		);
	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since 1.1.0
	 */
	public function display_plugin_admin_page() {
		include 'views/sg-cache.php';
	}
}
