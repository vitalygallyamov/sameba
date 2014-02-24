<?php

/**
* This is the model class for table "{{menu_items}}".
*
* The followings are the available columns in table '{{menu_items}}':
    * @property integer $id
    * @property string $name
    * @property string $url
    * @property integer $menu_id
    * @property integer $status
    * @property integer $sort
    * @property string $create_time
    * @property string $update_time
*/
class MenuItems extends EActiveRecord
{
    public function tableName()
    {
        return '{{menu_items}}';
    }

    public function defaultScope()
    {
        return array(
            'condition' => "status=1"
        );
    }

    public function rules()
    {
        return array(
            array('name, url', 'required'),
            array('menu_id, status, sort', 'numerical', 'integerOnly'=>true),
            array('name, url', 'length', 'max'=>255),
            array('create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, name, url, menu_id, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            'menu' => array(self::BELONGS_TO, 'MenuTypes', 'menu_id')
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Название',
            'url' => 'Ссылка',
            'menu_id' => 'Меню',
            'status' => 'Статус',
            'sort' => 'Вес для сортировки',
            'create_time' => 'Дата создания',
            'update_time' => 'Дата последнего редактирования',
        );
    }


    public function behaviors()
    {
        return CMap::mergeArray(parent::behaviors(), array(
        			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'create_time',
                'updateAttribute' => 'update_time',
			),
        ));
    }
    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('menu_id',$this->menu_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
        $criteria->order = 'sort';
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
        return 'Разделы меню';
    }


}
