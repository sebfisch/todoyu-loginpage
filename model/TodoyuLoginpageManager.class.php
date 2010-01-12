<?php



class TodoyuLoginpageManager {

	public static function addLoginscreenMainTabs() {
			// add menu entry
		TodoyuFrontend::addMenuEntry('login', 'LLL:loginpage.logintab.login', '?ext=loginpage&controller=ext', 10);
		TodoyuFrontend::addMenuEntry('help', 'LLL:loginpage.logintab.help', 'http://developer.todoyu.com', 20);
		TodoyuFrontend::addMenuEntry('blog', 'LLL:loginpage.logintab.blog', 'http://blog.snowflake.ch/de/blog-post/2009/01/31/todoyu-gewinnt-osbf-award/', 30);
		TodoyuFrontend::addMenuEntry('feedback', 'LLL:loginpage.logintab.feedback', 'http://feedback.todoyu.com/', 100);
	}

	public static function redirectToHome() {
		$url	= TodoyuDiv::buildUrl(array(), '', true);

		die($url);

		TodoyuHeader::location($url);
	}

}



?>