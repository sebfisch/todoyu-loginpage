<?php
/****************************************************************************
* todoyu is published under the BSD License:
* http://www.opensource.org/licenses/bsd-license.php
*
* Copyright (c) 2011, snowflake productions GmbH, Switzerland
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
 * Loginpage renderer
 *
 * @package		Todoyu
 * @subpackage	Loginpage
 */
class TodoyuLoginpageRenderer {

	/**
	 * @var string		Extension key
	 */
	const EXTKEY = 'loginpage';



	/**
	 * Render login-page panel widgets
	 *
	 * @return	String
	 */
	public static function renderPanelWidgets() {
		return TodoyuPanelWidgetRenderer::renderPanelWidgets(self::EXTKEY);
	}



	/**
	 * Render login mask (form)
	 *
	 * @return	String
	 */
	public static function renderLoginForm($status = null) {
		$xml	= 'ext/loginpage/config/form/login.xml';
		$form	= TodoyuFormManager::getForm($xml);
		$form->setUseRecordID(false);

			// If status is failed, show error message
		if( $status === 'failed' ) {
			$config	= array(
				'default'	=> 'LLL:loginpage.ext.form.loginFailed',
				'class'		=> 'error'
			);
			$form->getFieldset('message')->addFieldElement('info', 'comment', $config);
		}

			// Check remain login checkbox if last time was checked
		if( TodoyuLoginpageManager::hasRemainLoginFlagCookie() ) {
			$form->getField('loginremain')->setChecked();
		}

		return $form->render();
	}



	/**
	 * Render extended content (from registered function hooks)
	 *
	 * @return	String
	 */
	public static function renderExtendedContent() {
		$content	= '';

		$funcRefs	= Todoyu::$CONFIG['EXT']['loginpage']['extendedContentHooks'];

		if( is_array($funcRefs) ) {
			foreach($funcRefs as $funcRef) {
				if( TodoyuFunction::isFunctionReference($funcRef) ) {
					list($obj, $method) = explode('::', $funcRef);
					$obj = new $obj();
					$content	.= $obj->$method($requestData);
				}
			}
		}

		return $content;
	}



	/**
	 * @static
	 * @return String
	 */
	public static function renderForgotPasswordLink() {
		return render('ext/loginpage/view/forgotpasswordlink.tmpl', array());
	}



	/**
	 * Render form for requesting email with forgotten password
	 *
	 * @param	String	$username
	 * @return	String
	 */
	public static function renderForgotPasswordForm($username = '') {
		$xmlPath	= 'ext/loginpage/config/form/forgotpassword.xml';

		$form		= TodoyuFormManager::getForm($xmlPath);
		$form->setUseRecordID(false);
		$form->addFormData(array('username' => $username));

		return $form->render();
	}



	/**
	 * Renders the noscript javascript check an sets a cookie.
	 * To check if javaScript & cookies are enabled
	 *
	 * @static
	 * @return String
	 */
	public static function renderJavascriptAndCookieCheck() {
		$tmpl	= 'ext/loginpage/view/javascriptcheck.tmpl';

		$data	= array(
			'javaScriptManual'	=>	Todoyu::$CONFIG['EXT']['loginpage']['manuallinks']['javascript']
		);

		setcookie("check", 1, 0);

		return render($tmpl, $data);
	}

}

?>