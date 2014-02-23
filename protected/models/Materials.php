<?php

/**
* This is the model class for table "{{materials}}".
*
* The followings are the available columns in table '{{materials}}':
    * @property integer $id
    * @property string $name
*/
class Materials extends EActiveRecord
{
    public function tableName()
    {
        return '{{materials}}';
    }

    public function rules()
    {
        return array(
            array('name', 'required'),
            array('name', 'length', 'max'=>255),
            array('name', 'unique'),
            // The following rule is used by search().
            array('id, name', 'safe', 'on'=>'search'),
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
        );
    }


    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
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
        return 'Справочник материалов';
    }

    public static function getListForSelect(){
        $data = Yii::app()->db->createCommand()
            ->select('id, name as text')
            ->from('{{materials}}')
            ->queryAll();

        foreach ($data as $item) {
            $item['id'] = (int) $item['id'];
        }

        return $data;
    }
}
