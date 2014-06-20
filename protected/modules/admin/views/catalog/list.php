<?php
$this->menu=array(
	array('label'=>'Добавить','url'=>array('create')),
);
?>

<h1>Управление <?php echo $model->translition(); ?></h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'catalog-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
    'afterAjaxUpdate'=>"function() {sortGrid('catalog'); $('.make-switch')['bootstrapSwitch'](); }",
    'rowHtmlOptionsExpression'=>'array(
        "id"=>"items[]_".$data->id,
        "class"=>"status_".(isset($data->status) ? $data->status : ""),
    )',
	'columns'=>array(
		'name',
		// 'alias',
		// 'gllr_gallery',
		array(
			'name' => 'category_id',
			'type' => 'raw',
			'value' => '$data->category ? $data->category->name : "Не установлена"',
			'filter' => Categories::allCategories()
		),
		'art_id',
		'price_desc',
		/*array(
			'name' => 'price',
			'type' => 'raw',
			'value' => 'number_format($data->price, 0, " ", "")." руб."'
		),*/
		// 'seo_id',
		'period',
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
			'filter'=>Catalog::getStatusAliases()
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

<?php if($model->hasAttribute('sort')) Yii::app()->clientScript->registerScript('sortGrid', 'sortGrid("catalog");', CClientScript::POS_END) ;?>