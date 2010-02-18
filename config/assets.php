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

/**
 * Assets (JS, CSS, SWF, etc.) requirements for loginpage extension
 *
 * @package		Todoyu
 * @subpackage	Loginpage
 */

$CONFIG['EXT']['loginpage']['assets'] = array(
		// Default assets: loaded all over the installation always
	'default' => array(
		'js' => array(
			array(
				'file'		=> 'ext/loginpage/assets/js/Ext.js',
				'media'		=> 'all',
				'position'	=> 100
			)
		),
		'css' => array(
			array(
				'file'		=> 'ext/loginpage/assets/css/global.css',
				'media'		=> 'all',
				'position'	=> 100
			)
		)
	),


		// Public assets: basis assets for this extension
	'public' => array(
		'js' => array(
			array(
				'file'		=> 'lib/js/md5.js',
				'position'	=> 30,
				'merge'		=> true,
				'localize'	=> false,
				'compress'	=> true
			)
		),
		'css' => array(
			array(
				'file'		=> 'ext/loginpage/assets/css/ext.css',
				'media'		=> 'all',
				'position'	=> 100
			)
		)
	),

		// Assets of panel widgets
	'panelWidgetLoginHints' => array(
		'css' => array(
			array(
				'file' => 'ext/loginpage/assets/css/panelwidget-loginhints.css',
				'position' => 115,
			),
		)
	),


);

?>