<?php
// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$client_id = isset( $attributes['clientId'] ) ? str_replace( '-', '_', sanitize_key( wp_unslash( $attributes['clientId'] ) ) ) : '';

$block_id = 'cthf_' . $client_id;

$btt_styles = array(
	'label'          => isset( $attributes['backToTop']['label'] ) ? sanitize_text_field( $attributes['backToTop']['label'] ) : '',
	'gap'            => isset( $attributes['backToTop']['gap'] ) ? $attributes['backToTop']['gap'] : '',
	'margin'         => isset( $attributes['backToTop']['margin'] ) ? rootblox_render_trbl( 'margin', $attributes['backToTop']['margin'] ) : '',
	'border'         => isset( $attributes['backToTop']['border'] ) ? rootblox_render_trbl( 'border', $attributes['backToTop']['border'] ) : '',
	'radius'         => isset( $attributes['backToTop']['radius'] ) ? $attributes['backToTop']['radius'] : '',
	'box_width'      => isset( $attributes['backToTop']['boxWidth'] ) ? $attributes['backToTop']['boxWidth'] : '',
	'box_height'     => isset( $attributes['backToTop']['boxHeight'] ) ? $attributes['backToTop']['boxHeight'] : '',
	'h_padding'      => isset( $attributes['backToTop']['hPadding'] ) ? $attributes['backToTop']['hPadding'] : '',
	'v_padding'      => isset( $attributes['backToTop']['vPadding'] ) ? $attributes['backToTop']['vPadding'] : '',
	'icon_size'      => isset( $attributes['backToTop']['iconSize'] ) ? $attributes['backToTop']['iconSize'] : '',
	'font'           => array(
		'size'   => isset( $attributes['backToTop']['font']['size'] ) ? $attributes['backToTop']['font']['size'] : '',
		'family' => isset( $attributes['backToTop']['font']['family'] ) ? $attributes['backToTop']['font']['family'] : '',
	),
	'line_height'    => isset( $attributes['backToTop']['lineHeight'] ) ? $attributes['backToTop']['lineHeight'] : '',
	'letter_spacing' => isset( $attributes['backToTop']['letterSpacing'] ) ? $attributes['backToTop']['letterSpacing'] : '',
	'color'          => array(
		'icon'         => isset( $attributes['backToTop']['color']['icon'] ) ? $attributes['backToTop']['color']['icon'] : '',
		'icon_hover'   => isset( $attributes['backToTop']['color']['iconHover'] ) ? $attributes['backToTop']['color']['iconHover'] : '',
		'bg'           => isset( $attributes['backToTop']['color']['bg'] ) ? $attributes['backToTop']['color']['bg'] : '',
		'bg_hover'     => isset( $attributes['backToTop']['color']['bgHover'] ) ? $attributes['backToTop']['color']['bgHover'] : '',
		'border_hover' => isset( $attributes['backToTop']['color']['borderHover'] ) ? $attributes['backToTop']['color']['borderHover'] : '',
	),
);
$btt_icons  = array(
	'variation-1' => '<svg
						width="8"
						height="18"
						viewBox="0 0 8 18"
						fill="none"
						xmlns="http://www.w3.org/2000/svg">
						<path
							fill-rule="evenodd"
							clip-rule="evenodd"
							d="M0.142488 3.23847L3.23847 0.142488C3.42845 -0.0474959 3.73648 -0.0474959 3.92646 0.142488L7.02245 3.23847C7.21243 3.42845 7.21243 3.73648 7.02245 3.92646C6.83246 4.11645 6.52444 4.11645 6.33445 3.92646L4.06895 1.66097L4.06895 18L3.09598 18L3.09598 1.66097L0.830484 3.92647C0.640499 4.11645 0.332473 4.11645 0.142488 3.92647C-0.0474968 3.73648 -0.0474968 3.42845 0.142488 3.23847Z"
							fill="currentColor" />
					</svg>',
	'variation-2' => '<svg
						width="24"
						height="24"
						viewBox="0 0 24 24"
						fill="none"
						xmlns="http://www.w3.org/2000/svg">
						<path
							d="M12 19V5"
							stroke="currentColor"
							stroke-width="1.25"
							stroke-linecap="round"
							stroke-linejoin="round" />
						<path
							d="M5 12L12 5L19 12"
							stroke="currentColor"
							stroke-width="1.25"
							stroke-linecap="round"
							stroke-linejoin="round" />
					</svg>',
	'variation-3' => '<svg
						width="24"
						height="24"
						viewBox="0 0 24 24"
						fill="none"
						xmlns="http://www.w3.org/2000/svg">
						<path
							d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
							stroke="currentColor"
							stroke-width="1.25"
							stroke-linecap="round"
							stroke-linejoin="round" />
						<path
							d="M16 12L12 8L8 12"
							stroke="currentColor"
							stroke-width="1.25"
							stroke-linecap="round"
							stroke-linejoin="round" />
						<path
							d="M12 16V8"
							stroke="currentColor"
							stroke-width="1.25"
							stroke-linecap="round"
							stroke-linejoin="round" />
					</svg>',
	'variation-4' => '<svg
						width="24"
						height="24"
						viewBox="0 0 24 24"
						fill="none"
						xmlns="http://www.w3.org/2000/">
						<Path
							d="M18 15L12 9L6 15"
							stroke="currentColor"
							stroke-width="1.25"
							stroke-linecap="round"
							stroke-linejoin="round" />
					</svg>',
	'variation-5' => '<svg
						width="24"
						height="24"
						viewBox="0 0 24 24"
						fill="none"
						xmlns="http://www.w3.org/2000/svg">
						<Path
							d="M17 11L12 6L7 11"
							stroke="currentColor"
							stroke-width="1.25"
							stroke-linecap="round"
							stroke-linejoin="round" />
						<Path
							d="M17 18L12 13L7 18"
							stroke="currentColor"
							stroke-width="1.25"
							stroke-linecap="round"
							stroke-linejoin="round" />
					</svg>',
);

