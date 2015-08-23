<?php

vc_map( array(
	'name' => __( 'Accordion', 'js_composer' ),
	'base' => 'vc_tta_accordion',
	'icon' => 'icon-wpb-ui-accordion',
	'is_container' => true,
	'show_settings_on_create' => false,
	'as_parent' => array(
		'only' => 'vc_tta_section'
	),
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Collapsible content panels', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'param_name' => 'title',
			'heading' => __( 'Widget title', 'js_composer' ),
			'description' => __( 'Enter text used as widget title (Note: located above content element).', 'js_composer' ),
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'style',
			'value' => array(
				__( 'Classic', 'js_composer' ) => 'classic',
				__( 'Modern', 'js_composer' ) => 'modern',
				__( 'Flat', 'js_composer' ) => 'flat',
				__( 'Outline', 'js_composer' ) => 'outline',
			),
			'heading' => __( 'Style', 'js_composer' ),
			'description' => __( 'Select accordion display style.', 'js_composer' ),
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'shape',
			'value' => array(
				__( 'Rounded', 'js_composer' ) => 'rounded',
				__( 'Square', 'js_composer' ) => 'square',
				__( 'Round', 'js_composer' ) => 'round',
			),
			'heading' => __( 'Shape', 'js_composer' ),
			'description' => __( 'Select accordion shape.', 'js_composer' ),
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'color',
			'value' => getVcShared( 'colors-dashed' ),
			'std' => 'grey',
			'heading' => __( 'Color', 'js_composer' ),
			'description' => __( 'Select accordion color.', 'js_composer' ),
			'param_holder_class' => 'vc_colored-dropdown',
		),
		array(
			'type' => 'checkbox',
			'param_name' => 'no_fill',
			'heading' => __( 'Do not fill content area?', 'js_composer' ),
			'description' => __( 'Do not fill content area with color.', 'js_composer' ),
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'spacing',
			'value' => array(
				__( 'None', 'js_composer' ) => '',
				__( '1px', 'js_composer' ) => '1',
				__( '2px', 'js_composer' ) => '2',
				__( '3px', 'js_composer' ) => '3',
				__( '4px', 'js_composer' ) => '4',
				__( '5px', 'js_composer' ) => '5',
				__( '10px', 'js_composer' ) => '10',
				__( '15px', 'js_composer' ) => '15',
				__( '20px', 'js_composer' ) => '20',
				__( '25px', 'js_composer' ) => '25',
				__( '30px', 'js_composer' ) => '30',
				__( '35px', 'js_composer' ) => '35',
			),
			'heading' => __( 'Spacing', 'js_composer' ),
			'description' => __( 'Select accordion spacing.', 'js_composer' ),
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'gap',
			'value' => array(
				__( 'None', 'js_composer' ) => '',
				__( '1px', 'js_composer' ) => '1',
				__( '2px', 'js_composer' ) => '2',
				__( '3px', 'js_composer' ) => '3',
				__( '4px', 'js_composer' ) => '4',
				__( '5px', 'js_composer' ) => '5',
				__( '10px', 'js_composer' ) => '10',
				__( '15px', 'js_composer' ) => '15',
				__( '20px', 'js_composer' ) => '20',
				__( '25px', 'js_composer' ) => '25',
				__( '30px', 'js_composer' ) => '30',
				__( '35px', 'js_composer' ) => '35',
			),
			'heading' => __( 'Gap', 'js_composer' ),
			'description' => __( 'Select accordion gap.', 'js_composer' ),
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'c_align',
			'value' => array(
				__( 'Left', 'js_composer' ) => 'left',
				__( 'Right', 'js_composer' ) => 'right',
				__( 'Center', 'js_composer' ) => 'center',
			),
			'heading' => __( 'Alignment', 'js_composer' ),
			'description' => __( 'Select accordion section title alignment.', 'js_composer' ),
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'autoplay',
			'value' => array(
				__( 'None', 'js_composer' ) => 'none',
				__( '1', 'js_composer' ) => '1',
				__( '2', 'js_composer' ) => '2',
				__( '3', 'js_composer' ) => '3',
				__( '4', 'js_composer' ) => '4',
				__( '5', 'js_composer' ) => '5',
				__( '10', 'js_composer' ) => '10',
				__( '20', 'js_composer' ) => '20',
				__( '30', 'js_composer' ) => '30',
				__( '40', 'js_composer' ) => '40',
				__( '50', 'js_composer' ) => '50',
				__( '60', 'js_composer' ) => '60',
			),
			'std' => 'none',
			'heading' => __( 'Autoplay', 'js_composer' ),
			'description' => __( 'Select auto rotate for accordion in seconds (Note: disabled by default).', 'js_composer' ),
		),
		array(
			'type' => 'checkbox',
			'param_name' => 'collapsible_all',
			'heading' => __( 'Allow collapse all?', 'js_composer' ),
			'description' => __( 'Allow collapse all accordion sections.', 'js_composer' ),
		),
		// Control Icons
		array(
			'type' => 'dropdown',
			'param_name' => 'c_icon',
			'value' => array(
				__( 'None', 'js_composer' ) => '',
				__( 'Chevron', 'js_composer' ) => 'chevron',
				__( 'Plus', 'js_composer' ) => 'plus',
				__( 'Triangle', 'js_composer' ) => 'triangle',
			),
			'std' => 'plus',
			'heading' => __( 'Icon', 'js_composer' ),
			'description' => __( 'Select accordion navigation icon.', 'js_composer' ),
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'c_position',
			'value' => array(
				__( 'Left', 'js_composer' ) => 'left',
				__( 'Right', 'js_composer' ) => 'right',
			),
			'dependency' => array(
				'element' => 'c_icon',
				'not_empty' => true,
			),
			'heading' => __( 'Position', 'js_composer' ),
			'description' => __( 'Select accordion navigation icon position.', 'js_composer' ),
		),
		// Control Icons END
		array(
			'type' => 'textfield',
			'param_name' => 'active_section',
			'heading' => __( 'Active section', 'js_composer' ),
			'value' => 1,
			'description' => __( 'Enter active section number (Note: to have all sections closed on initial load enter non-existing number).', 'js_composer' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
		),
	),
	'js_view' => 'VcBackendTtaAccordionView',
	'custom_markup' => '
<div class="vc_tta-container" data-vc-action="collapseAll">
	<div class="vc_general vc_tta vc_tta-accordion vc_tta-color-backend-accordion-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-o-shape-group vc_tta-controls-align-left vc_tta-gap-2">
	   <div class="vc_tta-panels vc_clearfix {{container-class}}">
	      {{ content }}
	      <div class="vc_tta-panel vc_tta-section-append">
	         <div class="vc_tta-panel-heading">
	            <h4 class="vc_tta-panel-title vc_tta-controls-icon-position-left">
	               <a href="javascript:;" aria-expanded="false" class="vc_tta-backend-add-control">
	                   <span class="vc_tta-title-text">' . __( 'Add Section', 'js_composer' ) . '</span>
	                    <i class="vc_tta-controls-icon vc_tta-controls-icon-plus"></i>
					</a>
	            </h4>
	         </div>
	      </div>
	   </div>
	</div>
</div>',
	'default_content' => '
[vc_tta_section title="' . sprintf( "%s %d", __( 'Section', 'js_composer' ), 1 ) . '"][/vc_tta_section]
[vc_tta_section title="' . sprintf( "%s %d", __( 'Section', 'js_composer' ), 2 ) . '"][/vc_tta_section]
	',
	'admin_enqueue_js' => vc_asset_url( 'lib/vc_accordion/vc-accordion.js' ),
) );