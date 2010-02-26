<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2009 snowflake productions gmbh
*  All rights reserved
*
*  This script is part of the todoyu project.
*  The todoyu project is free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License, version 2,
*  (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html) as published by
*  the Free Software Foundation;
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

$CONFIG['AUTH']['noLoginRequired']['loginpage'] = array('ext');

$CONFIG['AUTH']['login'] = array(
	'ext'		=> 'loginpage',
	'controller'=> 'ext'
);

$CONFIG['EXT']['loginpage']['waitAtFailLogin'] = 2;

$CONFIG['EXT']['loginpage']['extendedContentHooks'] = array();



	// Configure menu tabs
$CONFIG['EXT']['loginpage']['tabs']	= array(
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
		'href'		=> 'http://blog.snowflake.ch/de/blog-post/2009/01/31/todoyu-gewinnt-osbf-award/',
		'target'	=> '_blank'
	)
);



$CONFIG['EXT']['loginpage']['panelWidgetLiveNews'] = array(
	'url'	=> 'ext/loginpage/dev/news.html?v=' . TODOYU_VERSION
);

?>