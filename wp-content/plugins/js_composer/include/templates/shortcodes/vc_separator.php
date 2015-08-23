<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var string $el_width
 * @var string $style
 * @var string $color
 * @var string $border_width
 * @var string $accent_color
 * @var string $el_class
 * @var string $align
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Separator
 */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

echo do_shortcode( '[vc_text_separator layout="separator_no_text" align="'
                   . $align . '" style="'
                   . $style . '" color="'
                   . $color . '" accent_color="'
                   . $accent_color . '" border_width="'
                   . $border_width . '" el_width="'
                   . $el_width . '" el_class="' . $el_class . '"]' );
echo $this->endBlockComment( $this->getShortcode() );