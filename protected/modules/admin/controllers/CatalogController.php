<?php

class CatalogController extends AdminController
{
	public function actionTranslit($str){
		echo CJSON::encode(SiteHelper::translit($str));
	}

	public function actionChangeProp($id, $prop='status'){
		$model = Catalog::model()->findByPk($id);

		if(!$model) 
			Yii::app()->end(404);

		if(isset($_POST['val'])){
			$val = intval($_POST['val']);
			
			if(is_int($val)){
				$model->{$prop} = $_POST['val'];
				$model->save(false);
			}
		}

		Yii::app()->end();
	}

	public function gridStatus($data, $row){
		return $this->widget("yiiwheels.widgets.switch.WhSwitch", array(
			"id" => "s_status".$data->id,
			"model" => $data,
			"attribute" => "status",
			'onLabel' => 'Да',
			'offLabel' => 'Нет',
			"events" => array(
				'change' => 'js:function(e){
					var $this = jQuery(this),
						value = "";

					if($this.find(".switch-on").length) value = 1;
					if($this.find(".switch-off").length) value = 0;

					jQuery.ajax({
						url: "'.$this->createUrl('changeProp', array('id' => $data->id)).'",
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

	public function gridOnMain($data, $row){
		return $this->widget("yiiwheels.widgets.switch.WhSwitch", array(
			"id" => "s_main".$data->id,
			"model" => $data,
			"attribute" => "on_main",
			'onLabel' => 'Да',
			'offLabel' => 'Нет',
			"events" => array(
				'change' => 'js:function(e){
					var $this = jQuery(this),
						value = "";

					if($this.find(".switch-on").length) value = 1;
					if($this.find(".switch-off").length) value = 0;

					jQuery.ajax({
						url: "'.$this->createUrl('changeProp', array('id' => $data->id, 'prop' => 'on_main')).'",
						type: "POST",
						data: {val: value}
					});
				}'
			),
			'htmlOptions' => array(
				"checked" => $data->on_main == 1 ? "checked" : ""
			)
		), true);
	}
}
