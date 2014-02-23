<?php

class MaterialsController extends AdminController
{	
	private $_model = 'Materials';

	public function actionAddTag(){
		
		if(isset($_POST['Tag']) && !empty($_POST['Tag'])){

			$model = Materials::model()->find('name=:name', array(':name' => $_POST['Tag']));

			if(!$model){
				$model = new $this->_model;
				$model->name = $_POST['Tag'];
				$model->save();
			}

			$result = array('id' => $model->id, 'data' => Materials::getListForSelect());
			echo CJSON::encode((object) $result);
		}

		Yii::app()->end();
	}
}