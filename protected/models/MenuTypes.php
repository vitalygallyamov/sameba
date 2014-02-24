<?php

/**
* This is the model class for table "{{menu_types}}".
*
* The followings are the available columns in table '{{menu_types}}':
    * @property integer $id
    * @property string $name
    * @property string $uniq_name
*/
class MenuTypes extends EActiveRecord
{
    public function tableName()
    {
        return '{{menu_types}}';
    }

    public function rules()
    {
        return array(
            array('name, uniq_name', 'required'),
            array('name, uniq_name', 'length', 'max'=>255),
            // The following rule is used by search().
            array('id, name, uniq_name', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            'items' => array(self::HAS_MANY, 'MenuItems', 'menu_id')
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Название',
            'uniq_name' => 'Уникальное имя',
        );
    }


    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('uniq_name',$this->uniq_name,true);
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
        return 'Список меню';
    }

    public static function getList(){
        $criteria = new CDbCriteria;

        $criteria->select = 'id, name';

        return self::model()->findAll($criteria);
    }
}
