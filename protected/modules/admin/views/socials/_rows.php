<div class="row-fluid soc">
	<div class="span3">
		<?php echo TbHtml::activeTextField($model,"[$index]name"); ?>
	</div>
	<?/*<div class="span3">
		<div class='control-group'>
			<?php echo TbHtml::activeLabelEx($model, '[$index]img_preview'); ?>
			<?php echo TbHtml::activeFileField($model,'[$index]img_preview'); ?>
			<div class='img_preview'>
				<?php if ( !empty($model->img_preview) ) echo TbHtml::imageRounded( $model->imgBehaviorPreview->getImageUrl('small') ) ; ?>
				<span class='deletePhoto btn btn-danger btn-mini' data-modelname='Socials' data-attributename='Preview' <?php if(empty($model->img_preview)) echo "style='display:none;'"; ?>><i class='icon-remove icon-white'></i></span>
			</div>
			<?php echo TbHtml::error($model, '[$index]img_preview'); ?>
		</div>
	</div>*/?>
	<div class="span3">
		<?php echo TbHtml::activeTextField($model,"[$index]url"); ?>
	</div>
</div>
	<?php echo TbHtml::activeHiddenField($model,"[$index]page"); ?>
	<?php echo TbHtml::activeHiddenField($model,"[$index]img_preview"); ?>
	<?php echo TbHtml::activeHiddenField($model,"[$index]id"); ?>

	<?php //echo $form->textFieldControlGroup($model,'name',array('class'=>'span8','maxlength'=>255)); ?>

	<?php //echo $form->textFieldControlGroup($model,'url',array('class'=>'span8','maxlength'=>255)); ?>

