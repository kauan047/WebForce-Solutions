<?php
// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$client_id = isset( $attributes['clientId'] ) ? str_replace( '-', '_', sanitize_key( wp_unslash( $attributes['clientId'] ) ) ) : '';

$block_id = 'cthf_' . $client_id;

$allowed_tags = array(
	'h1',
	'h2',
	'h3',
	'h4',
	'h5',
	'h6',
	'div',
	'span',
	'p',
);

$styles = array(
	'padding'        => isset( $attributes['padding'] ) ? rootblox_render_trbl( 'padding', $attributes['padding'] ) : '',
	'margin'         => isset( $attributes['margin'] ) ? rootblox_render_trbl( 'margin', $attributes['margin'] ) : '',
	'tag'            => isset( $attributes['tag'] ) && in_array( $attributes['tag'], $allowed_tags, true ) ? $attributes['tag'] : 'p',
	'font'           => array(
		'size'   => isset( $attributes['typography']['font']['size'] ) ? $attributes['typography']['font']['size'] : '',
		'family' => isset( $attributes['typography']['font']['family'] ) ? $attributes['typography']['font']['family'] : '',
	),
	'line_height'    => isset( $attributes['typography']['lineHeight'] ) ? $attributes['typography']['lineHeight'] : '',
	'letter_spacing' => isset( $attributes['typography']['letterSpacing'] ) ? $attributes['typography']['letterSpacing'] : '',
	'color'          => array(
		'text'       => isset( $attributes['color']['text'] ) ? $attributes['color']['text'] : '',
		'text_hover' => isset( $attributes['color']['textHover'] ) ? $attributes['color']['textHover'] : '',
	),
);

$before_txt_styles = array(
	'font'           => array(
		'size'   => isset( $attributes['beforeText']['font']['size'] ) ? $attributes['beforeText']['font']['size'] : '',
		'family' => isset( $attributes['beforeText']['font']['family'] ) ? $attributes['beforeText']['font']['family'] : '',
	),
	'line_height'    => isset( $attributes['beforeText']['lineHeight'] ) ? $attributes['beforeText']['lineHeight'] : '',
	'letter_spacing' => isset( $attributes['beforeText']['letterSpacing'] ) ? $attributes['beforeText']['letterSpacing'] : '',
	'color'          => array(
		'text'       => isset( $attributes['beforeText']['color']['text'] ) ? $attributes['beforeText']['color']['text'] : '',
		'text_hover' => isset( $attributes['beforeText']['color']['textHover'] ) ? $attributes['beforeText']['color']['textHover'] : '',
	),
);

$year_styles = array(
	'font'  => array(
		'size'   => isset( $attributes['dynamicYear']['font']['size'] ) ? $attributes['dynamicYear']['font']['size'] : '',
		'family' => isset( $attributes['dynamicYear']['font']['family'] ) ? $attributes['dynamicYear']['font']['family'] : '',
	),
	'color' => array(
		'text' => isset( $attributes['dynamicYear']['color']['text'] ) ? $attributes['dynamicYear']['color']['text'] : '',
	),
);

$after_txt_styles = array(
	'font'           => array(
		'size'   => isset( $attributes['afterText']['font']['size'] ) ? $attributes['afterText']['font']['size'] : '',
		'family' => isset( $attributes['afterText']['font']['family'] ) ? $attributes['afterText']['font']['family'] : '',
	),
	'line_height'    => isset( $attributes['afterText']['lineHeight'] ) ? $attributes['afterText']['lineHeight'] : '',
	'letter_spacing' => isset( $attributes['afterText']['letterSpacing'] ) ? $attributes['afterText']['letterSpacing'] : '',
	'color'          => array(
		'text'       => isset( $attributes['afterText']['color']['text'] ) ? $attributes['afterText']['color']['text'] : '',
		'text_hover' => isset( $attributes['afterText']['color']['textHover'] ) ? $attributes['afterText']['color']['textHover'] : '',
	),
);

$block_styles = "
#$block_id {
    {$styles['padding']}
    {$styles['margin']}
    font-size: {$styles['font']['size']};
    font-weight: {$attributes['typography']['font']['weight']};
    font-family: {$styles['font']['family']};
    text-transform: {$attributes['typography']['letterCase']};
    text-decoration: {$attributes['typography']['decoration']};
    line-height: {$styles['line_height']};
    letter-spacing: {$styles['letter_spacing']};
    color: {$styles['color']['text']};
}
#$block_id a {
    color: {$styles['color']['text']};
}
#$block_id a:hover {
    color: {$styles['color']['text_hover']};
}