$scroll_progress_styles = array(
	'margin'  => array(
		'top'    => isset( $attributes['scrollProgress']['margin']['top'] ) ? $attributes['scrollProgress']['margin']['top'] : '',
		'bottom' => isset( $attributes['scrollProgress']['margin']['bottom'] ) ? $attributes['scrollProgress']['margin']['bottom'] : '',
	),
	'z_index' => isset( $attributes['scrollProgress']['zIndex'] ) ? $attributes['scrollProgress']['zIndex'] : '',
	'height'  => isset( $attributes['scrollProgress']['height'] ) ? $attributes['scrollProgress']['height'] : '',
	'color'   => array(
		'bg' => isset( $attributes['scrollProgress']['color']['bg'] ) ? $attributes['scrollProgress']['color']['bg'] : '',
	),
);

$block_styles = "
.cthf__back-to-top-wrapper.element-$block_id {
	{$btt_styles['margin']}
	{$btt_styles['border']}
	border-radius: {$btt_styles['radius']};
	width: {$btt_styles['box_width']};
	height: {$btt_styles['box_height']};
	padding-left: {$btt_styles['h_padding']};
	padding-right: {$btt_styles['h_padding']};
	padding-top: {$btt_styles['v_padding']};
	padding-bottom: {$btt_styles['v_padding']};
	background-color: {$btt_styles['color']['bg']};
	color: {$btt_styles['color']['icon']};
	flex-direction: {$attributes['backToTop']['display']};
	gap: {$btt_styles['gap']};

	& svg {
		width: {$btt_styles['icon_size']};
		height: {$btt_styles['icon_size']};
	}

	& .back-to-top__label {
		font-size: {$btt_styles['font']['size']};
		font-weight: {$attributes['backToTop']['font']['weight']};
		font-family: {$btt_styles['font']['family']};
		text-transform: {$attributes['backToTop']['letterCase']};
		text-decoration: {$attributes['backToTop']['decoration']};
		line-height: {$btt_styles['line_height']};
		letter-spacing: {$btt_styles['letter_spacing']};
	}

	&:hover {
		background-color: {$btt_styles['color']['bg_hover']};
		color: {$btt_styles['color']['icon_hover']};
		border-color: {$btt_styles['color']['border_hover']};
	}
}

