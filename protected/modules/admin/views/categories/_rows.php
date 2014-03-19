	<?php echo $form->textFieldControlGroup($model,'name',array('class'=>'span8 translit','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'alias',array('class'=>'span8 alias','maxlength'=>255)); ?>

	<?php echo $form->dropDownListControlGroup($model,'parent', Categories::allCategories()); ?>
	<?php 
	//echo $form->dropDownListControlGroup($model,'parent',); ?>

	<?php echo $form->dropDownListControlGroup($model,'video_id', array('' => 'Нет') + CHtml::listData(Video::model()->findAll(), 'id', 'name'), array('class' => 'span8')); ?>

	<?php echo $form->dropDownListControlGroup($model, 'status', Categories::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>
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