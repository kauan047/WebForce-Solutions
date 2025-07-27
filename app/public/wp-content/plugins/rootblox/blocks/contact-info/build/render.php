<?php
// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$client_id = isset( $attributes['clientId'] ) ? str_replace( '-', '_', sanitize_key( wp_unslash( $attributes['clientId'] ) ) ) : '';

$block_id = 'cthf_' . $client_id;

$item_styles = array(
	'gap'            => isset( $attributes['gap'] ) ? $attributes['gap'] : '',
	'stack_layout'   => isset( $attributes['stackLayout'] ) && filter_var( $attributes['stackLayout'], FILTER_VALIDATE_BOOLEAN ) ? 'wrap' : 'nowrap',
	'padding'        => isset( $attributes['itemStyles']['padding'] ) ? rootblox_render_trbl( 'padding', $attributes['itemStyles']['padding'] ) : '',
	'border'         => isset( $attributes['itemStyles']['border'] ) ? rootblox_render_trbl( 'border', $attributes['itemStyles']['border'] ) : '',
	'radius'         => isset( $attributes['itemStyles']['radius'] ) ? $attributes['itemStyles']['radius'] : '',
	'font'           => array(
		'size'   => isset( $attributes['itemStyles']['font']['size'] ) ? $attributes['itemStyles']['font']['size'] : '',
		'family' => isset( $attributes['itemStyles']['font']['family'] ) ? $attributes['itemStyles']['font']['family'] : '',
	),
	'line_height'    => isset( $attributes['itemStyles']['lineHeight'] ) ? $attributes['itemStyles']['lineHeight'] : '',
	'letter_spacing' => isset( $attributes['itemStyles']['letterSpacing'] ) ? $attributes['itemStyles']['letterSpacing'] : '',
	'color'          => array(
		'text'         => isset( $attributes['itemStyles']['color']['text'] ) ? $attributes['itemStyles']['color']['text'] : '',
		'text_hover'   => isset( $attributes['itemStyles']['color']['textHover'] ) ? $attributes['itemStyles']['color']['textHover'] : '',
		'bg'           => isset( $attributes['itemStyles']['color']['bg'] ) ? $attributes['itemStyles']['color']['bg'] : '',
		'bg_hover'     => isset( $attributes['itemStyles']['color']['bgHover'] ) ? $attributes['itemStyles']['color']['bgHover'] : '',
		'border_hover' => isset( $attributes['itemStyles']['color']['borderHover'] ) ? $attributes['itemStyles']['color']['borderHover'] : '',
	),
);

$icon_styles = array(
	'gap'        => isset( $attributes['icon']['gap'] ) ? $attributes['icon']['gap'] : '',
	'row_gap'    => isset( $attributes['icon']['rowGap'] ) ? $attributes['icon']['rowGap'] : '',
	'box_width'  => isset( $attributes['icon']['boxWidth'] ) ? $attributes['icon']['boxWidth'] : '',
	'box_height' => isset( $attributes['icon']['boxHeight'] ) ? $attributes['icon']['boxHeight'] : '',
	'size'       => isset( $attributes['icon']['size'] ) ? $attributes['icon']['size'] : '',
	'padding'    => isset( $attributes['icon']['padding'] ) ? rootblox_render_trbl( 'padding', $attributes['icon']['padding'] ) : '',
	'margin'     => array(
		'top'    => isset( $attributes['icon']['margin']['top'] ) ? $attributes['icon']['margin']['top'] : '',
		'bottom' => isset( $attributes['icon']['margin']['bottom'] ) ? $attributes['icon']['margin']['bottom'] : '',
	),
	'border'     => isset( $attributes['icon']['border'] ) ? rootblox_render_trbl( 'border', $attributes['icon']['border'] ) : '',
	'radius'     => isset( $attributes['icon']['radius'] ) ? $attributes['icon']['radius'] : '',
	'color'      => array(
		'svg'          => isset( $attributes['icon']['color']['svg'] ) ? $attributes['icon']['color']['svg'] : '',
		'svg_hover'    => isset( $attributes['icon']['color']['svgHover'] ) ? $attributes['icon']['color']['svgHover'] : '',
		'bg'           => isset( $attributes['icon']['color']['bg'] ) ? $attributes['icon']['color']['bg'] : '',
		'bg_hover'     => isset( $attributes['icon']['color']['bgHover'] ) ? $attributes['icon']['color']['bgHover'] : '',
		'border_hover' => isset( $attributes['icon']['color']['borderHover'] ) ? $attributes['icon']['color']['borderHover'] : '',
	),
);

