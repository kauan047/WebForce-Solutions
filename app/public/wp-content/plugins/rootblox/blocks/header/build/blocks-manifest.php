<?php
// This file is generated. Do not modify it manually.
return array(
	'build' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 2,
		'name' => 'cthf-blocks/header',
		'title' => 'Header Builder',
		'description' => 'The Header Block lets you create a fully customizable, responsive site header with options for sticky behavior, transparent backgrounds, and flexible layouts.',
		'category' => 'rootblox-header',
		'attributes' => array(
			'cover' => array(
				'type' => 'string',
				'default' => ''
			),
			'clientId' => array(
				'type' => 'string',
				'default' => ''
			),
			'enableOptions' => array(
				'type' => 'object',
				'default' => array(
					'topBar' => true,
					'bottomBar' => true
				)
			),
			'stickyHeader' => array(
				'type' => 'object',
				'default' => array(
					'enabled' => false,
					'topBar' => true,
					'bottomScrollHide' => false,
					'bottomScrollOffset' => 500,
					'backdropBlur' => '5px'
				)
			),
			'mobileMenu' => array(
				'type' => 'object',
				'default' => array(
					'status' => 'mobile',
					'layout' => array(
						array(
							'Site Logo'
						),
						array(
							'Navigation'
						)
					),
					'layoutAttr' => array(
						array(
							'stackLayout' => true,
							'gap' => '20px'
						),
						array(
							'stackLayout' => true,
							'gap' => '20px'
						),
						array(
							'stackLayout' => true,
							'gap' => '20px'
						)
					),
					'breakpoint' => 767,
					'wrapperPadding' => array(
						'top' => '26px',
						'right' => '26px',
						'bottom' => '26px',
						'left' => '26px'
					),
					'wrapperBorder' => array(
						'width' => '',
						'style' => '',
						'color' => ''
					),
					'menuID' => '',
					'iconSize' => '20px'
				)
			),
			'sidebar' => array(
				'type' => 'object',
				'default' => array(
					'siteLogo' => true,
					'navigation' => true,
					'button' => true,
					'btnGroup' => array(
						array(
							'label' => 'Subscribe',
							'link' => '#',
							'openNewTab' => false,
							'noFollow' => false,
							'textColor' => '',
							'textHoverColor' => '',
							'bgColor' => '',
							'bgHoverColor' => '',
							'borderColor' => '',
							'borderHoverColor' => ''
						)
					),
					'social' => true,
					'contentAlign' => 'left',
					'width' => '450px',
					'position' => 'left',
					'padding' => array(
						'top' => '40px',
						'right' => '26px',
						'bottom' => '40px',
						'left' => '26px'
					)
				)
			),
			'siteLogo' => array(
				'type' => 'object',
				'default' => array(
					'enableLogo' => true,
					'useDefaultLogo' => true,
					'custom' => array(
						'id' => '',
						'url' => ''
					),
					'width' => '40px',
					'enableTitle' => true,
					'titleTag' => 'h3',
					'gap' => '10px',
					'font' => array(
						'size' => '24px',
						'weight' => '500',
						'family' => ''
					),
					'letterCase' => 'none',
					'decoration' => 'none',
					'lineHeight' => '1.2em',
					'letterSpacing' => '',
					'color' => array(
						'text' => '',
						'textHover' => ''
					)
				)
			),
			'sidebarSiteLogo' => array(
				'type' => 'object',
				'default' => array(
					'enableLogo' => true,
					'width' => '40px',
					'enableTitle' => true,
					'titleTag' => 'h3',
					'gap' => '10px',
					'font' => array(
						'size' => '24px',
						'weight' => '500',
						'family' => ''
					),
					'letterCase' => 'none',
					'decoration' => 'none',
					'lineHeight' => '1.2em',
					'letterSpacing' => '',
					'color' => array(
						'text' => '',
						'textHover' => ''
					)
				)
			),
			'navigation' => array(
				'type' => 'object',
				'default' => array(
					'iconSize' => '',
					'icon' => 'variation-1',
					'menuGap' => '0',
					'submenuGap' => '10px',
					'padding' => array(
						'top' => '',
						'right' => '',
						'bottom' => '',
						'left' => ''
					),
					'margin' => array(
						'top' => '26px',
						'bottom' => '26px'
					),
					'border' => array(
						'top' => array(
							'width' => '1px',
							'style' => 'solid',
							'color' => '#ebe6fb'
						)
					),
					'itemPadding' => array(
						'top' => '12px',
						'right' => '',
						'bottom' => '12px',
						'left' => ''
					),
					'itemBorder' => array(
						'bottom' => array(
							'width' => '1px',
							'style' => 'solid',
							'color' => '#ebe6fb'
						)
					),
					'font' => array(
						'size' => '16px',
						'weight' => '500',
						'family' => 'Inter'
					),
					'letterCase' => 'none',
					'decoration' => 'none',
					'lineHeight' => '',
					'letterSpacing' => '',
					'color' => array(
						'icon' => '',
						'iconHover' => '',
						'text' => '',
						'textHover' => '',
						'submenu' => '',
						'submenuHover' => '',
						'submenuIcon' => '#5100ff',
						'submenuIconHover' => '#f90'
					)
				)
			),
			'sidebarCTA' => array(
				'type' => 'object',
				'default' => array(
					'stacked' => true,
					'gap' => '12px',
					'rowGap' => '12px',
					'width' => '100%',
					'justification' => 'center',
					'margin' => array(
						'top' => '',
						'bottom' => '26px'
					),
					'padding' => array(
						'top' => '14px',
						'right' => '36px',
						'bottom' => '14px',
						'left' => '36px'
					),
					'border' => array(
						'width' => '',
						'style' => '',
						'color' => ''
					),
					'radius' => '6px',
					'font' => array(
						'size' => '18px',
						'weight' => '500',
						'family' => ''
					),
					'letterCase' => 'none',
					'decoration' => 'none',
					'lineHeight' => '',
					'letterSpacing' => '',
					'color' => array(
						'text' => '#fff',
						'textHover' => '',
						'bg' => '#5144ff',
						'bgHover' => '#f90',
						'borderHover' => ''
					)
				)
			),
			'sidebarSocial' => array(
				'type' => 'object',
				'default' => array(
					'elements' => array(
						'Facebook',
						'X',
						'Instagram',
						'Linkedin'
					),
					'links' => array(
						
					),
					'stackLayout' => true,
					'gap' => '10px',
					'rowGap' => '10px',
					'justification' => 'center',
					'useBrandColor' => true,
					'openNewTab' => true,
					'noFollow' => false,
					'view' => 'stacked',
					'margin' => array(
						'top' => '',
						'bottom' => ''
					),
					'boxWidth' => '36px',
					'boxHeight' => '36px',
					'border' => array(
						'width' => '',
						'style' => '',
						'color' => ''
					),
					'radius' => '100px',
					'size' => '20px',
					'color' => array(
						'icon' => '#fff',
						'iconHover' => '#fff',
						'bg' => '#5100ff',
						'bgHover' => '#f90',
						'borderHover' => ''
					)
				)
			),
			'search' => array(
				'type' => 'object',
				'default' => array(
					'variation' => 'default',
					'ajax' => array(
						'enabled' => true,
						'postsPerPage' => 3,
						'openNewTab' => false,
						'noFollow' => false
					),
					'heading' => array(
						'enabled' => true,
						'content' => 'Looking for Something?',
						'font' => array(
							'size' => '28px',
							'weight' => '600',
							'family' => ''
						),
						'letterCase' => 'none',
						'decoration' => 'none',
						'lineHeight' => '',
						'letterSpacing' => ''
					),
					'postTitle' => array(
						'font' => array(
							'size' => '16px',
							'weight' => '500',
							'family' => ''
						),
						'letterCase' => 'none',
						'decoration' => 'none',
						'lineHeight' => '',
						'letterSpacing' => ''
					),
					'color' => array(
						'icon' => '',
						'iconHover' => '',
						'heading' => '',
						'link' => '#1c1c1c',
						'linkHover' => '#f90',
						'text' => '#6e6e6e',
						'overlay' => '#fff',
						'close' => '#acacac'
					)
				)
			),
			'ctaButton' => array(
				'type' => 'object',
				'default' => array(
					'label' => 'Subscribe',
					'link' => '#',
					'openNewTab' => false,
					'noFollow' => false,
					'padding' => array(
						'top' => '14px',
						'right' => '36px',
						'bottom' => '14px',
						'left' => '36px'
					),
					'border' => array(
						'style' => '',
						'width' => '',
						'color' => ''
					),
					'radius' => array(
						'top' => '',
						'right' => '',
						'bottom' => '',
						'left' => ''
					),
					'font' => array(
						'size' => '',
						'weight' => '',
						'family' => ''
					),
					'letterCase' => 'none',
					'decoration' => 'none',
					'lineHeight' => '',
					'letterSpacing' => '',
					'color' => array(
						'text' => '#fff',
						'textHover' => '',
						'bg' => '#5144ff',
						'bgHover' => '#f90',
						'borderHover' => ''
					)
				)
			),
			'miniCart' => array(
				'type' => 'object',
				'default' => array(
					'iconSize' => '30px',
					'icon' => 'variation-3',
					'font' => array(
						'size' => '14px',
						'weight' => '',
						'family' => ''
					),
					'color' => array(
						'icon' => '',
						'iconHover' => '',
						'text' => '#fff',
						'textBg' => '#ac0cff'
					)
				)
			),
			'acc' => array(
				'type' => 'object',
				'default' => array(
					'iconSize' => '',
					'icon' => 'variation-1',
					'color' => array(
						'icon' => '',
						'iconHover' => ''
					)
				)
			),
			'color' => array(
				'type' => 'object',
				'default' => array(
					'mobileBg' => '#fff',
					'text' => '#000',
					'iconHover' => '#f90',
					'sidebarBg' => '#fff',
					'sidebarCloseIcon' => '#9a9a9a'
				)
			)
		),
		'editorScript' => array(
			'cthf-blocks--header'
		),
		'editorStyle' => array(
			'cthf-blocks--header--editor-style'
		),
		'style' => array(
			'cthf-blocks--header--style'
		),
		'script' => array(
			'cthf-blocks--header--frontend-script'
		),
		'render' => 'file:./render.php'
	)
);
