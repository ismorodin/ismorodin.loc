<?php
return [
	'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	'extensions' => require(__DIR__ . '/../../vendor/yiisoft/extensions.php'),
	'language' => 'ru-RU',
	'components' => [
		'cache' => [
			'class' => 'yii\caching\FileCache',
		],
		'formatter' => [
			'class' => 'yii\i18n\Formatter',
		],
		'i18n' => [
			'translations' => [
				'*' => [
					'class' => 'yii\i18n\PhpMessageSource'
				],
			],
		],
		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'enableStrictParsing' => false,
			'rules' => [
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
			]
		],
		'view' => [
			'renderers' => [
				'twig' => [
					'class' => 'yii\twig\ViewRenderer',
					'globals' => ['html' => '\yii\helpers\Html'],
				],
			],
		],
	],
];
