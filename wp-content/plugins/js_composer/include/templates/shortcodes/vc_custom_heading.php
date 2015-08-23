<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $text
 * @var $link
 * @var $google_fonts
 * @var $font_container
 * @var $el_class
 * @var $css
 * @var $font_container_data - returned from $this->getAttributes
 * @var $google_fonts_data - returned from $this->getAttributes
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Custom_heading
 */
$output = $output_text = $css_class = $style = '';
$link = $text = $google_fonts = $font_container = $el_class = $css = $font_container_data = $google_fonts_data = '';
extract( $this->getAttributes( $atts ) );

extract( $this->getStyles( $el_class, $css, $google_fonts_data, $font_container_data, $atts ) );

$settings = get_option( 'wpb_js_google_fonts_subsets' );
$subsets = '';
if ( is_array( $settings ) && ! empty( $settings ) ) {
	$subsets = '&subset=' . implode( ',', $settings );
}
if ( ! empty( $google_fonts_data ) && isset( $google_fonts_data['values']['font_family'] ) ) {
	wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $google_fonts_data['values']['font_family'] . $subsets );
}
if ( ! empty( $styles ) ) {
	$style = 'style="' . esc_attr( implode( ';', $styles ) ) . '"';
}

$output_text = $text;
if ( ! empty( $link ) ) {
	$link = vc_build_link( $link );
	$output_text = '<a href="' . esc_attr( $link['url'] ) . '"'
	               . ( $link['target'] ? ' target="' . esc_attr( $link['target'] ) . '"' : '' )
	               . ( $link['title'] ? ' title="' . esc_attr( $link['title'] ) . '"' : '' )
	               . '>' . $text . '</a>';
}

if ( apply_filters( 'vc_custom_heading_template_use_wrapper', false ) ) {
	$output .= '<div class="' . esc_attr( $css_class ) . '" >';
	$output .= '<' . $font_container_data['values']['tag'] . ' ' . $style . ' >';
	$output .= $output_text;
	$output .= '</' . $font_container_data['values']['tag'] . '>';
	$output .= '</div>';
} else {
	$output .= '<' . $font_container_data['values']['tag'] . ' ' . $style . ' class="' . esc_attr( $css_class ) . '">';
	$output .= $output_text;
	$output .= '</' . $font_container_data['values']['tag'] . '>';
}
$output .= $this->endBlockComment( $this->getShortcode() );

echo $output;