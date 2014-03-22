<?php

class ContactsController extends AdminController
{
	public function actionUpdate($id){

		$model = Contacts::model()->findByPk($id);

		$phones = $model->phones;
		$socials = $model->socials;

		if(isset($_POST['Contacts'])){
			$model->attributes = $_POST['Contacts'];

			//phones
			if(isset($_POST['Phones']) && !empty($_POST['Phones'])){
				
				foreach ($_POST['Phones'] as $k => $phone) {
					$phone_model = new Phones;
					if(isset($phone['id']) && !empty($phone['id'])) $phone_model = Phones::model()->findByPk($phone['id']);

					$phone_model->attributes = $phone;
					$phone_model->save();
				}
			}

			//socials
			if(isset($_POST['Socials']) && !empty($_POST['Socials'])){
				
				foreach ($_POST['Socials'] as $k => $soc) {
					$soc_model = Socials::model()->findByPk($soc['id']);

					$soc_model->attributes = $soc;
					$soc_model->save(false);
				}
			}

			if($model->save()){
				$this->redirect($this->createUrl('update', array('id' => $id)));
			}
				
		}

		$data = array(
			'model' => $model,
			'phones' => $phones,
			'socials' => $socials,
		);

		$this->render('update', array('data'=>$data));
	}

	public function actionAddPhoneRow($index){
		$model = new Phones;
		$model->page = 1;

		$this->renderPartial('/phones/_rows', array('model' => $model, 'index' => $index));

		Yii::app()->end();
	}

	public function actionAddSocRow($index){
		$model = new Socials;
		$model->page = 1;

		$this->renderPartial('/socials/_rows', array('model' => $model, 'index' => $index));

		Yii::app()->end();
	}

	public function actionDeletePhone($id){
		$model = Phones::model()->findByPk($id);

		if($model) $model->delete();

		Yii::app()->end();
	}
}
