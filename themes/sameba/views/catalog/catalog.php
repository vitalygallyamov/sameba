<?php

$cs = Yii::app()->clientScript;

$cs->registerScriptFile($this->getAssetsUrl().'/js/vendor/jquery.mousewheel.js', CClientScript::POS_END);
$cs->registerScriptFile($this->getAssetsUrl().'/js/vendor/jquery.jscrollpane.min.js', CClientScript::POS_END);
$cs->registerScriptFile($this->getAssetsUrl().'/js/vendor/fancybox/jquery.fancybox.js', CClientScript::POS_END);

$cs->registerCssFile($this->getAssetsUrl().'/css/jquery.jscrollpane.css');
$cs->registerCssFile($this->getAssetsUrl().'/js/vendor/fancybox/jquery.fancybox.css');
?>
<section class="catalog">
    <div class="clearfix">
        <h1><?=CHTml::encode($category->name)?></h1>
        <nav class="top-menu no">
            <ul class="clearfix">
                <?
                $sub_cats = array();
                $rootlink = null;

                if($category->children){
                    $sub_cats = $category->children;
                    $rootlink = $this->createUrl('catalog/view', array('category'=>$category->alias));
                }elseif($category->cat_parent){
                    $sub_cats = $category->cat_parent->children;
                    $rootlink = $this->createUrl('catalog/view', array('category'=>$category->cat_parent->alias));
                }
                ?>

                <?foreach ($sub_cats as $child) {?>
                    <li <?=($category->alias == $child->alias ? 'class="active"' : '')?>><a href="<?=$this->createUrl('catalog/view', array('category'=>$child->alias))?>"><?=CHTml::encode($child->name)?></a></li>
                <?}?>
                <li <?=(!$category->cat_parent ? 'class="active"' : '')?>><a href="<?=$rootlink?>">все</a></li>
            </ul>
        </nav>
    </div>
    <div class="catalog-wrap">
        <div class="catalog-items scroll-pane-arrows">
            <?php $this->renderPartial('_all', array('data' => $data, 'category'=>$category)); ?>
        </div>
    </div>
</section>