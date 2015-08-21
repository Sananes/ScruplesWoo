<?php
/**
 *	Laborator 1 Click Demo Content Importer
 *
 *	Version: 1.1
 *
 *	Developed by: Arlind Nushi
 *	URL: www.laborator.co
 */

define("LAB_1CL_DEMO_INSTALLER_PATH", str_replace(ABSPATH, '', dirname(__FILE__) . '/'));
define("LAB_1CL_DEMO_INSTALLER_STYLESHEET", site_url(LAB_1CL_DEMO_INSTALLER_PATH . 'demo-content-importer.css'));

# Get Demo Content Packs
function lab_1cl_demo_installer_get_packs()
{
	return array(
		array(
			# Pack Info
			'name'           => 'Oxygen Main Demo',
			'desc'           => 'This pack will install the main demo website of Oxygen theme including all theme features.',

			# Pack Data
			'thumb'          => 'demo-content/main-demo/screenshot.png',
			'file'           => 'demo-content/main-demo/content.xml',
			'options'        => 'demo-content/main-demo/options.json',
			'revslider'      => 'demo-content/main-demo/revslider.zip',
			'custom_css'     => '',
		),
		
		array(
			# Pack Info
			'name'           => 'Oxygen Minimal Demo',
			'desc'           => 'This pack will install the minimal demo content of Oxygen theme.',

			# Pack Data
			'thumb'          => 'demo-content/minimal-demo/screenshot.png',
			'file'           => 'demo-content/minimal-demo/content.xml',
			'options'        => 'demo-content/minimal-demo/options.json',
			'revslider'      => 'demo-content/minimal-demo/revslider.zip',
			'custom_css'     => 'demo-content/minimal-demo/css.json'
		),
	);
}


# Importer Page
add_action('admin_menu', 'lab_1cl_demo_installer_menu');

function lab_1cl_demo_installer_menu()
{
	wp_register_style('lab-1cl-demo-installer', LAB_1CL_DEMO_INSTALLER_STYLESHEET);
	wp_enqueue_style('lab-1cl-demo-installer');
	
	add_submenu_page('laborator_options', '1-Click Demo Content Installer', 'Demo Content Install', 'edit_theme_options', 'laborator_demo_content_installer', 'lab_1cl_demo_installer_page');
}

function lab_1cl_demo_installer_page()
{
	
	# Change Media Download Status
	if(isset($_POST['lab_change_media_status']))
	{
		update_option('lab_1cl_demo_installer_download_media', post('lab_1cl_demo_installer_download_media') ? true : false);
	}

	$lab_demo_content_url = site_url(str_replace(ABSPATH, '', dirname(__FILE__)) . '/');

	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

	include 'demo-content-page.php';
}


function lab_1cl_demo_installer_get_pack($name)
{
	foreach(lab_1cl_demo_installer_get_packs() as $pack)
	{
		if(sanitize_title($pack['name']) == $name)
		{
			return $pack;
		}
	}

	return null;
}


# Import Content Pack
add_action('admin_init', 'lab_1cl_demo_installer_admin_init');

function lab_1cl_demo_installer_admin_init()
{
	if(get('page') == 'laborator_demo_content_installer' && ($pack_name = get('install-pack')))
	{
		$pack = lab_1cl_demo_installer_get_pack($pack_name);

		if($pack)
		{
			if(is_plugin_active('wordpress-importer/wordpress-importer.php'))
			{
				deactivate_plugins(array('wordpress-importer/wordpress-importer.php'));
				update_option('lab_should_activate_wp_importer', true);

				wp_redirect(admin_url('admin.php?page=laborator_demo_content_installer&install-pack="' . sanitize_title($pack_name)));
				exit;
			}

			require 'demo-content-install-pack.php';

			die();
		}
	}
}


# Save Custom CSS Options
function lab_1cl_demo_installer_custom_css_save($custom_css_vars)
{
	foreach($custom_css_vars as $var_name => $value)
	{
		update_option($var_name, $value);
	}
}


