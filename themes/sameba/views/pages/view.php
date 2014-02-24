<?php
$this->breadcrumbs=array(
	'Pages'=>array('index'),
	$model->title,
);

<h1>View Pages #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'alias',
		'wswg_body',
		'seo_id',
		'status',
		'sort',
		'create_time',
		'update_time',
	),
)); ?>
