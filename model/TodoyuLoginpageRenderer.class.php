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
 * Loginpage renderer
 *
 * @package		Todoyu
 * @subpackage	Loginpage
 */
class TodoyuLoginpageRenderer {

	/**
	 * Render loginpage headlet (logout button)
	 *
	 * @return	String
	 */
	public static function renderHeadlet() {
		$tmpl	= 'ext/loginpage/view/headlet.tmpl';
		$data	= array(
			'id'	=> 'loginpage'
		);

		return render($tmpl, $data);
	}


	/**
	 * Render loginpage panel widgets
	 *
	 * @return	String
	 */
	public static function renderPanelWidgets() {
		$params	= array();

		return TodoyuPanelWidgetRenderer::renderPanelWidgets('loginpage', $params);
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
				'default'	=> 'LLL:loginpage.form.loginFailed',
				'class'		=> 'error'
			);
			$field	= $form->getFieldset('message')->addFieldElement('info', 'comment', $config);
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

		$funcRefs	= $GLOBALS['CONFIG']['EXT']['loginpage']['extendedContentHooks'];

		if (is_array($funcRefs)) {
			foreach($funcRefs as $funcRef) {
				if(TodoyuDiv::isFunctionReference($funcRef))	{
					list($obj, $method) = explode('::', $funcRef);
					$obj = new $obj();
					$content	.= $obj->$method($requestData);
				}
			}
		}

		return $content;
	}



	/**
	 * Render todoyu info
	 *
	 * @return	String
	 */
	public static function renderTodoyuInfo() {
		$tmpl	= 'ext/loginpage/view/todoyuinfo.tmpl';
		$data	= array(
			'version'	=> TODOYU_VERSION,
			'update'	=> strtotime(TODOYU_UPDATE)
		);

		return render($tmpl, $data);
	}


}


?>