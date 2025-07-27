<?php
/**
 * AJAX callback to dismiss the RootBlox welcome notice.
 *
 * This function is triggered via an AJAX request when the user dismisses
 * the welcome notice. It verifies the security nonce and then updates
 * the corresponding option to prevent the notice from reappearing.
 *
 * @since 1.0.0
 *
 * @return void
 */
function rootblox_clear_welcome_notice_callback() {
	check_ajax_referer( 'rootblox-welcome-notice-dismissable', 'nonce', true );

	if ( ! current_user_can( 'manage_options' ) ) {
		wp_send_json_error( 'Insufficient permission' );
	}

	update_option( 'rootblox_welcome_notice_dismissed', 1 );
}
add_action( 'wp_ajax_rootblox_clear_welcome_notice', 'rootblox_clear_welcome_notice_callback' );
add_action( 'wp_ajax_nopriv_rootblox_clear_welcome_notice', 'rootblox_clear_welcome_notice_callback' );

/**
 * Determines whether a specific RootBlox block should be registered.
 *
 * This function checks two conditions:
 * 1. If the block is a premium-only block and the user is not using the premium version,
 *    it returns false to prevent registration.
 * 2. It checks the stored block status option to see if the block has been manually
 *    set to 'inactive', and returns false if so.
 *
 * If none of the above conditions are met, the block is considered active and the function returns true.
 *
 * @since 1.0.0
 *
 * @param string $block_name The name/slug of the block being checked.
 * @return bool True if the block should be registered, false otherwise.
 */
function rootblox_block_registration_status_callback( $block_name ) {
	$pro_blocks = array(
		'copyright-text',
		'business-hours',
	);

	if ( in_array( $block_name, $pro_blocks, true ) && ! rootblox_is_premium() ) {
		return false;
	}

	$block_status = get_option( 'rootblox_block_status' );

	if ( ! empty( $block_status ) && is_array( $block_status ) ) {
		if ( isset( $block_status[ $block_name ] ) && ! empty( $block_status[ $block_name ] ) ) {
			if ( 'inactive' === $block_status[ $block_name ] ) {
				return false;
			}
		}
	}

	return true;
}
add_filter( 'rootblox_block_registration_status', 'rootblox_block_registration_status_callback' );

function rootblox_update_block_status_callback() {
	check_ajax_referer( 'rootblox-block-status', 'nonce', true );

	if ( ! current_user_can( 'manage_options' ) ) {
		wp_send_json_error( 'Insufficient permission' );
	}

	$block_name = isset( $_POST['blockName'] ) ? sanitize_text_field( wp_unslash( $_POST['blockName'] ) ) : '';
	$status     = isset( $_POST['status'] ) ? sanitize_text_field( wp_unslash( $_POST['status'] ) ) : '';

	$block_dirs = glob( ROOTBLOX_PLUGIN_DIR . 'blocks/*' );
	$block_list = array_map( 'basename', $block_dirs );

	if ( ! in_array( $block_name, $block_list, true ) ) {
		wp_send_json_error( 'Not a Rootblox block' );
	}

	$block_status = get_option( 'rootblox_block_status' );

	if ( ! is_array( $block_status ) ) {
		$block_status = array();
	}

	if ( is_array( $block_status ) && ! empty( $block_list ) && isset( $block_status[ $block_name ] ) ) {
		$block_status[ $block_name ] = $status;
		update_option( 'rootblox_block_status', $block_status );
	} else {
		$block_status[ $block_name ] = $status;
		update_option( 'rootblox_block_status', $block_status );
	}

	wp_send_json_success( 'Block status updated!' );
}
add_action( 'wp_ajax_rootblox_update_block_status', 'rootblox_update_block_status_callback' );
add_action( 'wp_ajax_nopriv_rootblox_update_block_status', 'rootblox_update_block_status_callback' );
