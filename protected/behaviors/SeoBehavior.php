<?php

class SeoBehavior extends CActiveRecordBehavior
{
	public function attach($owner) {
        parent::attach($owner);
        $owner->metaData->addRelation('seo', array($owner::BELONGS_TO, 'Seo', 'seo_id'));
	}

	public function beforeSave($event){
		parent::beforeSave($event);
		$owner = $this->getOwner();

		if($owner->metaData->hasRelation('seo')){
            $seo = new Seo;

            if(isset($owner->seo_id)){
                $seo = Seo::model()->findByPk($owner->seo_id);
            }

            if(isset($_POST['Seo'])){
	            $seo->attributes = $_POST['Seo'];
	            if($seo->save()) {
	                $owner->seo_id = $seo->id;
	            }
	        }
        }
	}
	
}