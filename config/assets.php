<?php
/****************************************************************************
* todoyu is published under the BSD License:
* http://www.opensource.org/licenses/bsd-license.php
*
* Copyright (c) 2010, snowflake productions gmbh
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

/**
 * Assets (JS, CSS, SWF, etc.) requirements for loginpage extension
 *
 * @package		Todoyu
 * @subpackage	Loginpage
 */

Todoyu::$CONFIG['EXT']['loginpage']['assets'] = array(
	'js' => array(
		array(
			'file'		=> 'ext/loginpage/assets/js/Ext.js',
			'position'	=> 100
		),
		array(
			'file'		=> 'lib/js/md5.js',
			'position'	=> 30,
			'merge'		=> true,
			'localize'	=> false,
			'compress'	=> true
		),
		array(
			'file'		=> 'ext/loginpage/assets/js/PanelWidgetLoginNews.js',
			'position'	=> 120
		),
		array(
			'file'		=> 'ext/loginpage/assets/js/HeadletLogout.js',
			'position'	=> 120
		)
	),
	'css' => array(
		array(
			'file'		=> 'ext/loginpage/assets/css/global.css',
			'media'		=> 'all',
			'position'	=> 100
		),
		array(
			'file'		=> 'ext/loginpage/assets/css/ext.css',
			'media'		=> 'all',
			'position'	=> 100
		),
		array(
			'file' 		=> 'ext/loginpage/assets/css/panelwidget-loginnews.css',
			'position' 	=> 120,
		),
		array(
			'file' 		=> 'ext/loginpage/assets/css/headlet-logout.css',
			'position' 	=> 120,
		)
	)
);

?>