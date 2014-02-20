<?php

class MenuItemsController extends AdminController
{
	public function actionCreate(){

		$request = Yii::app()->request;
		$menu_id = $request->getQuery('menu_id');

		$model = new MenuItems;

		$filter = array();
		if($menu_id) {
			$model->menu_id = $menu_id;
			$filter['MenuItems'] = array('menu_id' => $menu_id);
		}

		if(isset($_POST['MenuItems'])){
			$model->attributes = $_POST['MenuItems'];

			if($model->save())
				$this->redirect($this->createUrl('list', $filter));
			//MenuItems
		}

		$this->render('create', array('model'=>$model));
	}
}
