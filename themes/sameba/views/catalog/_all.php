<?php
    $count = 0;
?>
<div class="row">
    <?if($category->video){?>
        <div class="col-sm-4">
            <a class="fancybox fancybox.iframe" href="http://www.youtube.com/embed/<?=CHtml::encode($category->video->video_id)?>"><img src="<?=CHtml::encode($category->video->video_image)?>" alt=""></a>
            <div class="desc"><a class="fancybox fancybox.iframe view" href="http://www.youtube.com/embed/<?=CHtml::encode($category->video->video_id)?>"></a><?=CHtml::encode($category->video->desc)?></div>
        </div>
    <? $count++; }?>
    <?foreach ($data as $item) {?>
        <div class="col-sm-4">
            <a href="<?=$this->createUrl('view', array('category' => $category->alias, 'alias' => $item->alias))?>"><img src="<?=$item->gallery->main->getUrl('middle')?>" alt=""></a>
            <div class="desc">
                <a href="<?=$this->createUrl('view', array('category' => $category->alias, 'alias' => $item->alias))?>" class="view"></a>
                <div class="id"><?=CHtml::encode($item->art_id)?></div>
                <div class="title"><?=CHtml::encode($item->name)?></div>
                <div class="price">от <?=CHtml::encode(number_format($item->price,0,'',' '))?> руб.</div>
            </div>
        </div>
    <?  $count++;
        if($count % 3 === 0) echo '</div><div class="row">'; 
    }?>
</div>
<?/*<div class="row">
    
    <div class="col-sm-4">
        <a href="#"><img src="img/tmp/item1.png" alt=""></a>
        <div class="desc">
            <a href="#" class="view"></a>
            <div class="id">2347658</div>
            <div class="title">Название позиции</div>
            <div class="price">от 32 000 руб.</div>
        </div>
    </div>
    <div class="col-sm-4">
        <a href="#"><img src="http://placehold.it/310x220" alt=""></a>
        <div class="desc">
            <a href="#" class="view"></a>
            <div class="id">2347658</div>
            <div class="title">Название позиции</div>
            <div class="price">от 32 000 руб.</div>
        </div>
    </div>
</div>*/?>