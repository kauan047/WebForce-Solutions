<?php
// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Determines and returns the premium status for Rootblox.
 *
 * This function checks whether the premium version is active by verifying
 * the feature set and premium status. Additionally, it checks if the
 * "Cozy Addons" plugin is installed and active. If so, it determines
 * premium access via `cozy_addons_premium_access()`. If premium access
 * is granted by Cozy Addons, that value is returned instead.
 *
 * @return bool True if premium is active, false otherwise.
 */
function rootblox_is_premium() {
	$premium_status = false;

	$plugins = get_plugins();
	if ( isset( $plugins['cozy-addons/cozy-addons.php'] ) && is_plugin_active( 'cozy-addons/cozy-addons.php' ) ) {
		if ( cozy_addons_premium_access() ) {
			return cozy_addons_premium_access();
		}
	}

	if ( function_exists( 'roo_fs' ) ) {
		$premium_status = roo_fs()->can_use_premium_code__premium_only() && roo_fs()->is__premium_only();
	}

	return $premium_status;
}
add_filter( 'rootblox_premium_check', 'rootblox_is_premium' );

/**
 * Return the style render for padding, border, and border radius.
 *
 * *
 *
 * @param string $type       The type of style to render ('padding', 'border', or 'radius').
 * @param array  $attributes An associative array of style attributes.
 *                           For 'border', this may include 'width', 'style', 'color', and per-side values (e.g., 'top', 'right', 'bottom', 'left').
 *                           For 'radius', per-side radius values (e.g., 'top', 'right', 'bottom', 'left').
 *                           For 'padding', per-side padding values (e.g., 'top', 'right', 'bottom', 'left').
 *
 * @return string            The generated CSS string for the specified type, with appropriate properties and values.
 */
function rootblox_render_trbl( $type, $attributes ) {
	$sides = array( 'top', 'right', 'bottom', 'left' );

	if ( ! function_exists( 'rootblox_generate_property' ) ) {
		/**
		 * Helper function to generate CSS properties conditionally.
		 *
		 * @param string $prop       The CSS property to generate (e.g., 'padding', 'border').
		 * @param string $side       The side of the element to apply the property (e.g., 'top', 'right', 'bottom', 'left').
		 * @param array  $attributes An associative array of style attributes for the element.
		 *                           Contains the values for the corresponding CSS property for each side.
		 *
		 * @return string            The generated CSS rule for the specified property and side, or an empty string if the attribute is not set.
		 */
		function rootblox_generate_property( $prop, $side, $attributes ) {
			$attr_side = esc_attr( $attributes[ $side ] );
			return ! empty( $attributes[ $side ] ) ? "{$prop}-{$side}: {$attr_side};" : '';
		}
	}

	switch ( $type ) {
		case 'border':
			// Check if any global border property exists.
			if ( isset( $attributes['width'] ) || isset( $attributes['style'] ) || isset( $attributes['color'] ) ) {
				$width = esc_attr( $attributes['width'] );
				$style = esc_attr( $attributes['style'] );
				$color = esc_attr( $attributes['color'] );
				return ( ! empty( $attributes['width'] ) ? "border-width: {$width};" : '' ) .
					( ! empty( $attributes['style'] ) ? "border-style: {$style};" : '' ) .
					( ! empty( $attributes['color'] ) ? "border-color: {$color};" : '' );
			}

			// Handle individual borders for each side.
			$css = '';
			foreach ( $sides as $side ) {
				$border_value =
					( ! empty( $attributes[ $side ]['width'] ) ? "{$attributes[$side]['width']} " : '' ) .
					( ! empty( $attributes[ $side ]['style'] ) ? "{$attributes[$side]['style']} " : '' ) .
					( ! empty( $attributes[ $side ]['color'] ) ? "{$attributes[$side]['color']}" : '' );

				if ( ! empty( $border_value ) ) {
					$css .= "border-{$side}: {$border_value};\n";
				}
			}
			return $css;

		case 'radius':
			// Handle individual border radius for each side.
			$top    = esc_attr( $attributes['top'] );
			$right  = esc_attr( $attributes['right'] );
			$bottom = esc_attr( $attributes['bottom'] );
			$left   = esc_attr( $attributes['left'] );

			return ( ! empty( $attributes['top'] ) ? "border-top-left-radius: {$top};" : '' ) .
				( ! empty( $attributes['right'] ) ? "border-top-right-radius: {$right};" : '' ) .
				( ! empty( $attributes['bottom'] ) ? "border-bottom-right-radius: {$bottom};" : '' ) .
				( ! empty( $attributes['left'] ) ? "border-bottom-left-radius: {$left};" : '' );

		case 'padding':
			// Handle padding for each side
			$css = '';
			foreach ( $sides as $side ) {
				$css .= rootblox_generate_property( 'padding', $side, $attributes ) . "\n";
			}
			return $css;

		case 'margin':
			// Handle margin for each side
			$css = '';
			foreach ( $sides as $side ) {
				$css .= rootblox_generate_property( 'margin', $side, $attributes ) . "\n";
			}
			return $css;

		default:
			return '';
	}
}