# Get Packpage Contents to Install
function lab_1cl_demo_installer_pack_content_types($pack)
{
	$active_plugins = apply_filters('active_plugins', get_option('active_plugins'));
	
	$full_path = ABSPATH . LAB_1CL_DEMO_INSTALLER_PATH;
	$content_packs = array();
	
	# WP Content
	if(isset($pack['file']) && $pack['file'])
	{
		$xml_file_size = '';//filesize($full_path . $pack['file']);
		
		$file_content_pack = array(
			'type'           => 'xml-wp-content',
			'title'          => 'WordPress Content',
			'description'    => 'This will import posts, pages, comments, custom fields, terms, navigation menus and custom posts.',
			'checked'		 => isset($pack['file_checked']) ? $pack['file_checked'] : true,
			'requires'		 => array(),
			'size'           => size_format($xml_file_size, 2)
		);
		
		if(isset($pack['requires']) && is_array($pack['requires']) && count($pack['requires']))
		{
			# Portfolio Post Type Plugin
			if(in_array('portfolio-post-type', $pack['requires']))
			{
				if( ! in_array('portfolio-post-type/portfolio-post-type.php', $active_plugins))
				{
					$file_content_pack['checked'] = false;
					$file_content_pack['disabled'] = true;
					$file_content_pack['requires']['portfolio-post-type'] = 'This content pack includes portfolio items which requires Portfolio Post Type plugin, to install it go to <a href="'.esc_url(admin_url("themes.php?page=tgmpa-install-plugins")).'" target="_blank">Appearance &raquo; Install Plugins</a> and then refresh this page.';
				}
			}
		}
		
		$content_packs[] = $file_content_pack;
		
		# Download Media Attachments
		if( ! isset($file_content_pack['disabled']))
		{
			$content_packs[] = array(
				'type'           => 'xml-wp-download-media',
				'title'          => 'Media Files',
				'description'    => 'This will download all media files presented in this demo content pack. Note: Images are in grey format.',
				'checked'		 => $file_content_pack['checked'],
				'requires'		 => array(),
				'size'           => ''
			);
		}
	}
	
	# Theme Options
	if(isset($pack['options']) && $pack['options'])
	{
		$theme_options_size = filesize($full_path . $pack['options']);
		
		$content_packs[] = array(
			'type'           => 'theme-options',
			'title'          => 'Theme Options',
			'description'    => 'This will import theme options and will rewrite all existing settings in Appearance &raquo; Theme Options.',
			'checked'		 => isset($pack['options_checked']) ? $pack['options_checked'] : true,
			'requires'		 => array(),
			'size'           => size_format($theme_options_size, 2)
		);
	}
	
	# Custom CSS
	if(isset($pack['custom_css']) && $pack['custom_css'])
	{
		$custom_css_size = filesize($full_path . $pack['custom_css']);
		
		$content_packs[] = array(
			'type'           => 'custom-css',
			'title'          => 'Custom CSS',
			'description'    => 'This content pack contains custom styling which can be later accessed in <a href="'.esc_url(admin_url("admin.php?page=laborator_custom_css")).'" target="_blank">Custom CSS</a>.',
			'checked'		 => isset($pack['custom_css_checked']) ? $pack['custom_css_checked'] : true,
			'requires'		 => array(),
			'size'           => size_format($custom_css_size, 2)
		);
	}
	
	# Revolution Slider
	if(isset($pack['revslider']) && $pack['revslider'])
	{
		$revslider_size = filesize($full_path . $pack['revslider']);
		$revslider_activated = in_array('revslider/revslider.php', $active_plugins);
		
		$content_packs[] = array(
			'type'           => 'revslider',
			'title'          => 'Revolution Slider',
			'description'    => 'This will import all sliders presented in demo site of this content package.',
			'checked'		 => $revslider_activated ? (isset($pack['revslider_checked']) ? $pack['revslider_checked'] : true) : false,
			'disabled'		 => ! $revslider_activated,
			'requires'		 => array(
				'revslider' => 'To import Revolution Slider content you must install and activate this plugin in <a href="'.esc_url(admin_url("themes.php?page=tgmpa-install-plugins")).'" target="_blank">Appearance &raquo; Install Plugins</a> and then refresh this page.'
			),
			'size'           => size_format($revslider_size, 2)
		);
	}
	
	# Layer Slider
	if(isset($pack['layerslider']) && $pack['layerslider'])
	{
		$layerslider_size = filesize($full_path . $pack['layerslider']);
		$layerslider_activated = in_array('LayerSlider/layerslider.php', $active_plugins);
		
		$content_packs[] = array(
			'type'           => 'layerslider',
			'title'          => 'Layer Slider',
			'description'    => 'This will import all sliders presented in demo site of this content package.',
			'checked'		 => $layerslider_activated ? (isset($pack['layerslider_checked']) ? $pack['layerslider_checked'] : true) : false,
			'disabled'		 => ! $layerslider_activated,
			'requires'		 => array(
				'layerslider' => 'To import Layer Slider content you must install and activate this plugin in <a href="'.esc_url(admin_url("themes.php?page=tgmpa-install-plugins")).'" target="_blank">Appearance &raquo; Install Plugins</a> and then refresh this page.'
			),
			'size'           => size_format($layerslider_size, 2)
		);
	}
	
	return $content_packs;
}


