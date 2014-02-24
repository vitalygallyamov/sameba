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
        <h1>Видео</h1>
       
        <nav class="top-menu">
            <ul class="clearfix">    
                <li><a href="#">Дате</a></li>
                <li><a href="#">Популярности</a></li>
                <li class="active"><a href="#">все</a></li>
            </ul>
        </nav>
        <div class="text">Показать по:</div>
        <form class="filter" action="<?=$this->createUrl('filter')?>" style="display: none;">
        	<input type="radio" name="Filter[choice]" value="date">
        	<input type="radio" name="Filter[choice]" value="popular">
        	<input type="radio" name="Filter[choice]" value="all" checked>
        </form>
    </div>
    <div class="catalog-wrap">
        <div class="catalog-items scroll-pane-arrows">
            <?php $this->renderPartial('_all', array('data' => $data)); ?>
        </div>
    </div>
</section>