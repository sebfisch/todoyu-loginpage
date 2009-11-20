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

class TodoyuLoginpageExtActionController extends TodoyuActionController {

	protected function hasActionAccess($action) {
		return true;
	}

	public function defaultAction(array $params) {
			// Add loginscreen maintabs
		TodoyuLoginpageManager::addLoginscreenMainTabs();
			// Set default tab
		TodoyuFrontend::setDefaultTab('login');

		TodoyuPage::init('ext/loginpage/view/ext.tmpl');
		TodoyuPage::setTitle('LLL:loginpage.page.title');

		TodoyuPage::addExtAssets('loginpage');

		$loginStatus		= $params['status'];


			// Render elements
		$panelWidgets		= TodoyuLoginpageRenderer::renderPanelWidgets();
		$loginForm			= TodoyuLoginpageRenderer::renderLoginForm($loginStatus);
		$extendedContent	= TodoyuLoginpageRenderer::renderExtendedContent();

		TodoyuPage::set('panelWidgets', $panelWidgets);
		TodoyuPage::set('loginForm', $loginForm);
		TodoyuPage::set('extendedContent', $extendedContent);

		TodoyuPage::addJsOnloadedFunction('Todoyu.Ext.loginpage.init.bind(Todoyu.Ext.loginpage)');

		return TodoyuPage::render();
	}



	public function logoutAction($params) {
		TodoyuAuth::logout();
	}


	public function loginAction($params) {
		$username	= trim(strtolower($params['username']));
		$passhash	= trim(strtolower($params['passhash']));
		$remain		= trim(strtolower($params['remain'])) === 'true';

			// Check if login is valid
		if( TodoyuAuth::isValidLogin($username, $passhash) ) {
				// Find user-ID by username
			$idUser = TodoyuUserManager::getUserIDbyUsername($username);

				// Login user
			TodoyuAuth::login($idUser);

				// Build JSON response
			$params	= array(
				'ext'		=> $GLOBALS['CONFIG']['FE']['DEFAULT']['ext'],
				'controller'=> $GLOBALS['CONFIG']['FE']['DEFAULT']['controller']
			);
			$response	= array(
				'success'	=> true,
				'redirect'	=> TodoyuDiv::buildUrl($params)
			);

				// Set remain login cookie
			if( $remain ) {
				TodoyuCookieLogin::setRemainLoginCookie($idUser);
			}

		} else {
				// Log failed login
			Todoyu::log('Login failed', LOG_LEVEL_NOTICE, array('username' => $username, 'passhash' => $passhash));

				// Build JSON response
			$response	= array(
				'success'	=> false,
				'message'	=> 'Login failed'
			);

				// Wait at failed login
			$secondsToWait = intval($GLOBALS['CONFIG']['EXT']['loginpage']['waitAtFailLogin']);
			sleep($secondsToWait);
		}

		TodoyuHeader::sendHeaderJSON();

		return json_encode($response);
	}

}





?>