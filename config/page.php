<?php

if( TodoyuAuth::isLoggedIn() ) {

	TodoyuFrontend::addSubmenuEntry('todoyu', 'logout', 'LLL:loginpage.submenu.logout', 'javascript:Todoyu.Ext.loginpage.logout()', 1000);
}

TodoyuHeadManager::addHeadlet('TodoyuHeadletLogout', 10);

?>