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
 * Panel widget manager for the login news
 *
 * @package		Todoyu
 * @subpackage	Loginpage
 */
class TodoyuPanelWidgetLoginNewsManager {

	/**
	 * Creates a File with news from todoyu.com
	 *
	 * first try over curl
	 * second try over file get contents
	 */
	public static function makeNewsFile() {
		if( self::checkForCurl() && ($content = self::makeCurlRequest()) !== false ) {
			self::writeCacheFile($content);
			return;
		}

		if( ($content = self::makeFileGetContentRequest()) !== false ) {
			self::writeCacheFile($content);
			return;
		}
	}



	/**
	 * Tries to get the file content over curl
	 *
	 * @return	String
	 */
	protected static function makeCurlRequest() {
		return TodoyuFileManager::downloadFile(Todoyu::$CONFIG['EXT']['loginpage']['panelWidgetLiveNews']['url']);
	}



	/**
	 * Tries to get the file content over file_get_contents
	 *
	 * @todo	Use core methods, remove @
	 * @return String
	 */
	protected static function makeFileGetContentRequest() {
		return @file_get_contents(Todoyu::$CONFIG['EXT']['loginpage']['panelWidgetLiveNews']['url']);
	}



	/**
	 * Writes the content to a cache file
	 *
	 * @param	String	$content
	 */
	protected static function writeCacheFile($content) {
		$file = PATH_CACHE.'/output/loginnews.html';

		// get content between the body tags
		$content = substr($content, strpos($content, '<body>')+6);
		$content = substr($content, 0, strlen($content) - (strlen($content)-strpos($content, '</body>')));

		TodoyuFileManager::makeDirDeep(PATH_CACHE.'/output');

		if( ! file_exists($file) ) {
			file_put_contents($file, $content);
		}

		if( ! (md5(file_get_contents($file)) == md5($content)) ) {
			file_put_contents($file, $content);
		}
	}



	/**
	 * Check whether Curl is installed
	 *
	 * @return	Boolean
	 */
	protected static function checkForCurl() {
		return in_array('curl', get_loaded_extensions());
	}

}