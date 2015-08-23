<?php
/**
 * @var $this WPBakeryShortCode_VC_Custom_heading
 */
$output = $output_text = $text = $google_fonts = $font_container = $el_class = $css = $google_fonts_data = $font_container_data = '';
extract( $this->getAttributes( $atts ) );
$link = vc_gitem_create_link( $atts );
extract( $this->getStyles( $el_class, $css, $google_fonts_data, $font_container_data, $atts ) );
$settings = get_option( 'wpb_js_google_fonts_subsets' );
$subsets = '';
if ( is_array( $settings ) && ! empty( $settings ) ) {
	$subsets = '&subset=' . implode( ',', $settings );
}
if ( ! empty( $link ) ) {
	$text = '<' . $link . '>' . $text . '</a>';
}
if ( ! empty( $google_fonts_data ) && isset( $google_fonts_data['values']['font_family'] ) ) {
	wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $google_fonts_data['values']['font_family'] . $subsets );
}

$style = '';
if ( ! empty( $styles ) ) {
    $style = 'style="' . esc_attr( implode( ';', $styles ) ) . '"';
}

if(apply_filters('vc_custom_heading_template_use_wrapper', false)) {
    $output .= '<div class="' . esc_attr( $css_class ) . '" >';
    $output .= '<' . $font_container_data['values']['tag'] . ' ' . $style . ' >';
    $output .= $text;
    $output .= '</' . $font_container_data['values']['tag'] . '>';
    $output .= '</div>';
} else {
    $output .= '<' . $font_container_data['values']['tag'] . ' ' . $style . ' class="' . esc_attr( $css_class ) . '">';
    $output .= $text;
    $output .= '</' . $font_container_data['values']['tag'] . '>';
}

echo $output;