#$block_id .copyright__before-text {
    font-size: {$before_txt_styles['font']['size']};
    font-weight: {$attributes['beforeText']['font']['weight']};
    font-family: {$before_txt_styles['font']['family']};
    text-transform: {$attributes['beforeText']['letterCase']};
    text-decoration: {$attributes['beforeText']['decoration']};
    line-height: {$before_txt_styles['line_height']};
    letter-spacing: {$before_txt_styles['letter_spacing']};
    color: {$before_txt_styles['color']['text']};
}
#$block_id .copyright__before-text a {
    color: {$before_txt_styles['color']['text']};
}
#$block_id .copyright__before-text a:hover {
    color: {$before_txt_styles['color']['text_hover']};
}

#$block_id .copyright__year {
    font-size: {$year_styles['font']['size']};
    font-weight: {$attributes['dynamicYear']['font']['weight']};
    font-family: {$year_styles['font']['family']};
    color: {$year_styles['color']['text']};
}

#$block_id .copyright__after-text {
    font-size: {$after_txt_styles['font']['size']};
    font-weight: {$attributes['afterText']['font']['weight']};
    font-family: {$after_txt_styles['font']['family']};
    text-transform: {$attributes['afterText']['letterCase']};
    text-decoration: {$attributes['afterText']['decoration']};
    line-height: {$after_txt_styles['line_height']};
    letter-spacing: {$after_txt_styles['letter_spacing']};
    color: {$after_txt_styles['color']['text']};
}
#$block_id .copyright__after-text a {
    color: {$after_txt_styles['color']['text']};
}
#$block_id .copyright__after-text a:hover {
    color: {$after_txt_styles['color']['text_hover']};
}
";
add_action(
	'wp_enqueue_scripts',
	function () use ( $block_styles ) {
		wp_add_inline_style( 'cthf-blocks--footer--style', $block_styles );
	}
);

$font_families = array();

if ( isset( $attributes['typography']['font']['family'] ) && ! empty( $attributes['typography']['font']['family'] ) ) {
	$font_families[] = $attributes['typography']['font']['family'];
}
if ( isset( $attributes['beforeText']['font']['family'] ) && ! empty( $attributes['beforeText']['font']['family'] ) ) {
	$font_families[] = $attributes['beforeText']['font']['family'];
}
if ( isset( $attributes['dynamicYear']['font']['family'] ) && ! empty( $attributes['dynamicYear']['font']['family'] ) ) {
	$font_families[] = $attributes['dynamicYear']['font']['family'];
}
if ( isset( $attributes['afterText']['font']['family'] ) && ! empty( $attributes['afterText']['font']['family'] ) ) {
	$font_families[] = $attributes['afterText']['font']['family'];
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
	<?php
		ob_start();

	if ( isset( $attributes['beforeText']['enabled'] ) && filter_var( $attributes['beforeText']['enabled'], FILTER_VALIDATE_BOOLEAN ) ) {
		?>
			<span class="copyright__before-text"><?php echo $attributes['beforeText']['content']; ?></span>
		<?php
	}

	if ( isset( $attributes['dynamicYear']['enabled'] ) && filter_var( $attributes['dynamicYear']['enabled'] ) ) {
		?>
			<span class="copyright__year">
				<?php
				$current_year  = gmdate( 'Y' );
				$previous_year = $current_year - $attributes['dynamicYear']['range'];

				$year_content = '';
				if ( rootblox_is_premium() && isset( $attributes['dynamicYear']['hasRange'] ) && filter_var( $attributes['dynamicYear']['hasRange'], FILTER_VALIDATE_BOOLEAN ) ) {
					?>
					<!-- <span class="previous-year"> -->
						<?php
						$year_content .= esc_html( $previous_year ) . esc_html( $attributes['dynamicYear']['separator'] );
						?>
					<!-- </span> -->
					<?php
				}
				$year_content .= esc_html( $current_year );

				echo $year_content;
				?>
			</span>
		<?php
	}

	if ( isset( $attributes['afterText']['enabled'] ) && filter_var( $attributes['afterText']['enabled'], FILTER_VALIDATE_BOOLEAN ) ) {
		?>
			<span class="copyright__after-text"><?php echo $attributes['afterText']['content']; ?></span>
		<?php
	}
	?>
			
		<?php

		$block_content = ob_get_clean();

		printf(
			'<%1$s id="%2$s" class="cthf__copyright-text">%3$s</%1$s>',
			esc_attr( $styles['tag'] ),
			esc_attr( $block_id ),
			$block_content,
		);
		?>
</div>