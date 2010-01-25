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
 * Loginpage manager
 *
 * @package		Todoyu
 * @subpackage	Loginpage
 */
class TodoyuLoginpageManager {

	/**
	 * Add special tabs to loginscreen
	 *
	 */
	public static function addLoginscreenMainTabs() {
			// add menu entry
		TodoyuFrontend::addMenuEntry('login', 'LLL:loginpage.logintab.login', '?ext=loginpage&controller=ext', 10);
		TodoyuFrontend::addMenuEntry('help', 'LLL:loginpage.logintab.help', 'http://developer.todoyu.com', 20);
		TodoyuFrontend::addMenuEntry('blog', 'LLL:loginpage.logintab.blog', 'http://blog.snowflake.ch/de/blog-post/2009/01/31/todoyu-gewinnt-osbf-award/', 30);
		TodoyuFrontend::addMenuEntry('bugs', 'LLL:loginpage.logintab.bugs', 'http://bugs.todoyu.com/', 100);
	}



	/**
	 * Redirect to default view
	 *
	 */
	public static function redirectToHome() {
		$url	= TodoyuDiv::buildUrl(array(), '', true);

		TodoyuHeader::location($url);
	}

}



?>