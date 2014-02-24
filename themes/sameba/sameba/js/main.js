(function ( $ ) {
	//categories hover
	var timeShow = null;

	$('.categories .root').hover(function(){
		var $this = $(this);

		if($this.hasClass('sub')){
			var sub = $this.find('.sub-categories');
			sub.css({
				left: -1 * sub.width() - 20
			});

			if(timeShow) clearTimeout(timeShow);

			sub.show();
		}
	}, function(){

		var $this = $(this);

		if($this.hasClass('sub')){
			console.log('out');
			var sub = $this.find('.sub-categories');

			if(timeShow) clearTimeout(timeShow);

			timeShow = setTimeout(function(){
				sub.hide();
			}, 1000);
		}
	});

	$('.sub-categories').hover(function(){
		clearTimeout(timeShow);
	}, function(){
		$(this).hide();
	});

	//catalog custom scroll
	if(jQuery('.scroll-pane-arrows').length){
		$('.scroll-pane-arrows').jScrollPane({
			showArrows: true,
			horizontalGutter: 10
		});
	}
	
	//bind fancybox
	if(jQuery('.fancybox').length){
		jQuery('.fancybox').fancybox({
			openEffect  : 'none',
			closeEffect : 'none',
			nextEffect  : 'none',
			prevEffect  : 'none',
			padding     : 0,
			// margin      : 50,
		});
	}

	//filter
	if(jQuery('.top-menu').length){
		jQuery('.top-menu a').on('click', function(e){
			e.preventDefault();

			var $this = jQuery(this),
				all = jQuery('.top-menu li');

			if(!$this.parent().hasClass('active'))
				all.find('.active').removeClass('active');

			$this.parent().addClass('active');
		});
	}
	
})(jQuery);