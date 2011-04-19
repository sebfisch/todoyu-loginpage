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

class TodoyuLoginpageMailer {

	/**
	 *
	 * @param	Integer		$idPerson
	 * @param	String		$password
	 * @return	Boolean
	 */
	public static function sendNewPasswordMail($idPerson, $password) {
		$person	= TodoyuContactPersonManager::getPerson($idPerson);

		$data	= array(
			'newPassword'	=> $password,
			'loginlink'		=> TodoyuString::buildUrl(array(), '', true)
		);

		$mailSubject	= Label('loginpage.ext.forgotpassword.mail.subject.newpassword');
		$fromAddress	= Todoyu::$CONFIG['SYSTEM']['email'];
		$fromName		= Todoyu::$CONFIG['SYSTEM']['name'];
		$toAddress		= $person->getEmail();
		$toName			= $person->getFullName();
		$htmlBody		= render('ext/loginpage/view/forgotpassword-mailbodyhtml.tmpl', $data);
		$textBody		= render('ext/loginpage/view/forgotpassword-mailbodyplain.tmpl', $data);

		$baseURL	= PATH_EXT_LOGINPAGE;

			// Send mail
		$sendStatus	= TodoyuMailManager::sendMail($mailSubject, $fromAddress, $fromName, $toAddress, $toName, $htmlBody, $textBody, $baseURL, true);

		return $sendStatus;
	}



	/**
	 * Send confirmation email
	 *
	 * @param	Integer		$idPerson
	 * @param	String		$hash
	 * @param	String		$userName
	 * @return	Boolean
	 */
	public static function sendConfirmationMail($idPerson, $hash, $userName) {
		$idPerson	= intval($idPerson);
		$person		= TodoyuContactPersonManager::getPerson($idPerson);

		$mailSubject= Label('loginpage.ext.forgotpassword.mail.confirmation.title');
		$fromAddress= Todoyu::$CONFIG['SYSTEM']['email'];
		$fromName	= Todoyu::$CONFIG['SYSTEM']['name'];
		$toAddress	= $person->getEmail();
		$toName		= $person->getFullName();

		$data	= array(
			'confirmationlink'	=> TodoyuString::buildUrl(
				array('ext' 		=> 'loginpage',
					  'controller'	=> 'ext',
					  'action'		=> 'confirmationmail',
					  'hash'		=> $hash,
					  'userName'	=> $userName
				),
				'',		// Hash
				true	// absolute
			),
			'isConfirmation'	=> true
		);
		$htmlBody	= render('ext/loginpage/view/forgotpassword-mailbodyhtml.tmpl', $data);
		$textBody	= render('ext/loginpage/view/forgotpassword-mailbodyplain.tmpl', $data);

		$baseURL	= PATH_EXT_LOGINPAGE;

			// Send mail
		$sendStatus	= TodoyuMailManager::sendMail($mailSubject, $fromAddress, $fromName, $toAddress, $toName, $htmlBody, $textBody, $baseURL, true);

		return $sendStatus;
	}

}

?>