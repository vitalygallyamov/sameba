<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class FrontController extends Controller
{
    public $layout='//layouts/simple';
    public $menu=array();
    public $breadcrumbs=array();

    public function init() {
        parent::init();
        $this->title = Yii::app()->name;
    }

    //Check home page
    public function is_home(){
        return $this->route == 'site/index';
    }

    public function beforeRender($view)
    {
        //get all menu
        $menu_types = MenuTypes::model()->findAll();
        $this->renderPartial('//layouts/_menu', array('menu_types' => $menu_types));

        //get all categories
        $categories = Categories::model()->published()->findAll('parent=0');
        $this->renderPartial('//layouts/_categories', array('categories' => $categories));

        return parent::beforeRender($view);
    }
}