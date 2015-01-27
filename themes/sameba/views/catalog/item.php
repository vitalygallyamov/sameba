<?php

$cs = Yii::app()->clientScript;

$cs->registerScriptFile($this->getAssetsUrl().'/js/vendor/jquery.mousewheel.js', CClientScript::POS_END);
$cs->registerScriptFile($this->getAssetsUrl().'/js/vendor/jquery.jscrollpane.min.js', CClientScript::POS_END);
$cs->registerScriptFile($this->getAssetsUrl().'/js/vendor/fancybox/jquery.fancybox.js', CClientScript::POS_END);

$cs->registerCssFile($this->getAssetsUrl().'/css/jquery.jscrollpane.css');
$cs->registerCssFile($this->getAssetsUrl().'/js/vendor/fancybox/jquery.fancybox.css');

$count = 0;
?>

<section class="catalog item">
    <div class="row">
        <div class="col-sm-4 photos">
            <div class="main">
                <a class="fancybox" rel="images" href="<?=$model->gallery->main->getUrl('big')?>"><img src="<?=$model->gallery->main->getUrl('middle')?>" alt=""></a>
            </div>
            <div class="ph-row">
                <?foreach ($model->gallery->photos_not_main as $photo):?>
                   <div class="ph-item">
                        <a class="fancybox" rel="images" href="<?=$photo->getUrl('big')?>"><img src="<?=$photo->getUrl('small')?>" alt=""></a>
                    </div>
                    <?$count++;if($count % 3 === 0) echo '</div><div class="ph-row">';?>
                <?endforeach;?>
            </div>
        </div>
        <div class="col-sm-8 item-wrap">
            <div class="item-info scroll-pane-arrows">
                <div class="back">
                    <a href="<?=$this->createUrl('view', array('category' => $category->alias))?>" class="back-button">Вернуться</a>
                </div>
                <h1><?=CHtml::encode($model->name)?></h1>
                <div class="param"><span>Артикул:</span> <?=CHtml::encode($model->art_id)?></div>
                <?/*<div class="price">Цена от: <strong><?=CHtml::encode(number_format($model->price, 0, '',' '))?> руб</strong>.</div>*/?>
                <?if($model->wswg_desc):?>
                <div class="desc line">
                    <?=$model->wswg_desc?>
                </div>
                <?endif;?>
                <?if($model->price_desc):?>
                <div class="param line"><span>Услуги:</span> <?=$model->price_desc?></div>
                <?endif;?>
                <?if($model->getMaterials()):?>
                <div class="param line"><span>Список материалов:</span> <?=implode(', ', CHtml::listData($model->getMaterials(), 'id', 'name'))?>.</div>
                <?endif;?>
                
                <?if($model->getPlaces()):?>
                <div class="param line">
                    <span>Где заказать:</span>
                    <?foreach ($model->getPlaces() as $place):?>
                        <a href="/contacts/<?=$place->id?>"><span class="span place"><i></i> <?=CHtml::encode($place->name)?></span></a>
                    <?endforeach;?>
                </div>
                <?endif;?>
               
                <?if($model->period):?>
                <?/*<div class="param line"><span>Срок изготовления:</span> <?=Yii::t('app', '{n} день|{n} дня|{n} дней', $model->period);?>.</div>*/?>
                <div class="param line"><span>Срок изготовления:</span> <?=CHtml::encode($model->period)?></div>
                <?endif;?>
            </div>
        </div>
    </div>
</section>