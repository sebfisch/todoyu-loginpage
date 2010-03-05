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
	 * 
	 */
	public static function makeNewsFile()	{
		if(self::checkForCurl() && ($content = self::makeCurlRequest()) !== false)	{
			self::writeCacheFile($content);
		}
		
		if(($content = self::makeFileGetContentRequest()) !== false)	{
			self::writeCacheFile($content);
		}
	}
	
	
	
	/**
	 * Tries to get the file content over curl
	 * 
	 * @return	String
	 */
	protected static function makeCurlRequest()	{
		$curl = curl_init();
		
		if(!$curl)	{
			return false;
		}
		
		curl_setopt($curl, CURLOPT_URL, $GLOBALS['CONFIG']['EXT']['loginpage']['panelWidgetLiveNews']['url']);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		
		$content = curl_exec($curl);
		
		curl_close($curl);
		
		return $content;
	}
	
	
	
	/**
	 * Tries to get the file content over file_get_contents
	 * 
	 * @return String
	 */
	protected static function makeFileGetContentRequest()	{
		return @file_get_contents($GLOBALS['CONFIG']['EXT']['loginpage']['panelWidgetLiveNews']['url']);
	}
	
	
	
	/**
	 * Writes the content to a cache file
	 * 
	 * @param	String	$content
	 */
	protected static function writeCacheFile($content)	{
		$file = PATH_CACHE.'/output/loginnews.html';
		
		TodoyuFileManager::makeDirDeep(PATH_CACHE.'/output');
		
		if(!file_exists($file)) file_put_contents($file, $content);
		
		if(! md5(file_get_contents($file)) == md5($content))	{
			file_put_contents($file, $content);
		}
	}
	
	
	
	/**
	 * checks if curl is installed
	 * 
	 * @return	Boolean
	 */
	protected static function checkForCurl()	{
		return in_array('curl', get_loaded_extensions());
	}
}