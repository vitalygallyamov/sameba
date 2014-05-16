(function ( $ ) {

	var main_slides = $('.main-page-nav .item');

	//hover
	main_slides.hover(function(){
		var $this = $(this);
		$this.find('.info').addClass('hover');
	},function (){
		var $this = $(this);
		$this.find('.info').removeClass('hover');
	});

	//mouse click
	main_slides.on('click', function(){
		var $this = $(this),
			index = main_slides.index($this),
			$fronts = jQuery('.front-block');

		if(timeId) clearTimeout(timeId);

		$('.main-page-nav .info.active').removeClass('active');
		$this.find('.info').addClass('active');

		$fronts.filter(':visible').hide();
		$fronts.eq(index).show();

		if(players.length){
			for(p in players){
				if(players[p].ready)
					players[p].video.pauseVideo();
			}
			$fronts.find('.video').hide();
			$fronts.find('.play').show();
		}
	});

	//change on interval
	main_slides.on('change.slide', function(){
		var $this = $(this),
			index = main_slides.index($this),
			$fronts = jQuery('.front-block');

		$('.main-page-nav .info.active').removeClass('active');
		$this.find('.info').addClass('active');

		$fronts.filter(':visible').hide();
		$fronts.eq(index).show();

		if(players.length){
			for(p in players){
				if(players[p].ready)
					players[p].video.pauseVideo();
			}
			$fronts.find('.video').hide();
			$fronts.find('.play').show();
		}
	});

	//play video button
	jQuery('.play').on('click', function(){
		var $this = jQuery(this),
			id = $this.data('videoid'),
			$front = $this.closest('.front-block');

		if(players.length){
			for(i in players){
				if(players[i].id == id){
					$front.find('.video').show();
					$front.find('.play').hide();
					
					if(players[i].ready)
						players[i].video.playVideo();
				}
			}
		}
	});

	var playSlider = function playSlider(){

		main_slides.each(function(){
			var $this = jQuery(this);

			if($this.find('.active').length){
				var $active = $this.find('.active'),
					$next = $this.next();
				$active.removeClass('active');

				if($next.length) $next.trigger('change.slide');
				else main_slides.eq(0).trigger('change.slide');

				return false;
			}
		});
	};

	var timeId = setInterval(playSlider, 8000);

})(jQuery);

//youtube video
var players = [];

var changePlayerHeight = function changePlayerHeight(){
	if(jQuery(window).width() > 768){
		var navH = jQuery('.main-page-nav').outerHeight(),
			wH = jQuery(window).height();

		jQuery('.front-video iframe').height(wH - navH);
	}else{
		jQuery('.front-video iframe').css({height: '500px'});
	}
};

function onYouTubeIframeAPIReady() {

	jQuery(window).resize(function(){
		changePlayerHeight();
	});

	jQuery('.play').each(function(){
		var $this = jQuery(this),
			id = $this.data('id'),
			videoid = $this.data('videoid'),
			dH = jQuery(document).height();

		players.push({id: videoid, video: new YT.Player('video-' + videoid, {
				videoId: videoid,
				playerVars: {
					rel: 0
				},
				events: {
					'onReady': onPlayerReady
				}
			}),
			ready: false
		});
	});
}

function onPlayerReady(event) {
	var data = event.target.getVideoData();

	changePlayerHeight();
	for(i in players){
		if(players[i].id == data.video_id){
			players[i].ready = true;
		}
	}
}