<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Raw_html
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );
$el_class .= ( 'vc_raw_html' === $this->settings['base'] ) ? ' wpb_content_element wpb_raw_html' : ' wpb_raw_js';
$content = rawurldecode( base64_decode( strip_tags( $content ) ) );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_raw_code' . $el_class, $this->settings['base'], $atts );

$output .= "\n\t" . '<div class="' . esc_attr( $css_class ) . '">';
$output .= "\n\t\t" . '<div class="wpb_wrapper">';
$output .= "\n\t\t\t" . $content;
$output .= "\n\t\t" . '</div> ' . $this->endBlockComment( '.wpb_wrapper' );
$output .= "\n\t" . '</div> ' . $this->endBlockComment( $this->getShortcode() );

echo $output;