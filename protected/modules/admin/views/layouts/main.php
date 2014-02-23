<!DOCTYPE html>
<html lang="en">
	<head>
	  <meta charset="utf-8">
	  <title><?php echo CHtml::encode(Yii::app()->name).' | Admin';?></title>
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
	  
		<?php
			$menuItems = array(
                // array('label'=>'Главная', 'url'=>'/admin/start/index'),
				array('label'=>'Страницы', 'url'=>'/admin/pages'),
				array('label'=>'Меню', 'url'=>'#', 'items' => array(
					array('label'=>'Список меню', 'url'=>"/admin/menuTypes/list"),
					array('label'=>'Добавить меню', 'url'=>"/admin/menuTypes/create"),
					array('label'=>'Разделы меню', 'url'=>"/admin/menuItems/list"),
					array('label'=>'Добавить раздел', 'url'=>"/admin/menuItems/create"),
				)),
				array('label'=>'Каталог', 'url'=>'/admin/catalog'),
				array('label'=>'Категории', 'url'=>'/admin/categories'),
				array('label'=>'Видео', 'url'=>'/admin/video'),
				// array('label'=>'Разделы', 'url'=>'#', 'items' => array(
					// array('label'=>'Пример', 'url'=>'#', 'items' => array(
					// 	array('label'=>'Создать', 'url'=>"/admin/brands/create"),
					// 	array('label'=>'Список', 'url'=>"/admin/brands/list"),
					// )),
				// )),
			);
		?>
		<?php $this->widget('bootstrap.widgets.TbNavbar', array(
			'color'=>'inverse', // null or 'inverse'
			'brandLabel'=> CHtml::encode(Yii::app()->name),
			'brandUrl'=>'/',
			'fluid' => true,
			'collapse'=>true, // requires bootstrap-responsive.css
			'items'=>array(
				array(
					'class'=>'bootstrap.widgets.TbNav',
					'items'=>$menuItems,
				),
				array(
					'class'=>'bootstrap.widgets.TbNav',
					'htmlOptions'=>array('class'=>'pull-right'),
					'items'=>array(
						array('label'=>'Настройки', 'url'=>'/admin/settings'),
						array('label'=>'Выйти', 'url'=>'/admin/user/logout'),
					),
				),
			),
		)); ?>

		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span1">
				<?php $this->widget('bootstrap.widgets.TbNav', array(
					'type' => TbHtml::NAV_TYPE_TABS,
					'stacked' => true,
					'items'=> $this->menu
					)); ?>
				</div>
				<div class="span11">
					<?php echo $content;?>
				</div>
			</div>
		</div>

	</body>
</html>