$block_styles = "
#$block_id > div:not(:first-child) {
	margin-top: {$item_styles['gap']};
}

#$block_id .contact__link {
	align-items: {$attributes['icon']['align']};
	flex-wrap: {$item_styles['stack_layout']};
	gap: {$icon_styles['gap']};
	row-gap: {$icon_styles['row_gap']};

	{$item_styles['padding']}
	{$item_styles['border']}
	border-radius: {$item_styles['radius']};
	font-size: {$item_styles['font']['size']};
	font-weight: {$attributes['itemStyles']['font']['weight']};
	font-family: {$item_styles['font']['family']};
	text-transform: {$attributes['itemStyles']['letterCase']};
	text-decoration: {$attributes['itemStyles']['decoration']};
	line-height: {$item_styles['line_height']};
	letter-spacing: {$item_styles['letter_spacing']};
	color: {$item_styles['color']['text']};
	background-color: {$item_styles['color']['bg']};
}
#$block_id .icon__wrapper {
	width: {$icon_styles['box_width']};
	height: {$icon_styles['box_height']};
	{$icon_styles['padding']}
	margin-top: {$icon_styles['margin']['top']};
	margin-bottom: {$icon_styles['margin']['bottom']};
	{$icon_styles['border']}
	border-radius: {$icon_styles['radius']};
	background-color: {$icon_styles['color']['bg']};
}
#$block_id .icon__wrapper svg {
	width: {$icon_styles['size']};
	height: {$icon_styles['size']};
	color: {$icon_styles['color']['svg']};
}
#$block_id .contact__link:hover  {
	color: {$item_styles['color']['text_hover']};
	background-color: {$item_styles['color']['bg_hover']};
	border-color: {$item_styles['color']['border_hover']};
}
#$block_id .contact__link:hover .icon__wrapper {
	background-color: {$icon_styles['color']['bg_hover']};
	border-color: {$icon_styles['color']['border_hover']};
}
#$block_id .contact__link:hover .icon__wrapper svg {
	color: {$icon_styles['color']['svg_hover']};
}
";

add_action(
	'wp_enqueue_scripts',
	function () use ( $block_styles ) {
		wp_add_inline_style( 'cthf-blocks--contact-info--style', $block_styles );
	}
);

$font_families = array();

if ( isset( $attributes['itemStyles']['font']['family'] ) && ! empty( $attributes['itemStyles']['font']['family'] ) ) {
	$font_families[] = $attributes['itemStyles']['font']['family'];
}

// Remove duplicate font families.
$font_families = array_unique( $font_families );

$font_query = '';

// Add other fonts.
foreach ( $font_families as $key => $family ) {
	if ( 0 === $key ) {
		$font_query .= 'family=' . $family . ':wght@100;200;300;400;500;600;700;800;900';
	} else {
		$font_query .= '&family=' . $family . ':wght@100;200;300;400;500;600;700;800;900';
	}
}

if ( ! empty( $font_query ) ) {
	// Generate the inline style for the Google Fonts link.
	$google_fonts_url = 'https://fonts.googleapis.com/css2?' . rawurlencode( $font_query );

	// Add the Google Fonts URL as an inline style.
	wp_add_inline_style( 'cthf-blocks--copyright-text--style', '@import url("' . rawurldecode( esc_url( $google_fonts_url ) ) . '");' );
}
?>

<div class="cthf-block__wrapper">
	<?php echo $content; ?>
</div>