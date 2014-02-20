	<?php echo $form->textFieldControlGroup($model,'name',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'url',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->dropDownListControlGroup($model,'menu_id', CHtml::listData(MenuTypes::getList(), 'id', 'name')); ?>
	<?php echo $form->dropDownListControlGroup($model, 'status', MenuItems::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>
