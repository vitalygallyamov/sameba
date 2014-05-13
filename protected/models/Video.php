<?php

/**
* This is the model class for table "{{video}}".
*
* The followings are the available columns in table '{{video}}':
    * @property integer $id
    * @property string $name
    * @property string $video_id
    * @property string $desc
    * @property string $video_image
    * @property integer $status
    * @property integer $sort
    * @property string $create_time
    * @property string $update_time
*/
class Video extends EActiveRecord
{
    public function tableName()
    {
        return '{{video}}';
    }


    public function rules()
    {
        return array(
            array('video_id', 'required'),
            array('status, sort, on_main, rating', 'numerical', 'integerOnly'=>true),
            array('name, video_id, video_image, url, img_video', 'length', 'max'=>255),
            array('desc, create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, name, video_id, desc, video_image, status, sort, rating, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
        );
    }

    public function scopes()
    {
        return array_merge(array(
            'on_main' => array(
                'condition' => 't.on_main=1',
            )), parent::scopes()
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Название видео',
            'video_id' => 'VID',
            'desc' => 'Описание',
            'video_image' => 'Превью видео',
            'url' => 'Ссылка',
            'status' => 'Статус',
            'sort' => 'Вес для сортировки',
            'rating' => 'Рейтинг',
            'on_main' => 'Показывать на главной',
            'img_video' => 'Обложка',
            'create_time' => 'Дата создания',
            'update_time' => 'Дата последнего редактирования',
        );
    }


    public function behaviors()
    {
        return CMap::mergeArray(parent::behaviors(), array(
            'imgBehaviorVideo' => array(
                'class' => 'application.behaviors.UploadableImageBehavior',
                'attributeName' => 'img_video',
                'versions' => array(
                    'mini' => array(
                        'adaptiveResize' => array(240, 100),
                    ),
                    'small' => array(
                        'adaptiveResize' => array(100, 70),
                    ),
                    'middle' => array(
                        'adaptiveResize' => array(300, 300),
                    ),
                    'big' => array(
                        'resize' => array(1000, 1000),
                    ),
                    'xbig' => array(
                        'resize' => array(1500, 1500),
                    ),
                ),
            ),
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
		$criteria->compare('video_id',$this->video_id,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('video_image',$this->video_image,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
        $criteria->order = 'create_time DESC';
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
        return 'Видео';
    }


}
