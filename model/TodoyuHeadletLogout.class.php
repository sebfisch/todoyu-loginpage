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
 * Logout headlet with logout button
 *
 * @package		Todoyu
 * @subpackage	Loginpage
 */
class TodoyuHeadletLogout extends TodoyuHeadletTypeButton {

	/**
	 * Initialize headlet
	 *
	 */
	protected function init() {
			// Set javascript object which handles events
		$this->setJsHeadlet('Todoyu.Ext.loginpage.Headlet.Logout');
	}



	/**
	 * Get headlet label
	 *
	 * @return	String
	 */
	public function getLabel() {
		return 'Abmelden';
	}

}

?>