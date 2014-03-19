<?php

/**
* This is the model class for table "{{contacts}}".
*
* The followings are the available columns in table '{{contacts}}':
    * @property integer $id
    * @property string $title
    * @property integer $seo_id
*/
class Contacts extends EActiveRecord
{
    public function tableName()
    {
        return '{{contacts}}';
    }


    public function rules()
    {
        return array(
            array('seo_id', 'numerical', 'integerOnly'=>true),
            array('title, email', 'length', 'max'=>255),
            array('email', 'email'),
            // The following rule is used by search().
            array('id, title, seo_id', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            'phones' => array(self::HAS_MANY, 'Phones', 'page'),
            'socials' => array(self::HAS_MANY, 'Socials', 'page')
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'title' => 'Название раздела',
            'seo_id' => 'SEO раздел',
            'email' => 'E-mail'
        );
    }


    public function behaviors()
    {
        return CMap::mergeArray(parent::behaviors(), array(
        	'Seo' => array(
				'class' => 'application.behaviors.SeoBehavior',
			),
        ));
    }
    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
        $criteria->compare('title',$this->title,true);
		$criteria->compare('email',$this->title,true);
		$criteria->compare('seo_id',$this->seo_id);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function translition()
    {
        return 'Контакты';
    }

}
