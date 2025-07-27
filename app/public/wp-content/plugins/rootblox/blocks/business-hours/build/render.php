<?php
// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$client_id = isset( $attributes['clientId'] ) ? str_replace( '-', '_', sanitize_key( wp_unslash( $attributes['clientId'] ) ) ) : '';

$block_id = 'cthf_' . $client_id;

$attributes['systemTimezone'] = wp_timezone();
$attributes['systemLocale']   = str_replace( '_', '-', get_locale() );

$item_styles = array(
	'gap'            => isset( $attributes['itemStyles']['gap'] ) ? $attributes['itemStyles']['gap'] : '',
	'padding'        => isset( $attributes['itemStyles']['padding'] ) ? rootblox_render_trbl( 'padding', $attributes['itemStyles']['padding'] ) : '',
	'border'         => isset( $attributes['itemStyles']['border'] ) ? rootblox_render_trbl( 'border', $attributes['itemStyles']['border'] ) : '',
	'radius'         => isset( $attributes['itemStyles']['radius'] ) ? $attributes['itemStyles']['radius'] : '',
	'font'           => array(
		'size'   => isset( $attributes['itemStyles']['font']['size'] ) ? $attributes['itemStyles']['font']['size'] : '',
		'family' => isset( $attributes['itemStyles']['font']['family'] ) ? $attributes['itemStyles']['font']['family'] : '',
	),
	'line_height'    => isset( $attributes['itemStyles']['lineHeight'] ) ? $attributes['itemStyles']['lineHeight'] : '',
	'letter_spacing' => isset( $attributes['itemStyles']['letterSpacing'] ) ? $attributes['itemStyles']['letterSpacing'] : '',
	'label'          => array(
		'font'           => array(
			'size'   => isset( $attributes['itemStyles']['labelTypography']['font']['size'] ) ? $attributes['itemStyles']['labelTypography']['font']['size'] : '',
			'family' => isset( $attributes['itemStyles']['labelTypography']['font']['family'] ) ? $attributes['itemStyles']['labelTypography']['font']['family'] : '',
		),
		'line_height'    => isset( $attributes['itemStyles']['labelTypography']['lineHeight'] ) ? $attributes['itemStyles']['labelTypography']['lineHeight'] : '',
		'letter_spacing' => isset( $attributes['itemStyles']['labelTypography']['letterSpacing'] ) ? $attributes['itemStyles']['labelTypography']['letterSpacing'] : '',
	),
	'color'          => array(
		'text'  => isset( $attributes['itemStyles']['color']['text'] ) ? $attributes['itemStyles']['color']['text'] : '',
		'label' => isset( $attributes['itemStyles']['color']['label'] ) ? $attributes['itemStyles']['color']['label'] : '',
		'bg'    => isset( $attributes['itemStyles']['color']['bg'] ) ? $attributes['itemStyles']['color']['bg'] : '',

	),
);

$time_styles = array(
	'separator' => isset( $attributes['timeSeparator'] ) && ! empty( $attributes['timeSeparator'] ) ? $attributes['timeSeparator'] : '',
);

