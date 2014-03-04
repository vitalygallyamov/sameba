<?php

/**
* This is the model class for table "{{catalog}}".
*
* The followings are the available columns in table '{{catalog}}':
    * @property integer $id
    * @property string $name
    * @property string $alias
    * @property integer $gllr_gallery
    * @property integer $category_id
    * @property string $art_id
    * @property string $price
    * @property string $wswg_desc
    * @property integer $seo_id
    * @property integer $period
    * @property string $materials
    * @property string $places
    * @property integer $status
    * @property integer $sort
    * @property string $create_time
    * @property string $update_time
*/
class Catalog extends EActiveRecord
{
    public function tableName()
    {
        return '{{catalog}}';
    }


    public function rules()
    {
        return array(
            array('gllr_gallery, category_id, seo_id, period, status, sort, on_main', 'numerical', 'integerOnly'=>true),
            array('name, alias, art_id, materials, places', 'length', 'max'=>255),
            array('price', 'length', 'max'=>10),
            array('wswg_desc, create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, name, alias, gllr_gallery, category_id, art_id, price, wswg_desc, seo_id, period, materials, places, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
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


    public function relations()
    {
        return array(
            'category' => array(self::BELONGS_TO, 'Categories', 'category_id')
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Название',
            'alias' => 'Алиас',
            'gllr_gallery' => 'Галерея',
            'category_id' => 'Категория',
            'art_id' => 'Артикул',
            'price' => 'Цена от',
            'wswg_desc' => 'Описание',
            'seo_id' => 'SEO',
            'period' => 'Срок изготоваления',
            'materials' => 'Материалы',
            'places' => 'Где купить',
            'status' => 'Статус',
            'sort' => 'Вес для сортировки',
            'on_main' => 'Показывать на главной',
            'create_time' => 'Дата создания',
            'update_time' => 'Дата последнего редактирования',
        );
    }


    public function behaviors()
    {
        return CMap::mergeArray(parent::behaviors(), array(
        	'galleryBehaviorGallery' => array(
				'class' => 'appext.imagesgallery.GalleryBehavior',
				'idAttribute' => 'gllr_gallery',
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
				'name' => true,
				'description' => true,
			),
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
		$criteria->compare('gllr_gallery',$this->gllr_gallery);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('art_id',$this->art_id,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('wswg_desc',$this->wswg_desc,true);
		$criteria->compare('seo_id',$this->seo_id);
		$criteria->compare('period',$this->period);
		$criteria->compare('materials',$this->materials,true);
		$criteria->compare('places',$this->places,true);
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
        return 'Каталог';
    }

    //from materials table
    public function getMaterials(){
        if(!$this->materials)
            return '';

        $m = explode(',', $this->materials);

        $criteria = new CDbCriteria;
        $criteria->addInCondition('id', $m);

        $data = Materials::model()->findAll($criteria);

        return $data;
    }

    //from places table
    public function getPlaces(){
        if(!$this->places)
            return '';

        $m = explode(',', $this->places);

        $criteria = new CDbCriteria;
        $criteria->addInCondition('id', $m);

        $data = Places::model()->findAll($criteria);

        return $data;
    }

    public static function onMainList(){
        return array(
            0 => 'Нет',
            1 => 'Да'
        );
    }
}
