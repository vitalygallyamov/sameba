<?php
$this->breadcrumbs=array(
	'Catalogs'=>array('index'),
	$model->name,
);

<h1>View Catalog #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'alias',
		'gllr_gallery',
		'category_id',
		'art_id',
		'price',
		'wswg_desc',
		'seo_id',
		'period',
		'materials',
		'places',
		'status',
		'sort',
		'create_time',
		'update_time',
	),
)); ?>