$notifier_styles = array(
	'padding'        => isset( $attributes['notification']['padding'] ) ? rootblox_render_trbl( 'padding', $attributes['notification']['padding'] ) : '',
	'margin'         => array(
		'top'    => isset( $attributes['notification']['margin']['top'] ) ? $attributes['notification']['margin']['top'] : '',
		'bottom' => isset( $attributes['notification']['margin']['bottom'] ) ? $attributes['notification']['margin']['bottom'] : '',
	),
	'border'         => isset( $attributes['notification']['border'] ) ? rootblox_render_trbl( 'border', $attributes['notification']['border'] ) : '',
	'radius'         => isset( $attributes['notification']['radius'] ) ? $attributes['notification']['radius'] : '',
	'font'           => array(
		'size'   => isset( $attributes['notification']['font']['size'] ) ? $attributes['notification']['font']['size'] : '',
		'family' => isset( $attributes['notification']['font']['family'] ) ? $attributes['notification']['font']['family'] : '',
	),
	'line_height'    => isset( $attributes['notification']['lineHeight'] ) ? $attributes['notification']['lineHeight'] : '',
	'letter_spacing' => isset( $attributes['notification']['letterSpacing'] ) ? $attributes['notification']['letterSpacing'] : '',
	'timer'          => array(
		'font'           => array(
			'size'   => isset( $attributes['notification']['timerTypography']['font']['size'] ) ? $attributes['notification']['timerTypography']['font']['size'] : '',
			'family' => isset( $attributes['notification']['timerTypography']['font']['family'] ) ? $attributes['notification']['timerTypography']['font']['family'] : '',
		),
		'line_height'    => isset( $attributes['notification']['timerTypography']['lineHeight'] ) ? $attributes['notification']['timerTypography']['lineHeight'] : '',
		'letter_spacing' => isset( $attributes['notification']['timerTypography']['letterSpacing'] ) ? $attributes['notification']['timerTypography']['letterSpacing'] : '',
	),
	'color'          => array(
		'text'  => isset( $attributes['notification']['color']['text'] ) ? $attributes['notification']['color']['text'] : '',
		'timer' => isset( $attributes['notification']['color']['timer'] ) ? $attributes['notification']['color']['timer'] : '',
		'bg'    => isset( $attributes['notification']['color']['bg'] ) ? $attributes['notification']['color']['bg'] : '',

	),


);

$timezone_styles = array(
	'padding'        => isset( $attributes['timezone']['padding'] ) ? rootblox_render_trbl( 'padding', $attributes['timezone']['padding'] ) : '',
	'margin'         => array(
		'top'    => isset( $attributes['timezone']['margin']['top'] ) ? $attributes['timezone']['margin']['top'] : '',
		'bottom' => isset( $attributes['timezone']['margin']['bottom'] ) ? $attributes['timezone']['margin']['bottom'] : '',
	),
	'border'         => isset( $attributes['timezone']['border'] ) ? rootblox_render_trbl( 'border', $attributes['timezone']['border'] ) : '',
	'radius'         => isset( $attributes['timezone']['radius'] ) ? $attributes['timezone']['radius'] : '',
	'gap'            => isset( $attributes['timezone']['gap'] ) ? $attributes['timezone']['gap'] : '',
	'font'           => array(
		'size'   => isset( $attributes['timezone']['font']['size'] ) ? $attributes['timezone']['font']['size'] : '',
		'family' => isset( $attributes['timezone']['font']['family'] ) ? $attributes['timezone']['font']['family'] : '',
	),
	'line_height'    => isset( $attributes['timezone']['lineHeight'] ) ? $attributes['timezone']['lineHeight'] : '',
	'letter_spacing' => isset( $attributes['timezone']['letterSpacing'] ) ? $attributes['timezone']['letterSpacing'] : '',
	'label'          => array(
		'font'           => array(
			'size'   => isset( $attributes['timezone']['labelTypography']['font']['size'] ) ? $attributes['timezone']['labelTypography']['font']['size'] : '',
			'family' => isset( $attributes['timezone']['labelTypography']['font']['family'] ) ? $attributes['timezone']['labelTypography']['font']['family'] : '',
		),
		'line_height'    => isset( $attributes['timezone']['labelTypography']['lineHeight'] ) ? $attributes['timezone']['labelTypography']['lineHeight'] : '',
		'letter_spacing' => isset( $attributes['timezone']['labelTypography']['letterSpacing'] ) ? $attributes['timezone']['labelTypography']['letterSpacing'] : '',
	),
	'color'          => array(
		'text'  => isset( $attributes['timezone']['color']['text'] ) ? $attributes['timezone']['color']['text'] : '',
		'label' => isset( $attributes['timezone']['color']['label'] ) ? $attributes['timezone']['color']['label'] : '',
		'bg'    => isset( $attributes['timezone']['color']['bg'] ) ? $attributes['timezone']['color']['bg'] : '',

	),


);

