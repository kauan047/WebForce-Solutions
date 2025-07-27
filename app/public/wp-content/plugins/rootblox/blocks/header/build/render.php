<?php
// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$client_id = isset( $attributes['clientId'] ) ? str_replace( '-', '_', sanitize_key( wp_unslash( $attributes['clientId'] ) ) ) : '';

$block_id = 'cthf_' . $client_id;

// Necessary variables
$attributes['ajaxURL']     = admin_url( 'admin-ajax.php' );
$attributes['searchNonce'] = wp_create_nonce( 'rootblox_ajax_search' );
$attributes['isPremium']   = rootblox_is_premium();

$allowed_tags = array(
	'h1',
	'h2',
	'h3',
	'h4',
	'h5',
	'h6',
	'p',
);

$sticky_styles = array(
	'backdrop_blur' => isset( $attributes['stickyHeader']['backdropBlur'] ) ? sanitize_text_field( $attributes['stickyHeader']['backdropBlur'] ) : '',
);

$colors = array(
	'mobile_bg'          => isset( $attributes['color']['mobileBg'] ) ? $attributes['color']['mobileBg'] : '',
	'text'               => isset( $attributes['color']['text'] ) ? $attributes['color']['text'] : '',
	'icon_hover'         => isset( $attributes['color']['iconHover'] ) ? $attributes['color']['iconHover'] : '',
	'sidebar_bg'         => isset( $attributes['color']['sidebarBg'] ) ? $attributes['color']['sidebarBg'] : '',
	'sidebar_close_icon' => isset( $attributes['color']['sidebarCloseIcon'] ) ? $attributes['color']['sidebarCloseIcon'] : '',
	'bg'                 => isset( $attributes['color']['bg'] ) ? $attributes['color']['bg'] : '',
);

$mm_styles      = array(
	'wrapper_padding' => isset( $attributes['mobileMenu']['wrapperPadding'] ) ? rootblox_render_trbl( 'padding', $attributes['mobileMenu']['wrapperPadding'] ) : '',
	'wrapper_border'  => isset( $attributes['mobileMenu']['wrapperBorder'] ) ? rootblox_render_trbl( 'border', $attributes['mobileMenu']['wrapperBorder'] ) : '',
	'layout_attr'     => array(
		'0' => array(
			'gap'       => isset( $attributes['mobileMenu']['layoutAttr'][0]['gap'] ) ? $attributes['mobileMenu']['layoutAttr'][0]['gap'] : '',
			'flex_wrap' => isset( $attributes['mobileMenu']['layoutAttr'][0]['stackLayout'] ) && filter_Var( $attributes['mobileMenu']['layoutAttr'][0]['stackLayout'], FILTER_VALIDATE_BOOLEAN ) ? 'wrap' : 'nowrap',
		),
		'1' => array(
			'gap'       => isset( $attributes['mobileMenu']['layoutAttr'][1]['gap'] ) ? $attributes['mobileMenu']['layoutAttr'][1]['gap'] : '',
			'flex_wrap' => isset( $attributes['mobileMenu']['layoutAttr'][1]['stackLayout'] ) && filter_Var( $attributes['mobileMenu']['layoutAttr'][1]['stackLayout'], FILTER_VALIDATE_BOOLEAN ) ? 'wrap' : 'nowrap',
		),
		'2' => array(
			'gap'       => isset( $attributes['mobileMenu']['layoutAttr'][2]['gap'] ) ? $attributes['mobileMenu']['layoutAttr'][2]['gap'] : '',
			'flex_wrap' => isset( $attributes['mobileMenu']['layoutAttr'][2]['stackLayout'] ) && filter_Var( $attributes['mobileMenu']['layoutAttr'][2]['stackLayout'], FILTER_VALIDATE_BOOLEAN ) ? 'wrap' : 'nowrap',
		),
	),
	'icon_size'       => isset( $attributes['mobileMenu']['iconSize'] ) ? $attributes['mobileMenu']['iconSize'] : '',
);
$sidebar_styles = array(
	'width'   => isset( $attributes['sidebar']['width'] ) ? $attributes['sidebar']['width'] : '',
	'padding' => isset( $attributes['sidebar']['padding'] ) ? rootblox_render_trbl( 'padding', $attributes['sidebar']['padding'] ) : '',
);

$site_logo_styles = array(
	'logo_width'     => isset( $attributes['siteLogo']['width'] ) ? $attributes['siteLogo']['width'] : '',
	'title_tag'      => isset( $attributes['siteLogo']['titleTag'] ) && in_array( $attributes['siteLogo']['titleTag'], $allowed_tags, true ) ? $attributes['siteLogo']['titleTag'] : 'p',
	'gap'            => isset( $attributes['siteLogo']['gap'] ) ? $attributes['siteLogo']['gap'] : '',
	'font'           => array(
		'size'   => isset( $attributes['siteLogo']['font']['size'] ) ? $attributes['siteLogo']['font']['size'] : '',
		'family' => isset( $attributes['siteLogo']['font']['family'] ) ? $attributes['siteLogo']['font']['family'] : '',
	),
	'line_height'    => isset( $attributes['siteLogo']['lineHeight'] ) ? $attributes['siteLogo']['lineHeight'] : '',
	'letter_spacing' => isset( $attributes['siteLogo']['letterSpacing'] ) ? $attributes['siteLogo']['letterSpacing'] : '',
	'color'          => array(
		'text'       => isset( $attributes['siteLogo']['color']['text'] ) ? $attributes['siteLogo']['color']['text'] : '',
		'text_hover' => isset( $attributes['siteLogo']['color']['textHover'] ) ? $attributes['siteLogo']['color']['textHover'] : '',
	),
);

$sidebar_logo_styles = array(
	'logo_width'     => isset( $attributes['sidebarSiteLogo']['width'] ) ? $attributes['sidebarSiteLogo']['width'] : '',
	'title_tag'      => isset( $attributes['sidebarSiteLogo']['titleTag'] ) && in_array( $attributes['sidebarSiteLogo']['titleTag'], $allowed_tags, true ) ? $attributes['sidebarSiteLogo']['titleTag'] : 'p',
	'gap'            => isset( $attributes['sidebarSiteLogo']['gap'] ) ? $attributes['sidebarSiteLogo']['gap'] : '',
	'font'           => array(
		'size'   => isset( $attributes['sidebarSiteLogo']['font']['size'] ) ? $attributes['sidebarSiteLogo']['font']['size'] : '',
		'family' => isset( $attributes['sidebarSiteLogo']['font']['family'] ) ? $attributes['sidebarSiteLogo']['font']['family'] : '',
	),
	'line_height'    => isset( $attributes['sidebarSiteLogo']['lineHeight'] ) ? $attributes['sidebarSiteLogo']['lineHeight'] : '',
	'letter_spacing' => isset( $attributes['sidebarSiteLogo']['letterSpacing'] ) ? $attributes['sidebarSiteLogo']['letterSpacing'] : '',
	'color'          => array(
		'text'       => isset( $attributes['sidebarSiteLogo']['color']['text'] ) ? $attributes['sidebarSiteLogo']['color']['text'] : '',
		'text_hover' => isset( $attributes['sidebarSiteLogo']['color']['textHover'] ) ? $attributes['sidebarSiteLogo']['color']['textHover'] : '',
	),
);

$nav_styles = array(
	'padding'        => isset( $attributes['navigation']['padding'] ) ? rootblox_render_trbl( 'padding', $attributes['navigation']['padding'] ) : '',
	'margin'         => array(
		'top'    => isset( $attributes['navigation']['margin']['top'] ) ? $attributes['navigation']['margin']['top'] : '',
		'bottom' => isset( $attributes['navigation']['margin']['bottom'] ) ? $attributes['navigation']['margin']['bottom'] : '',
	),
	'border'         => isset( $attributes['navigation']['border'] ) ? rootblox_render_trbl( 'border', $attributes['navigation']['border'] ) : '',
	'menu_gap'       => isset( $attributes['navigation']['menuGap'] ) ? $attributes['navigation']['menuGap'] : '',
	'submenu_gap'    => isset( $attributes['navigation']['submenuGap'] ) ? $attributes['navigation']['submenuGap'] : '',
	'item_padding'   => isset( $attributes['navigation']['itemPadding'] ) ? rootblox_render_trbl( 'padding', $attributes['navigation']['itemPadding'] ) : '',
	'item_border'    => isset( $attributes['navigation']['itemBorder'] ) ? rootblox_render_trbl( 'border', $attributes['navigation']['itemBorder'] ) : '',
	'font'           => array(
		'size'   => isset( $attributes['navigation']['font']['size'] ) ? $attributes['navigation']['font']['size'] : '',
		'family' => isset( $attributes['navigation']['font']['family'] ) ? $attributes['navigation']['font']['family'] : '',
	),
	'line_height'    => isset( $attributes['navigation']['lineHeight'] ) ? $attributes['navigation']['lineHeight'] : '',
	'letter_spacing' => isset( $attributes['navigation']['letterSpacing'] ) ? $attributes['navigation']['letterSpacing'] : '',
	'color'          => array(
		'icon'               => isset( $attributes['navigation']['color']['icon'] ) && ! empty( $attributes['navigation']['color']['icon'] ) ? $attributes['navigation']['color']['icon'] : $colors['text'],
		'icon_hover'         => isset( $attributes['navigation']['color']['iconHover'] ) && ! empty( $attributes['navigation']['color']['iconHover'] ) ? $attributes['navigation']['color']['iconHover'] : $colors['icon_hover'],
		'text'               => isset( $attributes['navigation']['color']['text'] ) && ! empty( $attributes['navigation']['color']['text'] ) ? $attributes['navigation']['color']['text'] : $colors['text'],
		'text_hover'         => isset( $attributes['navigation']['color']['textHover'] ) ? $attributes['navigation']['color']['textHover'] : '',
		'submenu'            => isset( $attributes['navigation']['color']['submenu'] ) && ! empty( $attributes['navigation']['color']['submenu'] ) ? $attributes['navigation']['color']['submenu'] : '',
		'submenu_hover'      => isset( $attributes['navigation']['color']['submenuHover'] ) ? $attributes['navigation']['color']['submenuHover'] : '',
		'submenu_icon'       => isset( $attributes['navigation']['color']['submenuIcon'] ) && ! empty( $attributes['navigation']['color']['submenuIcon'] ) ? $attributes['navigation']['color']['submenuIcon'] : '',
		'submenu_icon_hover' => isset( $attributes['navigation']['color']['submenuIconHover'] ) && ! empty( $attributes['navigation']['color']['submenuIconHover'] ) ? $attributes['navigation']['color']['submenuIconHover'] : '',
	),
	'icon_size'      => isset( $attributes['navigation']['iconSize'] ) && ! empty( $attributes['navigation']['iconSize'] ) ? $attributes['navigation']['iconSize'] : $mm_styles['icon_size'],
);

$sidebar_cta = array(
	'stacked'        => isset( $attributes['sidebarCTA']['stacked'] ) && filter_var( $attributes['sidebarCTA']['stacked'], FILTER_VALIDATE_BOOLEAN ) ? 'wrap' : 'nowrap',
	'gap'            => isset( $attributes['sidebarCTA']['gap'] ) ? $attributes['sidebarCTA']['gap'] : '',
	'row_gap'        => isset( $attributes['sidebarCTA']['rowGap'] ) ? $attributes['sidebarCTA']['rowGap'] : '',
	'width'          => isset( $attributes['sidebarCTA']['width'] ) ? $attributes['sidebarCTA']['width'] : '',
	'padding'        => isset( $attributes['sidebarCTA']['padding'] ) ? rootblox_render_trbl( 'padding', $attributes['sidebarCTA']['padding'] ) : '',
	'margin'         => array(
		'top'    => isset( $attributes['sidebarCTA']['margin']['top'] ) ? $attributes['sidebarCTA']['margin']['top'] : '',
		'bottom' => isset( $attributes['sidebarCTA']['margin']['bottom'] ) ? $attributes['sidebarCTA']['margin']['bottom'] : '',
	),
	'border'         => isset( $attributes['sidebarCTA']['border'] ) ? rootblox_render_trbl( 'border', $attributes['sidebarCTA']['border'] ) : '',
	'radius'         => isset( $attributes['sidebarCTA']['radius'] ) ? $attributes['sidebarCTA']['radius'] : '',
	'font'           => array(
		'size'   => isset( $attributes['sidebarCTA']['font']['size'] ) ? $attributes['sidebarCTA']['font']['size'] : '',
		'family' => isset( $attributes['sidebarCTA']['font']['family'] ) ? $attributes['sidebarCTA']['font']['family'] : '',
	),
	'line_height'    => isset( $attributes['sidebarCTA']['lineHeight'] ) ? $attributes['sidebarCTA']['lineHeight'] : '',
	'letter_spacing' => isset( $attributes['sidebarCTA']['letterSpacing'] ) ? $attributes['sidebarCTA']['letterSpacing'] : '',
	'color'          => array(
		'text'         => isset( $attributes['sidebarCTA']['color']['text'] ) ? $attributes['sidebarCTA']['color']['text'] : $colors['text'],
		'text_hover'   => isset( $attributes['sidebarCTA']['color']['textHover'] ) ? $attributes['sidebarCTA']['color']['textHover'] : '',
		'bg'           => isset( $attributes['sidebarCTA']['color']['bg'] ) ? $attributes['sidebarCTA']['color']['bg'] : '',
		'bg_hover'     => isset( $attributes['sidebarCTA']['color']['bgHover'] ) ? $attributes['sidebarCTA']['color']['bgHover'] : '',
		'border_hover' => isset( $attributes['sidebarCTA']['color']['borderHover'] ) ? $attributes['sidebarCTA']['color']['borderHover'] : '',
	),
);

