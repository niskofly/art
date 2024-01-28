<?php

return array(
	'session' =>
		array(
			'value' =>
				array(
					'mode' => 'default',
					'handlers' =>
						array(
							'general' =>
								array(
									'_fromSecurity' => true,
									'type' => 'database',
								),
						),
				),
			'readonly' => true,
		),
	'utf_mode' =>
		array(
			'value' => true,
			'readonly' => true,
		),
	'cache_flags' =>
		array(
			'value' =>
				array(
					'config_options' => 3600,
					'site_domain' => 3600,
				),
			'readonly' => false,
		),
	'cookies' =>
		array(
			'value' =>
				array(
					'secure' => false,
					'http_only' => true,
				),
			'readonly' => false,
		),
	'exception_handling' =>
		array(
			'value' =>
				array(
					'debug' => true,
					'handled_errors_types' => 4437,
					'exception_errors_types' => 4437,
					'ignore_silence' => false,
					'assertion_throws_exception' => true,
					'assertion_error_type' => 256,
					'log' => null,
				),
			'readonly' => false,
		),
	'connections' =>
		array(
			'value' =>
				array(
					'default' =>
						array(
							'className' => '\\Bitrix\\Main\\DB\\MysqliConnection',
							'host' => 'localhost',
							'database' => 'bx59216_new-artistom',
							'login' => 'bx59216_new-artistom',
							'password' => 'nS3yN8gZ6w',
							'options' => 2,
						),
				),
			'readonly' => true,
		),
	'crypto' =>
		array(
			'value' =>
				array(
					'crypto_key' => '44c8f0b152cc34100936eff2fe656888',
				),
			'readonly' => true,
		),
	'analytics_counter' =>
		array(
			'value' =>
				array(
					'enabled' => false,
				),
		),
);
