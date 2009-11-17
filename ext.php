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
 * Extension main file for daytracks extension
 *
 * @package		Todoyu
 * @subpackage	Loginpage
 */

if( ! defined('TODOYU') ) die('NO ACCESS');



	// Declare ext ID, path
define('EXTID_LOGINPAGE', 110);
define('PATH_EXT_LOGINPAGE', PATH_EXT . '/loginpage');

	// Register module locales
TodoyuLocale::register('loginpage', PATH_EXT_LOGINPAGE . '/locale/ext.xml');
TodoyuLocale::register('panelwidget-loginpage', PATH_EXT_LOGINPAGE . '/locale/panelwidget-loginpage.xml');
TodoyuLocale::register('panelwidget-loginhints', PATH_EXT_LOGINPAGE . '/locale/panelwidget-loginhints.xml');
TodoyuLocale::register('panelwidget-checklibs', PATH_EXT_LOGINPAGE . '/locale/panelwidget-checklibs.xml');

	// Request configurations
require_once( PATH_EXT_LOGINPAGE . '/config/extension.php' );
require_once( PATH_EXT_LOGINPAGE . '/config/panelwidgets.php' );

if( TodoyuAuth::isLoggedIn() ) {
	TodoyuFrontend::addSubmenuEntry('todoyu', 'logout', 'LLL:loginpage.metamenu.logout', 'javascript:Todoyu.Ext.loginpage.logout()', 1000);
}


?>