$sidebar_social = array(
	'margin'     => array(
		'top'    => isset( $attributes['sidebarSocial']['margin']['top'] ) ? $attributes['sidebarSocial']['margin']['top'] : '',
		'bottom' => isset( $attributes['sidebarSocial']['margin']['bottom'] ) ? $attributes['sidebarSocial']['margin']['bottom'] : '',
	),
	'box_width'  => isset( $attributes['sidebarSocial']['boxWidth'] ) ? $attributes['sidebarSocial']['boxWidth'] : '',
	'box_height' => isset( $attributes['sidebarSocial']['boxHeight'] ) ? $attributes['sidebarSocial']['boxHeight'] : '',
	'border'     => isset( $attributes['sidebarSocial']['border'] ) ? rootblox_render_trbl( 'border', $attributes['sidebarSocial']['border'] ) : '',
	'radius'     => isset( $attributes['sidebarSocial']['radius'] ) ? $attributes['sidebarSocial']['radius'] : '',
	'gap'        => isset( $attributes['sidebarSocial']['gap'] ) ? $attributes['sidebarSocial']['gap'] : '',
	'row_gap'    => isset( $attributes['sidebarSocial']['rowGap'] ) ? $attributes['sidebarSocial']['rowGap'] : '',
	'size'       => isset( $attributes['sidebarSocial']['size'] ) ? $attributes['sidebarSocial']['size'] : '',
	'stack'      => isset( $attributes['sidebarSocial']['stackLayout'] ) && filter_var( $attributes['sidebarSocial']['stackLayout'], FILTER_VALIDATE_BOOLEAN ) ? 'wrap' : 'nowrap',
	'color'      => array(
		'icon'         => isset( $attributes['sidebarSocial']['color']['icon'] ) ? $attributes['sidebarSocial']['color']['icon'] : '',
		'icon_hover'   => isset( $attributes['sidebarSocial']['color']['iconHover'] ) ? $attributes['sidebarSocial']['color']['iconHover'] : '',
		'bg'           => isset( $attributes['sidebarSocial']['color']['bg'] ) ? $attributes['sidebarSocial']['color']['bg'] : '',
		'bg_hover'     => isset( $attributes['sidebarSocial']['color']['bgHover'] ) ? $attributes['sidebarSocial']['color']['bgHover'] : '',
		'border_hover' => isset( $attributes['sidebarSocial']['color']['borderHover'] ) ? $attributes['sidebarSocial']['color']['borderHover'] : '',
	),
);

$cta_button = array(
	'padding'        => isset( $attributes['ctaButton']['padding'] ) ? rootblox_render_trbl( 'padding', $attributes['ctaButton']['padding'] ) : '',
	'border'         => isset( $attributes['ctaButton']['border'] ) ? rootblox_render_trbl( 'border', $attributes['ctaButton']['border'] ) : '',
	'radius'         => isset( $attributes['ctaButton']['radius'] ) ? rootblox_render_trbl( 'radius', $attributes['ctaButton']['radius'] ) : '',
	'font'           => array(
		'size'   => isset( $attributes['ctaButton']['font']['size'] ) ? $attributes['ctaButton']['font']['size'] : '',
		'family' => isset( $attributes['ctaButton']['font']['family'] ) ? $attributes['ctaButton']['font']['family'] : '',
	),
	'line_height'    => isset( $attributes['ctaButton']['lineHeight'] ) ? $attributes['ctaButton']['lineHeight'] : '',
	'letter_spacing' => isset( $attributes['ctaButton']['letterSpacing'] ) ? $attributes['ctaButton']['letterSpacing'] : '',
	'color'          => array(
		'text'         => isset( $attributes['ctaButton']['color']['text'] ) && ! empty( $attributes['ctaButton']['color']['text'] ) ? $attributes['ctaButton']['color']['text'] : $colors['text'],
		'text_hover'   => isset( $attributes['ctaButton']['color']['textHover'] ) ? $attributes['ctaButton']['color']['textHover'] : '',
		'bg'           => isset( $attributes['ctaButton']['color']['bg'] ) ? $attributes['ctaButton']['color']['bg'] : '',
		'bg_hover'     => isset( $attributes['ctaButton']['color']['bgHover'] ) ? $attributes['ctaButton']['color']['bgHover'] : '',
		'border_hover' => isset( $attributes['ctaButton']['color']['borderHover'] ) ? $attributes['ctaButton']['color']['borderHover'] : '',
	),
);

$search_styles = array(
	'heading'    => array(
		'content'        => isset( $attributes['search']['heading']['content'] ) ? sanitize_text_field( $attributes['search']['heading']['content'] ) : '',
		'font'           => array(
			'size'   => isset( $attributes['search']['heading']['font']['size'] ) ? $attributes['search']['heading']['font']['size'] : '',
			'family' => isset( $attributes['search']['heading']['font']['family'] ) ? $attributes['search']['heading']['font']['family'] : '',
		),
		'line_height'    => isset( $attributes['search']['heading']['lineHeight'] ) ? $attributes['search']['heading']['lineHeight'] : '',
		'letter_spacing' => isset( $attributes['search']['heading']['letterSpacing'] ) ? $attributes['search']['heading']['letterSpacing'] : '',
	),
	'post_title' => array(
		'font'           => array(
			'size'   => isset( $attributes['search']['postTitle']['font']['size'] ) ? $attributes['search']['postTitle']['font']['size'] : '',
			'family' => isset( $attributes['search']['postTitle']['font']['family'] ) ? $attributes['search']['postTitle']['font']['family'] : '',
		),
		'line_height'    => isset( $attributes['search']['postTitle']['lineHeight'] ) ? $attributes['search']['postTitle']['lineHeight'] : '',
		'letter_spacing' => isset( $attributes['search']['postTitle']['letterSpacing'] ) ? $attributes['search']['postTitle']['letterSpacing'] : '',
	),
	'color'      => array(
		'icon'       => isset( $attributes['search']['color']['icon'] ) && ! empty( $attributes['search']['color']['icon'] ) ? $attributes['search']['color']['icon'] : $colors['text'],
		'icon_hover' => isset( $attributes['search']['color']['iconHover'] ) && ! empty( $attributes['search']['color']['iconHover'] ) ? $attributes['search']['color']['iconHover'] : $colors['icon_hover'],
		'heading'    => isset( $attributes['search']['color']['heading'] ) && ! empty( $attributes['search']['color']['heading'] ) ? $attributes['search']['color']['heading'] : '',
		'text'       => isset( $attributes['search']['color']['text'] ) && ! empty( $attributes['search']['color']['text'] ) ? $attributes['search']['color']['text'] : $colors['text'],
		'link'       => isset( $attributes['search']['color']['link'] ) && ! empty( $attributes['search']['color']['link'] ) ? $attributes['search']['color']['link'] : $colors['text'],
		'link_hover' => isset( $attributes['search']['color']['linkHover'] ) && ! empty( $attributes['search']['color']['linkHover'] ) ? $attributes['search']['color']['linkHover'] : '',
		'overlay'    => isset( $attributes['search']['color']['overlay'] ) ? $attributes['search']['color']['overlay'] : '',
		'close'      => isset( $attributes['search']['color']['close'] ) && ! empty( $attributes['search']['color']['close'] ) ? $attributes['search']['color']['close'] : $colors['text'],
	),
	'icon_size'  => isset( $attributes['search']['iconSize'] ) && ! empty( $attributes['search']['iconSize'] ) ? $attributes['search']['iconSize'] : $mm_styles['icon_size'],
);

$minicart_styles = array(
	'font'      => array(
		'size'   => isset( $attributes['miniCart']['font']['size'] ) ? $attributes['miniCart']['font']['size'] : '',
		'family' => isset( $attributes['miniCart']['font']['family'] ) ? $attributes['miniCart']['font']['family'] : '',
	),
	'color'     => array(
		'icon'       => isset( $attributes['miniCart']['color']['icon'] ) && ! empty( $attributes['miniCart']['color']['icon'] ) ? $attributes['miniCart']['color']['icon'] : $colors['text'],
		'icon_hover' => isset( $attributes['miniCart']['color']['iconHover'] ) ? $attributes['miniCart']['color']['iconHover'] : '',
		'text'       => isset( $attributes['miniCart']['color']['text'] ) && ! empty( $attributes['miniCart']['color']['text'] ) ? $attributes['miniCart']['color']['text'] : $colors['text'],
		'text_bg'    => isset( $attributes['miniCart']['color']['textBg'] ) ? $attributes['miniCart']['color']['textBg'] : '',
	),
	'icon_size' => isset( $attributes['miniCart']['iconSize'] ) && ! empty( $attributes['miniCart']['iconSize'] ) ? $attributes['miniCart']['iconSize'] : $mm_styles['icon_size'],
);

$acc_styles = array(
	'color'     => array(
		'icon'       => isset( $attributes['acc']['color']['icon'] ) && ! empty( $attributes['acc']['color']['icon'] ) ? $attributes['acc']['color']['icon'] : $colors['text'],
		'icon_hover' => isset( $attributes['acc']['color']['iconHover'] ) ? $attributes['acc']['color']['iconHover'] : '',
	),
	'icon_size' => isset( $attributes['acc']['iconSize'] ) && ! empty( $attributes['acc']['iconSize'] ) ? $attributes['acc']['iconSize'] : $mm_styles['icon_size'],
);

$block_styles = "
#$block_id {
	background-color: {$colors['bg']};
}

#$block_id.is-sticky.on-scroll__sticky:not(.top-bar__is-sticky) > .wp-block-group, #$block_id.is-sticky.on-scroll__sticky.top-bar__is-sticky {
	backdrop-filter: blur({$sticky_styles['backdrop_blur']});
}

