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

/**
 * Ext controller for loginpage
 *
 * @package		Todoyu
 * @subpackage	Loginpage
 */
class TodoyuLoginpageExtActionController extends TodoyuActionController {

	/**
	 * Default action when loading without parameters (normal call of login page)
	 *
	 * @param	Array		$params
	 * @return	String
	 */
	public function defaultAction(array $params) {
			// Redirect to default view if already logged in
		if( TodoyuAuth::isLoggedIn() ) {
			TodoyuLoginpageManager::redirectToHome();
		}

			// Add login screen maintabs
		TodoyuLoginpageManager::addLoginScreenMainTabs();
			// Set default tab
		TodoyuFrontend::setDefaultTab('login');

		TodoyuPage::init('ext/loginpage/view/ext.tmpl');
		TodoyuPage::setTitle('LLL:loginpage.page.title');

		$loginStatus	= $params['status'];

			// Render elements
		$panelWidgets		= TodoyuLoginpageRenderer::renderPanelWidgets();
		$loginForm			= TodoyuLoginpageRenderer::renderLoginForm($loginStatus);
		$extendedContent	= TodoyuLoginpageRenderer::renderExtendedContent();

		TodoyuPage::set('panelWidgets', $panelWidgets);
		TodoyuPage::set('loginForm', $loginForm);
		TodoyuPage::set('extendedContent', $extendedContent);
//		TodoyuPage::set('todoyuInfo', $todoyuInfo);

//		TodoyuPage::set('content', 'hallo');

			// Prevent robots to index the login page
		TodoyuPage::addMetatag('robots', 'noindex');

		return TodoyuPage::render();
	}



	/**
	 * Logout request
	 *
	 * @param	Array		$params
	 */
	public function logoutAction($params) {
		TodoyuAuth::logout();
	}



	/**
	 * Login request
	 *
	 * @param	Array		$params
	 * @return	String
	 */
	public function loginAction($params) {
			// If login form not submitted by AJAX, form vars are wrapped in login namespace
		if( ! TodoyuRequest::isAjaxRequest() ) {
				// Get login data from login namespace
			$loginData	= $params['login'];
				// Merge login data with params
			$params		= array_merge($params, $loginData);
		}

		$username	= trim(strtolower($params['username']));
		$passHash	= trim(strtolower($params['passhash']));
		$remain		= trim(strtolower($params['remain'])) === 'true';

			// Check whether login is valid
		if( TodoyuAuth::isValidLogin($username, $passHash) ) {
				// Find person-ID by username
			$idPerson = TodoyuPersonManager::getPersonIDByUsername($username);

				// Login person
			TodoyuAuth::login($idPerson);

				// Set locale cookie
			TodoyuLocaleManager::setLocaleCookie();

				// Build JSON response
			$params	= array(
				'ext'		=> Todoyu::$CONFIG['FE']['DEFAULT']['ext'],
				'controller'=> Todoyu::$CONFIG['FE']['DEFAULT']['controller']
			);

			$response	= array(
				'success'	=> true,
				'redirect'	=> TodoyuString::buildUrl($params)
			);

				// Set remain login cookie
			if( $remain ) {
				TodoyuCookieLogin::setRemainLoginCookie($idPerson);
				TodoyuLoginpageManager::setRemainLoginFlagCookie();
			} else {
				TodoyuLoginpageManager::removeRemainLoginFlagCookie();
			}

		} else {
				// Log failed login
			Todoyu::log('Login failed', TodoyuLogger::LEVEL_NOTICE, array('username' => $username, 'passhash' => $passHash));

				// Build JSON response
			$response	= array(
				'success'	=> false,
				'message'	=> Label('loginpage.form.status.loginFailed')
			);

				// Wait at failed log-in
			$secondsToWait = intval(Todoyu::$CONFIG['EXT']['loginpage']['waitAtFailLogin']);
			sleep($secondsToWait);
		}

			// If AJAX request, send json. If normal request, redirect to lo
		if( TodoyuRequest::isAjaxRequest() ) {
			TodoyuHeader::sendTypeJSON();

			return json_encode($response);
		} else {
			if( $response['success'] ) {
				TodoyuHeader::location(TODOYU_URL, true);
			} else {
				TodoyuHeader::redirect('loginpage', 'ext');
			}
		}
	}

}

?>