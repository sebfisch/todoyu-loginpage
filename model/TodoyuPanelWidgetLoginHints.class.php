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
 * Panel widget for the login page
 *
 * @package		Todoyu
 * @subpackage	Loginpage
 */
class TodoyuPanelWidgetLoginHints extends TodoyuPanelWidget implements TodoyuPanelWidgetIf {

	/**
	 * Initialize projectTree PanelWidget
	 *
	 * @param	Array		$config
	 * @param	Array		$params
	 * @param	Integer		$idArea
	 * @param	Boolean		$expanded
	 */
	public function __construct(array $config, array $params = array(), $idArea = 0) {

			// construct PanelWidget (init basic configuration)
		parent::__construct(
			'loginhints',									// ext key
			'loginhints',									// panel widget ID
			'LLL:panelwidget-loginhints.title',				// widget title text
			$config,										// widget config array
			$params,										// widget params
			$idArea											// area ID
		);

		TodoyuPage::addExtAssets('loginpage', 'panelWidgetLoginHints');
	}



	/**
	 * Render panelwidget content
	 *
	 * @return	String
	 */
	public function renderContent() {
		$tmpl	= 'ext/loginpage/view/panelwidget-loginhints.tmpl';
		$data	= array();

		$content= render($tmpl, $data);

		$this->setContent($content);

		return $content;
	}



	/**
	 * Render panelwidget including its content
	 *
	 * @return	String
	 */
	public function render() {
		$this->renderContent();

		return parent::render();
	}

}

?>