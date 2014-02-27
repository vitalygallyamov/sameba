<?php
$cs = Yii::app()->clientScript;

$cs->registerScriptFile('http://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU', CClientScript::POS_HEAD);

$cs->registerScriptFile($this->getAssetsUrl().'/js/map.js', CClientScript::POS_END);

?>
<section class="contacts" data-point-img="<?=$this->getAssetsUrl()?>/img/point.png">
    <div id="map" class="map">
    </div>
    <div class="info">
        <h1><?=CHtml::encode($model->title)?></h1>
        <div class="item phone"><i></i>+7 3452 700 899</div>
        <div class="item email"><i></i>mail@sameba.ru</div>
        <div class="socials">
            <a href="#" class="fb"></a>
            <a href="#" class="vk"></a>
            <a href="#" class="tw"></a>
            <a href="#" class="od"></a>
        </div>
    </div>
    <ul class="places">
        <li>
            <?foreach ($places as $i => $place):?>
                <a <?=($i == 0 ? 'class="active"' : '')?> href="#" data-coords="[<?=CHtml::encode($place->coords)?>]"><?=CHtml::encode($place->name)?><?=($i == 0 ? '<span class="arr"></span>' : '')?></a>
            <?endforeach;?>
        </li>
    </ul>
</section>