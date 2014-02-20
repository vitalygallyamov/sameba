<?if(!empty($video)){?>
	<?php echo TbHtml::mediaList(array(
	    array('image' => $video['thumbnail_url'], 'heading' => $video['title'], 'content' => $video['desc'])
	)); ?>
<?}?>
