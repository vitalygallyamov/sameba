(function ( $ ) {
	//categories hover
	var timeShow = null,
		windowH = jQuery(window).width();

	jQuery(window).resize(function(){
		if(jQuery(window).width() > 768 && jQuery('.scroll-pane-arrows').length){
			$('.scroll-pane-arrows').jScrollPane({
				showArrows: true,
				horizontalGutter: 10
			});
		}
	});

	$('.categories .root').hover(function(){
		var $this = $(this);

		if(windowH > 768 && $this.hasClass('sub')){
			var sub = $this.find('.sub-categories');
			sub.css({
				left: -1 * sub.width() - 20
			});

			if(timeShow) clearTimeout(timeShow);

			sub.show();
		}
	}, function(){

		var $this = $(this);

		if(windowH > 768 && $this.hasClass('sub')){
			console.log('out');
			var sub = $this.find('.sub-categories');

			if(timeShow) clearTimeout(timeShow);

			timeShow = setTimeout(function(){
				sub.hide();
			}, 1000);
		}
	});

	$('.sub-categories').hover(function(){
		if(windowH > 768) clearTimeout(timeShow);
	}, function(){
		if(windowH > 768) $(this).hide();
	});

	//catalog custom scroll
	jQuery(window).resize();
	
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
	if(jQuery('.top-menu').not('.no').length){
		jQuery('.top-menu a').on('click', function(e){
			e.preventDefault();

			var $this = jQuery(this),
				all = jQuery('.top-menu li'),
				filter = jQuery('.filter');

			if(!$this.parent().hasClass('active'))
				all.filter('.active').removeClass('active');

			$this.parent().addClass('active');

			var index = all.index($this.parent());
			filter.find('input:eq('+index+')').attr('checked', 'checked');

			jQuery.ajax({
				url: filter.attr('action'),
				data: filter.serialize(),
				success: function(data){
					jQuery('.catalog-items').html(data);
				}
			});
		});
	}
	
})(jQuery);