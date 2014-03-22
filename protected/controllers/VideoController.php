<?php

class VideoController extends FrontController
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
				'actions'=>array('index','view', 'filter'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionFilter(){

		if(isset($_GET['Filter'])){
			$choice = $_GET['Filter']['choice'];

			$criteria = new CDbCriteria;

			switch ($choice) {
				case 'date':
					$criteria->order = 'create_time DESC';
					break;
				case 'popular':
					$criteria->order = 'rating DESC';
					break;
				case 'all' :
					$criteria->order = 'sort';
					break;
			}

			$data = Video::model()->published()->findAll($criteria);

			$this->renderPartial('_all', array('data' => $data));

			Yii::app()->end();
		}
	}
	
	public function actionIndex()
	{
		// $dataProvider=new CActiveDataProvider('Video');
		// $this->render('index',array(
		// 	'dataProvider'=>$dataProvider,
		// ));

		$data = Video::model()->published()->findAll();

		$this->render('index',array(
			'data'=>$data,
		));
	}
}
