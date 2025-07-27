<?php
// This file is generated. Do not modify it manually.
return array(
	'build' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 2,
		'name' => 'cthf-blocks/contact-info',
		'title' => 'Contact Info',
		'description' => 'Display your business contact details clearly, including phone, email and address—all in one convenient block.',
		'category' => 'rootblox-footer',
		'supports' => array(
			'html' => false,
			'color' => array(
				'background' => true,
				'gradients' => true,
				'text' => true
			),
			'spacing' => array(
				'padding' => true,
				'margin' => array(
					'top',
					'bottom'
				),
				'__experimentalDefaultControls' => array(
					'padding' => true
				)
			),
			'__experimentalBorder' => array(
				'color' => true,
				'radius' => true,
				'style' => true,
				'width' => true,
				'__experimentalDefaultControls' => array(
					'color' => true,
					'radius' => true,
					'style' => true,
					'width' => true
				)
			)
		),
		'attributes' => array(
			'cover' => array(
				'type' => 'string',
				'default' => ''
			),
			'clientId' => array(
				'type' => 'string',
				'default' => ''
			),
			'gap' => array(
				'type' => 'string',
				'default' => '16px'
			),
			'stackLayout' => array(
				'type' => 'boolean',
				'default' => false
			),
			'itemStyles' => array(
				'type' => 'object',
				'default' => array(
					'padding' => array(
						'top' => '',
						'right' => '',
						'bottom' => '',
						'left' => ''
					),
					'border' => array(
						'width' => '',
						'style' => '',
						'color' => ''
					),
					'radius' => '',
					'font' => array(
						'size' => '',
						'weight' => '',
						'family' => ''
					),
					'letterCase' => 'none',
					'decoration' => 'underline',
					'lineHeight' => '',
					'letterSpacing' => '',
					'color' => array(
						'text' => '',
						'textHover' => '',
						'bg' => '',
						'bgHover' => '',
						'borderHover' => ''
					)
				)
			),
			'icon' => array(
				'type' => 'object',
				'default' => array(
					'enabled' => true,
					'gap' => '8px',
					'rowGap' => '4px',
					'align' => 'center',
					'boxWidth' => '',
					'boxHeight' => '',
					'size' => '16px',
					'padding' => array(
						'top' => '',
						'right' => '',
						'bottom' => '',
						'left' => ''
					),
					'margin' => array(
						'top' => '',
						'bottom' => ''
					),
					'border' => array(
						'width' => '',
						'style' => '',
						'color' => ''
					),
					'radius' => '',
					'color' => array(
						'svg' => '',
						'svgHover' => '',
						'bg' => '',
						'bgHover' => '',
						'borderHover' => ''
					)
				)
			)
		),
		'providesContext' => array(
			'icon' => 'icon'
		),
		'editorScript' => array(
			'cthf-blocks--contact-info'
		),
		'editorStyle' => array(
			'cthf-blocks--contact-info--editor-style'
		),
		'style' => array(
			'cthf-blocks--contact-info--style'
		),
		'render' => 'file:./render.php'
	)
);