.cthf__mobile-layout-wrapper.element-$block_id {
	{$mm_styles['wrapper_padding']}
	{$mm_styles['wrapper_border']}
	background-color: {$colors['mobile_bg']};

	& .wc-block-mini-cart__icon, & .cthf__mob-icon, & .cthf__cta-anchor-btn {
		color: {$colors['text']};

		&:hover {
			color: {$colors['icon_hover']};
		}
	}

	& .cthf__mob-icon.nav__icon {
		color: {$nav_styles['color']['icon']};
		width: {$nav_styles['icon_size']};
		height: {$nav_styles['icon_size']};

		&:hover {
			color: {$nav_styles['color']['icon_hover']};
		}
	}

	& .cthf__mob-icon.user__icon {
		width: {$acc_styles['icon_size']};
		height: {$acc_styles['icon_size']};
		color: {$acc_styles['color']['icon']};

		&:hover {
			color: {$acc_styles['color']['icon_hover']};
		}
	}

	& .wc-block-mini-cart__icon {
		width: {$minicart_styles['icon_size']};
		height: {$minicart_styles['icon_size']};
		color: {$minicart_styles['color']['icon']};

		&:hover {
			color: {$minicart_styles['color']['icon_hover']};
		}
	}
	& .wc-block-mini-cart__badge {
		font-size: {$minicart_styles['font']['size']};
		font-weight: {$attributes['miniCart']['font']['weight']};
		font-family: {$minicart_styles['font']['family']};
		color: {$minicart_styles['color']['text']};
		background: {$minicart_styles['color']['text_bg']};
	}

	& .cthf__responsive-navigation.layout-wrap-1 {
		gap: {$mm_styles['layout_attr']['0']['gap']};
		flex-wrap: {$mm_styles['layout_attr']['0']['flex_wrap']};
	}
	& .cthf__responsive-navigation.layout-wrap-2 {
		gap: {$mm_styles['layout_attr']['1']['gap']};
		flex-wrap: {$mm_styles['layout_attr']['1']['flex_wrap']};
	}
	& .cthf__responsive-navigation.layout-wrap-3 {
		gap: {$mm_styles['layout_attr']['2']['gap']};
		flex-wrap: {$mm_styles['layout_attr']['2']['flex_wrap']};
	}

	& .cthf__site-identity-wrap {
		gap: {$site_logo_styles['gap']};
	}
	& .custom-logo {
		max-width: {$site_logo_styles['logo_width']};
	}
	& .site-title {
		line-height: {$site_logo_styles['line_height']};
		letter-spacing: {$site_logo_styles['letter_spacing']};
	}
	& .site-title a {
		font-size: {$site_logo_styles['font']['size']};
		font-weight: {$attributes['siteLogo']['font']['weight']};
		font-family: {$site_logo_styles['font']['family']};
		text-transform: {$attributes['siteLogo']['letterCase']};
		text-decoration: {$attributes['siteLogo']['decoration']};
		line-height: {$site_logo_styles['line_height']};
		color: {$site_logo_styles['color']['text']};
		
		&:hover {
			color: {$site_logo_styles['color']['text_hover']};
		}
	}

	& .cthf__responsive-navigation .cthf__cta-anchor-btn {
		{$cta_button['padding']}
		{$cta_button['border']}
		{$cta_button['radius']}
		font-size: {$cta_button['font']['size']};
		font-weight: {$attributes['ctaButton']['font']['weight']};
		font-family: {$cta_button['font']['family']};
		text-transform: {$attributes['ctaButton']['letterCase']};
		text-decoration: {$attributes['ctaButton']['decoration']};
		line-height: {$cta_button['line_height']};
		letter-spacing: {$cta_button['letter_spacing']};
		color: {$cta_button['color']['text']};
		background-color: {$cta_button['color']['bg']};

		&:hover {
			color: {$cta_button['color']['text_hover']};
			background-color: {$cta_button['color']['bg_hover']};
			border-color: {$cta_button['color']['border_hover']};
		}
	}

	& .cthf__responsive-navigation .cthf__search-wrapper {
		& .cthf__mob-icon.search__icon {
			color: {$search_styles['color']['icon']};

			&:hover {
				color: {$search_styles['color']['icon_hover']};
			}
		}
	}	
}

.cthf-block__wrapper.element-$block_id {
	& form, & form .search__icon {
		color: {$search_styles['color']['text']};
	}

	& .cthf__search-overlay {
		background-color: {$search_styles['color']['overlay']};
	}

	& .cthf__search-modal .close__icon {
		color: {$search_styles['color']['close']};
	}

	& .cthf__search-modal .search__heading {
		font-size: {$search_styles['heading']['font']['size']};
		font-weight: {$attributes['search']['heading']['font']['family']};
		font-family: {$search_styles['heading']['font']['family']};
		text-transform: {$attributes['search']['heading']['letterCase']};
		text-decoration: {$attributes['search']['heading']['decoration']};
		line-height: {$search_styles['heading']['line_height']};
		letter-spacing: {$search_styles['heading']['letter_spacing']};
		color: {$search_styles['color']['heading']};
	}
	& .cthf__search-modal .post__title {
		font-size: {$search_styles['post_title']['font']['size']};
		font-weight: {$attributes['search']['postTitle']['font']['family']};
		font-family: {$search_styles['post_title']['font']['family']};
		text-transform: {$attributes['search']['postTitle']['letterCase']};
		line-height: {$search_styles['post_title']['line_height']};
		letter-spacing: {$search_styles['post_title']['letter_spacing']};
		
		& a {
			text-decoration: {$attributes['search']['postTitle']['decoration']};
			color: {$search_styles['color']['link']};

			&:hover {
				color: {$search_styles['color']['link_hover']};
			}
		}
	}
	& .cthf__search-modal .post.search__redirection a {
		text-decoration: {$attributes['search']['postTitle']['decoration']};
		color: {$search_styles['color']['link']};

		&:hover {
			color: {$search_styles['color']['link_hover']};
		}
	}
	& .cthf__search-modal .post.empty-result {
		color: {$search_styles['color']['text']};
	}
}

.cthf__mobile-layout-wrapper.element-$block_id.is-sticky.on-scroll__sticky {
	backdrop-filter: blur({$sticky_styles['backdrop_blur']});
}

.cthf__mobile-layout-wrapper.element-$block_id .cthf__sidebar-panel-wrap .sidebar-panel__body {
	width: {$sidebar_styles['width']};
	{$sidebar_styles['padding']}
	background-color: {$colors['sidebar_bg']};

	& .close__icon {
		color: {$colors['sidebar_close_icon']};
	}

	& .cthf__site-identity-wrap {
		gap: {$sidebar_logo_styles['gap']};
	}
	& .custom-logo {
		max-width: {$sidebar_logo_styles['logo_width']};
	}
	& .site-title {
		line-height: {$sidebar_logo_styles['line_height']};
		letter-spacing: {$sidebar_logo_styles['letter_spacing']};
	}
	& .site-title a {
		font-size: {$sidebar_logo_styles['font']['size']};
		font-weight: {$attributes['sidebarSiteLogo']['font']['weight']};
		font-family: {$sidebar_logo_styles['font']['family']};
		text-transform: {$attributes['sidebarSiteLogo']['letterCase']};
		text-decoration: {$attributes['sidebarSiteLogo']['decoration']};
		line-height: {$sidebar_logo_styles['line_height']};
		color: {$sidebar_logo_styles['color']['text']};
		
		&:hover {
			color: {$sidebar_logo_styles['color']['text_hover']};
		}
	}

	& .wp-block-navigation__container {
		{$nav_styles['padding']}
		margin-top: {$nav_styles['margin']['top']};
		margin-bottom: {$nav_styles['margin']['bottom']};
		{$nav_styles['border']}
		font-size: {$nav_styles['font']['size']};
		font-weight: {$attributes['navigation']['font']['weight']};
		font-family: {$nav_styles['font']['family']};
		text-transform: {$attributes['navigation']['letterCase']};
		line-height: {$nav_styles['line_height']};
		letter-spacing: {$nav_styles['letter_spacing']};

		& > li, .wp-block-page-list li {
			{$nav_styles['item_padding']}
			{$nav_styles['item_border']}
		}

		& > li:not(:first-child) {
  			margin-top: {$nav_styles['menu_gap']};
		}
		
		& li > a, & li > svg {
			text-decoration: {$attributes['navigation']['decoration']};
			color: {$nav_styles['color']['text']};
			fill: {$nav_styles['color']['text']};
		}
		& li a:hover, & li a:hover + button svg {
			color: {$nav_styles['color']['text_hover']} !important;
			fill: {$nav_styles['color']['text_hover']};
		}

		& .wp-block-navigation-item.has-child .wp-block-navigation__submenu-container a, & .wp-block-navigation-item.has-child .wp-block-navigation__submenu-container svg {
			color: {$nav_styles['color']['submenu']};
			fill: {$nav_styles['color']['submenu']};
		}
		& .wp-block-navigation-item.has-child .wp-block-navigation__submenu-container li a:hover, & .wp-block-navigation-item.has-child .wp-block-navigation__submenu-container li a:hover + button svg {
			color: {$nav_styles['color']['submenu_hover']} !important;
			fill: {$nav_styles['color']['submenu_hover']} !important;
		}

		& .wp-block-navigation__submenu-container {
			margin-top: {$nav_styles['submenu_gap']} !important;
			margin-bottom: 0 !important;
		}

		& .wp-block-navigation__submenu-icon {
			color: {$nav_styles['color']['submenu_icon']};

			&:hover {
				color: {$nav_styles['color']['submenu_icon_hover']};
			}
		}
	}

	& .cthf__cta-btn-group {
		margin-top: {$sidebar_cta['margin']['top']};
		margin-bottom: {$sidebar_cta['margin']['bottom']};
		flex-wrap: {$sidebar_cta['stacked']};
		gap: {$sidebar_cta['gap']};
		row-gap: {$sidebar_cta['row_gap']};
		justify-content: {$attributes['sidebarCTA']['justification']};
		font-size: {$sidebar_cta['font']['size']};
		font-weight: {$attributes['sidebarCTA']['font']['weight']};
		font-family: {$sidebar_cta['font']['family']};
		text-transform: {$attributes['sidebarCTA']['letterCase']};
		line-height: {$sidebar_cta['line_height']};
		letter-spacing: {$sidebar_cta['letter_spacing']};
		
		& .cthf__cta-anchor-btn.sidebar-btn {
			{$sidebar_cta['padding']}
			{$sidebar_cta['border']}
			width: {$sidebar_cta['width']};
			border-radius: {$sidebar_cta['radius']};
			color: {$sidebar_cta['color']['text']};
			background-color: {$sidebar_cta['color']['bg']};
			text-decoration: {$attributes['sidebarCTA']['decoration']};
			
			&:hover {
				color: {$sidebar_cta['color']['text_hover']};
				background-color: {$sidebar_cta['color']['bg_hover']};
				border-color: {$sidebar_cta['color']['border_hover']};
			}
		}
	}
	
	& .cthf__social-icon-group {
		margin-top: {$sidebar_social['margin']['top']};
		margin-bottom: {$sidebar_social['margin']['bottom']};
		flex-wrap: {$sidebar_social['stack']};
		gap: {$sidebar_social['gap']};
		row-gap: {$sidebar_social['row_gap']};
		justify-content: {$attributes['sidebarSocial']['justification']};

		& .cthf__social-icon.view-stacked {
			width: {$sidebar_social['box_width']};
			height: {$sidebar_social['box_height']};
			{$sidebar_social['border']}
			border-radius: {$sidebar_social['radius']};
		}

		& .cthf__social-icon svg {
			width: {$sidebar_social['size']};
			height: {$sidebar_social['size']};
		}

		& .cthf__social-icon:not(.has-brand-color) a {
			color: {$sidebar_social['color']['icon']};
		}
		& .cthf__social-icon.view-stacked:not(.has-brand-color) {
			background-color: {$sidebar_social['color']['bg']};
		}
		& .cthf__social-icon:hover a {
			color: {$sidebar_social['color']['icon_hover']};
		}
		& .cthf__social-icon.view-stacked:hover {
			background-color: {$sidebar_social['color']['bg_hover']};
			border-color: {$sidebar_social['color']['border_hover']};
		}
	}
}
";

/* Search Logic */
if ( isset( $_SERVER['REQUEST_METHOD'] ) && 'POST' === $_SERVER['REQUEST_METHOD'] ) {
	if ( isset( $_POST['search'], $_POST['_wpnonce'] ) ) {
		$search_keyword = sanitize_text_field( wp_unslash( $_POST['search'] ) );
		$nonce          = sanitize_text_field( wp_unslash( $_POST['_wpnonce'] ) );

		if ( ! wp_verify_nonce( $nonce ) ) {
			wp_die( 'Not allowed!' );
		}

		$site_url = get_site_url();

		$redirection_post_type = $attributes['search']['variation'];

		$all_plugins = get_plugins();
		if ( ( ! isset( $all_plugins['woocommerce/woocommerce.php'] ) || ! is_plugin_active( 'woocommerce/woocommerce.php' ) ) && 'product' === $redirection_post_type ) {
			$redirection_post_type = '';
		}

		if ( empty( $redirection_post_type ) || 'default' === $redirection_post_type ) {
			header( 'Location: ' . $site_url . '/?s=' . rawurlencode( $search_keyword ) );
		} else {
			header( 'Location: ' . $site_url . '/?s=' . rawurlencode( $search_keyword ) . '&post_type=' . rawurlencode( $redirection_post_type ) );
		}
		exit;
	}
}

$font_families = array();

if ( isset( $attributes['siteLogo']['font']['family'] ) && ! empty( $attributes['siteLogo']['font']['family'] ) ) {
	$font_families[] = $attributes['siteLogo']['font']['family'];
}

if ( isset( $attributes['sidebarSiteLogo']['font']['family'] ) && ! empty( $attributes['sidebarSiteLogo']['font']['family'] ) ) {
	$font_families[] = $attributes['sidebarSiteLogo']['font']['family'];
}

if ( isset( $attributes['navigation']['font']['family'] ) && ! empty( $attributes['navigation']['font']['family'] ) ) {
	$font_families[] = $attributes['navigation']['font']['family'];
}

