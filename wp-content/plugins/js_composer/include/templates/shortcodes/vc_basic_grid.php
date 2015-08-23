<?php
/**
 * Shortcode attributes
 * @var $atts array
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Basic_Grid
 */
$isotope_options = $posts = $filter_terms = array();

$this->buildAtts( $atts, $content );
$css_classes = ' ' . $this->shortcode;
wp_enqueue_script( 'prettyphoto' );
wp_enqueue_style( 'prettyphoto' );

$this->buildGridSettings();
if ( 'pagination' === $this->atts['style'] ) {
	wp_enqueue_script( 'twbs-pagination' );
}
$this->enqueueScripts();
?><!-- vc_grid start -->
<div class="vc_grid-container-wrapper vc_clearfix">
	<div class="vc_grid-container vc_clearfix wpb_content_element<?php echo esc_attr( $css_classes ); ?>"
	     data-vc-<?php echo esc_attr( $this->pagable_type ); ?>-settings="<?php echo esc_attr( json_encode( $this->grid_settings ) ); ?>"
	     data-vc-request="<?php echo esc_attr( admin_url( 'admin-ajax.php', 'relative' ) ); ?>"
	     data-vc-post-id="<?php echo esc_attr( get_the_ID() ); ?>">
	</div>
</div><!-- vc_grid end -->