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

<?php

$sc = Yii::app()->clientScript;

$cs->registerScriptFile($this->getAssetsUrl().'/js/slider.js', CClientScript::POS_END);
?>