if ( isset( $attributes['sidebarCTA']['font']['family'] ) && ! empty( $attributes['sidebarCTA']['font']['family'] ) ) {
	$font_families[] = $attributes['sidebarCTA']['font']['family'];
}

if ( isset( $attributes['ctaButton']['font']['family'] ) && ! empty( $attributes['ctaButton']['font']['family'] ) ) {
	$font_families[] = $attributes['ctaButton']['font']['family'];
}

if ( isset( $attributes['miniCart']['font']['family'] ) && ! empty( $attributes['miniCart']['font']['family'] ) ) {
	$font_families[] = $attributes['miniCart']['font']['family'];
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
	wp_add_inline_style( 'cthf-blocks--header--style', '@import url("' . rawurldecode( esc_url( $google_fonts_url ) ) . '");' );
}

add_action(
	'wp_enqueue_scripts',
	function () use ( $block_styles ) {
		wp_add_inline_style( 'cthf-blocks--header--style', $block_styles );
	}
);

wp_localize_script( 'cthf-blocks--header--frontend-script', $block_id, $attributes );
wp_add_inline_script( 'cthf-blocks--header--frontend-script', 'document.addEventListener("DOMContentLoaded", function(event) { window.cthfHeader( "' . esc_html( $block_id ) . '" ) }) ' );

$classes   = array();
$classes[] = 'cthf-block__wrapper';
$classes[] = 'element-' . $block_id;
?>

