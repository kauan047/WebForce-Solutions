<?php
// This file is generated. Do not modify it manually.
return array(
	'build' => array(
		'$schema'      => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion'   => 2,
		'name'         => 'cthf-blocks/footer',
		'title'        => 'Footer Builder',
		'description'  => 'The Footer Block allows you to design a fully customizable, responsive site footer with flexible layouts, widget areas, and styling options for a polished, professional finish.',
		'category'     => 'rootblox-footer',
		'attributes'   => array(
			'cover'          => array(
				'type'    => 'string',
				'default' => '',
			),
			'clientId'       => array(
				'type'    => 'string',
				'default' => '',
			),
			'backToTop'      => array(
				'type'    => 'object',
				'default' => array(
					'enabled'       => true,
					'enableIcon'    => true,
					'enableLabel'   => false,
					'label'         => 'Top',
					'gap'           => '0px',
					'position'      => 'right',
					'boxWidth'      => '26px',
					'boxHeight'     => '26px',
					'hPadding'      => '12px',
					'vPadding'      => '12px',
					'iconSize'      => '20px',
					'iconVariation' => 'variation-1',
					'display'       => 'column',
					'margin'        => array(
						'top'    => '',
						'right'  => '16px',
						'bottom' => '16px',
						'left'   => '',
					),
					'border'        => array(
						'width' => '',
						'style' => '',
						'color' => '',
					),
					'radius'        => '100px',
					'font'          => array(
						'size'   => '14px',
						'weight' => '',
						'family' => '',
					),
					'letterCase'    => 'none',
					'decoration'    => 'none',
					'lineHeight'    => '',
					'letterSpacing' => '',
					'color'         => array(
						'icon'        => '',
						'iconHover'   => '',
						'bg'          => '',
						'bgHover'     => '#f90',
						'borderHover' => '',
					),
				),
			),
			'scrollProgress' => array(
				'type'    => 'object',
				'default' => array(
					'enabled'  => false,
					'position' => 'top',
					'zIndex'   => '999',
					'height'   => '4px',
					'margin'   => array(
						'top'    => '',
						'bottom' => '',
					),
					'color'    => array(
						'bg' => '#5100ff',
					),
				),
			),
			'customScript'   => array(
				'type'    => 'object',
				'default' => array(
					'enabled' => false,
					'content' => '',
				),
			),
		),
		'editorScript' => array(
			'cthf-blocks--footer',
		),
		'editorStyle'  => array(
			'cthf-blocks--footer--editor-style',
		),
		'style'        => array(
			'cthf-blocks--footer--style',
		),
		'viewScript'   => array(
			'cthf-blocks--footer--frontend-script',
		),
		'render'       => 'file:./render.php',
	),
);
