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

if( ! defined('TODOYU') ) die('NO ACCESS');


	// add default panel widgets
$requiredLibraries = array(
	'TinyMCE'		=> array(
		'path' 			=> PATH_LIB . '/js/tiny_mce',
		'downloadURL'	=> 'http://tinymce.moxiecode.com/download.php',
		'instruction'	=> 'LLL:panelwidget-checklibs.instruction.tinymce'
	),
	'JS Calendar'	=> array(
		'path'			=> PATH_LIB . '/js/jscalendar',
		'downloadURL'	=> 'http://www.dynarch.com/static/jscalendar-1.0.zip',
		'instruction'	=> 'LLL:panelwidget-checklibs.instruction.jscalendar'
	),
	'PHPMailer'		=> array(
		'path'			=> PATH_LIB . '/php/phpmailer',
		'downloadURL'	=> 'http://sourceforge.net/projects/phpmailer/',
		'instruction'	=> 'LLL:panelwidget-checklibs.instruction.phpmailer'
	)
);

TodoyuPanelWidgetManager::addDefaultPanelWidget('loginpage', 'TodoyuPanelWidgetCheckLibs', 10, $requiredLibraries );

TodoyuPanelWidgetManager::addDefaultPanelWidget('loginpage', 'TodoyuPanelWidgetLoginPage', 20);

?>