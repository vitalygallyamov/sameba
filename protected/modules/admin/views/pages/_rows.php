	<?php echo $form->textFieldControlGroup($model,'title',array('class'=>'span8 translit','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'alias',array('class'=>'span8 alias','maxlength'=>255)); ?>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'wswg_body'); ?>
		<?php $this->widget('appext.ckeditor.CKEditorWidget', array('model' => $model, 'attribute' => 'wswg_body',
		)); ?>
		<?php echo $form->error($model, 'wswg_body'); ?>
	</div>

	<?php echo $form->dropDownListControlGroup($model, 'status', Pages::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>

	<?if($model->isNewRecord):?>
		<?php echo TbHtml::checkBox('addToMenu', false, array('label' => 'Добавить в меню')); ?>
		<?php echo TbHtml::dropDownListControlGroup('menuId', '', CHtml::listData(MenuTypes::getList(), 'id', 'name')); ?>
	<?endif;?>
	<script>
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
	</script>