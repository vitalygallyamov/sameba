<?php

/**
* This is the model class for table "{{categories}}".
*
* The followings are the available columns in table '{{categories}}':
    * @property integer $id
    * @property string $name
    * @property string $alias
    * @property integer $parent
    * @property integer $level
    * @property integer $video_id
    * @property integer $seo_id
    * @property integer $status
    * @property integer $sort
    * @property string $create_time
    * @property string $update_time
*/
class Categories extends EActiveRecord
{
    public function tableName()
    {
        return '{{categories}}';
    }


    public function rules()
    {
        return array(
            array('name', 'required'),
            array('parent, level, video_id, seo_id, status, sort', 'numerical', 'integerOnly'=>true),
            array('name, alias', 'length', 'max'=>255),
            array('create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, name, alias, parent, level, video_id, seo_id, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            'cat_parent' => array(self::BELONGS_TO, 'Categories', 'parent'),
            'children' => array(self::HAS_MANY, 'Categories', 'parent')
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Название категории',
            'alias' => 'Алиас',
            'parent' => 'Родительская категория',
            'level' => 'Уровень вложенности',
            'video_id' => 'Видео',
            'seo_id' => 'Seo данные',
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
			'Seo' => array(
				'class' => 'application.behaviors.SeoBehavior',
			),
        ));
    }
    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('alias',$this->alias,true);
		// $criteria->compare('parent',$this->parent);
        $this->parent = '';
		// $criteria->compare('level',$this->level);
		$criteria->compare('video_id',$this->video_id);
		$criteria->compare('seo_id',$this->seo_id);
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
        return 'Категории';
    }

    public static function allCategories($categories = array(), &$result = array()){

        $categories = ( $categories ? $categories : self::model()->findAll('parent=0') );

        foreach ($categories as $item) {

            if($item->level != 1)
                $result[$item->id] = str_repeat('-', $item->level).' '.$item->name;
            else 
                $result[$item->id] = $item->name;

            if($item->children) 
                self::allCategories($item->children, $result);
        }

        return array_merge(array(0 => 'Нет'), $result);
    }

    public function beforeSave(){
        
        if($this->cat_parent){
            $this->level = $this->cat_parent->level + 1;
        }

        return parent::beforeSave();
    }

}
