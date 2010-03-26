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
 * Loginpage manager
 *
 * @package		Todoyu
 * @subpackage	Loginpage
 */
class TodoyuLoginpageManager {

	/**
	 * Add tabs to loginscreen
	 */
	public static function addLoginScreenMainTabs() {
			// Add menu entries
		foreach(Todoyu::$CONFIG['EXT']['loginpage']['tabs'] as $tab) {
			TodoyuFrontend::addMenuEntry($tab['key'], $tab['label'], $tab['href'], $tab['position'], $tab['target']);
		}
	}


	/**
	 * Set a cookie to keep the remain login box checked
	 *
	 */
	public static function setRemainLoginFlagCookie() {
		setcookie('checkRemainLogin', 1, NOW + TodoyuTime::SECONDS_WEEK, PATH_WEB, null, false, true);
	}



	/**
	 * Remove the cookie which keeps the remain login box checked
	 *
	 */
	public static function removeRemainLoginFlagCookie() {
		setcookie('checkRemainLogin', 0, 1000, PATH_WEB, null, false, true);
	}



	/**
	 * Check if user has the cookie to keep the remain login box checked
	 *
	 * @return	Bool
	 */
	public static function hasRemainLoginFlagCookie() {
		return intval($_COOKIE['checkRemainLogin']) === 1;
	}



	/**
	 * Redirect to default view
	 *
	 */
	public static function redirectToHome() {
		$url	= TodoyuString::buildUrl(array(), '', true);

		TodoyuHeader::location($url);
	}

}

?>