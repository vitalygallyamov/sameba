<?php

class PagesController extends FrontController
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

	
	public function actionView($alias)
	{
		$model = null;

		if(is_int($alias))
			$model = Pages::model()->findByPk($alias);
		else
			$model = Pages::model()->find('alias=:alias', array(':alias' => $alias));

		if(!$model)
			throw new CHttpException(404, 'Unable to find the requested object.');


		if($alias == 'contacts'){

			$places = Places::model()->withCoords()->findAll();
			$this->render('contacts',array(
				'model'=>$model,
				'places' => $places
			));
		}else
			$this->render('view',array(
				'model'=>$model,
			));
		
	}

	
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Pages');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
}
