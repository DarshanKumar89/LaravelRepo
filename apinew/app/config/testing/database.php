<?php
// application/config/test/database.php

return array(

	'default' => 'mysql',

	'connections' => array(

		'mysql' => array(
			'driver'    => 'mysql',
            'host'      => getenv('APP_DATABASE_HOST'),
            'database'  => getenv('APP_DATABASE_DATABASE'),
            'username'  => getenv('APP_DATABASE_USERNAME'),
            'password'  => getenv('APP_DATABASE_PASSWORD'),
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
		),
	),
);