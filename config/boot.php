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

	// Declare ext ID, path
define('EXTID_LOGINPAGE', 110);
define('PATH_EXT_LOGINPAGE', PATH_EXT . '/loginpage');

	// Register module locales
TodoyuLabelManager::register('loginpage', 'loginpage', 'ext.xml');
TodoyuLabelManager::register('panelwidget-loginpage', 'loginpage', 'panelwidget-loginpage.xml');
TodoyuLabelManager::register('panelwidget-loginnews', 'loginpage', 'panelwidget-loginnews.xml');

	// Add the ext controller to the noLoginRequired list
Todoyu::$CONFIG['AUTH']['noLoginRequired']['loginpage'] = array('ext');

	// Define the extension as login fallback
Todoyu::$CONFIG['AUTH']['login'] = array(
	'ext'		=> 'loginpage',
	'controller'=> 'ext'
);

Todoyu::$CONFIG['EXT']['loginpage']['waitAtFailLogin'] = 2;

Todoyu::$CONFIG['EXT']['loginpage']['manuallinks']['cookies']		= 'http://docu.todoyu.com/index.php?id=manual-cookies';
Todoyu::$CONFIG['EXT']['loginpage']['manuallinks']['javascript']	= 'http://docu.todoyu.com/index.php?id=manual-javascript';

?>