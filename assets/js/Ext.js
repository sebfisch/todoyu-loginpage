/****************************************************************************
* todoyu is published under the BSD License:
* http://www.opensource.org/licenses/bsd-license.php
*
* Copyright (c) 2010, snowflake productions GmbH, Switzerland
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
 * @module	Loginpage
 */

/**
 * Loginpage main object
 *
 * @class		loginpage
 * @namespace	Todoyu.Ext
 */
Todoyu.Ext.loginpage = {

	PanelWidget: {},

	Headlet: {},

	fieldUsername:	'login-field-username',

	fieldPassword:	'login-field-password',

	fieldRemain:	'login-field-loginremain',

	elStatus:		'formElement-login-field-status-inputbox',

	forgotPasswordElStatus:		'formElement-forgotpassword-field-status-inputbox',

	popup: null,



	/**
	 * Init loginpage ext javaScript
	 */
	init: function() {
		if( Todoyu.getArea() === 'loginpage' ) {
			this.observeForm();
			this.observePasswordField();
			this.focusField();
			this.disableToggleSave();
		}

		this.registerHooks();

//		if( Todoyu.exists('headlets') ) {
//			this.Relogin.init();
//		}
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
	 * Override panelwidget save function, to prevent access denied message
	 * because the user isn't logged in
	 */
	disableToggleSave: function() {
		Todoyu.PanelWidget.saveToggleStatus = Prototype.emptyFunction;
	},



	/**
	 * Install form onSubmit-observer
	 */
	observeForm: function() {
		$('login-form').observe('submit', this.onFormSubmit.bindAsEventListener(this));
	},



	/**
	 * Observe the password field for changes
	 */
	observePasswordField: function() {
		$('login-field-password').observe('keyup', this.onPasswordEnter.bind(this));
		$('login-field-password').observe('change', this.onPasswordEnter.bind(this));
	},



	/**
	 * register hooks
	 */
	registerHooks: function()	{
		Todoyu.Hook.add('core.notloggedin', this.onLoggedOutAuto.bind(this));
	},



	/**
	 * When password field input changes, generate hashed password, if form is submitted normally (no AJAX)
	 *
	 * @param	{Event}		event
	 */
	onPasswordEnter: function(event) {
		$('login-field-passhash').value = this.getHashedPassword();
	},



	/**
	 * onSubmit event handler: stop event and evoke form submission
	 *
	 * @param	{Event}		event
	 * @return	{Boolean}
	 */
	onFormSubmit: function(event) {
		event.stop();

		this.submitForm();

		return false;
	},



	/**
	 * Evoke login form submission as Todoyu post-request, params taken from form fields
	 */
	submitForm: function() {
		if( this.checkFieldsNotEmpty() ) {
			this.onLoginRequest();

			var url		= Todoyu.getUrl('loginpage', 'ext');
			var	options	= {
				'parameters': {
					'action':	'login',
					'username':	$F(this.fieldUsername),
					'passhash':	this.getHashedPassword(),
					'remain':	this.isRemainLoginChecked()
				},
				'onComplete':	this.onLoginResponse.bind(this)
			};

			Todoyu.send(url, options);
		}
	},



	/**
	 * Get MD5 hash of entered password
	 *
	 * @return	String
	 */
	getHashedPassword: function() {
		return hex_md5($F(this.fieldPassword));
	},



	/**
	 * Check whether field 'remember me on this computer' is checked
	 *
	 * @return	{Boolean}
	 */
	isRemainLoginChecked: function() {
		return $(this.fieldRemain).checked === true;
	},



	/**
	 * Check whether all (required) fields of the login form are filled (username, password), if not filled: focus empty field
	 *
	 * @return	{Boolean}
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
	 * Handle login request: disable login form fields, display verification progress message
	 */
	onLoginRequest: function() {
		this.toggleLoginFields(false);
		this.displayVerifying();
	},



	/**
	 * Enable / disable fields of login form
	 *
	 * @param	{Boolean}	active
	 */
	toggleLoginFields: function(active) {
		var opacity, func;

		if( active ) {
			opacity	= 1.0;
			func	= 'enable';
		} else {
			opacity	= 0.3;
			func	= 'disable';
		}

		$(this.fieldUsername)[func]();
		$(this.fieldPassword)[func]();
		$(this.fieldUsername).up('div').setOpacity(opacity);
		$(this.fieldPassword).up('div').setOpacity(opacity);
		$('formElement-login-field-loginremain').setOpacity(opacity);
		$('formElement-login-field-forgotpassword').setOpacity(opacity);
		$('login-field-submit').setOpacity(opacity);
	},



	/**
	 * Handle login request, evoked from onComplete of login form submission
	 *
	 * @param	{Object}	response
	 */
	onLoginResponse: function(response){
		var status	= response.responseJSON;

		if( status.success ) {
			this.displayLoginSuccess();
//			console.log('reload');
			location.reload();
		} else {
			this.toggleLoginFields(true);
			this.displayLoginError(status.message);
			$(this.fieldPassword).select();
		}
	},



	/**
	 * Display status message when verifying received login data
	 */
	displayVerifying: function() {
		$(this.elStatus).update('<img src="core/assets/img/ajax-loader.png" /> [LLL:loginpage.form.status.verifyingLoginData]');
		$(this.elStatus).addClassName('notification');
	},



	/**
	 * Display status message of successful login
	 */
	displayLoginSuccess: function() {
		$(this.elStatus).update('<img src="core/assets/img/ajax-loader.png" /> &nbsp; <span class="icon"></span> &nbsp; [LLL:loginpage.form.status.loginOk]');
		$(this.elStatus).removeClassName('failure');
		$(this.elStatus).addClassName('success');
	},



	/**
	 * Display status message of login error
	 *
	 * @param	{String}	message
	 */
	displayLoginError: function(message) {
		$(this.elStatus).update('<span class="icon"></span>' + message);
		$(this.elStatus).addClassName('failure');
	},



	/**
	 * Display status message when verifying received login data
	 */
	displayForgotPasswordVerifying: function() {
		$(this.forgotPasswordElStatus).update('<img src="core/assets/img/ajax-loader.png" /> [LLL:loginpage.form.status.verifyingLoginData]');
		$(this.forgotPasswordElStatus).addClassName('notification');
	},



	/**
	 * Display status message of successful login
	 */
	displayForgotPasswordSuccess: function() {
		$(this.elStatus).update('<span class="icon"></span> &nbsp; [LLL:loginpage.forgotpassword.form.field.notification.success]');
		$(this.elStatus).addClassName('notification');
		$(this.elStatus).removeClassName('failure');
		$(this.elStatus).addClassName('success');
	},



	/**
	 * Display status message of forgot password error
	 * 
	 * @param	{String}	message
	 */
	displayForgotPasswordError: function(message)	{
		$(this.forgotPasswordElStatus).update('<span class="icon"></span>' + message);
		$(this.forgotPasswordElStatus).addClassName('notification');
		$(this.forgotPasswordElStatus).addClassName('failure');
	},



	/**
	 * Log out current person
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
	 * @param	{Ajax.Response}		response
	 */
	onLoggedOut: function(response) {
			// Remove all parameters from url and reload
		location.search = '';
	},



	/**
	 * 
	 */
	loadForgotPasswordForm: function()	{
		var url		= Todoyu.getUrl('loginpage', 'ext');
		var options	= {
			'parameters': {
				'action':	'loadForgotPasswordForm',
				'username':	$F(this.fieldUsername)
			},
			'onComplete':	this.onForgotPasswordFormLoaded.bind(this)
		};

		Todoyu.send(url, options);
	},



	/**
	 * 
	 * @param response
	 */
	onForgotPasswordFormLoaded: function(response)	{
		$('login-form').replace(response.responseText);
	},



	/**
	 * 
	 */
	submitForgotPasswordForm: function(form)	{
		this.displayForgotPasswordVerifying();
		
		$(form).request({
			'parameters': {
				'action':	'forgotPassword'
			},
			onComplete: this.onForgotPasswordResponse.bind(this)
		});
	},



	/**
	 *
	 * @param response
	 */
	onForgotPasswordResponse: function(response)	{
		var status	= response.responseJSON;

		if(response.hasTodoyuError())	{
			$('forgotpassword-form').replace(status.form);

			if(status.message != null) this.displayForgotPasswordError(status.message);
		} else {
			$('forgotpassword-form').replace(status.form);

			this.displayForgotPasswordSuccess();
			this.init();
		}
	},



	/**
	 * 
	 */
	onLoggedOutAuto: function()	{
		var url		= Todoyu.getUrl('loginpage', 'ext');

		var options = {
			'parameters': {
					'action': 'reloginPopup'
			},
			'onComplete': this.onLoggedOutFormLoaded.bind(this)
		};

		var idPopup	= 'reLoginPopup';
		var width	= 700;

		this.popup = Todoyu.Popup.openWindow(idPopup, '[LLL:loginpage.loginexpired.title]', width, url, options);
	},



	/**
	 * 
	 */
	onLoggedOutFormLoaded: function()	{
		$('login-form').observe('submit', this.onReLoginFormSubmit.bindAsEventListener(this));
		this.observePasswordField();
		this.focusField();
		this.disableToggleSave();
	},



	onReLoginFormSubmit: function()	{
		if( this.checkFieldsNotEmpty() ) {
			this.onLoginRequest();

			var url		= Todoyu.getUrl('loginpage', 'ext');
			var	options	= {
				'parameters': {
					'action':	'login',
					'username':	$F(this.fieldUsername),
					'passhash':	this.getHashedPassword(),
					'remain':	this.isRemainLoginChecked()
				},
				'onComplete':	this.onReLoginResponse.bind(this)
			};

			Todoyu.send(url, options);
		}
	},



	onReLoginResponse: function(response)	{
		var status	= response.responseJSON;

		if( status.success ) {
			this.popup.close();
		} else {
			this.toggleLoginFields(true);
			this.displayLoginError(status.message);
			$(this.fieldPassword).select();
		}
	}
};