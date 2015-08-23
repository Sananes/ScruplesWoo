<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $title
 * @var $flickr_id
 * @var $count
 * @var $type
 * @var $display
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_flickr
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_flickr_widget wpb_content_element' . $el_class, $this->settings['base'], $atts );

$output .= "\n\t" . '<div class="' . esc_attr( $css_class ) . '">';
$output .= "\n\t\t" . '<div class="wpb_wrapper">';
$output .= wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_flickr_heading' ) );
$output .= "\n\t\t\t" . '<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=' . $count . '&amp;display=' . $display . '&amp;size=s&amp;layout=x&amp;source=' . $type . '&amp;' . $type . '=' . $flickr_id . '"></script>';
$output .= "\n\t\t\t" . '<p class="flickr_stream_wrap"><a class="wpb_follow_btn wpb_flickr_stream" href="http://www.flickr.com/photos/' . $flickr_id . '">' . __( 'View stream on flickr', 'js_composer' ) . '</a></p>';
$output .= "\n\t\t" . '</div>' . $this->endBlockComment( '.wpb_wrapper' );
$output .= "\n\t" . '</div>' . $this->endBlockComment( $this->getShortcode() ) . "\n";

echo $output;
