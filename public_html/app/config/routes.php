<?php

return [
	'' => [
		'controller' => 'main',
		'action' => 'index',
	],

	'login' => [
		'controller' => 'account',
		'action' => 'login',
	],

	'register' => [
		'controller' => 'account',
		'action' => 'register',
	],

	'news/{id:\d+}' => [
		'controller' => 'main',
		'action' => 'news',
	]
];
