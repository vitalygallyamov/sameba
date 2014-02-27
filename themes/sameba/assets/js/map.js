(function($){
	ymaps.ready(init);
	var myMap;

	function init(){
		var $places = $('.places a');

		myMap = new ymaps.Map ("map", {
			center: [57.182631, 65.558412],
			zoom: 13,
			behaviors: ['default', 'scrollZoom']
		});

		myMap.controls.add('zoomControl', { top: 75, right: 5 });

		var coords = [],
		myCollection = new ymaps.GeoObjectCollection({}, {
			iconImageHref: jQuery('.contacts').data('point-img'),
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

		var beginCoord = $('.places a').eq(0).data('coords');
		myMap.setCenter(beginCoord);

		$('.places a').on('click', function(){
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
		// или myCollection = new ymaps.GeoObjectArray(...);

		for (var i = 0; i < coords.length; i++) {
			myCollection.add(new ymaps.Placemark(coords[i]));
		}

		myMap.geoObjects.add(myCollection);
	}
})(jQuery);