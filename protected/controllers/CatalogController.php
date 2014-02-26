<?php

class CatalogController extends FrontController
{
	public $layout='//layouts/simple';

	
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	//view all catalog or one item from catalog
	public function actionView($category, $alias='')
	{
		$data = Catalog::model()->published()->findAll();
		$cat = Categories::model()->published()->find('alias=:alias', array(':alias' => $category));

		if(!$cat)
			throw new CHttpException(404,'Страница не найдена');

		if($alias) {
			$model = null;

			if(is_numeric($alias))
				$model = Catalog::model()->published()->findByPk($alias);
			else
				$model = Catalog::model()->published()->find('alias=:alias', array(':alias' => $alias));

			if($model)
				$this->render('item', array('model' => $model, 'category' => $cat));
			return;
		}

		$this->render('catalog',array(
			'data'=>$data,
			'category'=>$cat
		));
	}

	
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Catalog');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
}
