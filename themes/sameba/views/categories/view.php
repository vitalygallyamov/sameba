<?php
$this->breadcrumbs=array(
	'Categories'=>array('index'),
	$model->name,
);

<h1>View Categories #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'alias',
		'parent',
		'level',
		'video_id',
		'seo_id',
		'status',
		'sort',
		'create_time',
		'update_time',
	),
)); ?>
