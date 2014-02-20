<?php
$this->menu=array(
	array('label'=>'Добавить','url'=>array('create')),
);
?>

<h1>Управление <?php echo $model->translition(); ?></h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'menu-types-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
    'afterAjaxUpdate'=>"function() {sortGrid('menutypes')}",
    'rowHtmlOptionsExpression'=>'array(
        "id"=>"items[]_".$data->id,
        "class"=>"status_".(isset($data->status) ? $data->status : ""),
    )',
	'columns'=>array(
		'name',
		'uniq_name',
		array(
            'header'  => '',
            'value' => 'CHtml::link("Добавить раздел", Yii::app()->createUrl("/admin/menuItems/create", array("menu_id" => $data->id)))',
            'type'  => 'html',
        ), 
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{view} {update} {delete}',
			'buttons' => array(
				'view' => array(
					'url'=>'Yii::app()->createUrl("/admin/menuItems/list", array("MenuItems"=>array("menu_id" => $data->id)))',
				)
			)
		),
	),
)); ?>

<?php if($model->hasAttribute('sort')) Yii::app()->clientScript->registerScript('sortGrid', 'sortGrid("menutypes");', CClientScript::POS_END) ;?>