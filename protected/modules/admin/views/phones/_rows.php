	<div class="row-fluid phone">
		<div class="span3">
			<?php
			$this->widget('CMaskedTextField', array(
				'model' => $model,
				'attribute' => "[$index]phone",
				'mask' => '+7 (999) 999-99-99',
				'htmlOptions' => array('class' => 'mask')
			));
			?>
		</div>
		<div class="span2">
			<?php echo TbHtml::activeHiddenField($model,"[$index]on_main", array('class' => 'on-main')); ?>
			<?php echo TbHtml::activeRadioButton($model,"on_main", array('class' => 'change-on-main')); ?>
		</div>
		<div class="span1">
			<?php echo TbHtml::button('Удалить', array('class' => 'remove-phone', 'color' => TbHtml::BUTTON_COLOR_DANGER, 'data-id' => $model->id)); ?>
		</div>
	</div>
	
	<?php echo TbHtml::activeHiddenField($model,"[$index]page"); ?>
	<?php echo TbHtml::activeHiddenField($model,"[$index]id"); ?>

