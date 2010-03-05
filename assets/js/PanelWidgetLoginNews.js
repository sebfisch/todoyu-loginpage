Todoyu.Ext.loginpage.PanelWidget.LoginNews = {
	
	newsLoaded: function() {
		var live	= $('news-live');
		var iframe	= $('loginnews-iframe');
		
		live.show();
				
		var height = $(iframe.contentDocument.body).scrollHeight;
		
		iframe.setStyle({
			'height': height + 30 + 'px'
		});
		
		live.hide();
		
		$('news-local').hide();
		Effect.SlideDown('news-live', {
			'duration': 0.3
		});
	}
	
};
