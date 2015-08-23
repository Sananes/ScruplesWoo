<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $type
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_TweetMeMe
 */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'twitter-share-button', $this->settings['base'], $atts );

$output = '<a href="http://twitter.com/share" class="'
          . esc_attr( $css_class ) . '" data-count="'
          . $type . '">'
          . __( 'Tweet', 'js_composer' ) . '</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>'
          . $this->endBlockComment( $this->getShortcode() ) . "\n";

echo $output;