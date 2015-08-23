<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $tab_id
 * @var $title
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Tab
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'jquery_ui_tabs_rotate' );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_tab ui-tabs-panel wpb_ui-tabs-hide vc_clearfix', $this->settings['base'], $atts );
$output .= "\n\t\t\t" . '<div id="tab-' . ( empty( $tab_id ) ? sanitize_title( $title ) : esc_attr( $tab_id ) ) . '" class="' . esc_attr( $css_class ) . '">';
$output .= ( '' === trim( $content ) ) ? __( 'Empty tab. Edit page to add content here.', 'js_composer' ) : "\n\t\t\t\t" . wpb_js_remove_wpautop( $content );
$output .= "\n\t\t\t" . '</div> ' . $this->endBlockComment( $this->getShortcode() );

echo $output;