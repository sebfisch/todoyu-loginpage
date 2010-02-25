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
		
//		Effect.SlideUp('news-local', {
//			'duration': 0.3
//		});
		$('news-local').hide();
		Effect.SlideDown('news-live', {
			'duration': 0.3
		});
		
		//alert("newsLoaded");
	}
	
};