$block_styles = "
#$block_id .business-hour__item:not(:first-child) {
	margin-top: {$item_styles['gap']};
}
#$block_id .business-hour__item {
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
	background-color: {$item_styles['color']['bg']};
	color: {$item_styles['color']['text']};
	align-items: {$attributes['itemStyles']['alignItems']};
}
#$block_id .business-hour__item .weekday {
	font-size: {$item_styles['label']['font']['size']};
	font-weight: {$attributes['itemStyles']['labelTypography']['font']['weight']};
	font-family: {$item_styles['label']['font']['family']};
	text-transform: {$attributes['itemStyles']['labelTypography']['letterCase']};
	text-decoration: {$attributes['itemStyles']['labelTypography']['decoration']};
	line-height: {$item_styles['label']['line_height']};
	letter-spacing: {$item_styles['label']['letter_spacing']};
	color: {$item_styles['color']['label']};
}

#$block_id .notification {
	{$notifier_styles['padding']}
	margin-top: {$notifier_styles['margin']['top']};
	margin-bottom: {$notifier_styles['margin']['bottom']};
	{$notifier_styles['border']}
	border-radius: {$notifier_styles['radius']};
	font-size: {$notifier_styles['font']['size']};
	font-weight: {$attributes['notification']['font']['weight']};
	font-family: {$notifier_styles['font']['family']};
	text-transform: {$attributes['notification']['letterCase']};
	text-decoration: {$attributes['notification']['decoration']};
	line-height: {$notifier_styles['line_height']};
	letter-spacing: {$notifier_styles['letter_spacing']};
	background-color: {$notifier_styles['color']['bg']};
	color: {$notifier_styles['color']['text']};
}
#$block_id .notification .timer {
	font-size: {$notifier_styles['timer']['font']['size']};
	font-weight: {$attributes['notification']['timerTypography']['font']['weight']};
	font-family: {$notifier_styles['timer']['font']['family']};
	text-transform: {$attributes['notification']['timerTypography']['letterCase']};
	text-decoration: {$attributes['notification']['timerTypography']['decoration']};
	line-height: {$notifier_styles['timer']['line_height']};
	letter-spacing: {$notifier_styles['timer']['letter_spacing']};
	color: {$notifier_styles['color']['timer']};
}

#$block_id .timezone__warning {
	{$timezone_styles['padding']}
	margin-top: {$timezone_styles['margin']['top']};
	margin-bottom: {$timezone_styles['margin']['bottom']};
	{$timezone_styles['border']}
	border-radius: {$timezone_styles['radius']};
	font-size: {$timezone_styles['font']['size']};
	font-weight: {$attributes['timezone']['font']['weight']};
	font-family: {$timezone_styles['font']['family']};
	text-transform: {$attributes['timezone']['letterCase']};
	text-decoration: {$attributes['timezone']['decoration']};
	line-height: {$timezone_styles['line_height']};
	letter-spacing: {$timezone_styles['letter_spacing']};
	background-color: {$timezone_styles['color']['bg']};
	color: {$timezone_styles['color']['text']};
}
#$block_id .timezone__warning .warning__message {
	font-size: {$timezone_styles['label']['font']['size']};
	font-weight: {$attributes['timezone']['labelTypography']['font']['weight']};
	font-family: {$timezone_styles['label']['font']['family']};
	text-transform: {$attributes['timezone']['labelTypography']['letterCase']};
	text-decoration: {$attributes['timezone']['labelTypography']['decoration']};
	line-height: {$timezone_styles['label']['line_height']};
	letter-spacing: {$timezone_styles['label']['letter_spacing']};
	color: {$timezone_styles['color']['label']};
}
#$block_id .timezone__warning .time__wrap {
	margin-top: {$timezone_styles['gap']};
}
";

