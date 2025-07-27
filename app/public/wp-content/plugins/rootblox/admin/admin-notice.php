<?php
/**
 * Displays a welcome admin notice for the Rootblox plugin.
 *
 * This function outputs a dismissible admin notice in the WordPress dashboard
 * for users who have the `manage_options` capability. It is not shown in the
 * network admin area and is suppressed if the notice has already been dismissed
 * (tracked via the `rootblox_welcome_notice_dismissed` option).
 *
 * The notice includes a header and can be extended to include additional
 * plugin-related information in the `.plugin-screen` section.
 *
 * @return void
 */
function rootblox_welcome_notice() {
	if ( is_admin() ) {
		$current_screen = get_current_screen();

		if ( is_network_admin() || ! current_user_can( 'manage_options' ) || filter_var( get_option( 'rootblox_welcome_notice_dismissed' ), FILTER_VALIDATE_BOOL ) || ( 'toplevel_page__rootblox' !== $current_screen->id && 'dashboard' !== $current_screen->id && 'plugins' !== $current_screen->id ) ) {
			return;
		}

		$rootblox_url = admin_url( 'admin.php?page=_rootblox' );
		$upsell_url   = rootblox_get_upsell_url();
		?>
		<div class="notice notice-info is-dismissible rootblox__welcome-notice">
			<div class="notice-content">
				<div class="brand-logo">
					<figure>
						<img src="<?php echo esc_url( ROOTBLOX_PLUGIN_URL . 'admin/assets/img/rootblox.png' ); ?>" alt="<?php esc_html_e( 'Rootblox brand logo', 'rootblox' ); ?>" />
					</figure>
				</div>
				<div class="notice-holder">
					<h2><?php esc_html_e( 'Thank You for Using Rootblox – Power Up Your Site!!', 'rootblox' ); ?></h2>
					<p><?php esc_html_e( 'Build stunning headers & footers with ease! Rootblox gives you 20+ headers, 50+ footers, a responsive menu builder, AJAX search, scroll progress bar & back to top button—all fully compatible with Full Site Editing.', 'rootblox' ); ?></p>
					<div class="cthf__btn-wrap">
						<a class="cthf__btn btn__primary" href="<?php echo esc_url( $rootblox_url ); ?>"><?php esc_html_e( 'Explore Rootblox', 'rootblox' ); ?></a>
						<a class="cthf__btn btn__secondary" href="<?php echo esc_url( $upsell_url ); ?>"><?php esc_html_e( 'Upgrade to PRO', 'rootblox' ); ?></a>
					</div>
				</div>
			</div>

			<div class="plugin-screen">
				<figure class="rootblox-notice__banner">
					<img src="<?php echo esc_url( ROOTBLOX_PLUGIN_URL . 'admin/assets/img/welcome-notice-banner.png' ); ?>" />
				</figure>
			</div>

		</div>
		<?php
	}
}
add_action( 'admin_notices', 'rootblox_welcome_notice' );
