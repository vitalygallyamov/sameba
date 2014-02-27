<?php
$cs = Yii::app()->clientScript;

$cs->registerScriptFile('http://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU', CClientScript::POS_HEAD);
?>
	<?php echo $form->textFieldControlGroup($model,'name',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->hiddenField($model,'coords',array('class'=>'coords')); ?>
	<div class="control-group">
		<label class="control-label required" for="Places_name">Адрес</label>
		<div class="controls">
			<?php echo TbHtml::textField('address','', array('class' => 'span8 address'));?><br>
			<?php echo TbHtml::button('Найти', array('class' => 'find'));?>
		</div>
	</div>
	<div class="control-group begin" data-coords="[<?=($model->coords ? $model->coords : '')?>]">
		<label class="control-label required" for="Places_name">Карта (кликните по карте чтобы установить место магазина)</label>
		<div class="controls">
			<div id="map" class="span8" style="height: 500px;"></div>
		</div>
	</div>

<script type="text/javascript">
	ymaps.ready(init);
	var myMap;

	function init(){
		myMap = new ymaps.Map ("map", {
			center: [57.141965, 65.563562],
			zoom: 12,
			behaviors: ['default', 'scrollZoom']
		});

		//zoom
		myMap.controls.add(
			new ymaps.control.ZoomControl()
		);

		//click on map and set coords
		myMap.events.add('click', function (e) {
			var coords = e.get('coords');

			//clear
			clearMap();

			findAddress(coords);

			jQuery('.coords').val(coords.join(','));
		});

		//function clear all placemarks
		var clearMap = function clearMap(){
			myMap.geoObjects.each(function(e){
				myMap.geoObjects.remove(e);
			});
		};

		//find addres by click
		var findAddress = function findAddress(coords){
			var myPlacemark = new ymaps.Placemark(coords);
			myMap.geoObjects.add(myPlacemark);

			ymaps.geocode(coords, {
				results: 1
			}).then(function(res){
				var firstGeoObject = res.geoObjects.get(0);

				var text = firstGeoObject.properties.get('text');
				jQuery('.address').val(text.replace('Россия, Тюмень, ', ''));
			});
		};

		//if coords exists
		var begin = jQuery('.begin').data('coords');
		if(begin.length){
			findAddress(begin);
		}

		//find coords by address
		jQuery('.find').on('click', function(){
			var address = jQuery('.address').val();

			if(address.length){
				ymaps.geocode('Тюмень ' + address, {
					results: 1
				}).then(function(res){
					var firstGeoObject = res.geoObjects.get(0),
						coords = firstGeoObject.geometry.getCoordinates(),
						bounds = firstGeoObject.properties.get('boundedBy');

					jQuery('.coords').val(coords.join(','));

					//clear
					clearMap();

					myMap.geoObjects.add(firstGeoObject);
					myMap.setBounds(bounds, {
						checkZoomRange: true
					});
				});
			}	
		});
	}
</script>