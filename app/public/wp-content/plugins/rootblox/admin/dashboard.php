<?php
// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="cthf__admin-dashboard">
	<section class="cthf-admin__toolbar">
		<div class="toolbar__divider">
			<ul class="toolbar__tabs">
				<li class="toolbar__tab cthf__logo-wrap">
					<figure class="cthf__logo">
						<img src="<?php echo esc_url( ROOTBLOX_PLUGIN_URL . 'admin/assets/img/rootblox.png' ); ?>" />
					</figure>
					<span class="cthf__brand-name">
						<?php
						esc_html_e( 'Rootblox', 'rootblox' );
						echo '<br />';
						?>
						<span class="cthf__version"><?php echo esc_html__( 'v', 'rootblox' ) . ROOTBLOX_VERSION; ?></span>
					</span>
					<?php
					if ( rootblox_is_premium() ) {
						?>
						<svg class="pro__crown" width="16" height="13" viewBox="0 0 16 13" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							<path d="M13.2 11.2H2.8C2.58 11.2 2.4 11.38 2.4 11.6V12.4C2.4 12.62 2.58 12.8 2.8 12.8H13.2C13.42 12.8 13.6 12.62 13.6 12.4V11.6C13.6 11.38 13.42 11.2 13.2 11.2ZM14.8 3.2C14.1375 3.2 13.6 3.7375 13.6 4.4C13.6 4.5775 13.64 4.7425 13.71 4.895L11.9 5.98C11.515 6.21 11.0175 6.08 10.795 5.69L8.7575 2.125C9.025 1.905 9.2 1.575 9.2 1.2C9.2 0.5375 8.6625 0 8 0C7.3375 0 6.8 0.5375 6.8 1.2C6.8 1.575 6.975 1.905 7.2425 2.125L5.205 5.69C4.9825 6.08 4.4825 6.21 4.1 5.98L2.2925 4.895C2.36 4.745 2.4025 4.5775 2.4025 4.4C2.4025 3.7375 1.865 3.2 1.2025 3.2C0.54 3.2 0 3.7375 0 4.4C0 5.0625 0.5375 5.6 1.2 5.6C1.265 5.6 1.33 5.59 1.3925 5.58L3.2 10.4H12.8L14.6075 5.58C14.67 5.59 14.735 5.6 14.8 5.6C15.4625 5.6 16 5.0625 16 4.4C16 3.7375 15.4625 3.2 14.8 3.2Z" fill="currentColor" />
						</svg>

						<?php
					}
					?>
				</li>
				<li class="toolbar__tab active-tab">
					<?php esc_html_e( 'Welcome', 'rootblox' ); ?>
				</li>
				<li class="toolbar__tab">
					<?php esc_html_e( 'Blocks', 'rootblox' ); ?>
				</li>
				<li class="toolbar__tab">
					<?php esc_html_e( 'Free vs Pro', 'rootblox' ); ?>
				</li>
			</ul>

			<div class="site-redirection__wrap">
				<a class="site-redirection" href="https://rootblox.cozythemes.com/" target="_blank" rel="nofollow"><?php esc_html_e( 'Visit Site', 'rootblox' ); ?></a>
			</div>
		</div>
	</section>

	<div class="cthf__dashboard-body-wrap">
		<?php
		if ( class_exists( 'Cozy_Addons' ) && cozy_addons_premium_access() ) {
			?>
			<div class="cthf__dashboard-notice"><?php esc_html_e( "It looks like you have an active 'Cozy Blocks Pro' subscription, which automatically includes access to 'Rootblox Pro'.", 'rootblox' ); ?></div>
			<?php
		}
		?>
		<div class="cthf__dashboard-body">

			<div class="tabs__content">
				<div class="content__item">
					<?php
					require_once ROOTBLOX_PLUGIN_DIR . 'admin/tabs/welcome.php';
					?>
				</div>
				<div class="content__item cthf__display-none">
					<?php
					require_once ROOTBLOX_PLUGIN_DIR . 'admin/tabs/blocks.php';
					?>
				</div>
				<div class="content__item cthf__display-none">
					<?php
					require_once ROOTBLOX_PLUGIN_DIR . 'admin/tabs/free-vs-pro.php';
					?>
				</div>

				<?php
				if ( ! rootblox_is_premium() ) {
					$upsell_url = rootblox_get_upsell_url();
					?>
					<div class="upsell__section">
						<div class="btn-wrap">
							<a class="btn btn__primary" href="<?php echo esc_url( $upsell_url ); ?>" target="_blank" rel="nofollow"><?php esc_html_e( 'Upgrade to Pro', 'rootblox' ); ?></a>
							<a class="btn btn__secondary" href="https://rootblox.cozythemes.com/#features" target="_blank" rel="nofollow"><?php esc_html_e( 'View Full Features Comparison', 'rootblox' ); ?></a>
						</div>
					</div>
					<?php
				}
				?>
			</div>

			<div class="cthf__sidebar">
				<?php
				require_once ROOTBLOX_PLUGIN_DIR . 'admin/tabs/sidebar.php';
				?>
			</div>
		</div>
	</div>
</div>