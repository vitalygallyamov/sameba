<?php

class CatalogController extends AdminController
{
	public function actionTranslit($str){
		echo CJSON::encode(SiteHelper::translit($str));
	}
}
