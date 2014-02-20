<?php

class PagesController extends AdminController
{
	public function actionTranslit($str){
		echo CJSON::encode(SiteHelper::translit($str));
	}

	public function actionCreate(){

		$model = new Pages;

		if(isset($_POST['Pages'])){
			$model->attributes = $_POST['Pages'];

			if($model->save()){

				//add to menu link to page
				if(isset($_POST['addToMenu']) && isset($_POST['menuId'])){
					$menuItem = new MenuItems;

					$menuItem->name = $model->title;
					$menuItem->url = ($model->alias ? '/pages/'.$model->alias : '/pages/'.$model->id);
					$menuItem->status = $model->status;
					$menuItem->menu_id = $_POST['menuId'];

					$menuItem->save();
				}

				$this->redirect($this->createUrl('list'));
			}
				
		}

		$this->render('create', array('model'=>$model));
	}

	// public function actionUpdate($id){

	// 	$model = Pages::model()->findByPk($id);

	// 	if(isset($_POST['Pages'])){
	// 		$model->attributes = $_POST['Pages'];

	// 		if($model->save())
	// 			$this->redirect($this->createUrl('list', $filter));
	// 	}

	// 	$this->render('update', array('model'=>$model));
	// }
}
