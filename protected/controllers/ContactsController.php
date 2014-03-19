<?php

class ContactsController extends FrontController
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
				'actions'=>array('index', 'view'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionView($id){
		$model = Contacts::model()->findByPk(1);
		$places = Places::model()->withCoords()->findAll();

		$start_place = Places::model()->findByPk($id);

		if(!$start_place)
			throw new CHttpException(404, 'Не найдено.');

		$this->render('index',array(
			'model'=>$model,
			'places'=>$places,
			'start_place' => $start_place
		));
	}

	
	public function actionIndex($id=null)
	{
		$model = Contacts::model()->findByPk(1);
		$places = Places::model()->withCoords()->findAll();

		$this->render('index',array(
			'model'=>$model,
			'places'=>$places
		));
	}
}
