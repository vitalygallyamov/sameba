<?php

class CatalogController extends AdminController
{
	public function actionTranslit($str){
		echo CJSON::encode(SiteHelper::translit($str));
	}

	public function actionChangeStatus($id){
		$model = Catalog::model()->findByPk($id);

		if(!$model) 
			Yii::app()->end(404);

		if(isset($_POST['val'])){
			$val = intval($_POST['val']);
			
			if(is_int($val)){
				$model->status = $_POST['val'];
				$model->save(false);
			}
		}

		Yii::app()->end();
	}

	public function gridStatus($data, $row){
		return $this->widget("yiiwheels.widgets.switch.WhSwitch", array(
			"model" => $data,
			"attribute" => "status",
			"events" => array(
				'change' => 'js:function(e){
					var $this = jQuery(this),
						value = "";

					if($this.find(".switch-on").length) value = 1;
					if($this.find(".switch-off").length) value = 0;

					jQuery.ajax({
						url: "'.$this->createUrl('changeStatus', array('id' => $data->id)).'",
						type: "POST",
						data: {val: value}
					});
				}'
			),
			'htmlOptions' => array(
				"checked" => $data->status == Catalog::STATUS_PUBLISH ? "checked" : ""
			)
		), true);
	}
}