<div class="<?php echo esc_html( implode( ' ', array_map( 'sanitize_html_class', array_values( $classes ) ) ) ); ?>">
	<?php
	if ( 'off' === $attributes['mobileMenu']['status'] || 'mobile' === $attributes['mobileMenu']['status'] ) {
		echo $content;
	}

	if ( ( 'mobile' === $attributes['mobileMenu']['status'] || 'always' === $attributes['mobileMenu']['status'] ) && ! empty( $attributes['mobileMenu']['layout'] ) ) {
		$output = apply_filters( 'rootblox_create_mobile_menu_pattern', $attributes );

		$classes   = array();
		$classes[] = 'cthf__mobile-layout-wrapper';
		$classes[] = 'element-' . $block_id;
		$classes[] = 'mobile' === $attributes['mobileMenu']['status'] ? 'cthf__display-none' : '';
		$classes[] = isset( $attributes['stickyHeader']['enabled'] ) && filter_var( $attributes['stickyHeader']['enabled'], FILTER_VALIDATE_BOOLEAN ) ? 'is-sticky' : '';
		$classes[] = isset( $attributes['stickyHeader']['enabled'], $attributes['stickyHeader']['bottomScrollHide'] ) && filter_var( $attributes['stickyHeader']['enabled'], FILTER_VALIDATE_BOOLEAN ) && filter_var( $attributes['stickyHeader']['bottomScrollHide'] ) ? 'is-bottom-scroll__hidden' : '';
		?>

		<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', array_values( $classes ) ) ) ); ?>">
			<?php
			echo $output;
			?>

			<div class="cthf__sidebar-panel-wrap cthf__display-none">
				<div class="sidebar-panel__overlay"></div>

				<?php
				$classes   = array();
				$classes[] = 'sidebar-panel__body';
				$classes[] = 'position-' . $attributes['sidebar']['position'];
				$classes[] = 'content-align-' . $attributes['sidebar']['contentAlign'];
				?>
				<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', array_values( $classes ) ) ) ); ?>">
					<svg class="close__icon" width="10" height="10" viewBox="0 0 10 10" xmlns="http://www.w3.org/2000/svg">
						<path d="M4.99999 4.058L8.29999 0.758003L9.24266 1.70067L5.94266 5.00067L9.24266 8.30067L8.29932 9.24334L4.99932 5.94334L1.69999 9.24334L0.757324 8.3L4.05732 5L0.757324 1.7L1.69999 0.75867L4.99999 4.058Z" fill="currentColor" />
					</svg>

					<?php
					if ( $attributes['sidebar']['siteLogo'] ) {
						?>
						<div class="cthf__site-identity-wrap">
							<?php
							if ( filter_var( $attributes['sidebarSiteLogo']['enableLogo'] ) ) {
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

							if ( filter_var( $attributes['sidebarSiteLogo']['enableTitle'] ) ) {
								?>
								<div class="site-title">
									<?php
									$home_url = home_url();
									printf( '<%1$s><a href="' . esc_url( $home_url ) . '">%2$s</a></%1$s>', esc_attr( $sidebar_logo_styles['title_tag'] ), esc_html( get_bloginfo( 'name' ) ) );
									?>
								</div>
								<?php
							}
							?>
						</div>
						<?php

					}

					if ( $attributes['sidebar']['navigation'] && isset( $attributes['mobileMenu']['menuID'] ) && ! empty( $attributes['mobileMenu']['menuID'] ) ) {
						$menu_id = intval( $attributes['mobileMenu']['menuID'] );

						if ( $menu_id && 'publish' === get_post_status( $menu_id ) ) {
							echo do_blocks( '<!-- wp:navigation {"ref":' . $menu_id . ', "overlayMenu": "never", "layout": {"type": "flex", "orientation":"vertical"}} /-->' );
						} else {
							echo do_blocks( '<!-- wp:navigation {"overlayMenu": "never", "layout": {"type": "flex", "orientation":"vertical"}} /-->' );
						}
					}

					if ( rootblox_is_premium() ) {
						if ( $attributes['sidebar']['button'] && is_array( $attributes['sidebar']['btnGroup'] ) ) {
							?>
							<div class="cthf__cta-btn-group">
								<?php
								foreach ( $attributes['sidebar']['btnGroup'] as $index => $cta_btn ) {
									$classes   = array();
									$classes[] = 'cthf__cta-anchor-btn';
									$classes[] = 'element-' . $block_id;
									$classes[] = 'sidebar-btn';
									$classes[] = 'cta-btn-' . ( ++$index );

									$btn_label = isset( $cta_btn['label'] ) ? $cta_btn['label'] : '';
									$btn_link  = isset( $cta_btn['link'] ) && ! empty( $cta_btn['link'] ) ? sanitize_url( $cta_btn['link'] ) : '#';
									$new_tab   = isset( $cta_btn['openNewTab'] ) && filter_var( $cta_btn['openNewTab'], FILTER_VALIDATE_BOOLEAN ) ? '_blank' : '';
									$nofollow  = isset( $cta_btn['noFollow'] ) && filter_var( $cta_btn['noFollow'], FILTER_VALIDATE_BOOLEAN ) ? 'nofollow' : '';
									$color     = array(
										'text'         => isset( $cta_btn['textColor'] ) ? $cta_btn['textColor'] : '',
										'text_hover'   => isset( $cta_btn['textHoverColor'] ) ? $cta_btn['textHoverColor'] : '',
										'bg'           => isset( $cta_btn['bgColor'] ) ? $cta_btn['bgColor'] : '',
										'bg_hover'     => isset( $cta_btn['bgHoverColor'] ) ? $cta_btn['bgHoverColor'] : '',
										'border'       => isset( $cta_btn['borderColor'] ) ? $cta_btn['borderColor'] : '',
										'border_hover' => isset( $cta_btn['borderHoverColor'] ) ? $cta_btn['borderHoverColor'] : '',
									);

									$cta_btn_styles = "
									.element-$block_id.cthf__cta-anchor-btn.sidebar-btn.cta-btn-$index {
										color: {$color['text']} !important;
										background-color: {$color['bg']} !important;
										border-color: {$color['border']} !important;
									}
									.element-$block_id.cthf__cta-anchor-btn.sidebar-btn.cta-btn-$index:hover {
										color: {$color['text_hover']} !important;
										background-color: {$color['bg_hover']} !important;
										border-color: {$color['border_hover']} !important;
									}
								";
									?>
									<style>
										<?php echo esc_html( $cta_btn_styles ); ?>
									</style>
									<a class="<?php echo esc_html( implode( ' ', array_map( 'sanitize_html_class', array_values( $classes ) ) ) ); ?>" href="<?php echo esc_url( $btn_link ); ?>" target="<?php echo esc_attr( $new_tab ); ?>" rel="<?php echo esc_attr( $nofollow ); ?>"><?php echo esc_html( $btn_label ); ?></a>
									<?php
								}
								?>
							</div>
							<?php
						}

						if ( $attributes['sidebar']['social'] && ! empty( $attributes['sidebarSocial']['elements'] ) ) {
							$valid_socials = array(
								'Facebook',
								'Instagram',
								'Linkedin',
								'Whatsapp',
								'X',
								'Pinterest',
								'Spotify',
								'Medium',
								'Reddit',
								'RSS',
								'Tiktok',
								'Telegram',
								'Snapchat',
								'VK',
								'Tumblr',
								'Youtube',
								'Twitch',
								'Yelp',
								'Etsy',
								'Dribble',
								'Behance',
							);

							$social_icons = array(
								'Facebook'  => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M9.101 23.691V15.711H6.627V12.044H9.101V10.464C9.101 6.37901 10.949 4.48601 14.959 4.48601C15.36 4.48601 15.914 4.52801 16.427 4.58901C16.8112 4.62855 17.1924 4.69369 17.568 4.78401V8.10901C17.3509 8.08875 17.133 8.07675 16.915 8.07301C16.6707 8.06667 16.4264 8.06367 16.182 8.06401C15.475 8.06401 14.923 8.16001 14.507 8.37301C14.2273 8.51332 13.9922 8.72869 13.828 8.99501C13.57 9.41501 13.454 9.99001 13.454 10.747V12.044H17.373L16.987 14.147L16.7 15.711H13.454V23.956C19.396 23.238 24 18.179 24 12.044C24 5.41701 18.627 0.0440063 12 0.0440063C5.373 0.0440063 0 5.41701 0 12.044C0 17.672 3.874 22.394 9.101 23.691Z" fill="currentColor"/>
									</svg>
									',
								'Instagram' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M7.03008 0.0840168C5.75328 0.144217 4.88138 0.348017 4.11908 0.647417C3.33028 0.954917 2.66158 1.36742 1.99628 2.03512C1.33108 2.70282 0.921282 3.37192 0.616082 4.16212C0.320682 4.92592 0.120482 5.79862 0.0640816 7.07612C0.00768159 8.35362 -0.00481841 8.76432 0.00148159 12.0231C0.00768159 15.2817 0.0220816 15.6902 0.0839816 16.9704C0.144982 18.2469 0.347982 19.1186 0.647482 19.8811C0.955482 20.67 1.36748 21.3384 2.03548 22.0039C2.70338 22.6694 3.37198 23.0782 4.16398 23.3839C4.92718 23.6789 5.80008 23.88 7.07738 23.9359C8.35468 23.9919 8.76578 24.0049 12.0236 23.9986C15.2814 23.9924 15.6916 23.9779 16.9714 23.9172C18.2514 23.8565 19.1184 23.652 19.8812 23.3539C20.6701 23.0453 21.339 22.6339 22.004 21.9658C22.669 21.2976 23.0785 20.628 23.3835 19.8374C23.6792 19.0742 23.8801 18.2014 23.9355 16.925C23.9915 15.6441 24.0047 15.2352 23.9985 11.977C23.9922 8.71872 23.9775 8.31022 23.9168 7.03052C23.8561 5.75082 23.6528 4.88182 23.3535 4.11882C23.0451 3.32992 22.6335 2.66202 21.9659 1.99602C21.2982 1.33002 20.628 0.920817 19.8378 0.616517C19.074 0.321017 18.2017 0.119717 16.9244 0.0645168C15.6471 0.00931678 15.236 -0.00498321 11.977 0.00141679C8.71798 0.00761679 8.30998 0.0216168 7.03008 0.0840168ZM7.17028 21.7771C6.00028 21.7262 5.36498 21.5318 4.94158 21.3691C4.38098 21.1531 3.98158 20.892 3.55968 20.4741C3.13768 20.0563 2.87858 19.6555 2.65968 19.0961C2.49528 18.6727 2.29728 18.0381 2.24258 16.8681C2.18308 15.6036 2.17058 15.2239 2.16358 12.0201C2.15658 8.81642 2.16888 8.43712 2.22428 7.17212C2.27428 6.00312 2.46988 5.36712 2.63228 4.94392C2.84828 4.38262 3.10848 3.98392 3.52728 3.56232C3.94608 3.14062 4.34568 2.88092 4.90558 2.66202C5.32858 2.49692 5.96308 2.30062 7.13258 2.24492C8.39808 2.18492 8.77728 2.17292 11.9806 2.16592C15.1839 2.15892 15.5641 2.17092 16.8301 2.22672C17.9991 2.27752 18.6354 2.47122 19.0581 2.63472C19.6189 2.85072 20.0181 3.11012 20.4397 3.52972C20.8614 3.94912 21.1213 4.34732 21.3402 4.90842C21.5055 5.33012 21.7019 5.96442 21.7571 7.13472C21.8173 8.40022 21.831 8.77972 21.8367 11.9827C21.8425 15.1857 21.8312 15.5661 21.7757 16.8307C21.7247 18.0007 21.5307 18.6362 21.3677 19.0601C21.1517 19.6205 20.8914 20.0201 20.4723 20.4415C20.0533 20.863 19.6542 21.1226 19.094 21.3415C18.6716 21.5064 18.0363 21.7032 16.8678 21.7589C15.6022 21.8184 15.223 21.8309 12.0185 21.8379C8.81398 21.8449 8.43578 21.8319 7.17028 21.7771ZM16.953 5.58642C16.9535 5.87125 17.0384 6.14954 17.197 6.38609C17.3557 6.62265 17.5809 6.80684 17.8443 6.91537C18.1076 7.02391 18.3972 7.05191 18.6765 6.99583C18.9557 6.93975 19.2121 6.80212 19.4131 6.60034C19.6141 6.39855 19.7508 6.14169 19.8058 5.86222C19.8609 5.58276 19.8318 5.29325 19.7223 5.03032C19.6128 4.76739 19.4277 4.54284 19.1906 4.38508C18.9534 4.22731 18.6748 4.14342 18.39 4.14402C18.0082 4.14481 17.6423 4.29721 17.3728 4.56769C17.1034 4.83818 16.9523 5.20461 16.953 5.58642ZM5.83848 12.012C5.84518 15.4152 8.60908 18.1677 12.0115 18.1613C15.4141 18.1548 18.1685 15.3912 18.1621 11.988C18.1556 8.58482 15.3911 5.83152 11.9881 5.83822C8.58508 5.84492 5.83208 8.60922 5.83848 12.012ZM7.99998 12.0077C7.99842 11.2166 8.23149 10.4428 8.66971 9.78412C9.10793 9.12546 9.73163 8.61154 10.4619 8.30735C11.1922 8.00315 11.9963 7.92234 12.7726 8.07514C13.5488 8.22794 14.2623 8.60749 14.8228 9.16578C15.3833 9.72408 15.7657 10.436 15.9216 11.2117C16.0774 11.9873 15.9998 12.7917 15.6985 13.5232C15.3972 14.2547 14.8858 14.8804 14.2289 15.3213C13.572 15.7621 12.7991 15.9982 12.008 15.9998C11.4827 16.0009 10.9623 15.8985 10.4766 15.6985C9.99082 15.4985 9.54925 15.2047 9.17706 14.834C8.80487 14.4633 8.50935 14.0229 8.30739 13.5379C8.10542 13.053 8.00097 12.533 7.99998 12.0077Z" fill="currentColor"/>
									</svg>
									',
								'Linkedin'  => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M22.2857 0H1.70893C0.766071 0 0 0.776786 0 1.73036V22.2696C0 23.2232 0.766071 24 1.70893 24H22.2857C23.2286 24 24 23.2232 24 22.2696V1.73036C24 0.776786 23.2286 0 22.2857 0ZM7.25357 20.5714H3.69643V9.11786H7.25893V20.5714H7.25357ZM5.475 7.55357C4.33393 7.55357 3.4125 6.62679 3.4125 5.49107C3.4125 4.35536 4.33393 3.42857 5.475 3.42857C6.61071 3.42857 7.5375 4.35536 7.5375 5.49107C7.5375 6.63214 6.61607 7.55357 5.475 7.55357ZM20.5875 20.5714H17.0304V15C17.0304 13.6714 17.0036 11.9625 15.1821 11.9625C13.3286 11.9625 13.0446 13.4089 13.0446 14.9036V20.5714H9.4875V9.11786H12.9V10.6821H12.9482C13.425 9.78214 14.5875 8.83393 16.3179 8.83393C19.9179 8.83393 20.5875 11.2071 20.5875 14.2929V20.5714Z" fill="currentColor"/>
									</svg>
									',
								'Whatsapp'  => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M17.472 14.382C17.175 14.233 15.714 13.515 15.442 13.415C15.169 13.316 14.971 13.267 14.772 13.565C14.575 13.862 14.005 14.531 13.832 14.729C13.659 14.928 13.485 14.952 13.188 14.804C12.891 14.654 11.933 14.341 10.798 13.329C9.91501 12.541 9.31801 11.568 9.14501 11.27C8.97201 10.973 9.12701 10.812 9.27501 10.664C9.40901 10.531 9.57301 10.317 9.72101 10.144C9.87001 9.97001 9.91901 9.84601 10.019 9.64701C10.118 9.44901 10.069 9.27601 9.99401 9.12701C9.91901 8.97801 9.32501 7.51501 9.07801 6.92001C8.83601 6.34101 8.59101 6.42001 8.40901 6.41001C8.23601 6.40201 8.03801 6.40001 7.83901 6.40001C7.64101 6.40001 7.31901 6.47401 7.04701 6.77201C6.77501 7.06901 6.00701 7.78801 6.00701 9.25101C6.00701 10.713 7.07201 12.126 7.22001 12.325C7.36901 12.523 9.31601 15.525 12.297 16.812C13.006 17.118 13.559 17.301 13.991 17.437C14.703 17.664 15.351 17.632 15.862 17.555C16.433 17.47 17.62 16.836 17.868 16.142C18.116 15.448 18.116 14.853 18.041 14.729C17.967 14.605 17.77 14.531 17.472 14.382ZM12.05 21.785H12.046C10.2758 21.7852 8.53809 21.3092 7.01501 20.407L6.65401 20.193L2.91301 21.175L3.91101 17.527L3.67601 17.153C2.68645 15.5773 2.16295 13.7537 2.16601 11.893C2.16701 6.44301 6.60201 2.00901 12.054 2.00901C14.694 2.00901 17.176 3.03901 19.042 4.90701C19.9627 5.82363 20.6924 6.91374 21.189 8.11425C21.6856 9.31477 21.9392 10.6019 21.935 11.901C21.932 17.351 17.498 21.785 12.05 21.785ZM20.463 3.48801C19.3612 2.37893 18.0502 1.49955 16.6061 0.900811C15.162 0.302074 13.6133 -0.00410676 12.05 1.046e-05C5.49501 1.046e-05 0.160007 5.33501 0.157007 11.892C0.157007 13.988 0.704007 16.034 1.74501 17.837L0.0570068 24L6.36201 22.346C8.1056 23.2959 10.0594 23.7938 12.045 23.794H12.05C18.604 23.794 23.94 18.459 23.943 11.901C23.9478 10.3383 23.6428 8.79011 23.0454 7.34604C22.4481 5.90198 21.5704 4.59068 20.463 3.48801Z" fill="currentColor"/>
									</svg>
									',
								'X'         => '<svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M18.901 0.153015H22.581L14.541 9.34302L24 21.846H16.594L10.794 14.262L4.156 21.846H0.474L9.074 12.016L0 0.154015H7.594L12.837 7.08602L18.901 0.153015ZM17.61 19.644H19.649L6.486 2.24002H4.298L17.61 19.644Z" fill="currentColor"/>
									</svg>
									',
								'Pinterest' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M12.017 0C5.39599 0 0.0289917 5.367 0.0289917 11.987C0.0289917 17.066 3.18699 21.404 7.64699 23.149C7.54199 22.2 7.44799 20.746 7.68799 19.71C7.90699 18.773 9.09399 13.753 9.09399 13.753C9.09399 13.753 8.73499 13.033 8.73499 11.972C8.73499 10.309 9.70199 9.061 10.903 9.061C11.927 9.061 12.421 9.83 12.421 10.749C12.421 11.778 11.768 13.316 11.429 14.741C11.144 15.934 12.029 16.906 13.204 16.906C15.332 16.906 16.972 14.661 16.972 11.419C16.972 8.558 14.909 6.55 11.964 6.55C8.55399 6.55 6.55499 9.112 6.55499 11.749C6.55499 12.782 6.94899 13.892 7.44399 14.49C7.54299 14.61 7.55599 14.715 7.52899 14.835C7.43899 15.21 7.23599 16.034 7.19499 16.198C7.14199 16.423 7.02299 16.469 6.79399 16.363C5.29899 15.673 4.36099 13.485 4.36099 11.717C4.36099 7.941 7.10899 4.465 12.281 4.465C16.439 4.465 19.673 7.432 19.673 11.388C19.673 15.523 17.066 18.85 13.44 18.85C12.226 18.85 11.086 18.221 10.682 17.471L9.93299 20.319C9.66399 21.364 8.92899 22.671 8.43499 23.465C9.55799 23.81 10.741 24 11.985 24C18.592 24 23.97 18.635 23.97 12.013C23.97 5.39 18.592 0.026 11.985 0.026L12.017 0Z" fill="currentColor"/>
									</svg>
									',
								'Spotify'   => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M12 0C5.4 0 0 5.4 0 12C0 18.6 5.4 24 12 24C18.6 24 24 18.6 24 12C24 5.4 18.66 0 12 0ZM17.521 17.34C17.281 17.699 16.861 17.82 16.5 17.58C13.68 15.84 10.14 15.479 5.939 16.439C5.521 16.561 5.16 16.26 5.04 15.9C4.92 15.479 5.22 15.12 5.58 15C10.14 13.979 14.1 14.4 17.22 16.32C17.64 16.5 17.699 16.979 17.521 17.34ZM18.961 14.04C18.66 14.46 18.12 14.64 17.699 14.34C14.46 12.36 9.54 11.76 5.76 12.96C5.281 13.08 4.74 12.84 4.62 12.36C4.5 11.88 4.74 11.339 5.22 11.219C9.6 9.9 15 10.561 18.72 12.84C19.081 13.021 19.26 13.62 18.961 14.04ZM19.081 10.68C15.24 8.4 8.82 8.16 5.16 9.301C4.56 9.48 3.96 9.12 3.78 8.58C3.6 7.979 3.96 7.38 4.5 7.199C8.76 5.939 15.78 6.179 20.221 8.82C20.76 9.12 20.94 9.84 20.64 10.38C20.341 10.801 19.62 10.979 19.081 10.68Z" fill="currentColor"/>
									</svg>
									',
								'Medium'    => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M4.21001 9.66701e-06C3.65681 -0.00117675 3.10883 0.106908 2.59751 0.31806C2.08619 0.529212 1.62162 0.839273 1.23044 1.23044C0.839273 1.62162 0.529212 2.08619 0.31806 2.59751C0.106908 3.10883 -0.00117676 3.65681 9.66215e-06 4.21001V19.79C-0.00117676 20.3432 0.106908 20.8912 0.31806 21.4025C0.529212 21.9138 0.839273 22.3784 1.23044 22.7696C1.62162 23.1607 2.08619 23.4708 2.59751 23.682C3.10883 23.8931 3.65681 24.0012 4.21001 24H19.79C20.3432 24.0012 20.8912 23.8931 21.4025 23.682C21.9138 23.4708 22.3784 23.1607 22.7696 22.7696C23.1607 22.3784 23.4708 21.9138 23.682 21.4025C23.8931 20.8912 24.0012 20.3432 24 19.79V18.697C23.863 18.71 23.722 18.717 23.578 18.717C21.001 18.717 19.551 16.571 19.488 13.885C19.4843 13.6488 19.4917 13.4125 19.51 13.177C19.603 11.991 19.985 10.936 20.615 10.155C20.9888 9.68552 21.4663 9.30901 22.01 9.05501C22.478 8.81801 23.137 8.68801 23.674 8.68801H23.697C23.798 8.68801 23.899 8.69201 24 8.69801V4.21101C24.0013 3.65773 23.8933 3.10963 23.6822 2.5982C23.4712 2.08677 23.1611 1.62207 22.7699 1.2308C22.3787 0.83952 21.9141 0.52937 21.4027 0.318155C20.8914 0.106941 20.3433 -0.00117723 19.79 9.66701e-06H4.21001ZM4.40801 5.58301H8.57301L12.161 14.018L15.751 5.58301H19.615V5.72901L19.596 5.73301C18.891 5.89301 18.533 6.13001 18.533 6.98701H18.53L18.533 17.261C18.593 17.937 18.957 18.146 19.596 18.291L19.616 18.295V18.44H14.693V18.295L14.712 18.29C15.351 18.146 15.706 17.937 15.766 17.26V7.26701L11.021 18.417H10.76L6.15001 7.56901V17.014C6.15001 17.871 6.50801 18.108 7.21301 18.267L7.23301 18.271V18.418H4.40501V18.271L4.42401 18.267C5.12901 18.107 5.48901 17.87 5.48901 17.014V6.98701C5.48901 6.13001 5.13101 5.89301 4.42501 5.73301L4.40701 5.72901L4.40801 5.58301ZM23.658 9.25101C22.572 9.27401 21.925 10.574 21.845 12.375H24V9.29801C23.8884 9.26807 23.7735 9.25228 23.658 9.25101ZM21.796 12.883C21.696 14.639 22.656 16.122 24 16.517V12.883H21.796Z" fill="currentColor"/>
									</svg>
									',
								'Reddit'    => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M12 0C5.373 0 0 5.373 0 12C0 15.314 1.343 18.314 3.515 20.485L1.229 22.771C0.775 23.225 1.097 24 1.738 24H12C18.627 24 24 18.627 24 12C24 5.373 18.627 0 12 0ZM16.388 3.199C17.492 3.199 18.387 4.094 18.387 5.198C18.387 6.303 17.492 7.198 16.388 7.198C15.442 7.198 14.649 6.541 14.441 5.659V5.661C13.294 5.823 12.409 6.811 12.409 8.002V8.009C14.185 8.076 15.809 8.576 17.095 9.372C17.568 9.009 18.159 8.792 18.802 8.792C20.349 8.792 21.604 10.046 21.604 11.594C21.604 12.711 20.949 13.675 20.003 14.125C19.915 17.381 16.366 20.001 12.006 20.001C7.645 20.001 4.101 17.384 4.008 14.131C3.054 13.684 2.394 12.716 2.394 11.593C2.394 10.045 3.649 8.791 5.197 8.791C5.842 8.791 6.436 9.009 6.909 9.376C8.184 8.586 9.79 8.085 11.549 8.011V8.001C11.549 6.338 12.812 4.967 14.429 4.794C14.617 3.883 15.422 3.199 16.388 3.199ZM8.303 11.575C7.519 11.575 6.844 12.355 6.797 13.372C6.75 14.388 7.437 14.801 8.223 14.801C9.009 14.801 9.594 14.432 9.641 13.416C9.688 12.399 9.088 11.575 8.303 11.575ZM15.709 11.575C14.923 11.575 14.324 12.399 14.371 13.416C14.418 14.433 15.005 14.801 15.789 14.801C16.574 14.801 17.262 14.388 17.215 13.372C17.169 12.355 16.494 11.575 15.709 11.575ZM12.006 15.588C11.032 15.588 10.099 15.636 9.236 15.723C9.089 15.738 8.995 15.891 9.053 16.028C9.536 17.182 10.675 17.992 12.006 17.992C13.336 17.992 14.476 17.182 14.959 16.028C15.016 15.891 14.922 15.738 14.775 15.723C13.912 15.636 12.98 15.588 12.006 15.588Z" fill="currentColor"/>
									</svg>
									',
								'RSS'       => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M19.199 24C19.199 13.467 10.533 4.8 0 4.8V0C13.165 0 24 10.835 24 24H19.199ZM3.291 17.415C5.105 17.415 6.584 18.894 6.584 20.71C6.584 22.523 5.099 24 3.283 24C1.47 24 0 22.526 0 20.71C0 18.894 1.475 17.416 3.291 17.415ZM15.909 24H11.244C11.244 17.831 6.169 12.755 0 12.755V8.09C8.727 8.09 15.909 15.274 15.909 24Z" fill="currentColor"/>
									</svg>
									',
								'Tiktok'    => '<svg width="22" height="24" viewBox="0 0 22 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M11.525 0.02C12.835 0 14.135 0.01 15.435 0C15.515 1.53 16.065 3.09 17.185 4.17C18.305 5.28 19.885 5.79 21.425 5.96V9.99C19.985 9.94 18.535 9.64 17.225 9.02C16.655 8.76 16.125 8.43 15.605 8.09C15.595 11.01 15.615 13.93 15.585 16.84C15.505 18.24 15.045 19.63 14.235 20.78C12.925 22.7 10.655 23.95 8.325 23.99C6.895 24.07 5.465 23.68 4.245 22.96C2.225 21.77 0.804998 19.59 0.594998 17.25C0.574998 16.75 0.564998 16.25 0.584998 15.76C0.764998 13.86 1.705 12.04 3.165 10.8C4.825 9.36 7.145 8.67 9.315 9.08C9.335 10.56 9.275 12.04 9.275 13.52C8.285 13.2 7.125 13.29 6.255 13.89C5.625 14.3 5.145 14.93 4.895 15.64C4.685 16.15 4.745 16.71 4.755 17.25C4.995 18.89 6.575 20.27 8.255 20.12C9.375 20.11 10.445 19.46 11.025 18.51C11.215 18.18 11.425 17.84 11.435 17.45C11.535 15.66 11.495 13.88 11.505 12.09C11.515 8.06 11.495 4.04 11.525 0.02Z" fill="currentColor"/>
									</svg>
									',
								'Telegram'  => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M11.944 3.26667e-05C8.77112 0.0148396 5.73324 1.28566 3.4949 3.53449C1.25656 5.78332 -3.4549e-05 8.82711 7.12435e-10 12C7.12441e-10 15.1826 1.26428 18.2349 3.51472 20.4853C5.76516 22.7357 8.8174 24 12 24C15.1826 24 18.2348 22.7357 20.4853 20.4853C22.7357 18.2349 24 15.1826 24 12C24 8.81743 22.7357 5.76519 20.4853 3.51475C18.2348 1.26431 15.1826 3.26667e-05 12 3.26667e-05C11.9813 -1.08889e-05 11.9627 -1.08889e-05 11.944 3.26667e-05ZM16.906 7.22403C17.006 7.22203 17.227 7.24703 17.371 7.36403C17.4667 7.44713 17.5277 7.56311 17.542 7.68903C17.558 7.78203 17.578 7.99503 17.562 8.16103C17.382 10.059 16.6 14.663 16.202 16.788C16.034 17.688 15.703 17.989 15.382 18.018C14.686 18.083 14.157 17.558 13.482 17.116C12.426 16.423 11.829 15.992 10.804 15.316C9.619 14.536 10.387 14.106 11.062 13.406C11.239 13.222 14.309 10.429 14.369 10.176C14.376 10.144 14.383 10.026 14.313 9.96403C14.243 9.90203 14.139 9.92303 14.064 9.94003C13.958 9.96403 12.271 11.08 9.003 13.285C8.523 13.615 8.09 13.775 7.701 13.765C7.273 13.757 6.449 13.524 5.836 13.325C5.084 13.08 4.487 12.951 4.539 12.536C4.566 12.32 4.864 12.099 5.432 11.873C8.93 10.349 11.262 9.34403 12.43 8.85903C15.762 7.47303 16.455 7.23203 16.906 7.22403Z" fill="currentColor"/>
									</svg>
									',
								'Snapchat'  => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M12.206 0.793C13.196 0.793 16.553 1.069 18.136 4.614C18.665 5.807 18.539 7.833 18.435 9.461L18.432 9.521C18.42 9.701 18.41 9.866 18.402 10.031C18.477 10.076 18.605 10.121 18.803 10.121C19.103 10.105 19.462 10.001 19.836 9.82C20.001 9.732 20.18 9.716 20.3 9.716C20.482 9.716 20.659 9.745 20.809 9.806C21.259 9.955 21.543 10.285 21.543 10.644C21.558 11.093 21.153 11.483 20.33 11.812C20.241 11.841 20.121 11.887 19.986 11.931C19.536 12.066 18.847 12.291 18.653 12.741C18.563 12.965 18.592 13.265 18.773 13.609L18.788 13.624C18.848 13.76 20.314 17.099 23.579 17.638C23.834 17.682 24.014 17.908 23.999 18.147C23.999 18.222 23.984 18.296 23.954 18.372C23.714 18.941 22.681 19.36 20.808 19.643C20.749 19.734 20.688 20.018 20.644 20.213C20.615 20.392 20.57 20.573 20.51 20.766C20.434 21.037 20.24 21.171 19.955 21.171H19.925C19.79 21.171 19.612 21.14 19.387 21.097C19.027 21.022 18.622 20.962 18.114 20.962C17.814 20.962 17.515 20.977 17.201 21.036C16.601 21.14 16.078 21.5 15.478 21.92C14.625 22.519 13.652 23.208 12.184 23.208C12.124 23.208 12.065 23.193 12.004 23.193H11.855C10.387 23.193 9.42799 22.518 8.57599 21.905C7.97699 21.485 7.46899 21.126 6.86899 21.021C6.55499 20.976 6.23999 20.947 5.94099 20.947C5.40099 20.947 4.98299 21.036 4.66899 21.096C4.45799 21.139 4.27799 21.17 4.12899 21.17C3.75499 21.17 3.60599 20.946 3.54599 20.75C3.48499 20.558 3.45599 20.361 3.41099 20.183C3.36499 20.002 3.30599 19.689 3.24499 19.613C1.32699 19.391 0.294994 18.971 0.0559944 18.387C0.0249944 18.324 0.00399441 18.237 0.000994406 18.162C-0.0140056 17.919 0.165994 17.697 0.420994 17.653C3.68499 17.113 5.15099 13.774 5.21199 13.633L5.22799 13.604C5.40799 13.259 5.45199 12.959 5.34699 12.735C5.15199 12.301 4.46299 12.077 4.01499 11.926C3.89399 11.897 3.77499 11.852 3.66899 11.807C2.56199 11.372 2.41199 10.877 2.47199 10.534C2.56199 10.055 3.14599 9.741 3.63999 9.741C3.78599 9.741 3.90999 9.77 4.02299 9.815C4.44299 10.009 4.81199 10.115 5.12699 10.115C5.36099 10.115 5.51099 10.055 5.59199 10.01L5.54599 9.441C5.44799 7.815 5.32099 5.79 5.85299 4.604C7.39199 1.077 10.739 0.807 11.727 0.807L12.146 0.792L12.206 0.793Z" fill="currentColor"/>
									</svg>
									',
								'VK'        => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M9.489 0.00399945L10.218 0.000999451H13.782L14.512 0.00399945L15.426 0.0139995L15.859 0.0209995L16.277 0.0319995L16.68 0.0459995L17.068 0.0619995L17.442 0.0829994L17.802 0.107999L18.147 0.137999L18.48 0.170999C20.22 0.366999 21.413 0.786999 22.313 1.687C23.213 2.587 23.633 3.779 23.829 5.52L23.863 5.853L23.892 6.199L23.917 6.559L23.937 6.932L23.962 7.52L23.974 7.93L23.987 8.574L23.996 9.489L24 10.469L23.999 13.782L23.996 14.512L23.986 15.426L23.979 15.859L23.968 16.277L23.954 16.68L23.938 17.068L23.917 17.442L23.892 17.802L23.862 18.147L23.829 18.48C23.633 20.22 23.213 21.413 22.313 22.313C21.413 23.213 20.221 23.633 18.48 23.829L18.147 23.863L17.801 23.892L17.441 23.917L17.068 23.937L16.48 23.962L16.07 23.974L15.426 23.987L14.511 23.996L13.531 24L10.218 23.999L9.488 23.996L8.574 23.986L8.141 23.979L7.723 23.968L7.32 23.954L6.932 23.938L6.558 23.917L6.198 23.892L5.853 23.862L5.52 23.829C3.78 23.633 2.587 23.213 1.687 22.313C0.787 21.413 0.367 20.221 0.171 18.48L0.137 18.147L0.108 17.801L0.083 17.441L0.063 17.068L0.038 16.48L0.026 16.07L0.013 15.426L0.004 14.511L0 13.531L0.001 10.218L0.004 9.488L0.014 8.574L0.021 8.141L0.032 7.723L0.046 7.32L0.062 6.932L0.083 6.558L0.108 6.198L0.138 5.853L0.171 5.52C0.367 3.78 0.787 2.587 1.687 1.687C2.587 0.786999 3.779 0.366999 5.52 0.170999L5.853 0.136999L6.199 0.107999L6.559 0.0829994L6.932 0.0629995L7.52 0.0379995L7.93 0.0259995L8.574 0.0129995L9.489 0.00399945ZM6.79 7.3H4.05C4.18 13.54 7.3 17.29 12.77 17.29H13.08V13.72C15.09 13.92 16.61 15.39 17.22 17.29H20.06C19.28 14.45 17.23 12.88 15.95 12.28C17.23 11.54 19.03 9.74 19.46 7.3H16.88C16.32 9.28 14.66 11.08 13.08 11.25V7.3H10.5V14.22C8.9 13.82 6.88 11.88 6.79 7.3Z" fill="currentColor"/>
									</svg>
									',
								'Tumblr'    => '<svg width="14" height="24" viewBox="0 0 14 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M9.563 24C4.47 24 2.532 20.244 2.532 17.589V9.747H0.115997V6.648C3.746 5.335 4.628 2.052 4.826 0.179C4.84 0.051 4.941 0 4.999 0H8.516V6.114H13.317V9.747H8.497V17.217C8.513 18.218 8.872 19.588 10.704 19.588H10.794C11.425 19.568 12.28 19.383 12.73 19.169L13.886 22.594C13.45 23.23 11.486 23.968 9.73 23.998H9.552L9.563 24Z" fill="currentColor"/>
									</svg>
									',
								'Youtube'   => '<svg width="24" height="18" viewBox="0 0 24 18" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M23.498 3.186C23.3624 2.67527 23.095 2.20913 22.7226 1.83426C22.3502 1.45939 21.8858 1.18894 21.376 1.05C19.505 0.544998 12 0.544998 12 0.544998C12 0.544998 4.495 0.544998 2.623 1.05C2.11341 1.18918 1.64929 1.45973 1.27708 1.83458C0.904861 2.20943 0.637591 2.67544 0.502 3.186C0 5.07 0 9 0 9C0 9 0 12.93 0.502 14.814C0.637586 15.3247 0.904975 15.7909 1.27739 16.1657C1.64981 16.5406 2.11418 16.8111 2.624 16.95C4.495 17.455 12 17.455 12 17.455C12 17.455 19.505 17.455 21.377 16.95C21.8869 16.8111 22.3513 16.5407 22.7237 16.1658C23.0961 15.791 23.3635 15.3248 23.499 14.814C24 12.93 24 9 24 9C24 9 24 5.07 23.498 3.186ZM9.545 12.568V5.432L15.818 9L9.545 12.568Z" fill="currentColor"/>
									</svg>
									',
								'Twitch'    => '<svg width="22" height="24" viewBox="0 0 22 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M10.571 4.714H12.286V9.857H10.57L10.571 4.714ZM15.286 4.714H17V9.857H15.286V4.714ZM4.99999 0L0.713989 4.286V19.714H5.85699V24L10.143 19.714H13.571L21.286 12V0H4.99999ZM19.571 11.143L16.143 14.571H12.714L9.71399 17.571V14.571H5.85699V1.714H19.571V11.143Z" fill="currentColor"/>
									</svg>
									',
								'Yelp'      => '<svg width="22" height="24" viewBox="0 0 22 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M6.6885 15.1415L3.017 15.9898C2.6401 16.0769 2.262 16.1728 1.8718 16.1448C1.6107 16.126 1.3596 16.1034 1.1112 15.9318C0.976983 15.8364 0.864229 15.714 0.780202 15.5724C0.431602 15.0205 0.414602 14.2063 0.410502 13.572C0.404998 12.8703 0.517013 12.1725 0.741902 11.5078C0.771626 11.4228 0.807487 11.3402 0.849202 11.2604C0.887148 11.186 0.929041 11.1138 0.974702 11.0439C1.02339 10.9754 1.07556 10.9095 1.131 10.8464C1.24264 10.725 1.37859 10.6286 1.53 10.5633C1.67516 10.5023 1.83187 10.4738 1.9892 10.4796C2.2247 10.4812 2.5031 10.5316 2.8992 10.653C2.9547 10.6721 3.0229 10.6912 3.0848 10.7102C3.4125 10.8115 3.7896 10.9506 4.2347 11.1089C4.921 11.3493 5.601 11.5959 6.281 11.8486L7.4927 12.2909C7.7144 12.3716 7.929 12.4709 8.1339 12.5879C8.3079 12.6863 8.4612 12.8177 8.5851 12.9749C8.67659 13.1046 8.74182 13.251 8.7771 13.4058C8.84794 13.7136 8.79666 14.037 8.63404 14.3078C8.47142 14.5786 8.21013 14.7758 7.9051 14.858C7.8583 14.8731 7.8199 14.8819 7.7966 14.8873L6.6916 15.1426L6.6885 15.1415ZM17.8208 7.56499C17.7571 7.50165 17.6888 7.44303 17.6166 7.38959C17.5498 7.33956 17.4805 7.29303 17.4089 7.25019C17.3353 7.20985 17.2595 7.17347 17.182 7.14119C17.0287 7.08106 16.8645 7.05393 16.7 7.06159C16.5427 7.07057 16.3892 7.11367 16.2502 7.18789C16.0395 7.29269 15.8114 7.46109 15.5082 7.74299C15.4662 7.78469 15.4135 7.83159 15.3662 7.87599C15.116 8.11109 14.8376 8.4012 14.5063 8.739C13.9958 9.25515 13.4903 9.77614 12.9897 10.3019L12.0935 11.2312C11.9294 11.401 11.7801 11.5845 11.6469 11.7795C11.5334 11.9444 11.4531 12.1298 11.4105 12.3254C11.3859 12.4753 11.3895 12.6286 11.4212 12.7772L11.4258 12.7972C11.4965 13.1049 11.6839 13.3731 11.9485 13.5453C12.2131 13.7174 12.5343 13.7802 12.8442 13.7202C12.8814 13.7149 12.9182 13.7078 12.9547 13.6989L17.7328 12.5949C18.1094 12.5079 18.4915 12.4282 18.8298 12.2318C19.0567 12.1002 19.2726 11.9698 19.4207 11.7066C19.4997 11.562 19.5476 11.4025 19.5612 11.2383C19.6345 10.5871 19.2944 9.8475 19.0209 9.2753C18.7192 8.64218 18.3135 8.06407 17.8208 7.56499ZM7.9703 0.0753949C7.69126 0.114017 7.41426 0.166212 7.1403 0.231795C6.8649 0.297795 6.5923 0.370095 6.3257 0.455395C5.4577 0.739795 4.2373 1.26169 4.0307 2.26189C3.9142 2.82739 4.1902 3.40579 4.4044 3.92189C4.6639 4.54729 5.0184 5.11079 5.3417 5.69959C6.196 7.25409 7.0662 8.7989 7.9339 10.3453C8.1929 10.807 8.4755 11.3917 8.9769 11.6309C9.00999 11.6454 9.0438 11.6582 9.0782 11.6692C9.303 11.7543 9.5481 11.7708 9.7823 11.7163C9.79625 11.7131 9.81018 11.7099 9.8241 11.7066C10.0405 11.6478 10.2363 11.5302 10.3899 11.3669C10.4176 11.3409 10.444 11.3134 10.4689 11.2847C10.8152 10.8497 10.8143 10.2014 10.8453 9.6713C10.9495 7.9003 11.0592 6.12899 11.1462 4.35709C11.1794 3.68589 11.2517 3.02379 11.2117 2.34749C11.1789 1.78959 11.1749 1.14909 10.8226 0.691195C10.2008 -0.116105 8.875 -0.0498051 7.9703 0.0753949ZM10.0543 16.0259C9.91915 15.8358 9.72733 15.6933 9.50629 15.6189C9.28525 15.5444 9.04632 15.5418 8.8237 15.6114C8.77137 15.6288 8.72037 15.6499 8.6711 15.6747C8.59496 15.7135 8.52233 15.7588 8.454 15.8101C8.2548 15.9576 8.0872 16.1493 7.9344 16.3416C7.8958 16.3906 7.8604 16.4559 7.8144 16.4978L7.0458 17.5551C6.6096 18.1472 6.17915 18.7436 5.7545 19.3441C5.4765 19.7336 5.2361 20.0625 5.0462 20.3535C5.0102 20.4082 4.9728 20.4695 4.9387 20.5182C4.711 20.8704 4.5821 21.1274 4.5159 21.3563C4.46624 21.5084 4.45054 21.6696 4.4699 21.8284C4.491 21.9939 4.5467 22.153 4.6334 22.2954C4.6794 22.3669 4.7291 22.436 4.7821 22.5024C4.83723 22.5664 4.89578 22.6273 4.9575 22.6849C5.02339 22.7478 5.09385 22.8056 5.1683 22.8581C5.6987 23.2271 6.2795 23.4923 6.8903 23.6972C7.39869 23.8659 7.92711 23.9669 8.4619 23.9976C8.5529 24.0022 8.644 24.0001 8.7347 23.9916C8.8188 23.9843 8.90245 23.9726 8.9853 23.9565C9.06807 23.9372 9.14976 23.9135 9.23 23.8855C9.38622 23.8271 9.52845 23.7365 9.6475 23.6197C9.7602 23.5067 9.8469 23.3707 9.9016 23.2208C9.9905 22.9994 10.0489 22.7182 10.0873 22.3008C10.0907 22.2415 10.0991 22.1703 10.105 22.105C10.1354 21.7587 10.1493 21.3519 10.1716 20.8735C10.2091 20.1378 10.2386 19.4054 10.2619 18.6709C10.2619 18.6709 10.3114 17.3656 10.3113 17.3649C10.3226 17.0641 10.3133 16.7307 10.2299 16.4313C10.1933 16.2877 10.134 16.1509 10.0543 16.0259ZM18.7297 18.0698C18.5692 17.8938 18.3419 17.7184 17.9835 17.5016C17.9317 17.4728 17.8711 17.4342 17.8151 17.4007C17.5166 17.2212 17.1571 17.0323 16.7371 16.8042C16.0927 16.451 15.4451 16.1036 14.7944 15.7622L13.6429 15.1515C13.5832 15.134 13.5226 15.0908 13.4663 15.0637C13.2451 14.9579 13.0105 14.8592 12.7671 14.8139C12.6832 14.7978 12.598 14.7889 12.5126 14.7874C12.4575 14.7868 12.4024 14.7901 12.3478 14.7974C12.1175 14.8332 11.9043 14.9407 11.7386 15.1047C11.573 15.2687 11.4632 15.4807 11.4251 15.7107C11.4076 15.857 11.4129 16.0051 11.441 16.1497C11.4973 16.4562 11.6342 16.7593 11.7756 17.0247L12.3906 18.1773C12.7328 18.8273 13.079 19.4736 13.4341 20.1179C13.6631 20.5381 13.8537 20.8978 14.0323 21.1959C14.0661 21.2519 14.1044 21.3122 14.1334 21.3641C14.3507 21.7225 14.5254 21.9481 14.7024 22.1099C14.817 22.2206 14.9544 22.3049 15.105 22.3569C15.2633 22.4094 15.431 22.4279 15.5969 22.4115C15.6813 22.4015 15.7651 22.387 15.8479 22.368C15.9296 22.346 16.0101 22.32 16.0889 22.2896C16.1741 22.2576 16.2568 22.2194 16.3364 22.1753C16.804 21.9131 17.2349 21.5904 17.6182 21.2156C18.0778 20.7634 18.4841 20.2702 18.8002 19.7056C18.8442 19.6256 18.8821 19.5426 18.914 19.4573C18.9438 19.3783 18.9696 19.2978 18.9913 19.2162C19.0099 19.1332 19.0243 19.0493 19.0342 18.9649C19.05 18.7991 19.0307 18.6318 18.9777 18.4739C18.9256 18.3227 18.8409 18.1847 18.7297 18.0698ZM21.5897 21.8118C21.5902 21.9603 21.552 22.1063 21.4787 22.2354C21.4047 22.3674 21.3007 22.4731 21.1672 22.5526C21.0347 22.6317 20.883 22.6728 20.7287 22.6716C20.5749 22.6727 20.4238 22.632 20.2914 22.5537C20.161 22.4775 20.0531 22.3681 19.9789 22.2366C19.9055 22.1071 19.8673 21.9606 19.8679 21.8118C19.8679 21.6592 19.9059 21.516 19.9822 21.3824C20.0568 21.2506 20.1657 21.1415 20.2972 21.0665C20.4281 20.9901 20.5771 20.9502 20.7287 20.9509C20.8794 20.9503 21.0276 20.9898 21.1581 21.0653C21.2899 21.1398 21.3991 21.2486 21.4741 21.3801C21.5505 21.5111 21.5904 21.6602 21.5897 21.8118ZM21.4695 21.8118C21.4695 21.679 21.4363 21.5558 21.3699 21.442C21.3035 21.3282 21.2135 21.2382 21.0997 21.1718C20.9876 21.1049 20.8593 21.07 20.7287 21.0711C20.5987 21.0703 20.4709 21.1047 20.3589 21.1707C20.2466 21.2357 20.1531 21.3288 20.0876 21.4409C20.0213 21.5532 19.9869 21.6814 19.988 21.8118C19.988 21.9438 20.0212 22.0675 20.0876 22.1828C20.1524 22.2956 20.2461 22.3893 20.3589 22.4541C20.4713 22.519 20.5989 22.553 20.7287 22.5526C20.8587 22.5534 20.9865 22.5189 21.0985 22.453C21.2105 22.3884 21.3036 22.2956 21.3687 22.1839C21.4356 22.0714 21.4704 21.9427 21.4695 21.8118ZM20.8925 21.8702L21.1649 22.3224H20.9727L20.7357 21.9172H20.5811V22.3224H20.4116V21.3024H20.7104C20.8372 21.3024 20.9299 21.3271 20.9887 21.3768C21.0482 21.4264 21.0779 21.502 21.0779 21.6035C21.0788 21.6615 21.0616 21.7183 21.0287 21.766C20.9967 21.8126 20.9512 21.8473 20.8925 21.8702ZM20.8513 21.7294C20.8692 21.7147 20.8835 21.6962 20.8932 21.6751C20.9029 21.6541 20.9078 21.6311 20.9073 21.608C20.9073 21.5507 20.8909 21.5099 20.8582 21.4855C20.8253 21.4604 20.7735 21.4478 20.7025 21.4478H20.5811V21.7763H20.7048C20.7658 21.7763 20.8146 21.7607 20.8513 21.7294Z" fill="currentColor"/>
									</svg>
									',
								'Etsy'      => '<svg width="22" height="24" viewBox="0 0 22 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M7.559 2.445C7.559 2.12 7.592 1.925 8.149 1.925H15.614C16.914 1.925 17.634 3.035 18.154 5.118L18.574 6.784H19.844C20.074 2.056 20.274 0 20.274 0C20.274 0 17.078 0.36 15.184 0.36H5.635L0.520996 0.196V1.566L2.246 1.892C3.456 2.132 3.746 2.388 3.846 3.498C3.846 3.498 3.956 6.768 3.956 12.138C3.956 17.523 3.866 20.748 3.866 20.748C3.866 21.721 3.476 22.081 2.276 22.321L0.553996 22.651V24L5.684 23.835H14.234C16.169 23.835 20.624 24 20.624 24C20.729 22.83 21.374 17.52 21.479 16.936H20.279L18.995 19.846C17.99 22.126 16.519 22.291 14.885 22.291H9.979C8.349 22.291 7.564 21.651 7.564 20.241V12.8C7.564 12.8 11.184 12.8 12.354 12.896C13.266 12.96 13.817 13.221 14.114 14.494L14.504 16.189H15.914L15.824 11.911L16.016 7.606H14.625L14.175 9.496C13.892 10.74 13.695 10.966 12.421 11.096C10.755 11.266 7.606 11.236 7.606 11.236V2.45H7.556L7.559 2.445Z" fill="currentColor"/>
									</svg>
									',
								'Dribble'   => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M12 24C5.385 24 0 18.615 0 12C0 5.385 5.385 0 12 0C18.615 0 24 5.385 24 12C24 18.615 18.615 24 12 24ZM22.12 13.642C21.77 13.532 18.95 12.689 15.736 13.204C17.076 16.888 17.623 19.888 17.728 20.512C20.028 18.957 21.664 16.492 22.123 13.642H22.12ZM16.005 21.45C15.852 20.55 15.255 17.418 13.815 13.68L13.749 13.7C7.959 15.715 5.889 19.725 5.709 20.1C7.439 21.458 9.629 22.266 11.999 22.266C13.419 22.266 14.769 21.976 15.999 21.452L16.005 21.45ZM4.385 18.87C4.617 18.47 7.43 13.815 12.717 12.105C12.852 12.06 12.987 12.021 13.122 11.985C12.862 11.4 12.582 10.818 12.29 10.245C7.17 11.775 2.206 11.71 1.756 11.7L1.752 12.012C1.752 14.645 2.75 17.049 4.386 18.867L4.385 18.87ZM1.965 9.915C2.425 9.923 6.648 9.941 11.442 8.667C9.744 5.649 7.912 3.109 7.642 2.739C4.774 4.089 2.632 6.729 1.966 9.909L1.965 9.915ZM9.6 2.052C9.882 2.432 11.745 4.966 13.422 8.052C17.067 6.687 18.612 4.612 18.795 4.35C16.985 2.74 14.605 1.764 12 1.764C11.175 1.764 10.37 1.864 9.6 2.049V2.052ZM19.935 5.535C19.717 5.825 18 8.028 14.211 9.575C14.451 10.065 14.681 10.56 14.891 11.061C14.971 11.241 15.041 11.421 15.111 11.591C18.521 11.161 21.911 11.851 22.251 11.921C22.231 9.501 21.371 7.281 19.941 5.541L19.935 5.535Z" fill="currentColor"/>
									</svg>
									',
								'Behance'   => '<svg width="24" height="16" viewBox="0 0 24 16" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M16.969 12.927C17.2235 13.1627 17.5232 13.3442 17.85 13.4606C18.1768 13.577 18.5238 13.6258 18.87 13.604C19.4186 13.6179 19.9566 13.451 20.401 13.129C20.763 12.894 21.037 12.545 21.18 12.139H23.765C23.4896 13.2967 22.8173 14.3214 21.865 15.035C20.9508 15.6417 19.8706 15.9492 18.774 15.915C17.9913 15.9252 17.2146 15.778 16.49 15.482C15.8342 15.2088 15.2462 14.7955 14.767 14.271C14.2898 13.7216 13.9231 13.0853 13.687 12.397C13.4223 11.6274 13.2927 10.8178 13.304 10.004C13.299 9.20399 13.433 8.40899 13.7 7.65499C14.0601 6.59474 14.746 5.67538 15.6597 5.02815C16.5735 4.38092 17.6683 4.03893 18.788 4.05099C19.615 4.03384 20.4327 4.2276 21.164 4.614C21.825 4.976 22.395 5.48399 22.832 6.09899C23.2784 6.74394 23.5984 7.46774 23.775 8.23199C23.969 9.05299 24.038 9.89799 23.98 10.74H16.281C16.218 11.53 16.465 12.314 16.969 12.927ZM6.947 0.0839947C7.59529 0.0722527 8.24263 0.138733 8.875 0.281995C9.40769 0.398052 9.91338 0.614582 10.365 0.919995C10.783 1.22299 11.113 1.63099 11.323 2.10199C11.564 2.68099 11.68 3.30499 11.664 3.93199C11.6919 4.6212 11.5159 5.30334 11.158 5.89299C10.7822 6.44962 10.2628 6.8943 9.655 7.18C10.4802 7.40229 11.199 7.91187 11.682 8.61699C12.146 9.36399 12.379 10.232 12.352 11.111C12.3679 11.8117 12.2232 12.5068 11.929 13.143C11.6574 13.6986 11.2591 14.1827 10.766 14.556C10.2593 14.926 9.68875 15.1995 9.083 15.363C8.45517 15.5369 7.80648 15.6241 7.155 15.622H0V0.0839947H6.947ZM6.712 12.984C7.02 12.988 7.328 12.955 7.628 12.885C7.90234 12.8247 8.16244 12.712 8.394 12.553C8.622 12.395 8.805 12.182 8.928 11.934C9.07 11.617 9.136 11.271 9.119 10.925C9.14994 10.6091 9.10817 10.2903 8.99689 9.99304C8.88561 9.69578 8.70777 9.42792 8.477 9.20999C7.98742 8.84991 7.38781 8.67137 6.781 8.70499H3.241V12.984H6.712ZM20.347 7.01699C20.1316 6.80153 19.8725 6.63478 19.5872 6.528C19.3018 6.42121 18.9969 6.37688 18.693 6.39799C18.2895 6.38235 17.8888 6.47158 17.53 6.65699C17.2457 6.81328 16.995 7.02394 16.792 7.277C16.6112 7.51363 16.4768 7.78237 16.396 8.06899C16.322 8.30799 16.276 8.55399 16.259 8.80299H21.028C20.9862 8.15328 20.7496 7.53123 20.349 7.01799L20.347 7.01699ZM6.534 6.369C7.04366 6.38984 7.54533 6.23719 7.957 5.93599C8.356 5.58099 8.564 5.05599 8.517 4.52299C8.52997 4.21602 8.46892 3.91043 8.339 3.63199C8.22817 3.41078 8.05643 3.22585 7.844 3.09899C7.62857 2.95934 7.38644 2.86603 7.133 2.82499C6.85803 2.77123 6.57813 2.74676 6.298 2.75199H3.241V6.383H6.534V6.369ZM21.62 1.12199H15.644V2.64899H21.62V1.12199Z" fill="currentColor"/>
									</svg>
									',
							);

							?>
							<ul class="cthf__social-icon-group">
								<?php
								foreach ( $attributes['sidebarSocial']['elements'] as $social ) {
									$social_link = '';
									$new_tab     = isset( $attributes['sidebarSocial']['openNewTab'] ) && filter_var( $attributes['sidebarSocial']['openNewTab'], FILTER_VALIDATE_BOOLEAN ) ? '_blank' : '';
									$nofollow    = isset( $attributes['sidebarSocial']['noFollow'] ) && filter_var( $attributes['sidebarSocial']['noFollow'], FILTER_VALIDATE_BOOLEAN ) ? 'nofollow' : '';
									if ( ! in_array( $social, $valid_socials, true ) ) {
										continue;
									}

									foreach ( $attributes['sidebarSocial']['links'] as $item ) {
										if ( $social === $item['label'] ) {
											$social_link = sanitize_url( $item['url'] );
											break;
										}
									}

									if ( empty( $social_link ) ) {
										$social_link = '#';
									}

									$classes   = array();
									$classes[] = 'cthf__social-icon';
									$classes[] = 'social-' . strtolower( $social );
									$classes[] = 'view-' . $attributes['sidebarSocial']['view'];
									$classes[] = $attributes['sidebarSocial']['useBrandColor'] ? 'has-brand-color' : '';

									?>
									<li class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', array_values( $classes ) ) ) ); ?>">
										<a href="<?php echo esc_url( $social_link ); ?>" target="<?php echo esc_attr( $new_tab ); ?>" rel="<?php echo esc_attr( $nofollow ); ?>">
											<?php echo $social_icons[ $social ]; ?>
										</a>
									</li>
									<?php
								}
								?>
							</ul>
							<?php
						}
					}
					?>
				</div>
			</div>
		</div>
		<?php
	}
	?>

	<!-- Search Modal -->
	<div class="cthf__search-modal">
		<!-- Overlay -->
		<div class="cthf__search-overlay"></div>

		<!-- Body -->
		<div class="cthf__search-body">
			<?php
			if ( isset( $attributes['search']['heading']['enabled'] ) && filter_var( $attributes['search']['heading']['enabled'], FILTER_VALIDATE_BOOLEAN ) ) {
				?>
				<h4 class="search__heading"><?php echo esc_html( $search_styles['heading']['content'] ); ?></h4>
				<?php
			}
			?>
			<form method="POST" action="">

				<div class="search__icon">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
						<path d="M21 20.9984L16.65 16.6484" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
					</svg>

				</div>

				<input class="cthf__search" type="text" name="search" placeholder="<?php echo esc_html__( 'Search...', 'rootblox' ); ?>" />

				<?php
				wp_nonce_field();
				?>
			</form>

			<!-- Ajax Search Body -->
			<?php
			if ( rootblox_is_premium() && isset( $attributes['search']['ajax']['enabled'] ) && filter_var( $attributes['search']['ajax']['enabled'], FILTER_VALIDATE_BOOLEAN ) ) {
				?>
				<div class="cthf__search-results">
					<div class="spinner cthf__display-none"></div>

					<ul class="posts__collection">

					</ul>
				</div>
				<?php
			}
			?>
		</div>

		<svg class="close__icon" width="10" height="10" viewBox="0 0 10 10" xmlns="http://www.w3.org/2000/svg">
			<path d="M4.99999 4.058L8.29999 0.758003L9.24266 1.70067L5.94266 5.00067L9.24266 8.30067L8.29932 9.24334L4.99932 5.94334L1.69999 9.24334L0.757324 8.3L4.05732 5L0.757324 1.7L1.69999 0.75867L4.99999 4.058Z" fill="currentColor" />
		</svg>
	</div>
</div>