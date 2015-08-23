<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $el_id
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Accordion_tab
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_accordion_section group', $this->settings['base'], $atts );
$output .= "\n\t\t\t" . '<div ' . ( isset( $el_id ) && ! empty( $el_id ) ? "id='" . esc_attr( $el_id ) . "'" : "" ) . 'class="' . esc_attr( $css_class ) . '">';
$output .= "\n\t\t\t\t" . '<h3 class="wpb_accordion_header ui-accordion-header"><a href="#' . sanitize_title( $title ) . '">' . $title . '</a></h3>';
$output .= "\n\t\t\t\t" . '<div class="wpb_accordion_content ui-accordion-content vc_clearfix">';
$output .= ( '' === trim( $content ) ) ? __( 'Empty section. Edit page to add content here.', 'js_composer' ) : "\n\t\t\t\t" . wpb_js_remove_wpautop( $content );
$output .= "\n\t\t\t\t" . '</div>';
$output .= "\n\t\t\t" . '</div> ' . $this->endBlockComment( $this->getShortcode() ) . "\n";

echo $output;