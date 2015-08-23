<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $link
 * @var $el_class
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Video
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if ( '' === $link ) {
	return null;
}
$el_class = $this->getExtraClass( $el_class );

$video_w = ( isset( $content_width ) ) ? $content_width : 500;
$video_h = $video_w / 1.61; //1.61 golden ratio
/** @var WP_Embed $wp_embed */
global $wp_embed;
$embed = '';
if ( is_object( $wp_embed ) ) {
	$embed = $wp_embed->run_shortcode( '[embed width="' . $video_w . '"' . $video_h . ']' . $link . '[/embed]' );
}
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_video_widget wpb_content_element' . $el_class . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

$output .= "\n\t" . '<div class="' . esc_attr( $css_class ) . '">';
$output .= "\n\t\t" . '<div class="wpb_wrapper">';
$output .= wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_video_heading' ) );
$output .= '<div class="wpb_video_wrapper">' . $embed . '</div>';
$output .= "\n\t\t" . '</div> ' . $this->endBlockComment( '.wpb_wrapper' );
$output .= "\n\t" . '</div> ' . $this->endBlockComment( $this->getShortcode() );

echo $output;