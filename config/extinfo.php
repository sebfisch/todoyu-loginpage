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
 * Various loginpage extension info data
 */


$CONFIG['EXT']['loginpage']['info'] = array(
	'title'				=> 'todoyu login page',
	'description' 		=> 'todoyu login page',
	'author' 			=> array(
		'name'		=> '',
		'email'		=> '',
		'company'	=> 'Snowflake Productions, Zürich'
	),
	'dependencies' 		=> '',
	'conflicts'			=> '',
	'state' 			=> 'beta',
	'version' => '0.1.0',
	'constraints' => array(
		'depends' => array(
			'user'			=> '0.1.0',
		),
		'conflicts' => array(

		),
		'suggests' => array(

		),
	)
);

?>