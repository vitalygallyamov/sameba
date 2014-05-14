(function ( $ ) {
	//categories hover
	var timeShow = null,
		windowW = $(window).width();

	var changeNavBar = function changeNavBar(){
		if(windowW > 768){
			$('.nav-categories').removeClass('navbar-default').find('.categories').css({height: 'auto'});
		}else 
		$('.nav-categories').addClass('navbar-default');
	};

	changeNavBar();

	$(window).resize(function(){
		windowW = $(window).width();
		changeNavBar();

		if(windowW > 768) $('.nav-categories').removeClass('navbar-default');
		else $('.nav-categories').addClass('navbar-default');

		if(windowW > 768 && $('.scroll-pane-arrows').length){
			$('.scroll-pane-arrows').jScrollPane({
				showArrows: true,
				horizontalGutter: 10
			});
		}
	});

	$('.categories .root').hover(function(){
		var $this = $(this);

		if(windowW > 768 && $this.hasClass('sub')){
			var sub = $this.find('.sub-categories');
			sub.css({
				left: -1 * sub.width() - 20
			});

			if(timeShow) clearTimeout(timeShow);

			sub.show();
		}
	}, function(){

		var $this = $(this);

		if(windowW > 768 && $this.hasClass('sub')){
			console.log('out');
			var sub = $this.find('.sub-categories');

			if(timeShow) clearTimeout(timeShow);

			timeShow = setTimeout(function(){
				sub.hide();
			}, 1000);
		}
	});

	$('.sub-categories').hover(function(){
		if(windowW > 768) clearTimeout(timeShow);
	}, function(){
		if(windowW > 768) $(this).hide();
	});

	//catalog custom scroll
	$(window).resize();
	
	//bind fancybox
	if($('.fancybox').length){
		$('.fancybox').fancybox({
			openEffect  : 'none',
			closeEffect : 'none',
			nextEffect  : 'none',
			prevEffect  : 'none',
			padding     : 0,
			// margin      : 50,
		});
	}

	//filter
	if($('.top-menu').not('.no').length){
		$('.top-menu a').on('click', function(e){
			e.preventDefault();

			var $this = $(this),
				all = $('.top-menu li'),
				filter = $('.filter');

			if(!$this.parent().hasClass('active'))
				all.filter('.active').removeClass('active');

			$this.parent().addClass('active');

			var index = all.index($this.parent());
			filter.find('input:eq('+index+')').attr('checked', 'checked');

			$.ajax({
				url: filter.attr('action'),
				data: filter.serialize(),
				success: function(data){
					$('.catalog-items').html(data);
				}
			});
		});
	}
	
})(jQuery);