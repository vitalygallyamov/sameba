<?php $this->beginClip('categories'); ?>
<ul class="categories collapse">
	<?foreach ($categories as $root) {
		$isChildren = (boolean) $root->children;
		$name = CHtml::encode($root->name);
		$alias = CHtml::encode($root->alias);
	?>
		<li class="root<?=($isChildren ? ' sub' : '')?>"><a href="<?=Yii::app()->createUrl('catalog/view', array('category' => $alias))?>"><?=$name?></a>
		<?if($isChildren){?>
			<ul class="sub-categories">
				<?foreach ($root->children as $child) {
					$name = CHtml::encode($child->name);
					$alias = CHtml::encode($child->alias);
				?>
					<li><a href="<?=Yii::app()->createUrl('catalog/view', array('category' => $alias))?>"><?=$name?></a></li>
				<?}?>
	        </ul>
		<?}?>
		</li>
	<?}?>
</ul>
<?php $this->endClip(); ?>
