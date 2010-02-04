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
 * Ext: loginpage
 */

Todoyu.Ext.loginpage = {

	PanelWidget: {},

	Headlet: {},


	fieldUsername:	'login-field-username',

	fieldPassword:	'login-field-password',

	fieldRemain:	'login-field-loginremain',

	elStatus:		'formElement-login-field-status-inputbox',



	/**
	 * Init loginpage ext javaScript
	 */
	init: function() {
		this.observeForm();
		this.observePasswordField();
		this.focusField();
	},
	
	
	
	/**
	 * Focus username input if empty, otherwise: focus password input
	 */
	focusField: function() {
		if( $F(this.fieldUsername) === '' ) {
			$(this.fieldUsername).focus();
		} else {
			$(this.fieldPassword).focus();
		}
	},



	/**
	 * Install form onSubmit-observer
	 */
	observeForm: function() {
		$('login-form').observe('submit', this.onFormSubmit.bind(this));
	},
	
	
	
	/**
	 * Observe the password field for changes
	 */
	observePasswordField: function() {
		$('login-field-password').observe('keyup', this.onPasswordEnter.bind(this));
		$('login-field-password').observe('change', this.onPasswordEnter.bind(this));
	},
	
	
	
	/**
	 * When passwordfield changes, generate hashed password, if form is submitted normaly (no ajax)
	 * 
	 * @param	Event		event
	 */
	onPasswordEnter: function(event) {
		$('login-field-passhash').value = this.getHashedPassword();
	},



	/**
	 * onSubmit event handler: stop event and evoke form submission
	 */
	onFormSubmit: function(event) {
		event.stop();

		this.submitForm();
	},



	/**
	 * Evoke login form submission as Todoyu post-request, params taken from form fields
	 */
	submitForm: function() {
		if( this.checkFieldsNotEmpty() ) {
			this.displayVerifying();

			var url		= Todoyu.getUrl('loginpage', 'ext');
			var	options	= {
				'parameters': {
					'action':	'login',
					'username':	$F(this.fieldUsername),
					'passhash':	this.getHashedPassword(),
					'remain':	this.isRemainLoginChecked()
				},
				'onComplete':	this.onLoginRequested.bind(this)
			}

			Todoyu.send(url, options);
		}
	},



	/**
	 * Get MD5 hash of entered password
	 *
	 *	@return	String
	 */
	getHashedPassword: function() {
		return hex_md5($F(this.fieldPassword));
	},



	/**
	 * Check whether field 'remember me on this computer' is checked
	 *
	 *	@return	Boolean
	 */
	isRemainLoginChecked: function() {
		return $(this.fieldRemain).checked === true;
	},



	/**
	 * Check whether all (required) fields of the login form are filled (username, password), if not filled: focus empty field
	 *
	 *	@return	Boolean
	 */
	checkFieldsNotEmpty: function() {
		if( $F(this.fieldUsername) === '' ) {
			alert('[LLL:loginpage.error.enterUsername]');
			$(this.fieldUsername).focus();
			return false;
		}
		if( $F(this.fieldPassword) === '' ) {
			alert('[LLL:loginpage.error.enterPassword]');
			$(this.fieldPassword).focus();
			return false;
		}

		return true;
	},



	/**
	 * Handle login request, evoked from oncomplete of login form submission
	 *
	 *	@param	Object	response
	 */
	onLoginRequested: function(response){
		var status	= response.responseJSON;

		if( status.success ) {
			this.displayLoginSuccess();
			location.href = status.redirect;
			//Todoyu.log(status.redirect);
		} else {
			this.displayLoginError(status.message);
			$(this.fieldPassword).select();
		}
	},



	/**
	 * Display status message when verifying received login data
	 */
	displayVerifying: function() {
		$(this.elStatus).update(
			'&nbsp; [LLL:loginpage.form.status.verifyingLoginData]'
		).insert({
			'top':	'<img src="core/assets/img/ajax-loader.png"/>'
		});
		$(this.elStatus).addClassName('notification')
	},



	/**
	 * Display status message of successful login
	 */
	displayLoginSuccess: function() {
		$(this.elStatus).update(
			'[LLL:loginpage.form.status.loginOk]'
		).insert({
			'top':	'<img class="icon" />'
		});
		$(this.elStatus).removeClassName('failure');
		$(this.elStatus).addClassName('success');
	},



	/**
	 * Display status message of login error
	 */
	displayLoginError: function(message) {
		$(this.elStatus).update(
			message
		).insert({
			'top':	'<img class="icon" />'
		});
		$(this.elStatus).addClassName('failure');
	},



	/**
	 *	Log out
	 */
	logout: function() {
		var url		= Todoyu.getUrl('loginpage', 'ext');
		var options	= {
			'parameters': {
				'action':	'logout'
			},
			'onComplete':	this.onLoggedOut.bind(this)
		};

		Todoyu.send(url, options);
	},



	/**
	 * Handle logging out: clears all params and reloads loginpage
	 *
	 *	@param	Object	response
	 */
	onLoggedOut: function(response) {
			// Remove all parameters from url and reload
		location.search = '';
	}

};