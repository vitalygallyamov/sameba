<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'contacts-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
		'enctype' => 'multipart/form-data'
	)
)); ?>

	<?php echo $form->errorSummary($data['model']); ?>

	<?php $tabs = array(); ?>
	<?php $tabs[] = array('label' => 'Основные данные', 'content' => $this->renderPartial('_rows', array('form'=>$form, 'data' => $data), true), 'active' => true); ?>
	<?php $tabs[] = array('label' => 'SEO раздел', 'content' => $this->getSeoForm($data['model'])); ?>

	<?php $this->widget('bootstrap.widgets.TbTabs', array( 'tabs' => $tabs)); ?>

	<div class="form-actions">
		<?php echo TbHtml::submitButton('Сохранить', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
        <?php //echo TbHtml::linkButton('Отмена', array('url'=>'/admin/contacts/list')); ?>
	</div>

<?php $this->endWidget(); ?>
