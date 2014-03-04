<?php
$this->menu=array(
	array('label'=>'Добавить','url'=>array('create')),
);
?>

<h1>Управление <?php echo $model->translition(); ?></h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'video-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
    'afterAjaxUpdate'=>"function() {sortGrid('video')}",
    'rowHtmlOptionsExpression'=>'array(
        "id"=>"items[]_".$data->id,
        "class"=>"status_".(isset($data->status) ? $data->status : ""),
    )',
	'columns'=>array(
		array(
			'name'=>'video_image',
			'type'=>'html',
			'value'=>'CHtml::image($data->video_image, "", array("width" => 150))',
			'filter' => false
		),
		'name',
		// 'video_id',
		array(
			'name'=>'on_main',
			'type'=>'raw',
			'value'=>array($this,'gridOnMain'),
			'filter'=>Catalog::onMainList()
		),
		array(
			'header' => 'Активность',
			'name'=>'status',
			'type'=>'raw',
			'value'=>array($this,'gridStatus'),
			'filter'=>Video::getStatusAliases()
		),
		/*'sort',
		array(
			'name'=>'create_time',
			'type'=>'raw',
			'value'=>'$data->create_time ? SiteHelper::russianDate($data->create_time).\' в \'.date(\'H:i\', strtotime($data->create_time)) : ""'
		),
		array(
			'name'=>'update_time',
			'type'=>'raw',
			'value'=>'$data->update_time ? SiteHelper::russianDate($data->update_time).\' в \'.date(\'H:i\', strtotime($data->update_time)) : ""'
		),*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>

<?php if($model->hasAttribute('sort')) Yii::app()->clientScript->registerScript('sortGrid', 'sortGrid("video");', CClientScript::POS_END) ;?>