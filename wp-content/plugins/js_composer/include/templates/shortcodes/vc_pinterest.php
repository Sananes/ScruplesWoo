<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $type
 * @var $annotation
 * // Todo check why annotation doesn't set before
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Pinterest
 */

global $post;
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$url = rawurlencode( get_permalink() );
if ( has_post_thumbnail() ) {
	$img_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
	$media = ( is_array( $img_url ) ) ? '&amp;media=' . rawurlencode( $img_url[0] ) : '';
} else {
	$media = '';
}
$excerpt = is_object( $post ) && isset( $post->post_excerpt ) ? $post->post_excerpt : '';
$description = ( '' !== $excerpt ) ? '&amp;description=' . rawurlencode( strip_tags( $excerpt ) ) : '';

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_pinterest wpb_content_element wpb_pinterest_type_' . $type, $this->settings['base'], $atts );
$output .= '<div class="' . esc_attr( $css_class ) . '">';
$output .= '<a href="http://pinterest.com/pin/create/button/?url=' . $url . $media . $description . '" class="pin-it-button" count-layout="' . $type . '"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>';
$output .= '</div>' . $this->endBlockComment( $this->getShortcode() ) . "\n";

echo $output;