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

	//
	main_slides.on('click', function(){
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
/*	//init vars
	var time = 5000,
		timeId = null,
		curSlide = -1,
		$doc = $(document),
		$wrap = $('.slider-wrap'),
		$navBlock = $('.slider-nav'),
		$bar = $('.slider-progress'),
		$slides = $('.slider-images img'),
		$sliderPager = $('.slider-pager'),
		$slidesInfo = $('.slides-info');

	//init slider-pager
	var items = new Array($slides.length + 1);
	$sliderPager.find('ul').html(items.join('<li></li>'));

	//vertical align slider-pager block
	$sliderPager.css({
		marginTop: ($slidesInfo.height() - $sliderPager.height()) / 2
	});

	//function change slider
	var changeSlider = function changeSlider(){

		if(curSlide >= $slides.length) curSlide = 0;

		var $curImage = $slides.eq(curSlide);

		var newImg = new Image();

		newImg.onload = function(){
			$slides.parent().css({
				top: ($wrap.height() - $curImage.height()) / 2,
				left: ($wrap.width() - $curImage.width()) / 2
			});

			$slides.hide();
			$curImage.show();

			$slides.eq(curSlide).css({width: 'auto'}).animate({
				width: '+=50px'
			}, time);
			
			$sliderPager.find('li.active').removeClass('active');
			$sliderPager.find('li:eq('+curSlide+')').addClass('active');

			//show info slide
			$slidesInfo.find('.info').hide();
			$slidesInfo.find('.info:eq('+curSlide+')').show();
		};

		newImg.src = $curImage.attr('src');
	};

	var start = function start(){
		$bar.width(0);
		curSlide++;
		changeSlider();
		$bar.animate({width: '+=480'}, time, function(){
			timeId = setTimeout(start, 200);
		});
	};

	var next = function next(){
		$bar.width(0);
		changeSlider();
		$bar.animate({width: '+=480'}, time, function(){
			timeId = setTimeout(start, 200);
		});
	};

	//button click top bottom
	$('.slider-pager .arrow').on('click', function(e){
		e.preventDefault();

		$this = $(this);

		clearTimeout(timeId);
		$bar.stop(true, false);

		//top
		if($this.hasClass('top')){
			curSlide--;
			if(curSlide < 0) curSlide = $slides.length - 1;
		}

		//bottom
		if($this.hasClass('bottom')){
			curSlide++;
			if(curSlide >= $slides.length) curSlide = 0;
		}

		timeId = setTimeout(next, 200);

	});

	start();

	//vertical align .slider-nav block
	$navBlock.css({marginTop: ($doc.height() - $navBlock.height()) / 2});*/

})(jQuery);

//youtube video
var players = [];

function onYouTubeIframeAPIReady() {
	// console.log('as');

	jQuery('.play').each(function(){
		var $this = jQuery(this),
			id = $this.data('id'),
			videoid = $this.data('videoid'),
			dH = jQuery(document).height();

		var main_page_w = jQuery('.main-page').width(),
			navH = jQuery('.main-page-nav').height();

		players.push({id: videoid, video: new YT.Player('video-' + videoid, {
				height: dH - navH,
				width: main_page_w,
				videoId: videoid,
				events: {
					'onReady': onPlayerReady
					// 'onStateChange': onPlayerStateChange
				}
			}),
			ready: false
		});
		/*setTimeout(function(){
			$('.front-block .video').css('display','none');
		}, 1000);*/
		// $('.front-block .video').css('display','none');
	});
}

function onPlayerReady(event) {
	var data = event.target.getVideoData();
		// code = event.target.getVideoEmbedCode();

	for(i in players){
		if(players[i].id == data.video_id)
			players[i].ready = true;
	}

	//event.target.playVideo();
}