/**
 * Generates the mobile menu pattern callback based on the provided layout.
 *
 * This function looks for available `.php` files in the 'resources/patterns' directory, removes the `.php`
 * extension, and checks if the provided layout matches any of the available patterns. If a valid pattern
 * is found, the corresponding `.php` file is included, and its output is returned. If the layout is empty or
 * does not match an available pattern, an empty string is returned.
 *
 * @param string $layout The name of the layout pattern to include and render (without file extension).
 *
 * @return string The output generated from the pattern file or an empty string if no valid layout is found.
 */
function rootblox_create_mobile_menu_pattern_callback( $attributes ) {
	$layout = $attributes['mobileMenu']['layout'];

	if ( ! is_array( $layout ) || empty( $layout ) ) {
		return '';
	}

	$allowed_tags = array(
		'h1',
		'h2',
		'h3',
		'h4',
		'h5',
		'h6',
		'p',
	);

	$output = '';

	ob_start();
	?>


	<div class="cthf__mobile-layout">
		<?php
		$index = 1;
		foreach ( $attributes['mobileMenu']['layout'] as $layout ) {
			if ( is_array( $layout ) && ! empty( $layout ) ) {
				$classes   = array();
				$classes[] = 'cthf__responsive-navigation';
				$classes[] = 'layout-wrap-' . $index;
				?>
				<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', array_values( $classes ) ) ) ); ?>">
					<?php
					foreach ( $layout as $item ) {
						switch ( $item ) {
							case 'Site Logo':
								if ( $attributes['sidebar']['siteLogo'] ) {
									?>
									<div class="cthf__site-identity-wrap">
										<?php
										if ( filter_var( $attributes['siteLogo']['enableLogo'] ) ) {
											if ( rootblox_is_premium() && ! filter_var( $attributes['siteLogo']['useDefaultLogo'] ) ) {
												?>
												<a class="custom-logo-link" href="<?php echo esc_url( home_url() ); ?>" rel="home">
													<img class="custom-logo" src="<?php echo esc_url( $attributes['siteLogo']['custom']['url'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
												</a>
												<?php
											} else {
												the_custom_logo();
											}
										}

										if ( filter_var( $attributes['siteLogo']['enableTitle'] ) ) {
											?>
											<div class="site-title">
												<?php
												$home_url  = home_url();
												$title_tag = isset( $attributes['siteLogo']['titleTag'] ) && in_array( $attributes['siteLogo']['titleTag'], $allowed_tags, true ) ? $attributes['siteLogo']['titleTag'] : 'p';

												printf( '<%1$s><a href="' . esc_url( $home_url ) . '">%2$s</a></%1$s>', esc_attr( $title_tag ), esc_html( get_bloginfo( 'name' ) ) );
												?>
											</div>
											<?php
										}
										?>
									</div>
									<?php

								}
								break;

							case 'Navigation':
								?>
								<svg class="cthf__mob-icon nav__icon" width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
									<?php
									$path = 'M0 0H18V2H0V0ZM0 7H18V9H0V7ZM0 14H18V16H0V14Z';

									if ( 'variation-2' === $attributes['navigation']['icon'] ) {
										$path = 'M0 0H18V2H0V0ZM0 7H12V9H0V7ZM0 14H18V16H0V14Z';
									} elseif ( 'variation-3' === $attributes['navigation']['icon'] ) {
										$path = 'M0 0H18V2H0V0ZM6 7H18V9H6V7ZM0 14H18V16H0V14Z';
									}
									?>
									<path d="<?php echo esc_html( $path ); ?>" fill="currentColor" />
								</svg>

								<?php
								break;

							case 'Search':
								if ( ! rootblox_is_premium() ) {
									break;
								}
								?>
								<div class="cthf__mob-icon-wrapper search__icon-wrapper">
									<svg class="cthf__mob-icon search__icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M8.783 16.8277C10.3738 16.8292 11.9294 16.3594 13.2534 15.4775C14.5774 14.5956 15.6104 13.3412 16.222 11.8727C16.8333 10.4039 16.9945 8.78674 16.6852 7.22624C16.376 5.66574 15.6102 4.23226 14.485 3.10766C13.3605 1.98261 11.9277 1.21618 10.3677 0.90522C8.80769 0.594263 7.19052 0.752743 5.72057 1.36063C4.25062 1.96852 2.99387 2.99852 2.10915 4.32047C1.22443 5.64242 0.751452 7.19697 0.75 8.78766C0.75 10.9187 1.596 12.9617 3.102 14.4687C4.60848 15.9758 6.65107 16.8241 8.782 16.8277M14.488 14.4907L19.25 19.2497" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
									</svg>
								</div>
								<?php
								break;

							case 'My Account':
								if ( ! rootblox_is_premium() ) {
									break;
								}

								if ( class_exists( 'WooCommerce' ) ) {
									$account_page_url = wc_get_page_permalink( 'myaccount' );
									?>
									<a class="cthf__my-account-wrap" href="<?php echo esc_url( $account_page_url ); ?>" rel="nofollow">
										<?php
										if ( 'variation-3' === $attributes['acc']['icon'] ) {
											?>
											<svg class="cthf__mob-icon user__icon" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M8.26843 0.5C12.4084 0.5 15.7684 3.86 15.7684 8C15.7684 12.14 12.4084 15.5 8.26843 15.5C4.12843 15.5 0.768433 12.14 0.768433 8C0.768433 3.86 4.12843 0.5 8.26843 0.5ZM3.78568 10.562C4.88668 12.2045 6.53968 13.25 8.38843 13.25C10.2364 13.25 11.8902 12.2053 12.9904 10.562C11.7422 9.39545 10.0969 8.74761 8.38843 8.75C6.67971 8.74742 5.03407 9.39527 3.78568 10.562ZM8.26843 7.25C8.86517 7.25 9.43747 7.01295 9.85942 6.59099C10.2814 6.16903 10.5184 5.59674 10.5184 5C10.5184 4.40326 10.2814 3.83097 9.85942 3.40901C9.43747 2.98705 8.86517 2.75 8.26843 2.75C7.6717 2.75 7.0994 2.98705 6.67744 3.40901C6.25549 3.83097 6.01843 4.40326 6.01843 5C6.01843 5.59674 6.25549 6.16903 6.67744 6.59099C7.0994 7.01295 7.6717 7.25 8.26843 7.25Z" fill="currentColor" />
											</svg>
											<?php
										} elseif ( 'variation-2' === $attributes['acc']['icon'] ) {
											?>
											<svg class="cthf__mob-icon user__icon" width="12" height="15" viewBox="0 0 12 15" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M11.3334 14.6667H0.666687V13.3333C0.666687 12.4493 1.01788 11.6014 1.643 10.9763C2.26812 10.3512 3.11597 9.99999 4.00002 9.99999H8.00002C8.88408 9.99999 9.73192 10.3512 10.357 10.9763C10.9822 11.6014 11.3334 12.4493 11.3334 13.3333V14.6667ZM6.00002 8.66666C5.47473 8.66666 4.95459 8.56319 4.46929 8.36217C3.98398 8.16116 3.54303 7.86652 3.17159 7.49508C2.80016 7.12365 2.50552 6.68269 2.3045 6.19739C2.10348 5.71209 2.00002 5.19194 2.00002 4.66666C2.00002 4.14137 2.10348 3.62123 2.3045 3.13592C2.50552 2.65062 2.80016 2.20966 3.17159 1.83823C3.54303 1.4668 3.98398 1.17216 4.46929 0.971138C4.95459 0.77012 5.47473 0.666656 6.00002 0.666656C7.06089 0.666657 8.0783 1.08808 8.82845 1.83823C9.57859 2.58837 10 3.60579 10 4.66666C10 5.72752 9.57859 6.74494 8.82845 7.49508C8.0783 8.24523 7.06089 8.66666 6.00002 8.66666Z" fill="currentColor" />
											</svg>

											<?php
										} else {
											?>
											<svg class="cthf__mob-icon user__icon" width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M16.6188 19.25C16.6188 15.648 12.6028 12.72 9.00081 12.72C5.39881 12.72 1.38281 15.648 1.38281 19.25M9.00081 9.456C10.1553 9.456 11.2625 8.99738 12.0788 8.18104C12.8952 7.36469 13.3538 6.25749 13.3538 5.103C13.3538 3.94851 12.8952 2.84131 12.0788 2.02496C11.2625 1.20862 10.1553 0.75 9.00081 0.75C7.84633 0.75 6.73912 1.20862 5.92278 2.02496C5.10643 2.84131 4.64781 3.94851 4.64781 5.103C4.64781 6.25749 5.10643 7.36469 5.92278 8.18104C6.73912 8.99738 7.84633 9.456 9.00081 9.456Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
											</svg>
											<?php
										}
										?>
									</a>
									<?php
								}
								break;

							case 'Mini Cart':
								if ( ! rootblox_is_premium() ) {
									break;
								}
								if ( class_exists( 'WooCommerce' ) ) {
									$cart_icon = '';

									if ( 'variation-2' === $attributes['miniCart']['icon'] ) {
										$cart_icon = 'bag';
									} elseif ( 'variation-3' === $attributes['miniCart']['icon'] ) {
										$cart_icon = 'bag-alt';
									}
									echo do_blocks( '<!-- wp:woocommerce/mini-cart {"miniCartIcon":"' . esc_html( $cart_icon ) . '"} /-->' );
								}
								break;

							case 'Button':
								if ( ! rootblox_is_premium() ) {
									break;
								}

								$label    = isset( $attributes['ctaButton']['label'] ) ? sanitize_text_field( $attributes['ctaButton']['label'] ) : '';
								$link     = isset( $attributes['ctaButton']['link'] ) && ! empty( $attributes['ctaButton']['link'] ) ? sanitize_url( $attributes['ctaButton']['link'] ) : '#';
								$new_tab  = isset( $attributes['ctaButton']['openNewTab'] ) && filter_var( $attributes['ctaButton']['openNewTab'], FILTER_VALIDATE_BOOLEAN ) ? '_blank' : '';
								$nofollow = isset( $attributes['ctaButton']['noFollow'] ) && filter_var( $attributes['ctaButton']['noFollow'], FILTER_VALIDATE_BOOLEAN ) ? 'nofollow' : '';
								?>
								<a class="cthf__cta-anchor-btn" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $new_tab ); ?>" rel="<?php echo esc_attr( $nofollow ); ?>"><?php echo esc_html( $label ); ?></a>
								<?php
								break;

							default:
								break;
						}
					}
					?>
				</div>
				<?php

				++$index;
			}
		}
		?>
	</div>
	<?php
	$output .= ob_get_clean();

	return $output;
}
add_filter( 'rootblox_create_mobile_menu_pattern', 'rootblox_create_mobile_menu_pattern_callback' );

