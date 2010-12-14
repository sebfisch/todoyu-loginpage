<?php
/****************************************************************************
* todoyu is published under the BSD License:
* http://www.opensource.org/licenses/bsd-license.php
*
* Copyright (c) 2010, snowflake productions GmbH, Switzerland
* All rights reserved.
*
* This script is part of the todoyu project.
* The todoyu project is free software; you can redistribute it and/or modify
* it under the terms of the BSD License.
*
* This script is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the BSD License
* for more details.
*
* This copyright notice MUST APPEAR in all copies of the script.
*****************************************************************************/


Todoyu::$CONFIG['EXT']['loginpage']['extendedContentHooks'] = array();

	// Configure menu tabs
Todoyu::$CONFIG['EXT']['loginpage']['tabs']	= array(
	array(
		'position'	=> 10,
		'key'		=> 'login',
		'label'		=> 'LLL:loginpage.tab.login',
		'href'		=> '?ext=loginpage&controller=ext',
	),
	array(
		'position'	=> 20,
		'key'		=> 'help',
		'label'		=> 'LLL:loginpage.tab.help',
		'href'		=> 'http://developer.todoyu.com',
		'target'	=> '_blank'
	),
	array(
		'position'	=> 30,
		'key'		=> 'blog',
		'label'		=> 'LLL:loginpage.tab.blog',
		'href'		=> 'http://blog.snowflake.ch/de/blog-category/todoyu/',
		'target'	=> '_blank'
	)
);

Todoyu::$CONFIG['EXT']['loginpage']['panelWidgetLiveNews'] = array(
	'url'	=> 'http://www.todoyu.com/?154&type=101'
);

?>