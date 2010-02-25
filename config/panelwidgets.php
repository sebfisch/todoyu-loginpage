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
 * Configure panel widgets to be shown in Project area
 */

$loginHintsConfig	= array(
	'message'	=> 'todoyu beta version is developed and tested on Firefox and Internet Explorer v 8.0<br/><br/><img src="ext/loginpage/assets/img/firefox.png" />We recommend using the Firefox browser for testing the current todoyu version!'
);

TodoyuPanelWidgetManager::addDefaultPanelWidget('loginpage', 'TodoyuPanelWidgetLoginHints', 20, $loginHintsConfig );

TodoyuPanelWidgetManager::addDefaultPanelWidget('loginpage', 'TodoyuPanelWidgetLoginPage', 30);

TodoyuPanelWidgetManager::addDefaultPanelWidget('loginpage', 'TodoyuPanelWidgetLoginNews', 10, $CONFIG['EXT']['loginpage']['panelWidgetLiveNews']);

?>