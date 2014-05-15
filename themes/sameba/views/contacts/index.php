<?php
$cs = Yii::app()->clientScript;

$cs->registerScriptFile('http://api-maps.yandex.ru/2.1/?lang=ru_RU', CClientScript::POS_HEAD);

$cs->registerScriptFile($this->getAssetsUrl().'/js/map.js', CClientScript::POS_END);

?>
<section class="contacts" data-point-img="<?=$this->getAssetsUrl()?>/img/point.png">
    <div class="info">
        <h1><?=CHtml::encode($model->title)?></h1>
		<?foreach ($model->phones as $phone) {?>
			<div class="item phone"><i></i><?=CHtml::encode($phone->phone)?></div>
		<?}?>
        <?if($model->email):?>
        <div class="item email"><i></i><?=CHtml::encode($model->email)?></div>
        <?endif;?>
        <div class="socials">
        	<?foreach ($model->socials as $soc) {?>
            <a target="_blank" href="<?=CHtml::encode($soc->url)?>" class="<?=CHtml::encode($soc->img_preview)?>"></a>
            <?}?>
        </div>
    </div>
    <div id="map" class="map"></div>
    <ul class="places"<?=isset($start_place) ? ' data-begin="'.$start_place->id.'"' : ''?>>
        <?foreach ($places as $i => $place):?>
            <li><a <?=($i == 0 ? 'class="active"' : '')?> href="#" data-id="<?=$place->id?>" data-coords="[<?=CHtml::encode($place->coords)?>]"><?=CHtml::encode($place->name)?><?=($i == 0 ? '<span class="arr"></span>' : '')?></a></li>
        <?endforeach;?>
    </ul>
</section>