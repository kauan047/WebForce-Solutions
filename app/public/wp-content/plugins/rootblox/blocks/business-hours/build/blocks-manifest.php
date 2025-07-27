<?php
// This file is generated. Do not modify it manually.
return array(
	'build' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 2,
		'name' => 'cthf-blocks/business-hours',
		'title' => 'Business Hours',
		'description' => 'Displays your business hours in a clear, concise format to show when you\'re available.',
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
			'timeFormat' => array(
				'type' => 'boolean',
				'default' => true
			),
			'scheduling' => array(
				'type' => 'object',
				'default' => array(
					'type' => 'default',
					'startingDay' => 'monday',
					'abbr' => true,
					'customAbbr' => false,
					'abbrLength' => 3
				)
			),
			'weekdays' => array(
				'type' => 'array',
				'default' => array(
					array(
						'key' => 'monday',
						'opened' => true,
						'alwaysOpen' => false,
						'alwaysOpenLabel' => 'Open 24 Hours',
						'openTime' => array(
							'hours' => '00',
							'minutes' => '00'
						),
						'closeTime' => array(
							'hours' => '12',
							'minutes' => '00'
						)
					),
					array(
						'key' => 'tuesday',
						'opened' => true,
						'alwaysOpen' => false,
						'alwaysOpenLabel' => 'Open 24 Hours',
						'openTime' => array(
							'hours' => '00',
							'minutes' => '00'
						),
						'closeTime' => array(
							'hours' => '12',
							'minutes' => '00'
						)
					),
					array(
						'key' => 'wednesday',
						'opened' => true,
						'alwaysOpen' => false,
						'alwaysOpenLabel' => 'Open 24 Hours',
						'openTime' => array(
							'hours' => '00',
							'minutes' => '00'
						),
						'closeTime' => array(
							'hours' => '12',
							'minutes' => '00'
						)
					),
					array(
						'key' => 'thursday',
						'opened' => true,
						'alwaysOpen' => false,
						'alwaysOpenLabel' => 'Open 24 Hours',
						'openTime' => array(
							'hours' => '00',
							'minutes' => '00'
						),
						'closeTime' => array(
							'hours' => '12',
							'minutes' => '00'
						)
					),
					array(
						'key' => 'friday',
						'opened' => true,
						'alwaysOpen' => false,
						'alwaysOpenLabel' => 'Open 24 Hours',
						'openTime' => array(
							'hours' => '00',
							'minutes' => '00'
						),
						'closeTime' => array(
							'hours' => '12',
							'minutes' => '00'
						)
					),
					array(
						'key' => 'saturday',
						'opened' => false,
						'alwaysOpen' => false,
						'alwaysOpenLabel' => 'Open 24 Hours',
						'openTime' => array(
							'hours' => '00',
							'minutes' => '00'
						),
						'closeTime' => array(
							'hours' => '12',
							'minutes' => '00'
						)
					),
					array(
						'key' => 'sunday',
						'opened' => false,
						'alwaysOpen' => false,
						'alwaysOpenLabel' => 'Open 24 Hours',
						'openTime' => array(
							'hours' => '00',
							'minutes' => '00'
						),
						'closeTime' => array(
							'hours' => '12',
							'minutes' => '00'
						)
					)
				)
			),
			'groupedWeekdays' => array(
				'type' => 'array',
				'default' => array(
					array(
						'opened' => true,
						'start' => 'monday',
						'end' => 'friday',
						'alwaysOpen' => false,
						'alwaysOpenLabel' => 'Open 24 Hours',
						'openTime' => array(
							'hours' => '00',
							'minutes' => '00'
						),
						'closeTime' => array(
							'hours' => '00',
							'minutes' => '00'
						)
					),
					array(
						'start' => 'saturday',
						'end' => 'sunday',
						'opened' => false,
						'alwaysOpen' => false,
						'alwaysOpenLabel' => 'Open 24 Hours',
						'openTime' => array(
							'hours' => '00',
							'minutes' => '00'
						),
						'closeTime' => array(
							'hours' => '00',
							'minutes' => '00'
						)
					)
				)
			),
			'timeSeparator' => array(
				'type' => 'string',
				'default' => '—'
			),
			'groupSeparator' => array(
				'type' => 'string',
				'default' => 'to'
			),
			'notification' => array(
				'type' => 'object',
				'default' => array(
					'enabled' => true,
					'open' => 'We\'re open!',
					'close' => 'We\'re closed for the day!',
					'addTimer' => false,
					'timeDiff' => array(
						'hours' => '00',
						'minutes' => '30'
					),
					'nearingClose' => 'We\'re closing soon!',
					'nearingOpen' => 'We\'re opening soon!',
					'timerLabel' => array(
						'h' => 'h',
						'm' => 'm',
						's' => 's'
					),
					'padding' => array(
						'top' => '',
						'right' => '',
						'bottom' => '',
						'left' => ''
					),
					'margin' => array(
						'top' => '26px',
						'bottom' => ''
					),
					'border' => array(
						'width' => '',
						'style' => '',
						'color' => ''
					),
					'radius' => '',
					'font' => array(
						'size' => '16px',
						'weight' => '',
						'family' => ''
					),
					'letterCase' => 'none',
					'decoration' => 'none',
					'lineHeight' => '',
					'letterSpacing' => '',
					'timerTypography' => array(
						'font' => array(
							'size' => '15px',
							'weight' => '500',
							'family' => ''
						),
						'letterCase' => 'capitalize',
						'decoration' => 'none',
						'lineHeight' => '',
						'letterSpacing' => ''
					),
					'color' => array(
						'text' => '',
						'timer' => '',
						'bg' => ''
					)
				)
			),
			'timezone' => array(
				'type' => 'object',
				'default' => array(
					'enableNotice' => true,
					'message' => 'Different timezone detected!',
					'enableTime' => true,
					'gap' => '6px',
					'padding' => array(
						'top' => '',
						'right' => '',
						'bottom' => '',
						'left' => ''
					),
					'margin' => array(
						'top' => '26px',
						'bottom' => ''
					),
					'border' => array(
						'width' => '',
						'style' => '',
						'color' => ''
					),
					'radius' => '',
					'font' => array(
						'size' => '15px',
						'weight' => '',
						'family' => ''
					),
					'letterCase' => 'none',
					'decoration' => 'none',
					'lineHeight' => '',
					'letterSpacing' => '',
					'labelTypography' => array(
						'font' => array(
							'size' => '',
							'weight' => '',
							'family' => ''
						),
						'letterCase' => 'none',
						'decoration' => 'none',
						'lineHeight' => '',
						'letterSpacing' => ''
					),
					'color' => array(
						'text' => '',
						'label' => '',
						'bg' => ''
					)
				)
			),
			'itemStyles' => array(
				'type' => 'object',
				'default' => array(
					'gap' => '6px',
					'alignItems' => 'end',
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
					'decoration' => 'none',
					'lineHeight' => '',
					'letterSpacing' => '',
					'labelTypography' => array(
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
						'text' => '',
						'label' => '',
						'bg' => ''
					)
				)
			)
		),
		'editorScript' => array(
			'cthf-blocks--business-hours'
		),
		'editorStyle' => array(
			'cthf-blocks--business-hours--editor-style'
		),
		'style' => array(
			'cthf-blocks--business-hours--style'
		),
		'viewScript' => array(
			'cthf-blocks--business-hours--frontend-script',
			'rootblox--luxon'
		),
		'render' => 'file:./render.php'
	)
);
