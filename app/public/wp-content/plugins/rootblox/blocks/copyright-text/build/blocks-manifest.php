<?php
// This file is generated. Do not modify it manually.
return array(
	'build' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 2,
		'name' => 'cthf-blocks/copyright-text',
		'title' => 'Copyright Text',
		'description' => 'The Copyright Text block allows you to add a copyright text in the footer area.',
		'category' => 'rootblox-footer',
		'attributes' => array(
			'cover' => array(
				'type' => 'string',
				'default' => ''
			),
			'clientId' => array(
				'type' => 'string',
				'default' => ''
			),
			'tag' => array(
				'type' => 'string',
				'default' => 'p'
			),
			'beforeText' => array(
				'type' => 'object',
				'default' => array(
					'enabled' => true,
					'content' => '© ',
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
						'text' => '',
						'textHover' => ''
					)
				)
			),
			'dynamicYear' => array(
				'type' => 'object',
				'default' => array(
					'enabled' => true,
					'hasRange' => false,
					'range' => 1,
					'separator' => '-',
					'font' => array(
						'size' => '',
						'weight' => '',
						'family' => ''
					),
					'color' => array(
						'text' => ''
					)
				)
			),
			'afterText' => array(
				'type' => 'object',
				'default' => array(
					'enabled' => true,
					'content' => ' <a href=\'#\'>Company Name</a>. All rights reserved.',
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
						'text' => '',
						'textHover' => ''
					)
				)
			),
			'padding' => array(
				'type' => 'object',
				'default' => array(
					'top' => '',
					'right' => '',
					'bottom' => '',
					'left' => ''
				)
			),
			'margin' => array(
				'type' => 'object',
				'default' => array(
					'top' => '',
					'right' => '',
					'bottom' => '',
					'left' => ''
				)
			),
			'typography' => array(
				'type' => 'object',
				'default' => array(
					'font' => array(
						'size' => '',
						'weight' => '',
						'family' => ''
					),
					'letterCase' => 'none',
					'decoration' => 'none',
					'lineHeight' => '',
					'letterSpacing' => ''
				)
			),
			'color' => array(
				'type' => 'object',
				'default' => array(
					'text' => '',
					'textHover' => ''
				)
			)
		),
		'editorScript' => array(
			'cthf-blocks--copyright-text'
		),
		'editorStyle' => array(
			'cthf-blocks--copyright-text--editor-style'
		),
		'style' => array(
			'cthf-blocks--copyright-text--style'
		),
		'render' => 'file:./render.php'
	)
);
