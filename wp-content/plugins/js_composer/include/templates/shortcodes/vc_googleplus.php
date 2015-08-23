<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $type
 * @var $annotation
 * @var $widget_width
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_GooglePlus
 */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if ( empty( $annotation ) ) {
	$annotation = 'bubble';
}
$params = '';
$params .= ( '' !== $type ) ? ' size="' . $type . '"' : '';
$params .= ( '' !== $annotation ) ? ' annotation="' . $annotation . '"' : '';

if ( empty( $type ) ) {
	$type = 'standard';
}
if ( 'inline' === $annotation && strlen( $widget_width ) > 0 ) {
	$params .= ' width="' . (int) $widget_width . '"';
}
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_googleplus wpb_content_element wpb_googleplus_type_' . $type . ' vc_googleplus-annotation-' . $annotation, $this->settings['base'], $atts );
$output = '<div class="' . esc_attr( $css_class ) . '"><g:plusone' . $params . '></g:plusone></div>' . $this->endBlockComment( $this->getShortcode() ) . "\n";

echo $output;