add_action(
	'wp_enqueue_scripts',
	function () use ( $block_styles ) {
		wp_add_inline_style( 'cthf-blocks--business-hours--style', esc_html( $block_styles ) );
	}
);

$font_families = array();

if ( isset( $attributes['itemStyles']['font']['family'] ) && ! empty( $attributes['itemStyles']['font']['family'] ) ) {
	$font_families[] = $attributes['itemStyles']['font']['family'];
}
if ( isset( $attributes['itemStyles']['labelTypography']['font']['family'] ) && ! empty( $attributes['itemStyles']['labelTypography']['font']['family'] ) ) {
	$font_families[] = $attributes['itemStyles']['labelTypography']['font']['family'];
}
if ( isset( $attributes['notification']['font']['family'] ) && ! empty( $attributes['notification']['font']['family'] ) ) {
	$font_families[] = $attributes['notification']['font']['family'];
}
if ( isset( $attributes['notification']['timerTypography']['font']['family'] ) && ! empty( $attributes['notification']['timerTypography']['font']['family'] ) ) {
	$font_families[] = $attributes['notification']['timerTypography']['font']['family'];
}
if ( isset( $attributes['timezone']['font']['family'] ) && ! empty( $attributes['timezone']['font']['family'] ) ) {
	$font_families[] = $attributes['timezone']['font']['family'];
}
if ( isset( $attributes['timezone']['labelTypography']['font']['family'] ) && ! empty( $attributes['timezone']['labelTypography']['font']['family'] ) ) {
	$font_families[] = $attributes['timezone']['labelTypography']['font']['family'];
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

$wrapper_attributes = get_block_wrapper_attributes();

$weekday_translated_labels = array(
	'monday'    => __( 'Monday', 'rootblox' ),
	'tuesday'   => __( 'Tuesday', 'rootblox' ),
	'wednesday' => __( 'Wednesday', 'rootblox' ),
	'thursday'  => __( 'Thursday', 'rootblox' ),
	'friday'    => __( 'Friday', 'rootblox' ),
	'saturday'  => __( 'Saturday', 'rootblox' ),
	'sunday'    => __( 'Sunday', 'rootblox' ),
);
?>

<div class="cthf-block__wrapper">
	<div <?php echo $wrapper_attributes; ?>>
		<div id="<?php echo esc_attr( $block_id ); ?>" class="cthf-block__business-hours">
			<ul class="business-hours__wrap">
				<?php
				if ( isset( $attributes['weekdays'], $attributes['scheduling']['type'] ) && 'default' === $attributes['scheduling']['type'] && is_array( $attributes['weekdays'] ) && ! empty( $attributes['weekdays'] ) ) {
					foreach ( $attributes['weekdays'] as $index => $weekday ) {
						$label = $weekday['key'];

						if ( isset( $attributes['scheduling']['abbr'], $attributes['scheduling']['customAbbr'] ) && filter_var( $attributes['scheduling']['abbr'], FILTER_VALIDATE_BOOLEAN ) && filter_var( $attributes['scheduling']['customAbbr'] ) ) {
							$abbr_len = isset( $attributes['scheduling']['abbrLength'] ) ? sanitize_text_field( $attributes['scheduling']['abbrLength'] ) : 3;
							if ( function_exists( 'mb_substr' ) ) {
								$label = mb_substr( $label, 0, $abbr_len, 'UTF-8' );
							} else {
								$label = substr( $label, 0, $abbr_len );
							}
						} elseif ( isset( $attributes['scheduling']['abbr'] ) && filter_var( $attributes['scheduling']['abbr'], FILTER_VALIDATE_BOOLEAN ) ) {
							if ( function_exists( 'mb_substr' ) ) {
								$label = mb_substr( $label, 0, 3, 'UTF-8' );
							} else {
								$label = substr( $label, 0, 3 );
							}
						}
						?>
						<li class="business-hour__item">
							<span class="weekday"><?php echo esc_html( ucfirst( $label ) ); ?></span>
							<?php
							if ( isset( $weekday['opened'] ) && filter_var( $weekday['opened'], FILTER_VALIDATE_BOOLEAN ) ) {
								if ( isset( $weekday['alwaysOpen'] ) && filter_var( $weekday['alwaysOpen'], FILTER_VALIDATE_BOOLEAN ) ) {
									$label = isset( $weekday['alwaysOpenLabel'] ) ? sanitize_text_field( $weekday['alwaysOpenLabel'] ) : '';
									?>
									<div class="always-open"><?php echo esc_html( trim( $time_styles['separator'] ) . ' ' ) . esc_html( trim( $label ) ); ?></div>
									<?php
								} else {


									$open_time  = array(
										'hours'   => isset( $weekday['openTime']['hours'] ) ? $weekday['openTime']['hours'] : '',
										'minutes' => isset( $weekday['openTime']['minutes'] ) ? $weekday['openTime']['minutes'] : '',
									);
									$close_time = array(
										'hours'   => isset( $weekday['closeTime']['hours'] ) ? $weekday['closeTime']['hours'] : '',
										'minutes' => isset( $weekday['closeTime']['minutes'] ) ? $weekday['closeTime']['minutes'] : '',
									);
									?>
									<div class="active-hours">
										<span class="opening-hour"><?php echo esc_html( rootblox_handle_time_format( $open_time['hours'], $open_time['minutes'], $attributes['timeFormat'] ) ); ?></span>
										<span class="time-separator"><?php echo esc_html( $time_styles['separator'] ); ?></span>
										<span class="closing-hour"><?php echo esc_html( ' ' . rootblox_handle_time_format( $close_time['hours'], $close_time['minutes'], $attributes['timeFormat'] ) ); ?></span>
									</div>
									<?php
								}
							} else {
								?>
								<span class="closed-message"><?php echo esc_html( trim( $time_styles['separator'] ) . ' ' ) . esc_html__( 'Closed', 'rootblox' ); ?></span>
								<?php
							}
							?>
						</li>
						<?php
					}
				}

				if ( isset( $attributes['scheduling']['type'], $attributes['groupedWeekdays'] ) && 'group' === $attributes['scheduling']['type'] && is_array( $attributes['groupedWeekdays'] ) && ! empty( $attributes['groupedWeekdays'] ) ) {
					$group_separator = isset( $attributes['groupSeparator'] ) ? sanitize_text_field( $attributes['groupSeparator'] ) : 'to';
					foreach ( $attributes['groupedWeekdays'] as $index => $group ) {
						$start_label = sanitize_text_field( $group['start'] );
						$end_label   = sanitize_text_field( $group['end'] );

						if ( isset( $attributes['scheduling']['abbr'], $attributes['scheduling']['customAbbr'] ) && filter_var( $attributes['scheduling']['abbr'], FILTER_VALIDATE_BOOLEAN ) && filter_var( $attributes['scheduling']['customAbbr'] ) ) {
							$abbr_len = isset( $attributes['scheduling']['abbrLength'] ) ? sanitize_text_field( $attributes['scheduling']['abbrLength'] ) : 3;
							if ( function_exists( 'mb_substr' ) ) {
								$start_label = mb_substr( $start_label, 0, $abbr_len, 'UTF-8' );
								$end_label   = mb_substr( $end_label, 0, $abbr_len, 'UTF-8' );
							} else {
								$start_label = substr( $start_label, 0, $abbr_len );
								$end_label   = substr( $end_label, 0, $abbr_len );
							}
						} elseif ( isset( $attributes['scheduling']['abbr'] ) && filter_var( $attributes['scheduling']['abbr'], FILTER_VALIDATE_BOOLEAN ) ) {
							if ( function_exists( 'mb_substr' ) ) {
								$start_label = mb_substr( $start_label, 0, 3, 'UTF-8' );
								$end_label   = mb_substr( $end_label, 0, 3, 'UTF-8' );
							} else {
								$start_label = substr( $start_label, 0, 3 );
								$end_label   = substr( $end_label, 0, 3 );
							}
						}
						?>
						<li class="business-hour__item">
							<span class="weekday"><?php echo esc_html( trim( ucfirst( $start_label ) ) . ' ' . trim( $group_separator ) . ' ' . trim( ucfirst( $end_label ) ) ); ?></span>
							<?php
							if ( isset( $group['opened'] ) && filter_var( $group['opened'], FILTER_VALIDATE_BOOLEAN ) ) {
								if ( isset( $group['alwaysOpen'] ) && filter_var( $group['alwaysOpen'], FILTER_VALIDATE_BOOLEAN ) ) {
									$label = isset( $group['alwaysOpenLabel'] ) ? sanitize_text_field( $group['alwaysOpenLabel'] ) : '';
									?>
									<div class="always-open"><?php echo esc_html( $time_styles['separator'] . ' ' ) . esc_html( $label ); ?></div>
									<?php
								} else {
									$open_time  = array(
										'hours'   => isset( $group['openTime']['hours'] ) ? $group['openTime']['hours'] : '',
										'minutes' => isset( $group['openTime']['minutes'] ) ? $group['openTime']['minutes'] : '',
									);
									$close_time = array(
										'hours'   => isset( $group['closeTime']['hours'] ) ? $group['closeTime']['hours'] : '',
										'minutes' => isset( $group['closeTime']['minutes'] ) ? $group['closeTime']['minutes'] : '',
									);
									?>
									<div class="active-hours">
										<span class="opening-hour"><?php echo esc_html( rootblox_handle_time_format( $open_time['hours'], $open_time['minutes'], $attributes['timeFormat'] ) ); ?></span>
										<span class="time-separator"><?php echo esc_html( $time_styles['separator'] ); ?></span>
										<span class="closing-hour"><?php echo esc_html( ' ' . rootblox_handle_time_format( $close_time['hours'], $close_time['minutes'], $attributes['timeFormat'] ) ); ?></span>
									</div>
									<?php
								}
							} else {
								?>
								<span class="closed-message"><?php echo esc_html( trim( $time_styles['separator'] ) . ' ' ) . esc_html__( 'Closed', 'rootblox' ); ?></span>
								<?php
							}
							?>
						</li>
						<?php
					}
				}
				?>
			</ul>

			<?php
			if ( isset( $attributes['notification']['enabled'] ) && ! empty( $attributes['notification']['enabled'] ) && filter_var( $attributes['notification']['enabled'], FILTER_VALIDATE_BOOLEAN ) ) {
				?>
				<div class="notification">
					<div class="message">
					</div>

					<div class="timer"></div>
				</div>
				<?php
			}

			if ( isset( $attributes['timezone']['enableNotice'] ) && filter_var( $attributes['timezone']['enableNotice'], FILTER_VALIDATE_BOOLEAN ) ) {
				$msg = isset( $attributes['timezone']['message'] ) ? sanitize_text_field( $attributes['timezone']['message'] ) : '';
				?>
				<div class="timezone__warning">
					<div class="warning__message"><?php echo esc_html( $msg ); ?></div>

					<?php
					if ( isset( $attributes['timezone']['enableTime'] ) && filter_var( $attributes['timezone']['enableTime'], FILTER_VALIDATE_BOOLEAN ) ) {
						?>
						<div class="time__wrap">
							<div class="label"></div>
							<div class="time"></div>
						</div>
						<?php
					}
					?>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>

<?php
wp_localize_script( 'cthf-blocks--business-hours--frontend-script', $block_id, $attributes );
wp_add_inline_script( 'cthf-blocks--business-hours--frontend-script', 'document.addEventListener("DOMContentLoaded", function(event) { window.cthfBusinessHours( "' . esc_html( $block_id ) . '" ) }) ' );