.cthf__scroll-progress-bar.element-$block_id {
	z-index: {$scroll_progress_styles['z_index']};
	margin-top: {$scroll_progress_styles['margin']['top']};
	margin-bottom: {$scroll_progress_styles['margin']['bottom']};

	& .progress-bar {
		height: {$scroll_progress_styles['height']};
		background-color: {$scroll_progress_styles['color']['bg']};
	}
}
";

$font_families = array();

if ( isset( $attributes['backToTop']['font']['family'] ) && ! empty( $attributes['backToTop']['font']['family'] ) ) {
	$font_families[] = $attributes['backToTop']['font']['family'];
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
	wp_add_inline_style( 'cthf-blocks--footer--style', '@import url("' . rawurldecode( esc_url( $google_fonts_url ) ) . '");' );
}

add_action(
	'wp_enqueue_scripts',
	function () use ( $block_styles ) {
		wp_add_inline_style( 'cthf-blocks--footer--style', $block_styles );
	}
);

wp_localize_script( 'cthf-blocks--footer--frontend-script', $block_id, $attributes );
wp_add_inline_script( 'cthf-blocks--footer--frontend-script', 'document.addEventListener("DOMContentLoaded", function(event) { window.cthfFooter( "' . esc_html( $block_id ) . '" ) }) ' );

?>
<div class="cthf-block__wrapper footer__wrap">
	<?php
	echo $content;

	if ( isset( $attributes['backToTop']['enabled'] ) && filter_var( $attributes['backToTop']['enabled'], FILTER_VALIDATE_BOOLEAN ) ) {
		$classes   = array();
		$classes[] = 'cthf__back-to-top-wrapper';
		$classes[] = 'position-' . $attributes['backToTop']['position'];
		$classes[] = 'element-' . $block_id;
		?>
		<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', array_values( $classes ) ) ) ); ?>">
			<?php
			if ( isset( $attributes['backToTop']['enableIcon'] ) && filter_var( $attributes['backToTop']['enableIcon'], FILTER_VALIDATE_BOOLEAN ) ) {
				?>
				<div class="icon__wrapper">
					<?php
					$svg_icon = array_key_exists( $attributes['backToTop']['iconVariation'], $btt_icons ) ? $btt_icons[ $attributes['backToTop']['iconVariation'] ] : $btt_icons['variation-1'];
					echo $svg_icon;
					?>
				</div>
				<?php
			}

			if ( isset( $attributes['backToTop']['enableLabel'] ) && filter_Var( $attributes['backToTop']['enableLabel'], FILTER_VALIDATE_BOOLEAN ) ) {
				?>
				<p class="back-to-top__label"><?php echo esc_html( $btt_styles['label'] ); ?></p>
				<?php
			}
			?>

		</div>
		<?php
	}

	if ( rootblox_is_premium() && isset( $attributes['scrollProgress']['enabled'] ) && filter_var( $attributes['scrollProgress']['enabled'], FILTER_VALIDATE_BOOLEAN ) ) {
		$classes   = array();
		$classes[] = 'cthf__scroll-progress-bar';
		$classes[] = 'position-' . $attributes['scrollProgress']['position'];
		$classes[] = 'element-' . $block_id;
		?>
		<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', array_values( $classes ) ) ) ); ?>">
			<div class="progress-bar"></div>
		</div>
		<?php
	}
	?>
</div>

<?php
if ( rootblox_is_premium() && isset( $attributes['customScript']['enabled'] ) && filter_var( $attributes['customScript']['enabled'], FILTER_VALIDATE_BOOLEAN ) ) {
	$allowed_tags = array(); // No HTML, just raw script.
	?>
	<script>
		<?php echo wp_kses( $attributes['customScript']['content'], $allowed_tags ); ?>
	</script>
	<?php
}
?>