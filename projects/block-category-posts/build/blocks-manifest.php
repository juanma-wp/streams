<?php
// This file is generated. Do not modify it manually.
return array(
	'block-category-posts' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'create-block/block-category-posts',
		'version' => '0.1.0',
		'title' => 'Block Category Posts',
		'category' => 'widgets',
		'icon' => 'smiley',
		'description' => 'Example block scaffolded with Create Block tool.',
		'example' => array(
			
		),
		'supports' => array(
			'html' => false
		),
		'attributes' => array(
			'categoryId' => array(
				'type' => 'number',
				'default' => 0
			)
		),
		'textdomain' => 'block-category-posts',
		'editorScript' => 'file:./index.js',
		'render' => 'file:./render.php'
	)
);