/**
 * Formats a given hour and minute into either 12-hour or 24-hour time format.
 *
 * @param int  $hour       The hour in 24-hour format (0–23).
 * @param int  $minute     The minute (0–59).
 * @param bool $timeFormat If true, returns 12-hour format with AM/PM; if false, returns 24-hour format.
 *
 * @return string Formatted time string (e.g., "02:05 PM" or "14:05").
 */
function rootblox_handle_time_format( $hour, $minute, $time_format ) {
	// Ensure hour and minute are not empty and set defaults if needed.
	$hour   = isset( $hour ) && ! empty( $hour ) ? (int) $hour : 0;
	$minute = isset( $minute ) && ! empty( $minute ) ? (int) $minute : 0;

	// Format minutes to ensure they are two digits.
	$minute_str = str_pad( $minute, 2, '0', STR_PAD_LEFT );

	// If time_format is provided and is true, format as 12-hour format with AM/PM.
	if ( isset( $time_format ) && filter_var( $time_format, FILTER_VALIDATE_BOOLEAN ) ) {
		// Convert hour to 12-hour format, with special handling for 12 and 0 hours.
		$hour12   = ( $hour % 12 === 0 ) ? 12 : ( $hour % 12 );
		$period   = $hour >= 12 ? 'PM' : 'AM';
		$hour_str = str_pad( $hour12, 2, '0', STR_PAD_LEFT );

		// Return formatted time
		return "$hour_str:$minute_str $period";
	} else {
		// If 24-hour format, ensure the hour is always two digits.
		$hour_str = str_pad( $hour, 2, '0', STR_PAD_LEFT );

		// Return formatted time in 24-hour format.
		return "$hour_str:$minute_str";
	}
}

