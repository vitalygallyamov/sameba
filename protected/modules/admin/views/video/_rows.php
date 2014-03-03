	<style>
		.media-object{width: 200px;}
		.loader{display: none;}
	</style>
	<fieldset>
		<legend>Видео</legend>
		<?php echo $form->textFieldControlGroup($model, 'url', array('class' => 'span8 url', 'label' => 'Ссылка'));?>
		<div class="loader"><img src="<?=$this->getAssetsUrl()."/img/ajax-loader.gif"?>" alt=""></div>
		<div id="video"></div>
	</fieldset>
	<?php echo $form->textFieldControlGroup($model,'name',array('class'=>'span8 video-title','maxlength'=>255)); ?>

	<?php echo $form->hiddenField($model,'video_id',array('class'=>'vid')); ?>
	<?php echo $form->hiddenField($model,'video_image',array('class'=>'preview')); ?>

	<?php echo $form->textAreaControlGroup($model,'desc',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->dropDownListControlGroup($model, 'on_main', array(0 => 'Нет', 1 => 'Да'), array('class'=>'span8', 'displaySize'=>1)); ?>

	<?php echo $form->dropDownListControlGroup($model, 'status', Video::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>
	<script>
	var timeID = null,
		$url = jQuery('.url');

	$url.on('keyup', function(){
		var $this = $(this),
			url = $this.val(),
			regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/,
			match = url.match(regExp);

		if (match && match[2].length == 11){
			var vid = match[2];

			if(timeID) clearTimeout(timeID);

			jQuery('.vid').val(vid);
			jQuery('.loader').show();

			timeID = setTimeout(function(){
				
				jQuery
					.ajax({
						url: '<?=$this->createUrl("getVideoInfo")?>',
						data: {vid: vid},
						type: 'GET',
						dataType: 'html',
						success: function(data){
							$video = jQuery('#video');
							jQuery('.loader').hide();
							$video.html(data);
							var preview = $video.find('.media-object'),
								title = $video.find('.media-heading');
							jQuery('.preview').val(preview.attr('src'));
							//set title
							if(jQuery('.video-title').val() == ''){
								jQuery('.video-title').val(title.text());
							}
						},
						error: function(){
							jQuery('.loader').hide();
						}
					});
			}, 300);
		}else{
		    //error
		}
	});

	if($url.val() != '') $url.keyup();
	</script>