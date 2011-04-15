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
	 * @static
	 * @param	Integer	$idPerson
	 * @param	String	$password
	 * @return	Boolean
	 */
	public static function sendNewPasswordMail($idPerson, $password) {
		$person	= TodoyuContactPersonManager::getPerson($idPerson);

			// Get mailer
		$mailer	= TodoyuMailManager::getPHPMailerLite(true);

			// Set "from" (sender) name and email address
		$fromName		= Todoyu::$CONFIG['SYSTEM']['name'];
		$fromAddress	= Todoyu::$CONFIG['SYSTEM']['email'];
		$mailer->SetFrom($fromAddress, $fromName);

			// Set "replyTo", "subject"
		$mailer->AddReplyTo($fromAddress, $fromName);
		$mailer->Subject	= Label('loginpage.ext.forgotpassword.mail.subject.newpassword');

		$data	= array(
			'newPassword'	=> $password,
			'loginlink'	=> TodoyuString::buildUrl(array(), '', true)
		);

			// Add message body as HTML and plain text
		$htmlTmpl	= 'ext/loginpage/view/forgotpassword-mailbodyhtml.tmpl';
		$htmlBody		= render($htmlTmpl, $data);

		$plainTmpl	= 'ext/loginpage/view/forgotpassword-mailbodyplain.tmpl';
		$mailer->MsgHTML($htmlBody, PATH_EXT_LOGINPAGE);
		$mailer->AltBody	= render($plainTmpl, $data);

			// Add "to" (recipient) address
		$mailer->AddAddress($person->getEmail(), $person->getFullName());

		try {
			$sendStatus	= $mailer->Send();
		} catch(phpmailerException $e) {
			Todoyu::log($e->getMessage(), TodoyuLogger::LEVEL_ERROR);
		} catch(Exception $e) {
			Todoyu::log($e->getMessage(), TodoyuLogger::LEVEL_ERROR);
		}

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
		$person	= TodoyuContactPersonManager::getPerson($idPerson);

			// Get mailer
		$mailer	= TodoyuMailManager::getPHPMailerLite(true);

			// Set "from" (sender) name and email address
		$fromName		= Todoyu::$CONFIG['SYSTEM']['name'];
		$fromAddress	= Todoyu::$CONFIG['SYSTEM']['email'];
		$mailer->SetFrom($fromAddress, $fromName);

			// Set "replyTo", "subject"
		$mailer->AddReplyTo($fromAddress, $fromName);
		$mailer->Subject	= Label('loginpage.ext.forgotpassword.mail.confirmation.title');

		$data	= array(
			'confirmationlink'	=> TodoyuString::buildUrl(
				array('ext' => 'loginpage',
					  'controller'	=> 'ext',
					  'action'		=> 'confirmationmail',
					  'hash'			=> $hash,
					  'userName'		=> $userName
				),
				'',		// Hash
				true	// absolute
			),
			'isConfirmation'	=> true
		);

			// Add message body as HTML and plain text
		$htmlTmpl	= 'ext/loginpage/view/forgotpassword-mailbodyhtml.tmpl';
		$htmlBody		= render($htmlTmpl, $data);


		$plainTmpl	= 'ext/loginpage/view/forgotpassword-mailbodyplain.tmpl';
		$mailer->MsgHTML($htmlBody, PATH_EXT_LOGINPAGE);
		$mailer->AltBody	= render($plainTmpl, $data);

			// Add "to" (recipient) address
		$mailer->AddAddress($person->getEmail(), $person->getFullName());

		try {
			$sendStatus	= $mailer->Send();
		} catch(phpmailerException $e) {
			Todoyu::log($e->getMessage(), TodoyuLogger::LEVEL_ERROR);
		} catch(Exception $e) {
			Todoyu::log($e->getMessage(), TodoyuLogger::LEVEL_ERROR);
		}

		return $sendStatus;
	}
}

?>