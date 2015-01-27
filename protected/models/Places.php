<?php

/**
* This is the model class for table "{{places}}".
*
* The followings are the available columns in table '{{places}}':
    * @property integer $id
    * @property string $name
    * @property string $coords
*/
class Places extends EActiveRecord
{
    public function tableName()
    {
        return '{{places}}';
    }


    public function rules()
    {
        return array(
            array('name', 'required'),
            array('sort, on_main', 'numerical', 'integerOnly'=>true),
            array('name, coords', 'length', 'max'=>255),
            // The following rule is used by search().
            array('id, name, coords, sort', 'safe', 'on'=>'search'),
        );
    }

    public function scopes()
    {
        return array(
            'bySort' => array(
                'order'=>'sort'
            ),
            'withCoords'=>array(
                'condition'=>'coords!=""',
                'order'=>'sort'
            )
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
            'name' => 'Название',
            'coords' => 'Координаты',
            'sort' => 'Вес для сортировки',
            'on_main' => 'На главной'
        );
    }


    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
        $criteria->compare('coords',$this->coords,true);
        $criteria->compare('coords',$this->sort);
		$criteria->compare('on_main',$this->sort);
        $criteria->order='sort';
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
        return 'Адреса магазинов';
    }

    public static function getListForSelect(){
        $data = Yii::app()->db->createCommand()
            ->select('id, name as text')
            ->from('{{places}}')
            ->queryAll();

        foreach ($data as $item) {
            $item['id'] = (int) $item['id'];
        }

        return $data;
    }

    public static function getAllOnMain(){
        return self::model()->bySort()->findAll('on_main=1');
    }

    public function beforeSave(){

        /*if($this->on_main == 1){
            self::model()->updateAll(array('on_main' => 0));
        }*/

        return parent::beforeSave();
    }
}