# Import Content Pack
add_action('wp_ajax_lab_1cl_demo_install_package_content', 'lab_1cl_demo_install_package_content');

function lab_1cl_demo_install_package_content()
{
	$resp = array(
		'success' => false,
		'errorMsg' => ''
	);
	
	$pack_name = $_POST['pack'];
	$source_details = $_POST['contentSourceDetails'];
	
	$pack = lab_1cl_demo_installer_get_pack($pack_name);
	
	# Content Source Install by Type
	switch($source_details['type'])
	{
		case "xml-wp-content":
		
			# Run wordpress importer independently
			if( ! defined("WP_LOAD_IMPORTERS"))
			{
				define("WP_LOAD_IMPORTERS", true);
				require dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'wordpress-importer/wordpress-importer.php';
			}
			
			# Demo Content File (XML)
			$xml_file = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . $pack['file'];

			try {			
				set_time_limit(0);
	
				$wp_importer = new WP_Import();
				
				$wp_importer->fetch_attachments = isset($source_details['downloadMedia']) && $source_details['downloadMedia'];
				$wp_importer->id = sanitize_title($pack['name']);
				
				ob_start();
				$wp_importer->import($xml_file);
				$content = ob_get_clean();
				
				$resp['imp'] = $wp_importer;
				$resp['success'] = true;
			}
			catch(Exception $e)
			{
				$resp['errorMsg'] = $e;
			}
			
			break;
		
		case "theme-options":
			
			$theme_options = dirname(__FILE__) . DIRECTORY_SEPARATOR . $pack['options'];
			
			try
			{	
				if($theme_options = file_get_contents($theme_options))
				{
					$smof_data = unserialize(base64_decode($theme_options));
					of_save_options($smof_data);
					
					$resp['success'] = true;
				}
				else
				{
					$resp['errorMsg'] = 'Invalid data serialization for Theme Options. Required format: Base64 Encoded';
				}
			}
			catch(Exception $e)
			{
				$resp['errorMsg'] = $e;
			}
			
			break;
		
		case "custom-css":
			
			$custom_css = $pack['custom_css'];
			
			if($custom_css)
			{
				$custom_css = dirname(__FILE__) . DIRECTORY_SEPARATOR . $custom_css;
			
				try {
					
					if($custom_css = file_get_contents($custom_css))
					{
						$custom_css_options = json_decode(base64_decode($custom_css));
						
						lab_1cl_demo_installer_custom_css_save($custom_css_options);
						
						$resp['success'] = true;
					}
				}
				catch(Exception $e)
				{
					$resp['errorMsg'] = $e;
				}
			}
			
			break;
		
		case "revslider":
		
			try
			{
				# Import Revolution Slider
				if($pack['revslider'] && class_exists('RevSlider'))
				{
					$revslider = dirname(__FILE__) . DIRECTORY_SEPARATOR . $pack['revslider'];
					
					$rev = new RevSlider();
					
					ob_start();
					$rev->importSliderFromPost(true, true, $revslider);
					$content = ob_get_clean();
					
					$resp['success'] = true;
				}
				else
				{
					$resp['errorMsg'] = 'Revolution Slider is not installed/activated and thus this content source couldn\'t be imported!';
				}
			}
			catch(Exception $e)
			{
				$resp['errorMsg'] = $e;
			}
			
			break;
		
		case "layerslider":
		
			try
			{
				# Import Layer Slider
				if($pack['layerslider'] && function_exists('ls_import_sliders'))
				{
					$layerslider = dirname(__FILE__) . DIRECTORY_SEPARATOR . $pack['layerslider'];
				
					include LS_ROOT_PATH . '/classes/class.ls.importutil.php';
				
					$import = new LS_ImportUtil($layerslider, basename($layerslider));
					
					$resp['success'] = true;
				}
				else
				{
					$resp['errorMsg'] = 'Layer Slider is not installed/activated and thus this content source couldn\'t be imported!';
				}
			}
			catch(Exception $e)
			{
				$resp['errorMsg'] = $e;
			}
			
			break;
	}
	
	
	echo json_encode($resp);
	die();
}