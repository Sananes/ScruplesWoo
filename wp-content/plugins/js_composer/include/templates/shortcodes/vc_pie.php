<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $el_class
 * @var $value
 * @var $units
 * @var $color
 * @var $label_value
 * Shortcode class
 * @var $this WPBakeryShortCode_Vc_Pie
 */
$title = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'vc_pie' );

$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_pie_chart wpb_content_element' . $el_class, $this->settings['base'], $atts );
$output = "\n\t" . '<div class= "' . esc_attr( $css_class ) . '" data-pie-value="' . esc_attr( $value ) . '" data-pie-label-value="' . esc_attr( $label_value ) . '" data-pie-units="' . esc_attr( $units ) . '" data-pie-color="' . htmlspecialchars( $color ) . '">';
$output .= "\n\t\t" . '<div class="wpb_wrapper">';
$output .= "\n\t\t\t" . '<div class="vc_pie_wrapper">';
$output .= "\n\t\t\t" . '<span class="vc_pie_chart_back"></span>';
$output .= "\n\t\t\t" . '<span class="vc_pie_chart_value"></span>';
$output .= "\n\t\t\t" . '<canvas width="101" height="101"></canvas>';
$output .= "\n\t\t\t" . '</div>';
if ( '' !== $title ) {
	$output .= '<h4 class="wpb_heading wpb_pie_chart_heading">' . $title . '</h4>';
}
$output .= "\n\t\t" . '</div>' . $this->endBlockComment( '.wpb_wrapper' );
$output .= "\n\t" . '</div>' . $this->endBlockComment( $this->getShortcode() ) . "\n";

echo $output;