<?php

/**
* This is the model class for table "{{socials}}".
*
* The followings are the available columns in table '{{socials}}':
    * @property integer $id
    * @property string $name
    * @property string $img_preview
    * @property string $url
    * @property integer $page
*/
class Socials extends EActiveRecord
{
    public function tableName()
    {
        return '{{socials}}';
    }


    public function rules()
    {
        return array(
            array('img_preview, url', 'required'),
            array('page', 'numerical', 'integerOnly'=>true),
            array('name, img_preview, url', 'length', 'max'=>255),
            // The following rule is used by search().
            array('id, name, img_preview, url, page', 'safe', 'on'=>'search'),
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
            'img_preview' => 'Изображение',
            'url' => 'Ссылка',
            'page' => 'Страница',
        );
    }


    public function behaviors()
    {
        return CMap::mergeArray(parent::behaviors(), array(
        	'imgBehaviorPreview' => array(
				'class' => 'application.behaviors.UploadableImageBehavior',
				'attributeName' => 'img_preview',
				'versions' => array(
					'icon' => array(
						'centeredpreview' => array(90, 90),
					),
					'small' => array(
						'resize' => array(200, 180),
					)
				),
			),
        ));
    }
    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('img_preview',$this->img_preview,true);
		$criteria->compare('url',$this->url,true);
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


}
