<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $link
 * @var $size
 * @var $el_class
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Gmaps
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$zoom = 14; // deprecated 4.0.2. In 4.6 was moved outside from shortcode_atts
$type = 'm'; // deprecated 4.0.2
$bubble = ''; // deprecated 4.0.2

if ( '' === $link ) {
	return null;
}
$link = trim( vc_value_from_safe( $link ) );
$bubble = ( $bubble != '' && $bubble != '0' ) ? '&amp;iwloc=near' : '';
$size = str_replace( array( 'px', ' ' ), array( '', '' ), $size );

$el_class = $this->getExtraClass( $el_class );
$el_class .= ( $size == '' ) ? ' vc_map_responsive' : '';

if ( is_numeric( $size ) ) {
	$link = preg_replace( '/height="[0-9]*"/', 'height="' . $size . '"', $link );
}

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_gmaps_widget wpb_content_element' . $el_class, $this->settings['base'], $atts );
?>
<div class="<?php echo esc_attr( $css_class ); ?>">
<?php echo wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_map_heading' ) ); ?>
	<div class="wpb_wrapper">
	<div class="wpb_map_wraper">
		<?php
		if ( preg_match( '/^\<iframe/', $link ) ) {
			echo $link;
		} else {
			// todo refactor or remove outdated/deprecated attributes that is not mapped in gmaps.
			echo '<iframe width="100%" height="' . $size . '" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="' . $link . '&amp;t=' . $type . '&amp;z=' . $zoom . '&amp;output=embed' . $bubble . '"></iframe>';
		}
		?>
	</div>
	</div><?php echo $this->endBlockComment( '.wpb_wrapper' ); ?>
	</div><?php echo $this->endBlockComment( $this->getShortcode() ); ?>