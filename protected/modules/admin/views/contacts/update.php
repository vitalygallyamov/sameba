<?php
$this->breadcrumbs=array(
	"{$data['model']->translition()}"=>array($this->createUrl('update', array('id' => $data['model']->id))),
	'Редактирование',
);

$this->menu=array(
	// array('label'=>'Список', 'url'=>array('list')),
	// array('label'=>'Добавить','url'=>array('create')),
);
?>

<h1><?php echo $data['model']->translition(); ?> - Редактирование</h1>

<?php echo $this->renderPartial('_form',array('data'=>$data)); ?>