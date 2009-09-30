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
	
	
	fieldUsername: 'login-field-username',
	fieldPassword: 'login-field-password',
	fieldRemain: 'login-field-loginremain',
	elStatus: 'formElement-login-field-status-inputbox',



	init: function() {
		this.observeForm();
		this.focusField();
	},
	
	focusField: function() {
		if( $F(this.fieldUsername) === '' ) {
			$(this.fieldUsername).focus();
		} else {
			$(this.fieldPassword).focus();
		}
	},
	
	observeForm: function() {
		$('login-form').observe('submit', this.onFormSubmit.bind(this));
	},
	
	onFormSubmit: function(event) {
		event.stop();
		
		if( this.checkFieldsNotEmpty() ) {
			this.displayVerifying();
			
			var url		= Todoyu.getUrl('loginpage', 'ext');
			var	options	= {
				'parameters': {
					'cmd': 'login',
					'username': $F(this.fieldUsername),
					'passhash': this.getHashedPassword(),
					'remain': this.isRemainLoginChecked()
				},
				'onComplete': this.onLoginRequest.bind(this)
			}
			
			Todoyu.send(url, options);
		}
	},
	
	
	getHashedPassword: function() {
		return hex_md5($F(this.fieldPassword));
	},
	
	isRemainLoginChecked: function() {
		return $(this.fieldRemain).checked === true;
	},
	
	
	
	checkFieldsNotEmpty: function() {
		if( $F(this.fieldUsername) === '' ) {
			alert('[LLL:Please enter your username]');
			$(this.fieldUsername).focus();
			return false;
		}
		if( $F(this.fieldPassword) === '' ) {
			alert('[LLL:Please enter your password]');
			$(this.fieldPassword).focus();
			return false;
		}
		
		return true;
	},
	
	onLoginRequest: function(response){
		var status	= response.responseJSON;
		
		if( status.success ) {
			this.displayLoginSuccess();
			location.href = status.redirect;	
		} else {
			this.displayLoginError(status.message);
			$(this.fieldPassword).select();
		}
	},
	
	displayVerifying: function() {
		$(this.elStatus).update('Verifying username/password').insert({'top':'<img src="core/assets/img/ajax-loader.gif">'});
	},
	
	displayLoginSuccess: function() {
		$(this.elStatus).update('Login ok');
	},
	
	displayLoginError: function(message) {
		$(this.elStatus).update(message);
	},


	/**
	 *	Log out
	 */
	logout: function() {
		location.href = '?ext=loginpage&cmd=logout';
	}

};