/**
 * Handles the AJAX search request for RootBlox.
 *
 * This function verifies the nonce for security, decodes and sanitizes the
 * incoming attributes data, and returns a JSON response.
 *
 * @return void Outputs a JSON success or error response and terminates execution.
 */
function rootblox_ajax_search_result_handler() {
	check_ajax_referer( 'rootblox_ajax_search', 'nonce', true );

	$attributes = isset( $_POST['attributes'] ) ? json_decode( sanitize_text_field( wp_unslash( $_POST['attributes'] ) ), true ) : '';

	$search_keyword = isset( $_POST['searchKeyword'] ) && ! empty( $_POST['searchKeyword'] ) ? sanitize_text_field( wp_unslash( $_POST['searchKeyword'] ) ) : '';

	if ( ! rootblox_is_premium() && empty( $attributes ) && ! empty( $search_keyword ) ) {
		wp_send_json_error( '' );
		return;
	}

	$search_post_type = sanitize_text_field( wp_unslash( $attributes['search']['variation'] ) );
	$posts_per_page   = isset( $attributes['search']['ajax']['postsPerPage'] ) ? sanitize_text_field( wp_unslash( $attributes['search']['ajax']['postsPerPage'] ) ) : 3;
	if ( 'default' === $search_post_type ) {
		$search_post_type = '';
	}
	$all_plugins = get_plugins();
	if ( ( ! isset( $all_plugins['woocommerce/woocommerce.php'] ) || ! is_plugin_active( 'woocommerce/woocommerce.php' ) ) && 'product' === $search_post_type ) {
		$search_post_type = '';
	}

	$args = array(
		'post_type'      => $search_post_type,
		'posts_per_page' => $posts_per_page,
		'post_status'    => 'publish',
		's'              => $search_keyword,
	);

	$query          = new WP_Query( $args );
	$search_results = $query->get_posts();

	ob_start();
	if ( ! empty( $search_results ) ) {
		?>
			<?php
			foreach ( $search_results as $item ) {
				$post_id = $item->ID;

				$img_url    = get_the_post_thumbnail_url( $post_id, 'full' );
				$post_title = $item->post_title;
				$post_url   = get_permalink( $post_id );

				$classes   = array();
				$classes[] = 'post';
				$classes[] = 'post-' . $post_id;

				$new_tab  = isset( $attributes['search']['ajax']['openNewTab'] ) && filter_var( $attributes['search']['ajax']['openNewTab'], FILTER_VALIDATE_BOOLEAN ) ? '_blank' : '';
				$nofollow = isset( $attributes['search']['ajax']['noFollow'] ) && filter_var( $attributes['search']['ajax']['noFollow'], FILTER_VALIDATE_BOOLEAN ) ? 'nofollow' : '';
				?>
					<li class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', array_values( $classes ) ) ) ); ?>">
						<?php
						if ( ! empty( $img_url ) ) {
							?>
							<figure class="post__image">
								<a href="<?php echo esc_url( $post_url ); ?>" target="<?php echo esc_attr( $new_tab ); ?>" rel="<?php echo esc_attr( $nofollow ); ?>">
									<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $post_title ); ?>" />
								</a>
							</figure>
							<?php
						}
						?>
						<h4 class="post__title"><a href="<?php echo esc_url( $post_url ); ?>" target="<?php echo esc_attr( $new_tab ); ?>" rel="<?php echo esc_attr( $nofollow ); ?>"><?php echo esc_html( $post_title ); ?></a></h4>
					</li>
					<?php
			}

			$redirection_url       = '';
			$site_url              = get_site_url();
			$redirection_post_type = $attributes['search']['variation'];
			$all_plugins           = get_plugins();
			if ( ( ! isset( $all_plugins['woocommerce/woocommerce.php'] ) || ! is_plugin_active( 'woocommerce/woocommerce.php' ) ) && 'product' === $redirection_post_type ) {
				$redirection_post_type = '';
			}
			if ( empty( $redirection_post_type ) || 'default' === $redirection_post_type ) {
				$redirection_url = $site_url . '/?s=' . rawurlencode( $search_keyword );
			} else {
				$redirection_url = $site_url . '/?s=' . rawurlencode( $search_keyword ) . '&post_type=' . rawurlencode( $redirection_post_type );
			}
			?>
			<li class="post search__redirection"><a href="<?php echo esc_url( $redirection_url ); ?>" rel="nofollow"><?php echo esc_html__( 'View More', 'rootblox' ); ?></a></li>
		<?php
	} else {
		?>
		<li class="post empty-result"><?php echo esc_html__( 'Hmm… we couldn’t find that. Search again?', 'rootblox' ); ?></li>
		<?php
	}

	$output = ob_get_clean();

	wp_send_json_success(
		array(
			'render' => $output,
			'posts'  => $search_results,
		)
	);
}
add_action( 'wp_ajax_rootblox_ajax_search_result', 'rootblox_ajax_search_result_handler' );
add_action( 'wp_ajax_nopriv_rootblox_ajax_search_result', 'rootblox_ajax_search_result_handler' );

/**
 * Returns the upsell URL for the RootBlox plugin.
 *
 * This function checks if the submenu for the RootBlox top-level admin menu (`_rootblox`)
 * has been registered. If the submenu exists but is empty, it defaults to the main `_rootblox` page.
 * Otherwise, it links directly to the pricing/upsell page (`_rootblox-pricing`).
 *
 * @global array $submenu WordPress global submenu array.
 *
 * @return string The URL to the upsell or fallback admin page.
 */
function rootblox_get_upsell_url() {
	$upsell_url = 'https://rootblox.cozythemes.com/#pricing-table';

	return $upsell_url;
}