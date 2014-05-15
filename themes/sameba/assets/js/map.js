(function($){
	ymaps.ready(init);
	var myMap;

	function init(){
		var $places = $('.places a');

		myMap = new ymaps.Map ("map", {
			center: [57.182631, 65.558412],
			zoom: 13,
			controls: ['typeSelector']
		});

		var zoomControl = new ymaps.control.ZoomControl({
			options: {
				float: 'none',
				position: { top: 75, right: 5 }
			}
		});

		myMap.controls.add(zoomControl);

		// var icon = jQuery('<img src="" alt="" >').attr('src', );
		// console.log(icon);
		var circleLayout = ymaps.templateLayoutFactory.createClass('<div class="placemark_layout_container"><div class="circle_layout"><img src="'+jQuery('.contacts').data('point-img')+'" alt=""></div></div>');

		var coords = [],
		myCollection = new ymaps.GeoObjectCollection({}, {
			iconLayout: circleLayout,
			iconImageSize: [37, 42]
		});

		//set up coords from html list
		$places.each(function(){
			coords.push($(this).data('coords'));
		});

		myCollection.events.add("click", function (e) {
			myMap.panTo(e.get('coords'), {
				flying: 1, 
				delay: 200,
				checkZoomRange: 1
			});
		});

		var startPlace = $('.places').data('begin');
		var beginCoord = $('.places a').eq(0).data('coords');

		if(startPlace){
			$item = $('a[data-id='+startPlace+']');
			beginCoord = $item.data('coords');

			$item.closest('.places').find('.active').removeClass('active').find('span').remove();
			$item.addClass('active').append('<span class="arr"></span>');
		}
		
		myMap.setCenter(beginCoord);

		$('.places a').on('click', function(e){
			e.preventDefault();

			var $this = $(this);
			var coords = $this.data('coords');

			$this.closest('.places').find('.active').removeClass('active').find('span').remove();
			$this.addClass('active').append('<span class="arr"></span>');

			myMap.panTo(coords, {
				flying: false, 
				delay: 200,
				checkZoomRange: 1
			});
		});
		var info = jQuery('.contacts .info');
		
		var init = function init(){
			var top_offset = info.outerHeight() + info.offset().top + 50;
			jQuery('.places').css({top: top_offset});
		};
		init();
		// или myCollection = new ymaps.GeoObjectArray(...);

		//resize
		jQuery(window).resize(function(){
			init();
		});

		for (var i = 0; i < coords.length; i++) {
			myCollection.add(new ymaps.Placemark(coords[i]));
		}

		myMap.geoObjects.add(myCollection);

		if ($(window).width() < 768 && myMap.behaviors.isEnabled('drag')) {
			myMap.behaviors.disable('drag');
		}else if($(window).width() >= 768 && !myMap.behaviors.isEnabled('drag'))
			myMap.behaviors.enable('drag');

		$(window).resize(function(){
			if ($(window).width() < 768 && myMap.behaviors.isEnabled('drag')) {
				myMap.behaviors.disable('drag');
			}else if($(window).width() >= 768 && !myMap.behaviors.isEnabled('drag'))
				myMap.behaviors.enable('drag');
		});
	}
})(jQuery);