<?php

$cs = Yii::app()->clientScript;

$cs->registerScriptFile($this->getAssetsUrl().'/js/vendor/jquery.mousewheel.js', CClientScript::POS_END);
$cs->registerScriptFile($this->getAssetsUrl().'/js/vendor/jquery.jscrollpane.min.js', CClientScript::POS_END);
$cs->registerCssFile($this->getAssetsUrl().'/css/jquery.jscrollpane.css');
?>
<section class="page">
	<div class="row">
		<div class="span12">
			<h1><?=CHtml::encode($model->title)?></h1>
		</div>
	</div>
	<div class="catalog-wrap desc">
		<div class="span12 scroll-pane-arrows catalog-items">
			<?=$model->wswg_body?>
		</div>
	</div>
</section>
