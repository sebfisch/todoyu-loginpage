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

	// Include mail library
require_once( PATH_LIB . '/php/phpmailer/class.phpmailer-lite.php' );

class TodoyuLoginpageMailer {



	/**
	 * @static
	 * @param	Integer	$idPerson
	 * @param	String	$password
	 * @return	Boolean
	 */
	public static function sendNewPasswordMail($idPerson, $password) {
		$person	= TodoyuContactPersonManager::getPerson($idPerson);

			// Set mail config
		$mail			= new PHPMailerLite(true);
		$mail->Mailer	= 'mail';
		$mail->CharSet	= 'utf-8';

			// Set "from" (sender) name and email address
		$fromName		= Todoyu::$CONFIG['SYSTEM']['name'];
		$fromAddress	= Todoyu::$CONFIG['SYSTEM']['email'];
		$mail->SetFrom($fromAddress, $fromName);

			// Set "replyTo", "subject"
		$mail->AddReplyTo($fromAddress, $fromName);
		$mail->Subject	= TodoyuLabelManager::getLabel('LLL:loginpage.ext.forgotpassword.mail.subject.newpassword');

		$data	= array(
			'newPassword'	=> $password,
			'loginlink'	=> TodoyuString::buildUrl(array(), '', true)
		);

			// Add message body as HTML and plain text
		$htmlTmpl	= 'ext/loginpage/view/forgotpassword-mailbodyhtml.tmpl';
		$htmlBody		= render($htmlTmpl, $data);


		$plainTmpl	= 'ext/loginpage/view/forgotpassword-mailbodyplain.tmpl';
		$mail->MsgHTML($htmlBody, PATH_EXT_LOGINPAGE);
		$mail->AltBody	= render($plainTmpl, $data);

			// Add "to" (recipient) address
		$mail->AddAddress($person->getEmail(), $person->getFullName());

		try {
			$sendStatus	= $mail->Send();
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

			// Set mail config
		$mail			= new PHPMailerLite(true);
		$mail->Mailer	= 'mail';
		$mail->CharSet	= 'utf-8';

			// Set "from" (sender) name and email address
		$fromName		= Todoyu::$CONFIG['SYSTEM']['name'];
		$fromAddress	= Todoyu::$CONFIG['SYSTEM']['email'];
		$mail->SetFrom($fromAddress, $fromName);

			// Set "replyTo", "subject"
		$mail->AddReplyTo($fromAddress, $fromName);
		$mail->Subject	= TodoyuLabelManager::getLabel('LLL:loginpage.ext.forgotpassword.mail.confirmation.title');

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
		$mail->MsgHTML($htmlBody, PATH_EXT_LOGINPAGE);
		$mail->AltBody	= render($plainTmpl, $data);

			// Add "to" (recipient) address
		$mail->AddAddress($person->getEmail(), $person->getFullName());

		try {
			$sendStatus	= $mail->Send();
		} catch(phpmailerException $e) {
			Todoyu::log($e->getMessage(), TodoyuLogger::LEVEL_ERROR);
		} catch(Exception $e) {
			Todoyu::log($e->getMessage(), TodoyuLogger::LEVEL_ERROR);
		}

		return $sendStatus;
	}
}

?>