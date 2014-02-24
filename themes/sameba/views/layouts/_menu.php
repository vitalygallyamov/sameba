<?foreach ($menu_types as $menu) {?>
	<?php $this->beginClip($menu->uniq_name); ?>
	<ul>
		<?foreach ($menu->items as $item) {
			echo '<li><a href="'.$item->url.'">'.$item->name.'</a></li>';
		}?>
	</ul> 	
	<?php $this->endClip(); ?>
<?}?>
