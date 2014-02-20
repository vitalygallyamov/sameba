<?php

class CategoriesController extends AdminController
{
	public function actionTranslit($str){
		echo CJSON::encode(SiteHelper::translit($str));
	}
}
