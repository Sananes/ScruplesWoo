<?php

$iconsParams = vc_map_integrate_shortcode( 'vc_icon', 'i_', '',
	array(
		'include_only_regex' => '/^(type|icon_\w*)/',
		// we need only type, icon_fontawesome, icon_.., NOT color and etc
	), array(
		'element' => 'add_icon',
		'value' => 'true',
	)
);

$params = array_merge(
	array(
		array(
			'type' => 'textfield',
			'param_name' => 'title',
			'heading' => __( 'Title', 'js_composer' ),
			'description' => __( 'Enter section title (Note: you can leave it empty).', 'js_composer' ),
		),
		array(
			'type' => 'el_id',
			'param_name' => 'tab_id',
			'settings' => array(
				'auto_generate' => true,
			),
			'heading' => __( 'Section ID', 'js_composer' ),
			'description' => __( 'Enter section ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'js_composer' ),
		),
		array(
			'type' => 'checkbox',
			'param_name' => 'add_icon',
			'heading' => __( 'Add icon?', 'js_composer' ),
			'description' => __( 'Add icon next to section title.', 'js_composer' ),
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'i_position',
			'value' => array(
				__( 'Before title', 'js_composer' ) => 'left',
				__( 'After title', 'js_composer' ) => 'right',
			),
			'dependency' => array(
				'element' => 'add_icon',
				'value' => 'true',
			),
			'heading' => __( 'Icon position', 'js_composer' ),
			'description' => __( 'Select icon position.', 'js_composer' ),
		),
	),
	$iconsParams,
	array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	)
);
vc_map( array(
	'name' => __( 'Section', 'js_composer' ),
	'base' => 'vc_tta_section',
	'icon' => 'icon-wpb-ui-tta-section',
	'allowed_container_element' => 'vc_row',
	'is_container' => true,
	'show_settings_on_create' => false,
	'as_child' => array(
		'only' => 'vc_tta_tour,vc_tta_tabs,vc_tta_accordion',
	),
	//'content_element' => false,
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Section for Tabs, Tours, Accordions.', 'js_composer' ),
	'params' => $params,
	'js_view' => 'VcBackendTtaSectionView',
	'custom_markup' => '
<div class="vc_tta-panel-heading">
    <h4 class="vc_tta-panel-title vc_tta-controls-icon-position-left"><a href="javascript:;" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-accordion data-vc-container=".vc_tta-container"><span class="vc_tta-title-text">{{ section_title }}</span><i class="vc_tta-controls-icon vc_tta-controls-icon-plus"></i></a></h4>
</div>
<div class="vc_tta-panel-body">
	{{ editor_controls }}
	<div class="{{ container-class }}">
	{{ content }}
	</div>
</div>',
	'default_content' => '',
) );