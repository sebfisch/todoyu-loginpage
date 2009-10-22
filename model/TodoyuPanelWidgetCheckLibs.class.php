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
 * Library check Panel widget for the login page
 *
 * @package		Todoyu
 * @subpackage	Loginpage
 */

class TodoyuPanelWidgetCheckLibs extends TodoyuPanelWidget implements TodoyuPanelWidgetIf {

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
			'loginpage',							// ext key
			'checklibs',							// panel widget ID
			'LLL:panelwidget-checklibs.title',		// widget title text
			$config,								// widget config array
			$params,								// widget params
			$idArea									// area ID
		);
	}




	/**
	 * Render panelwidget content
	 *
	 * @return	String
	 */
	public function renderContent() {
		TodoyuPage::addExtAssets( 'loginpage', 'panelWidgetCheckLibs' );

		$tmpl	= 'ext/loginpage/view/panelwidget-checklibs.tmpl';

		$data	= array(
			'missingLibs'	=> $this->missingLibs
		);

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
			// Check availability of neccessary 3rd party libraries
		$this->missingLibs = self::checkLibrariesAvailability();

			// Only show panel widget if any depencies are missing
		if (count($this->missingLibs) > 0) {
			$this->renderContent();

			return parent::render();
		}
	}



	public function checkLibrariesAvailability() {
		$missingLibs = array();

		foreach ($this->config as $requiredLib => $libConf) {
			if (! file_exists($libConf['path']) ) {
				$missingLibs[$requiredLib] = $libConf;
			}
		}

		return $missingLibs;
	}


	/**
	 * This panelwidget is for the loginpage where no user is loged in.
	 * So we always allow to render this widget
	 *
	 * @return	Bool		true on loginpage only
	 */
	public static function isAllowed() {
		return AREA === 110;
	}


}

?>