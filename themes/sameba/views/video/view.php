<?php
$this->breadcrumbs=array(
	'Videos'=>array('index'),
	$model->name,
);

<h1>View Video #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'video_id',
		'desc',
		'video_image',
		'url',
		'status',
		'sort',
		'create_time',
		'update_time',
	),
)); ?>
