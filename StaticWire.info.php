<?php

$info = [
	'title' => 'StaticWire',
	'summary' => 'Covert pages to HTML files via CLI or ProcessWire admin.',
	'version' => 6,
	'author' => 'Christoph Engelmayer', 
	'icon' => 'code', 
	'permission' => 'staticwire-generate', 
	'permissions' => [ 'staticwire-generate' => 'Covert pages to HTML files'
	],
	'page' => [
		'name' => 'staticwire',
		'parent' => 'setup', 
		'title' => 'Static Site Generator',
	],
];
