<?php

/**
* This is the model class for table "{{phones}}".
*
* The followings are the available columns in table '{{phones}}':
    * @property integer $id
    * @property string $phone
    * @property integer $on_main
    * @property integer $page
*/
class Phones extends EActiveRecord
{
    public function tableName()
    {
        return '{{phones}}';
    }


    public function rules()
    {
        return array(
            array('phone', 'required'),
            array('on_main, page', 'numerical', 'integerOnly'=>true),
            array('phone', 'length', 'max'=>255),
            // The following rule is used by search().
            array('id, phone, on_main, page', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'phone' => 'Телефон',
            'on_main' => 'На главной',
            'page' => 'Страница',
        );
    }


    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('on_main',$this->on_main);
		$criteria->compare('page',$this->page);
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
        return 'Телефоны';
    }

    public static function getPhone(){
        $model = self::model()->find('on_main=1');

        return $model->phone;
    }
}
