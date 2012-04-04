<?php
/****************************************************************************
* todoyu is published under the BSD License:
* http://www.opensource.org/licenses/bsd-license.php
*
* Copyright (c) 2012, snowflake productions GmbH, Switzerland
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
 * Various loginpage extension info data
 */

Todoyu::$CONFIG['EXT']['loginpage']['info'] = array(
	'title'			=> 'todoyu Login Page',
	'description'	=> 'todoyu Login Page',
	'author'		=> array(
		'name'		=> 'todoyu Core Developer Team',
		'email'		=> 'team@todoyu.com',
		'company'	=> 'snowflake productions GmbH, Zurich'
	),
	'state'			=> 'stable',
	'version'		=> '1.2.0b',
	'constraints'	=> array(
		'core'		=> '2.2.0b',
		'depends'	=> array(
			'contact'	=> '1.2.0'
		)
	),
	'urlDocumentation'	=> 'http://doc.todoyu.com/?loginpage'
);

?>