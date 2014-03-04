<section class="main-page">
    <?foreach ($items as $key => $item):?>
        <?if($item instanceof Catalog):?>
        <div class="front-block n<?=$key?>" style="background-image: url('<?=$item->gallery->main->getUrl('xbig')?>');<?=($key != 0 ? ' display: none;' : '')?>">
            <div class="product-info">
                <h1><?=CHtml::encode($item->name)?></h1>
                <div class="desc">
                    <?=$item->wswg_desc?>
                </div>
                <div class="price">От <?=CHtml::encode(number_format($item->price, 0, '', ' '))?> руб.</div>
                <a href="<?=Yii::app()->createUrl('catalog/view', array('category' => $item->category->alias, 'alias' => $item->alias))?>" class="view">подробнее</a>
            </div>
        </div>
        <?endif;?>
        <?if($item instanceof Video):?>
        <div class="front-block n<=$key?>" style="background-image: url('<?=$item->getImageUrl('xbig')?>');<?=($key != 0 ? ' display: none;' : '')?>">
            <div class="video"><div id="video-<?=$item->video_id?>"></div></div>
            <div class="play" data-id="<?=$item->id?>" data-videoid="<?=$item->video_id?>"></div>
        </div>
        <?endif;?>
    <?endforeach;?>
    <div class="main-page-nav">
        <?foreach ($items as $key => $item):?>
            <?if($item instanceof Catalog):?>
            <div class="item">
                <img src="<?=$item->gallery->main->getUrl('mini')?>" alt="">
                <div class="info<?=($key == 0 ? ' active' : '')?>">
                    <div class="title"><?=CHtml::encode($item->name)?></div>
                </div>
            </div>
            <?endif;?>
            <?if($item instanceof Video):?>
            <div class="item video" style="background-image: url('<?=$item->getImageUrl('mini')?>');>">
                <div class="info<?=($key == 0 ? ' active' : '')?>">
                    <div class="title video"><?=CHtml::encode($item->name)?></div>
                </div>
            </div>
            <?endif;?>
        <?endforeach;?>
    </div>
</section>
<?/*
<div class="slider-wrap">
    <div class="slider-images">
        <img src="<?=$this->getAssetsUrl()?>/img/slide1.jpg" alt="">
        <img src="<?=$this->getAssetsUrl()?>/img/slide2.jpg" alt="">
        <img src="http://placehold.it/1100" alt="">
        <img src="http://placehold.it/1100/fecfec" alt="">
        <img src="http://placehold.it/1100/fffeee&text=Hello" alt="">
    </div>
    <div class="slider-nav">
        <div class="slider-progress"></div>
        <div class="slides-info clearfix">
            <div class="info">
                <h1>Кухни 1</h1>
                <div class="desc">
                    По индивидуальному заказу, <span>от 25 000 руб</span>.
                </div>
                <a class="view" href="#"><i></i> подробнее</a>
            </div>
            <div class="info">
                <h1>Кухни 2</h1>
                <div class="desc">
                    По индивидуальному заказу, <span>от 25 000 руб</span>.
                </div>
                <a class="view" href="#"><i></i> подробнее</a>
            </div>
            <div class="info">
                <h1>Кухни 3</h1>
                <div class="desc">
                    По индивидуальному заказу, <span>от 25 000 руб</span>.
                </div>
                <a class="view" href="#"><i></i> подробнее</a>
            </div>
            <div class="info">
                <h1>Кухни 4</h1>
                <div class="desc">
                    По индивидуаль заказу, <span>от 25 000 руб</span>.
                </div>
                <a class="view" href="#"><i></i> подробнее</a>
            </div>
            <div class="info">
                <h1>Кухни 5</h1>
                <div class="desc">
                    По индивидуальному заказу, <span>от 25 000 руб</span>.
                </div>
                <a class="view" href="#"><i></i> подробнее</a>
            </div>
            <div class="slider-pager">
                <a class="arrow top" href="#">&nbsp;</a>
                <ul>
                    <li></li>
                </ul>
                <a class="arrow bottom" href="#">&nbsp;</a>
            </div>
        </div>
    </div>
</div>
*/?>
<?php

$cs = Yii::app()->clientScript;

$cs->registerScriptFile($this->getAssetsUrl().'/js/slider.js', CClientScript::POS_END);
$cs->registerScriptFile('https://www.youtube.com/iframe_api', CClientScript::POS_END);
//http://www.youtube.com/apiplayer?enablejsapi=1&version=3

?>