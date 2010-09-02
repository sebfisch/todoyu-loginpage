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
 * Panel widget for the login news
 *
 * @package		Todoyu
 * @subpackage	Loginpage
 */
class TodoyuPanelWidgetLoginNews extends TodoyuPanelWidget implements TodoyuPanelWidgetIf {

	/**
	 * Initialize projectTree PanelWidget
	 *
	 * @param	Array		$config
	 * @param	Array		$params
	 * @param	Integer		$idArea
	 * @param	Boolean		$expanded
	 */
	public function __construct(array $config, array $params = array(), $idArea = 0) {

			// Construct panelWidget (init basic configuration)
		parent::__construct(
			'loginpage',							// ext key
			'loginnews',							// panel widget ID
			'LLL:panelwidget-loginnews.title',		// widget title text
			$config,								// widget config array
			$params,								// widget parameters
			$idArea									// area ID
		);
	}



	/**
	 * Render panelwidget content
	 *
	 * @return	String
	 */
	public function renderContent() {
		$tmpl	= 'ext/loginpage/view/panelwidget-loginnews.tmpl';

		TodoyuPanelWidgetLoginNewsManager::makeNewsFile();

		$data	= array(
			'file'	=> PATH_WEB .'/cache/output/loginnews.html',
			'filecheck'	=> PATH_CACHE.'/output/loginnews.html'
		);

		$content = render($tmpl, $data);

		$this->setContent($content);


		return $content;
	}



	/**
	 * Render panelWidget including its content
	 *
	 * @return	String
	 */
	public function render() {
		$this->renderContent();

		return parent::render();
	}

}

?>