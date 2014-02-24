<?php
    $count = 0;
?>
<div class="row">
	<?foreach ($data as $item) {?>
		<div class="col-sm-4">
            <a class="fancybox fancybox.iframe" href="http://www.youtube.com/embed/<?=CHtml::encode($item->video_id)?>"><img src="<?=CHtml::encode($item->video_image)?>" alt=""></a>
            <div class="desc"><a class="fancybox fancybox.iframe view" href="http://www.youtube.com/embed/<?=CHtml::encode($item->video_id)?>"></a><?=CHtml::encode($item->desc)?></div>
        </div>
	<?	$count++;
		if($count % 3 === 0) echo '</div><div class="row">'; 
	}?>
</div>