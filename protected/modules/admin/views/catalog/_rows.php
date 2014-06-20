	<?php echo $form->textFieldControlGroup($model,'name',array('class'=>'span8 translit','maxlength'=>255)); ?>
	<?php echo $form->textFieldControlGroup($model,'alias',array('class'=>'span8 alias','maxlength'=>255)); ?>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'gllr_gallery'); ?>
		<?php if ($model->galleryBehaviorGallery->getGallery() === null) {
			echo '<p class="help-block">Прежде чем загружать изображения, нужно сохранить текущее состояние</p>';
		} else {
			$this->widget('appext.imagesgallery.GalleryManager', array(
				'gallery' => $model->galleryBehaviorGallery->getGallery(),
				'controllerRoute' => '/admin/gallery',
			));
		} ?>
	</div>

	<?php //echo $form->textFieldControlGroup($model,'category_id',array('class'=>'span8')); ?>
	<?php echo $form->dropDownListControlGroup($model,'category_id',Categories::allCategories()); ?>

	<?php echo $form->textFieldControlGroup($model,'art_id',array('class'=>'span8','maxlength'=>255)); ?>

	<?php //echo $form->textFieldControlGroup($model,'price',array('class'=>'span8','maxlength'=>10)); ?>
	<?php echo $form->textFieldControlGroup($model,'price_desc',array('class'=>'span8','maxlength'=>255)); ?>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'wswg_desc'); ?>
		<?php $this->widget('appext.ckeditor.CKEditorWidget', array('model' => $model, 'attribute' => 'wswg_desc',
		)); ?>
		<?php echo $form->error($model, 'wswg_desc'); ?>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="Catalog_alias">Материалы</label>
		<div class="controls" data-url= "<?=Yii::app()->createUrl("admin/materials/addTag")?>">
			<?php
				$this->widget('yiiwheels.widgets.select2.WhSelect2', array(
				'model' => $model,
				'attribute' => 'materials',
				'asDropDownList' => false,
				'pluginOptions' => array(
					'tags' => Materials::getListForSelect(),
				    'width' => '40%',
				),
				'htmlOptions' => array(
				)));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="Catalog_alias">Где купить</label>
		<div class="controls" data-url="<?=Yii::app()->createUrl("admin/places/addTag")?>">
			<?php
				$this->widget('yiiwheels.widgets.select2.WhSelect2', array(
				'model' => $model,
				'attribute' => 'places',
				'asDropDownList' => false,
				'pluginOptions' => array(
					'tags' => Places::getListForSelect(),
				    'width' => '40%',
				),
				'htmlOptions' => array(

				)));
			?>
		</div>
	</div>

	<?php echo $form->textFieldControlGroup($model,'period',array('class'=>'span8')); ?>

	<?php echo $form->dropDownListControlGroup($model, 'on_main', array(0 => 'Нет', 1 => 'Да'), array('class'=>'span8', 'displaySize'=>1)); ?>

	<?php echo $form->dropDownListControlGroup($model, 'status', Catalog::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>

	<script>
		jQuery(document).ready(function(){
			var timeID = null;
		
			jQuery('.translit').on('keyup', function(){
				var $this = jQuery(this);

				if(timeID) clearTimeout(timeID);
				
				timeID = setTimeout(function(){
					jQuery.getJSON('<?=$this->createUrl("translit")?>',{str: $this.val()})
						.done(function(s){
							jQuery('.alias').val(s);
						});
				}, 500);
			});

			jQuery('#Catalog_materials, #Catalog_places').on('selected',function(e){
				var $this = jQuery(this),
					val = parseInt(e.val, 10);

				if(isNaN(val)){
					jQuery.ajax({
						url: $this.closest('.controls').data('url'),
						data: {Tag: e.val},
						type: 'POST',
						dataType: 'json'
					}).done(function(res){

						if(res.id.length && res.data.length){
							var v = $this.val();
							$this.val(v.replace(e.val, res.id));
							$this.select2({tags: res.data, width:'40%'}).trigger('change');
						}
					});
				}
			});
		});
	</script>